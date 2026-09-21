<?php

namespace App\Http\Controllers;

use App\Models\category_document;
use App\Models\course;
use App\Models\document;
use App\Models\group_prople;
use App\Models\level_document;
use App\Models\sent_office;
use App\Models\sub_document;
use App\Models\sub_title_document;
use App\Models\title_document;
use App\Models\type_document;
use App\Models\type_quality;
use App\Models\year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DocumentController extends Controller
{
    private const FILE_RULE = 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:51200';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('member-permission');
    }

    public function index($mode = 'document', $id = '')
    {
        abort_unless(in_array($mode, ['document', 'course'], true), 404);
        $types = type_document::where('mode', $mode)->orderBy('ordinal')->get();
        $model = $mode === 'course' ? course::class : document::class;
        $item = $id !== '' ? $model::findOrFail($id) : null;
        if ($mode === 'document' && $item && $item->type_quality_id) {
            $types = type_document::where('type_quality_id', $item->type_quality_id)->orderBy('ordinal')->get();
        }
        $items = $model::orderBy('id', 'desc')->get();

        return view('backend.'.$mode.'.document', array_merge($this->showMenuv1(), [
            'data_document' => $items, 'document' => $item, 'type_document' => $types,
            'sent_office' => sent_office::all(), 'years' => year::orderBy('year', 'desc')->get(),
            'groups' => group_prople::where('borad_id', 3)->orderBy('ordinal')->get(),
            'sub_document' => $mode === 'document' && $item ? sub_document::where('document_id', $item->id)->get() : collect(),
        ]));
    }

    public function edit($id)
    {
        return $this->index('document', $id);
    }

    public function quality_index($id = '')
    {
        $item = $id !== ''
            ? document::whereNotNull('type_quality_id')->findOrFail($id)
            : null;
        $items = document::whereNotNull('type_quality_id')->orderByDesc('id')->get();
        foreach ($items as $row) {
            $row->number_sub_document = sub_document::where('document_id', $row->id)->count();
        }

        $qualities = type_quality::orderBy('id')->get();
        $selectedQuality = $item?->type_quality_id ?? $qualities->first()?->id;
        $types = type_document::whereNotNull('type_quality_id')
            ->when($selectedQuality, fn ($query) => $query->where('type_quality_id', $selectedQuality))
            ->orderBy('ordinal')
            ->get();

        return view('backend.quality.document', array_merge($this->showMenuv1(), [
            'data_document' => $items,
            'document' => $item,
            'type_document' => $types,
            'type_qualities' => $qualities,
            'selected_quality_id' => $selectedQuality,
            'sent_office' => sent_office::all(),
            'years' => year::when($selectedQuality, fn ($query) => $query->where('type_quality_id', $selectedQuality))->orderByDesc('year')->get(),
            'groups' => group_prople::where('borad_id', 3)->orderBy('ordinal')->get(),
            'sub_document' => $item ? sub_document::where('document_id', $item->id)->get() : collect(),
        ]));
    }

    public function quality_edit($id)
    {
        return $this->quality_index($id);
    }

    protected function validateHierarchy(Request $request): void
    {
        $request->validate([
            'type_document_id' => 'nullable|integer|exists:type_documents,id',
            'category_document_id' => ['nullable', 'integer', Rule::exists('category_documents', 'id')->where('type_document_id', $request->type_document_id)],
            'title_document_id' => ['nullable', 'integer', Rule::exists('title_documents', 'id')->where('category_document_id', $request->category_document_id)->where('type_document_id', $request->type_document_id)],
            'sub_title_document_id' => ['nullable', 'integer', Rule::exists('sub_title_documents', 'id')->where('title_document_id', $request->title_document_id)->where('category_document_id', $request->category_document_id)->where('type_document_id', $request->type_document_id)],
        ]);
    }

    public function document_insert(Request $request)
    {
        $request->validate([
            'document_id' => 'nullable|integer|exists:documents,id', 'name' => 'required|string|max:250',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'filename' => 'nullable|'.self::FILE_RULE,
            'multifilename' => 'nullable|array', 'multifilename.*' => 'nullable|'.self::FILE_RULE,
            'multiname' => 'nullable|array', 'multiname.*' => 'nullable|string|max:250',
            'link' => 'nullable|string|max:255', 'detail' => 'nullable|string',
            'ordinal' => 'nullable|integer|min:0', 'status_use' => 'nullable|boolean',
            'number_document' => 'nullable|string|max:255', 'year' => 'nullable|digits:4',
            'sent_office_id' => 'nullable|integer|exists:sent_offices,id',
            'level_document_id' => 'nullable|integer|exists:level_documents,id',
            'type_quality_id' => 'nullable|integer|exists:type_qualities,id',
        ]);
        $this->validateHierarchy($request);
        if ($request->filled('type_quality_id') && $request->filled('type_document_id')) {
            $qualityType = type_document::findOrFail($request->type_document_id);
            if ((int) $qualityType->type_quality_id !== (int) $request->type_quality_id
                || ($request->filled('year') && (string) $qualityType->year !== (string) $request->year)) {
                throw ValidationException::withMessages([
                    'type_document_id' => 'ประเภทเอกสารไม่ตรงกับรูปแบบประกันคุณภาพหรือปีที่เลือก',
                ]);
            }
        }
        $item = $request->filled('document_id') ? document::findOrFail($request->document_id) : new document;
        $item->{$item->exists ? 'member_id_update' : 'member_id_create'} = session('user.member_id');
        foreach (['name', 'link', 'detail', 'number_document', 'year', 'type_quality_id', 'sent_office_id', 'level_document_id', 'type_document_id', 'category_document_id', 'title_document_id', 'sub_title_document_id'] as $field) {
            if ($request->has($field)) {
                $item->$field = $request->input($field);
            }
        }
        if ($request->filled('type_document_id')) {
            $type = type_document::findOrFail($request->type_document_id);
            if (! $request->has('type_quality_id')) {
                $item->type_quality_id = $type->type_quality_id;
            }
            if (! $request->has('year')) {
                $item->year = $type->year;
            }
        }
        $item->status_use = $request->input('status_use') ?? ($item->getAttributes()['status_use'] ?? 1);
        $item->ordinal = $request->input('ordinal') ?? $item->ordinal ?? 0;
        if ($request->has('date_announcement')) {
            $item->date_announcement = $this->documentDate($request->date_announcement);
        }
        $newFiles = $oldFiles = [];
        try {
            DB::transaction(function () use ($item, $request, &$newFiles, &$oldFiles) {
                $this->replaceUpload($item, 'thumbnail', $request->file('image_name'), 'document_img', $newFiles, $oldFiles);
                $this->replaceUpload($item, 'file', $request->file('filename'), 'document', $newFiles, $oldFiles);
                $item->save();
                foreach ($request->file('multifilename', []) as $key => $file) {
                    if (! $file) {
                        continue;
                    }
                    $attachment = new sub_document;
                    $attachment->document_id = $item->id;
                    $attachment->name = $request->input('multiname.'.$key) ?: $file->getClientOriginalName();
                    $attachment->status_use = $item->status_use;
                    $attachment->member_id_create = session('user.member_id');
                    $this->replaceUpload($attachment, 'file', $file, 'sub_document/'.$item->id, $newFiles, $oldFiles);
                    $attachment->save();
                }
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($newFiles);
            throw $exception;
        }
        Storage::disk('public')->delete($oldFiles);

        return redirect()->route('document.index');
    }

    public function document_update(Request $request)
    {
        if (! $request->filled('document_id')) {
            $request->merge(['document_id' => $request->id]);
        }
        $request->validate(['document_id' => 'required|integer|exists:documents,id']);

        return $this->document_insert($request);
    }

    protected function documentDate($value): ?string
    {
        if (! $value) {
            return null;
        }
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value, $parts)) {
            [, $year, $month, $day] = $parts;
        } elseif (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $parts)) {
            [, $month, $day, $year] = $parts;
        } else {
            throw ValidationException::withMessages(['date_announcement' => 'Invalid date.']);
        }
        $year = (int) $year > 2500 ? (int) $year - 543 : (int) $year;
        if (! checkdate((int) $month, (int) $day, $year)) {
            throw ValidationException::withMessages(['date_announcement' => 'Invalid date.']);
        }

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    protected function replaceUpload($model, $column, $file, $directory, array &$newFiles, array &$oldFiles): void
    {
        if (! $file) {
            return;
        }
        $path = $file->store($directory, 'public');
        if (! $path) {
            throw new \RuntimeException('Unable to store uploaded file.');
        }
        $newFiles[] = $path;
        if ($model->$column) {
            $oldFiles[] = $directory.'/'.$model->$column;
        }
        $model->$column = basename($path);
    }

    protected function attachmentPaths(sub_document $item): array
    {
        // Older single-file forms saved attachments directly in sub_document.
        return $item->file ? ['sub_document/'.$item->document_id.'/'.$item->file, 'sub_document/'.$item->file] : [];
    }

    public function delete_document($id = '')
    {
        $item = document::findOrFail($id);
        $files = [];
        if ($item->thumbnail) {
            $files[] = 'document_img/'.$item->thumbnail;
        }
        if ($item->file) {
            $files[] = 'document/'.$item->file;
        }
        foreach (sub_document::where('document_id', $id)->get() as $attachment) {
            $files = array_merge($files, $this->attachmentPaths($attachment));
        }
        DB::transaction(function () use ($item) {
            sub_document::where('document_id', $item->id)->delete();
            $item->delete();
        });
        Storage::disk('public')->delete($files);

        return redirect()->route('document.index');
    }

    public function sub_document($id = '')
    {
        return view('backend.document.document_sub', array_merge($this->showMenuv1(), [
            'document' => document::findOrFail($id), 'sub_document' => sub_document::where('document_id', $id)->get(),
            'sent_office' => sent_office::all(), 'levels' => level_document::all(),
        ]));
    }

    public function sub_document_insert(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|exists:sub_documents,id', 'document_id' => 'required|integer|exists:documents,id',
            'name' => 'required|string|max:250', 'filename' => 'required_without:id|nullable|'.self::FILE_RULE,
            'status_use' => 'nullable|boolean', 'number_document' => 'nullable|string|max:255',
            'sent_office_id' => 'nullable|integer|exists:sent_offices,id',
            'level_document_id' => 'nullable|integer|exists:level_documents,id',
        ]);
        $item = $request->filled('id') ? sub_document::where('document_id', $request->document_id)->findOrFail($request->id) : new sub_document;
        $item->{$item->exists ? 'member_id_update' : 'member_id_create'} = session('user.member_id');
        $oldFiles = $request->hasFile('filename') ? $this->attachmentPaths($item) : [];
        $newFiles = [];
        $item->name = $request->name;
        $item->document_id = $request->document_id;
        $item->status_use = $request->input('status_use') ?? ($item->getAttributes()['status_use'] ?? 1);
        foreach (['number_document', 'sent_office_id', 'level_document_id'] as $field) {
            if ($request->has($field)) {
                $item->$field = $request->input($field);
            }
        }
        if ($request->has('date_announcement')) {
            $item->date_announcement = $this->documentDate($request->date_announcement);
        }
        try {
            $this->replaceUpload($item, 'file', $request->file('filename'), 'sub_document/'.$item->document_id, $newFiles, $oldFiles);
            $item->save();
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($newFiles);
            throw $exception;
        }
        Storage::disk('public')->delete($oldFiles);

        return redirect()->route('sub_document.show', $item->document_id);
    }

    public function delete_sub_document($id = '')
    {
        $item = sub_document::findOrFail($id);
        $files = $this->attachmentPaths($item);
        $parent = $item->document_id;
        $item->delete();
        Storage::disk('public')->delete($files);

        return redirect()->route('sub_document.show', $parent);
    }

    public function sent_office(Request $request)
    {
        $request->validate(['id' => 'nullable|integer|exists:sent_offices,id']);

        return $this->index()->with('editing_office', $request->filled('id') ? sent_office::findOrFail($request->id) : null);
    }

    public function sent_office_insert(Request $request)
    {
        $request->validate(['sent_office_id' => 'nullable|integer|exists:sent_offices,id', 'name' => 'required|string|max:250', 'fullname' => 'required|string|max:250', 'address' => 'required|string|max:255']);
        $item = $request->filled('sent_office_id') ? sent_office::findOrFail($request->sent_office_id) : new sent_office;
        foreach (['name', 'fullname', 'address'] as $field) {
            $item->$field = $request->input($field);
        }
        $item->save();

        return redirect()->route('document.index');
    }

    public function sent_office_update(Request $request)
    {
        if (! $request->filled('sent_office_id')) {
            $request->merge(['sent_office_id' => $request->id]);
        }
        $request->validate(['sent_office_id' => 'required|integer|exists:sent_offices,id']);

        return $this->sent_office_insert($request);
    }

    public function delete_sent_office($id = '')
    {
        $item = sent_office::findOrFail($id);
        abort_if(document::where('sent_office_id', $id)->exists() || sub_document::where('sent_office_id', $id)->exists(), 422, 'This office is used by documents.');
        $item->delete();

        return redirect()->route('document.index');
    }

    protected function options($rows, $value = 'id'): string
    {
        return $rows->map(fn ($row) => '<option value="'.e($row->$value).'" data-ordinal="'.e($row->ordinal ?? 0).'">'.e($value === 'year' ? $row->year : trim(($row->code ?? '').' '.$row->name)).'</option>')->implode('');
    }

    public function fetch_year(Request $request)
    {
        return $this->options(year::where('type_quality_id', $request->value)->orderByDesc('year')->get(), 'year');
    }

    public function fetch_type_document(Request $request)
    {
        $query = type_document::query();
        if ($request->select === 'year' || $request->source === 'year') {
            if ($request->filled('value')) {
                $query->where('year', $request->value);
            }
            if ($request->filled('type_quality_id')) {
                $query->where('type_quality_id', $request->type_quality_id);
            }
        } else {
            $query->where('type_quality_id', $request->value);
        }
        if ($request->filled('base')) {
            $query->where('mode', $request->base);
        }

        return $this->options($query->orderBy('ordinal')->get());
    }

    public function fetch_category_document(Request $request)
    {
        return $this->options(category_document::where('type_document_id', $request->value)->orderBy('ordinal')->get());
    }

    public function fetch_title_document(Request $request)
    {
        return $this->options(title_document::where('category_document_id', $request->value)->orderBy('ordinal')->get());
    }

    public function fetch_sub_title_document(Request $request)
    {
        return $this->options(sub_title_document::where('title_document_id', $request->value)->orderBy('ordinal')->get());
    }

    public function fetch_dataAll_document(Request $request)
    {
        $models = ['type' => type_document::class, 'category' => category_document::class, 'title' => title_document::class, 'Subtitle' => sub_title_document::class, 'SubTitle' => sub_title_document::class];
        $request->validate(['mode' => ['required', Rule::in(array_keys($models))], 'id' => 'required|integer']);
        $row = $models[$request->mode]::findOrFail($request->id);

        return [
            'Subtitle' => $row instanceof sub_title_document ? $row : null,
            'title' => $row instanceof title_document ? $row : title_document::find($row->title_document_id),
            'category' => $row instanceof category_document ? $row : category_document::find($row->category_document_id),
            'type' => $row instanceof type_document ? $row : type_document::find($row->type_document_id),
            'year' => $row->year,
        ];
    }

    public function setting_all($mode = 'document', $year = '')
    {
        if ($mode === 'qualities') {
            return view('backend.quality.setting', array_merge($this->showMenuv1(), [
                'qualities' => type_quality::orderBy('id')->get(),
            ]));
        }

        $quality = is_numeric($mode) ? $mode : null;
        if ($quality !== null) {
            $mode = 'report';
        }
        $mode = $mode ?: 'document';
        abort_unless(in_array($mode, ['document', 'course', 'report'], true), 404);
        $years = year::when($quality !== null, fn ($q) => $q->where('type_quality_id', $quality))->orderBy('year')->get();
        $year = $year ?: ($years->last()?->year ?? '');
        $types = type_document::when($quality !== null, fn ($q) => $q->where('type_quality_id', $quality), fn ($q) => $q->where('mode', $mode))
            ->when($mode === 'report' && $year !== '', fn ($q) => $q->where('year', $year))->orderBy('ordinal')->get();
        foreach ($types as $type) {
            $categories = category_document::where('type_document_id', $type->id)->orderBy('ordinal')->get();
            foreach ($categories as $category) {
                $titles = title_document::where('category_document_id', $category->id)->orderBy('ordinal')->get();
                foreach ($titles as $title) {
                    $title->setRelation('sub_title', sub_title_document::where('title_document_id', $title->id)->orderBy('ordinal')->get());
                }
                $category->setRelation('title', $titles);
            }
            $type->setRelation('category', $categories);
        }

        return view('backend.document.setting_mode', array_merge($this->showMenuv1(), [
            'types' => $types, 'set_document_setting' => $types, 'years' => $years, 'mode' => $mode, 'current_year' => $year,
        ]));
    }

    public function manage_document_insert(Request $request)
    {
        $methods = ['quality' => 'quality_save', 'type' => 'type_document_insert', 'category' => 'category_document_insert', 'title' => 'title_document_insert', 'SubTitle' => 'sub_title_document_insert'];
        $request->validate(['table' => ['required', Rule::in(array_keys($methods))]]);

        return $this->{$methods[$request->table]}($request);
    }

    public function quality_save(Request $request)
    {
        $request->validate([
            'id_quality' => 'nullable|integer|exists:type_qualities,id',
            'name_quality' => 'required|string|max:250',
        ]);
        $quality = $request->filled('id_quality')
            ? type_quality::findOrFail($request->id_quality)
            : new type_quality;
        $quality->name_th = $request->name_quality;
        $quality->save();

        return redirect()->route('document.setting', 'qualities');
    }

    public function quality_delete($id)
    {
        $quality = type_quality::findOrFail($id);
        abort_if(
            type_document::where('type_quality_id', $id)->exists()
                || document::where('type_quality_id', $id)->exists()
                || year::where('type_quality_id', $id)->exists(),
            422,
            'ไม่สามารถลบประเภทประกันคุณภาพที่มีข้อมูลใช้งานอยู่ได้'
        );
        $quality->delete();

        return redirect()->route('document.setting', 'qualities');
    }

    public function type_document_insert(Request $request)
    {
        return $this->saveClassification($request, 'type');
    }

    public function category_document_insert(Request $request)
    {
        return $this->saveClassification($request, 'category');
    }

    public function title_document_insert(Request $request)
    {
        return $this->saveClassification($request, 'title');
    }

    public function sub_title_document_insert(Request $request)
    {
        return $this->saveClassification($request, 'Subtitle');
    }

    protected function saveClassification(Request $request, string $kind)
    {
        if ($kind === 'category') {
            $request->merge(['id_category' => $request->input('id_category', $request->id_Category), 'name_category' => $request->input('name_category', $request->name_Category)]);
        }
        $models = ['type' => type_document::class, 'category' => category_document::class, 'title' => title_document::class, 'Subtitle' => sub_title_document::class];
        $model = $models[$kind];
        $table = (new $model)->getTable();
        $request->validate([
            'id_'.$kind => 'nullable|integer|exists:'.$table.',id', 'name_'.$kind => 'required|string|max:250',
            'year' => 'nullable|digits:4', 'ordinal' => 'nullable|integer|min:0',
            'base' => 'nullable|in:document,course,report', 'type_quality_id' => 'nullable|integer|exists:type_qualities,id',
            'detail_title' => 'nullable|string', 'detail_Subtitle' => 'nullable|string', 'code_Subtitle' => 'nullable|string|max:250',
        ]);
        $row = $request->filled('id_'.$kind) ? $model::findOrFail($request->input('id_'.$kind)) : new $model;
        $row->name = $request->input('name_'.$kind);
        $row->ordinal = $request->input('ordinal') ?? $row->ordinal ?? 0;
        $row->year = $request->input('year', $row->year);
        if ($kind === 'type') {
            $row->mode = $request->input('base') ?? $row->mode ?? 'document';
            $row->type_quality_id = $request->input('type_quality_id', $row->type_quality_id);
        } else {
            $request->validate(['id_type' => 'required|integer|exists:type_documents,id']);
            $parent = type_document::findOrFail($request->id_type);
            // Existing classification nodes stay under their original parent.
            abort_if($row->exists && $row->type_document_id != $parent->id, 422, 'Cannot move a classification to another parent.');
            $row->type_document_id = $parent->id;
            $row->year = $parent->year;
            $row->type_quality_id = $parent->type_quality_id;
            if (in_array($kind, ['title', 'Subtitle'], true)) {
                $request->validate(['id_category' => ['required', Rule::exists('category_documents', 'id')->where('type_document_id', $parent->id)]]);
                abort_if($row->exists && $row->category_document_id != $request->id_category, 422, 'Cannot move a classification to another parent.');
                $row->category_document_id = $request->id_category;
                $row->detail = $request->input('detail_'.$kind);
            }
            if ($kind === 'Subtitle') {
                $request->validate(['id_title' => ['required', Rule::exists('title_documents', 'id')->where('category_document_id', $request->id_category)]]);
                abort_if($row->exists && $row->title_document_id != $request->id_title, 422, 'Cannot move a classification to another parent.');
                $row->title_document_id = $request->id_title;
                $row->code = $request->code_Subtitle;
            }
        }
        $row->save();

        return redirect()->back();
    }

    public function type_document_delete($id = '')
    {
        return $this->deleteClassification('type', $id);
    }

    public function category_document_delete($id = '')
    {
        return $this->deleteClassification('category', $id);
    }

    public function title_document_delete($id = '')
    {
        return $this->deleteClassification('title', $id);
    }

    public function sub_title_document_delete($id = '')
    {
        return $this->deleteClassification('sub_title', $id);
    }

    protected function deleteClassification($kind, $id)
    {
        $models = ['type' => type_document::class, 'category' => category_document::class, 'title' => title_document::class, 'sub_title' => sub_title_document::class];
        $row = $models[$kind]::findOrFail($id);
        $column = $kind.'_document_id';
        abort_if(document::where($column, $id)->exists() || (in_array($kind, ['type', 'category'], true) && course::where($column, $id)->exists()), 422, 'This classification is used by documents.');
        DB::transaction(function () use ($kind, $column, $id, $row) {
            if ($kind !== 'sub_title') {
                sub_title_document::where($column, $id)->delete();
            }
            if (in_array($kind, ['type', 'category'], true)) {
                title_document::where($column, $id)->delete();
            }
            if ($kind === 'type') {
                category_document::where($column, $id)->delete();
            }
            $row->delete();
        });

        return redirect()->back();
    }

    public function year_insert(Request $request)
    {
        $request->validate(['year' => 'required|digits:4', 'mode' => 'nullable|in:document,course,report', 'type_quality_id' => 'nullable|integer|exists:type_qualities,id']);
        $mode = $request->input('mode', 'document');
        $quality = $request->type_quality_id;
        DB::transaction(function () use ($request, $mode, $quality) {
            $scope = fn () => type_document::when($quality !== null, fn ($q) => $q->where('type_quality_id', $quality), fn ($q) => $q->where('mode', $mode));
            $exists = $scope()->where('year', $request->year)->exists();
            $previous = $scope()->where('year', '<', $request->year)->orderByDesc('year')->value('year');
            $yearRow = year::where('year', $request->year)->where('type_quality_id', $quality)->first();
            if (! $yearRow) {
                $yearRow = new year;
                $yearRow->year = $request->year;
                $yearRow->type_quality_id = $quality;
                $yearRow->save();
            }
            if ($exists || ! $previous) {
                return;
            }
            foreach ($scope()->where('year', $previous)->get() as $oldType) {
                $newType = $oldType->replicate();
                $newType->year = $request->year;
                $newType->save();
                foreach (category_document::where('type_document_id', $oldType->id)->get() as $oldCategory) {
                    $newCategory = $oldCategory->replicate();
                    $newCategory->type_document_id = $newType->id;
                    $newCategory->year = $request->year;
                    $newCategory->save();
                    foreach (title_document::where('category_document_id', $oldCategory->id)->get() as $oldTitle) {
                        $newTitle = $oldTitle->replicate();
                        $newTitle->type_document_id = $newType->id;
                        $newTitle->category_document_id = $newCategory->id;
                        $newTitle->year = $request->year;
                        $newTitle->save();
                        foreach (sub_title_document::where('title_document_id', $oldTitle->id)->get() as $oldSub) {
                            $newSub = $oldSub->replicate();
                            $newSub->type_document_id = $newType->id;
                            $newSub->category_document_id = $newCategory->id;
                            $newSub->title_document_id = $newTitle->id;
                            $newSub->year = $request->year;
                            $newSub->save();
                        }
                    }
                }
            }
        });

        return redirect()->back();
    }

    public function insert_course(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|integer|exists:courses,id', 'title' => 'required|string|max:250',
            'title_eng' => 'nullable|string|max:250', 'title_short' => 'nullable|string|max:250', 'title_short_eng' => 'nullable|string|max:250',
            'unit' => 'nullable|string|max:250', 'course_open' => 'nullable|string|max:250', 'occupation' => 'nullable|string', 'detail' => 'nullable|string',
            'group_people_id' => 'nullable|integer|exists:group_proples,id', 'status_use' => 'nullable|boolean',
            'link' => 'nullable|array', 'link.*' => 'nullable|url|max:2048',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);
        $this->validateHierarchy($request);
        $row = $request->filled('course_id') ? course::findOrFail($request->course_id) : new course;
        foreach (['title', 'title_eng', 'title_short', 'title_short_eng', 'unit', 'course_open', 'occupation', 'detail', 'type_document_id', 'category_document_id', 'group_people_id'] as $field) {
            $row->$field = $request->input($field);
        }
        $row->status_use = $request->input('status_use') ?? $row->status_use ?? 1;
        $row->link = implode('|', array_filter($request->input('link', [])));
        $row->account_action = session('user.ldap_username');
        $row->ip_address = $request->ip();
        $row->date_save = $this->today();
        $newFiles = $oldFiles = [];
        try {
            $this->replaceUpload($row, 'thumbnail', $request->file('image_name'), 'course', $newFiles, $oldFiles);
            $row->save();
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($newFiles);
            throw $exception;
        }
        Storage::disk('public')->delete($oldFiles);

        return redirect()->route('document.mode', 'course');
    }

    public function delete_course($id = '')
    {
        $row = course::findOrFail($id);
        $thumbnail = $row->thumbnail;
        $row->delete();
        if ($thumbnail) {
            Storage::disk('public')->delete('course/'.$thumbnail);
        }

        return redirect()->route('document.mode', 'course');
    }
}
