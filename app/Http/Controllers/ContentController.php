<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\borad;
use App\Models\detail_menu;
use App\Models\group_prople;
use App\Models\main_menu;
use App\Models\people;
use App\Models\position;
use App\Models\prefix;
use App\Models\sub_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ContentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('member-permission');
    }

    public function index($id = '', $mode = '')
    {
        if (! session()->has('user')) {
            return redirect('login');
        }
        $mode = $mode ?: request('mode', 'sub');
        $menu = $this->contentMenu($id, $mode);
        $query = detail_menu::where($mode.'_menu_id', $id)->orderBy('number_show')->orderBy('id');
        $data = $this->showMenuv1();
        $data['menu'] = $menu;
        $data['mode'] = $mode;
        $data['data_detail_menu'] = $menu->number_of_data == 2 ? null : $query->first();
        $data['data_detail_menu_all'] = $menu->number_of_data == 2 ? $query->get() : collect();

        return view('backend.content.page', $data);
    }

    protected function contentMenu($id, $mode)
    {
        abort_unless(in_array($mode, ['main', 'sub'], true), 404);

        return $mode === 'main' ? main_menu::findOrFail($id) : sub_menu::findOrFail($id);
    }

    protected function peopleData($id): array
    {
        return array_merge($this->showMenuv1(), [
            'group_id' => borad::findOrFail($id),
            'position' => position::where('borad_id', $id)->orderBy('oridal')->get(),
            'data_group' => group_prople::where('borad_id', $id)->orderBy('ordinal')->get(),
            'prefix' => prefix::all(),
        ]);
    }

    public function borad($id = '')
    {
        $data = $this->peopleData($id);
        $data['peopleAll_id'] = people::where('borad_id', $id)->orderBy('ordinal')->get();

        return view('backend.people.peopleAll', $data);
    }

    public function edit_people($id = '')
    {
        $person = people::findOrFail($id);
        $data = $this->peopleData($person->borad_id);
        $data['people_id'] = $person;

        return view('backend.people.peopleAll_edit', $data);
    }

    public function insert_people(Request $request)
    {
        $request->merge(['group_prople_id' => $request->input('group_people_id', $request->input('group_prople_id'))]);
        $request->validate([
            'id' => 'nullable|integer|exists:people,id',
            'group_id' => 'required|integer|exists:borads,id',
            'people_name' => 'required|string|max:250',
            'people_lastname' => 'nullable|string|max:250',
            'prefix_id' => 'nullable|integer|exists:prefix,id',
            'position_id' => ['nullable', 'integer', Rule::exists('positions', 'id')->where('borad_id', $request->group_id)],
            'group_prople_id' => ['nullable', 'integer', Rule::exists('group_proples', 'id')->where('borad_id', $request->group_id)],
            'people_email' => 'nullable|email|max:250',
            'people_telephone' => 'nullable|string|max:250',
            'people_other' => 'nullable|string|max:250',
            'ldep_username' => 'nullable|string|max:250',
            'ordinal' => 'nullable|integer|min:0',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'link_image' => 'nullable|url|max:250',
            'link_personal' => 'nullable|url|max:250',
            'status' => 'nullable|boolean',
        ]);
        $person = $request->filled('id') ? people::findOrFail($request->id) : new people;
        $person->{$person->exists ? 'member_id_update' : 'member_id_create'} = session('user.member_id');
        $person->prefix_id = $request->prefix_id;
        $person->name = $request->people_name;
        $person->lastname = $request->people_lastname;
        $person->borad_id = $request->group_id;
        $person->position_id = $request->position_id;
        $person->group_prople_id = $request->group_prople_id;
        $person->position_self = $request->people_other;
        $person->email = $request->people_email;
        $person->telephone = $request->people_telephone;
        $person->ldep_username = $request->ldep_username;
        $person->ordinal = $request->input('ordinal') ?? $person->ordinal ?? 0;
        $person->link_image = $request->input('link_image', $person->link_image);
        $person->link_personal = $request->input('link_personal', $person->link_personal);
        $person->status_show = $request->input('status', $person->status_show ?? 1);
        $this->saveWithUploads($person, $request, ['image_name' => ['thumbnail', 'people']]);

        return redirect()->route('content.borad', $person->borad_id);
    }

    public function update_people(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:people,id']);

        return $this->insert_people($request);
    }

    public function delete_people($id = '')
    {
        $person = people::findOrFail($id);
        $group = $person->borad_id;
        $thumbnail = $person->thumbnail;
        $person->delete();
        if ($thumbnail) {
            Storage::disk('public')->delete('people/'.$thumbnail);
        }

        return redirect()->route('content.borad', $group);
    }

    public function insert_detail_menu(Request $request)
    {
        $request->validate([
            'detail_menu_id' => 'nullable|integer|exists:detail_menus,id',
            'main_menu_id' => 'nullable|required_without:sub_menu_id|prohibits:sub_menu_id|integer|exists:main_menus,id',
            'sub_menu_id' => 'nullable|required_without:main_menu_id|prohibits:main_menu_id|integer|exists:sub_menus,id',
            'title' => 'nullable|string|max:250',
            'detail' => 'nullable|string',
            'link' => 'nullable|string|max:250',
            'number_show' => 'nullable|integer|min:0',
            'image_name' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'filename' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip|max:51200',
        ]);
        $mode = $request->filled('main_menu_id') ? 'main' : 'sub';
        $id = $request->input($mode.'_menu_id');
        $detail = $request->filled('detail_menu_id')
            ? detail_menu::where($mode.'_menu_id', $id)->findOrFail($request->detail_menu_id)
            : new detail_menu;
        $detail->{$detail->exists ? 'member_id_update' : 'member_id_create'} = session('user.member_id');
        $detail->title = $request->title;
        $detail->detail = $request->input('detail', '');
        $detail->link = $request->link;
        $detail->{$mode.'_menu_id'} = $id;
        if ($request->filled('number_show')) {
            $detail->number_show = $request->number_show;
        }
        foreach (['start_date', 'end_date'] as $field) {
            if ($request->has($field)) {
                $detail->$field = $this->contentDate($request->input($field), $field);
            }
        }
        $this->saveWithUploads($detail, $request, [
            'image_name' => ['thumbnail', 'content'], 'filename' => ['file', 'file'],
        ]);

        return redirect()->route('content.index', ['id' => $id, 'mode' => $mode]);
    }

    protected function contentDate($value, string $field): ?string
    {
        if (! $value) {
            return null;
        }
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value, $parts)) {
            [, $year, $month, $day] = $parts;
        } elseif (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $parts)) {
            [, $month, $day, $year] = $parts;
        } else {
            throw ValidationException::withMessages([$field => 'Invalid date.']);
        }
        $year = (int) $year > 2500 ? (int) $year - 543 : (int) $year;
        if (! checkdate((int) $month, (int) $day, $year)) {
            throw ValidationException::withMessages([$field => 'Invalid date.']);
        }

        return sprintf('%04d-%02d-%02d', $year, $month, $day);
    }

    public function edit_detail_menu($id1 = '', $id2 = '', $mode = '')
    {
        // Existing URLs use detail/menu/mode; newer forms pass menu/mode/detail.
        if (in_array($id2, ['main', 'sub'], true)) {
            [$id1, $id2, $mode] = [$mode, $id1, $id2];
        }
        $menu = $this->contentMenu($id2, $mode);
        $detail = detail_menu::where($mode.'_menu_id', $id2)->findOrFail($id1);

        return view('backend.content.page', array_merge($this->showMenuv1(), [
            'menu' => $menu, 'mode' => $mode, 'data_detail_menu' => $detail,
            'data_detail_menu_all' => collect(),
        ]));
    }

    public function delete_detail_menu($id = '')
    {
        $detail = detail_menu::findOrFail($id);
        $mode = $detail->sub_menu_id ? 'sub' : 'main';
        $menuId = $detail->{$mode.'_menu_id'};
        $files = array_filter([
            $detail->thumbnail ? 'content/'.$detail->thumbnail : null,
            $detail->file ? 'file/'.$detail->file : null,
        ]);
        $detail->delete();
        Storage::disk('public')->delete($files);

        return redirect()->route('content.index', ['id' => $menuId, 'mode' => $mode]);
    }

    public function setting_index(Request $request)
    {
        return view('backend.banner.setting_index_right', array_merge($this->showMenuv1(), [
            'data_banner' => banner::where('place', 'right')->orderBy('ordinal')->get(),
        ]));
    }

    public function set_index_insert(Request $request)
    {
        $request->validate(['place' => 'required|in:right,top,popup']);
        if ($request->place === 'right') {
            $request->validate([
                'name' => 'required|array', 'name.*' => 'nullable|string|max:250',
                'id' => 'nullable|array', 'id.*' => 'nullable|integer|exists:banners,id',
                'ordinal' => 'required|array', 'ordinal.*' => 'required|integer|min:0',
                'link' => 'nullable|array', 'link.*' => 'nullable|string|max:250',
                'status_show' => 'nullable|array', 'status_show.*' => 'boolean',
                'file' => 'nullable|array', 'file.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            ]);
            foreach ($request->name as $key => $name) {
                $id = $request->input("id.$key");
                $item = $id ? banner::where('place', 'right')->findOrFail($id) : new banner;
                $item->name = $name;
                $item->ordinal = $request->input("ordinal.$key", $key + 1);
                $item->link = $request->input("link.$key", $item->link);
                $item->status_show = $request->input("status_show.$key", 0);
                $item->place = 'right';
                $this->saveWithUploads($item, $request, ["file.$key" => ['file', 'index']]);
            }

            return redirect()->route('setting.index');
        }
        $request->validate([
            'id' => 'nullable|integer|exists:banners,id',
            'name' => 'nullable|string|max:250', 'link' => 'nullable|string|max:250',
            'ordinal' => 'required|integer|min:0', 'status_show' => 'nullable|boolean',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'date_start' => 'nullable|date_format:Y-m-d',
            'date_end' => 'nullable|date_format:Y-m-d|after_or_equal:date_start',
        ]);
        $item = $request->filled('id') ? banner::where('place', $request->place)->findOrFail($request->id) : new banner;
        $item->name = $request->name;
        $item->link = $request->link;
        $item->ordinal = $request->ordinal;
        $item->status_show = $request->input('status_show', 0);
        $item->place = $request->place;
        $item->date_start = $request->input('date_start', $item->date_start);
        $item->date_end = $request->input('date_end', $item->date_end);
        $this->saveWithUploads($item, $request, ['file' => ['file', 'index']]);

        return redirect()->route('setting_index.index', $item->place);
    }

    public function setting_index_top($place = 'top')
    {
        abort_unless(in_array($place, ['top', 'popup'], true), 404);

        return view('backend.banner.setting_index_'.$place, array_merge($this->showMenuv1(), [
            'data_bannertop' => banner::where('place', $place)->orderBy('ordinal')->get(),
            'title_menu' => $place === 'top' ? 'banner ด้านบน' : 'popup หน้าแรก',
        ]));
    }

    public function update_index_top($id = '', $place = 'top')
    {
        $item = banner::where('place', $place)->findOrFail($id);
        $view = $this->setting_index_top($place);

        return $view->with('data_banner', collect([$item]));
    }

    public function delete_index_top($id = '', $place = 'top')
    {
        abort_unless(in_array($place, ['top', 'popup'], true), 404);
        $item = banner::where('place', $place)->findOrFail($id);
        $file = $item->file;
        $item->delete();
        if ($file) {
            Storage::disk('public')->delete('index/'.$file);
        }

        return redirect()->route('setting_index.index', $place);
    }

    public function toggle(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:banners,id']);
        $item = banner::findOrFail($request->id);
        $item->status_show = ! $item->status_show;
        $item->save();

        return response()->json(['success' => true, 'status_show' => (bool) $item->status_show]);
    }

    protected function saveWithUploads($model, Request $request, array $uploads): void
    {
        $newFiles = [];
        $oldFiles = [];
        try {
            foreach ($uploads as $input => [$column, $directory]) {
                if (! $request->hasFile($input)) {
                    continue;
                }
                $path = $request->file($input)->store($directory, 'public');
                if (! $path) {
                    throw new \RuntimeException('Unable to save uploaded file.');
                }
                $newFiles[] = $path;
                if ($model->$column) {
                    $oldFiles[] = $directory.'/'.$model->$column;
                }
                $model->$column = basename($path);
            }
            $model->save();
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($newFiles);
            throw $exception;
        }
        Storage::disk('public')->delete($oldFiles);
    }
}
