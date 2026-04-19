<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Main_menu;
use App\Sub_menu;
use App\Detail_menu;
use App\Borad;
use App\Position;
use App\People;
use App\Banner;
use Image;

class ContentController extends Controller
{

    public function index($id = '', $mode = '')
    {
        if (!session()->has('user')) {
            return redirect('login');
        } else {
            $count_data = 0;
            $menu = array();
            if ($mode == 'main') {
                $menu = Main_menu::find($id);
                $data_detail_menu = Detail_menu::where('main_menu_id', $id)->get();
                $a = 'main';
                $count_data = Detail_menu::where('main_menu_id', $id)->count();
            } else {
                $menu = Sub_menu::find($id);
                $data_detail_menu = Detail_menu::where('sub_menu_id', $id)->get();
                $a = 'sub';
                $count_data = Detail_menu::where('sub_menu_id', $id)->count();

            }
            $data = $this->showMenu();
            $data['menu'] = $menu;
            $data['data_detail_menu'] = $data_detail_menu;
            $data['mode'] = $a;
            $data['count_data'] = $count_data + 1;

            // return dd($data);
            return view('admin.index', $data);
        }
    }


    public function borad($id = '')
    {

        $group_id = Borad::find($id);
        $peopleAll_id = People::where('borad_id', $id)->get();

        $data = $this->showMenu();
        $data['group_id'] = $group_id;
        $data['peopleAll_id'] = $peopleAll_id;

        return view('admin.peopleAll', $data);
    }

    public function insert_people(Request $request)
    {
        $people = new People();
        if (!empty($request->prefix_id)) {
            $people->prefix_id = $request->prefix_id;
        }
        $people->name = $request->people_name;
        $people->lastname = $request->people_lastname;

        if ($request->hasFile('image_name')) {
            $new_image_name = uniqid() . '.' . $request->image_name->extension();

            $request->image_name->storeAs('people', $new_image_name, 'public');
            $people->thumbnail = $new_image_name;
        }

        $people->borad_id = $request->group_id;
        $people->position_id = $request->position_id;

        $people->position_self = $request->people_other;

        $people->email = $request->people_email;
        $people->telephone = $request->people_telephone;
        $people->ldep_username = $request->ldep_username;
        $people->member_id_create = $request->member_id;

        $people->group_prople_id = $request->group_prople_id;


        $people->save();
        return redirect()->route('content.borad', [$request->group_id]);

    }

    public function edit_people($id = '')
    {

        $people_id = People::where('id', $id)->first();
        $group_id = Borad::find($people_id->borad_id);

        $data = $this->showMenu();
        $data['group_id'] = $group_id;
        $data['people_id'] = $people_id;
        return view('admin.peopleAll_edit', $data);
    }

    public function update_people(Request $request)
    {

        $people = People::find($request->id);
        $people->prefix_id = $request->prefix_id;
        $people->name = $request->people_name;
        $people->lastname = $request->people_lastname;

        if ($request->hasFile('image_name')) {

            Storage::disk('public')->delete('people/' . $people->thumbnail);
            $new_image_name = uniqid() . '.' . $request->image_name->extension();
            $request->image_name->storeAs('people', $new_image_name, 'public');
            $people->thumbnail = $new_image_name;
        }

        $people->borad_id = $request->group_id;
        $people->position_id = $request->position_id;
        $people->position_self = $request->people_other;
        $people->email = $request->people_email;
        $people->telephone = $request->people_telephone;
        $people->ldep_username = $request->ldep_username;

        $people->member_id_update = $request->member_id;

        $people->group_prople_id = $request->group_prople_id;

        $people->save();

        return redirect()->route('content.borad', $request->group_id);

    }

    public function delete_people($id = '')
    {
        $people_id = People::where('id', $id)->first();
        $group_id = Borad::find($people_id->borad_id);

        Storage::disk('public')->delete('people/' . $people_id->thumbnail);
        $people = People::find($id)->delete();

        return redirect()->route('content.borad', $group_id->id);
    }

    public function insert_detail_menu(Request $request)
    {
//        dd($request);

        if (!empty($request->detail_menu_id)) {
            $detail_menu = Detail_menu::where('id', $request->detail_menu_id)->first();

            if ($request->hasFile('image_name')) {
                Storage::disk('public')->delete('content/' . $detail_menu->thumbnail);
            }
            if ($request->hasFile('filename')) {
                Storage::disk('public')->delete('file/' . $detail_menu->file);
            }
            $detail_menu->member_id_update = $request->member_id;
        } else {
            $detail_menu = new Detail_menu();
            $detail_menu->member_id_create = $request->member_id;
        }

        $detail_menu->title = $request->title;
        $detail_menu->detail = $request->detail;

        if (!empty($request->filename)) {
            $new_filename = uniqid() . '.' . $request->filename->extension();
            $request->filename->storeAs('file', $new_filename, 'public');
            $detail_menu->file = $new_filename;
        }
        if (!empty($request->image_name)) {
            $new_image_name = uniqid() . '.' . $request->image_name->extension();
            $request->image_name->storeAs('content', $new_image_name, 'public');
            $detail_menu->thumbnail = $new_image_name;

        }
        if (!empty($request->number_show)) {
            $detail_menu->number_show = $request->number_show;

        }

        $detail_menu->link = $request->link;
        if (!empty($request->main_menu_id)) {
            $detail_menu->main_menu_id = $request->main_menu_id;
            $id = $request->main_menu_id;
            $mode = 'main';

        }
        if (!empty($request->sub_menu_id)) {
            $detail_menu->sub_menu_id = $request->sub_menu_id;
            $id = $request->sub_menu_id;
            $mode = 'sub';

        }
        $detail_menu->start_date = $this->set_format_date($request->start_date);
        $detail_menu->end_date = $this->set_format_date($request->end_date);
//dd($request);
        $detail_menu->save();

        return redirect()->route('content.index', ['id' => $id, 'mode' => $mode]);
    }

    public function edit_detail_menu($id1 = '', $id2 = '', $mode = '')
    {
        $menu = array();
        if ($mode == 'main') {
            $menu = Main_menu::find($id2);
            $data_detail_menu = Detail_menu::where('id', $id1)->get();
            $a = 'main';
        } elseif ($mode == 'sub') {
            $menu = Sub_menu::find($id2);
            $data_detail_menu = Detail_menu::where('id', $id1)->get();
            $a = 'sub';

        }
        $data = $this->showMenu();
        $data['menu'] = $menu;
        $data['data_detail_menu'] = $data_detail_menu;
        $data['mode'] = $a;

        // return dd($data);
        return view('admin.index_edit', $data);
    }

    public function delete_detail_menu($id = '')
    {
        $detail = Detail_menu::where('id', $id)->first();
        if (!empty($detail->main_menu_id)) {
            $detail_id = $detail->main_menu_id;
            $mode = 'main';
        }
        if (!empty($detail->sub_menu_id)) {
            $detail_id = $detail->sub_menu_id;
            $mode = 'sub';
        }

        Storage::disk('public')->delete('content/' . $detail->thumbnail);
        $detail_menu = Detail_menu::find($id)->delete();

        return redirect()->route('content.index', ['id' => $detail_id, 'mode' => $mode]);
    }

    public function setting_index(Request $request)
    {
        $banner = Banner::where('place', 'right')->orderBy('ordinal', 'ASC')->get();
        $data = $this->showMenu();
        $data['data_banner'] = $banner;
        // dd($data);
        return view('admin.setting_index', $data);
    }

    public function set_index_insert(Request $request)
    {
        // dd($request->all());
        if ($request->place == 'right') {
            foreach ($request->name as $key => $row) {
                if (!empty($request->id[$key])) {
                    $banner = Banner::where('id', $request->id[$key])->first();
                    if ($request->hasFile('file.' . $key)) {
                        Storage::disk('public')->delete('index/' . $banner->file);
                    }
                } else {
                    $banner = new Banner();
                }
                $banner->name = $request->name[$key];
                if ($request->hasFile('file.' . $key)) {
                    $new_image_name = uniqid() . '.' . $request->file[$key]->extension();

                    $request->file[$key]->storeAs('index', $new_image_name, 'public');
                    $banner->file = $new_image_name;
                }
                // $banner->file = $request->file[$key];
                $banner->ordinal = $request->ordinal[$key];
                $banner->link = $request->link[$key];
                $banner->status_show = (isset($request->status_show[$key])) ? $request->status_show[$key] : 0;
                $banner->place = $request->place;
                $banner->save();
            }
            return redirect()->route('setting.index');

        } elseif ($request->place == 'top') {
            if (!empty($request->id)) {
                $banner = Banner::where('id', $request->id)->first();
                if ($request->hasFile('file')) {
                    Storage::disk('public')->delete('index/' . $banner->file);
                }
            } else {
                $banner = new Banner();
            }

            $banner->name = $request->name;
            if ($request->hasFile('file')) {
                $new_image_name = uniqid() . '.' . $request->file->extension();
                $request->file->storeAs('index', $new_image_name, 'public');
                $banner->file = $new_image_name;
            }

            $banner->ordinal = $request->ordinal;
            $banner->status_show = $request->status_show;
            $banner->place = $request->place;
            $banner->link = $request->link;
            $banner->save();
            return redirect()->route('setting.index_top');
        }
    }

    public function setting_index_top(Request $request)
    {
        $banner = Banner::where('place', 'top')->orderBy('ordinal', 'ASC')->get();
        $data = $this->showMenu();
        $data['data_bannertop'] = $banner;
        return view('admin.setting_index_top', $data);
    }

    public function update_index_top($id = '')
    {
        $banner1 = Banner::where('place', 'top')->orderBy('ordinal', 'ASC')->get();
        $banner = Banner::where('id', $id)->get();
        $data = $this->showMenu();
        $data['data_bannertop'] = $banner1;
        $data['data_banner'] = $banner;
        return view('admin.setting_index_top', $data);
    }

    public function delete_index_top($id = '')
    {
        $banner = Banner::where('id', $id)->first();
        Storage::disk('public')->delete('index/' . $banner->file);
        $banner_data = Banner::find($id)->delete();

        return redirect()->route('setting.index_top');
    }

}
