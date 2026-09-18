<div id="sidebar" class="app-sidebar" data-bs-theme="dark">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{--                                {{session()->get('user.ldap_username')}} <br> --}}
                                {{ session()->get('user.full_name') }}
                            </div>
                        </div>
                        <small>{{ session()->get('user.permission_name') }} </small>
                    </div>
                </a>
            </div>


            @if (session()->has('main-menu.main_menu_all'))
                @if (in_array(session()->get('user.permission'), [1, 2, 4, 5]))
                    <div class="menu-header">Content Menu</div>
                    @foreach (session()->get('main-menu.main_menu_all') as $main)
                        @if ($main->status_setting == 1 && $main->join_database == null)
                            @if (!empty($main->submenu[0]) && $main->count_sub_show() > 0)
                                <div class="menu-item has-sub">
                                    <a href="javascript:;" class="menu-link">
                                        <div class="menu-icon">
                                            <i class="far fa-circle-dot"></i>
                                        </div>
                                        <div class="menu-text">{{ $main->name }} </div>
                                        <div class="menu-caret"></div>
                                    </a>
                                    <div class="menu-submenu">
                                        @foreach ($main->submenu as $sub)
                                            @if ($sub->status_setting == 1 && $sub->join_database == null)
                                                <div class="menu-item">
                                                    <a href="{{ route('content.index', ['id' => $sub->id, 'mode' => 'sub']) }}"
                                                        class="menu-link">
                                                        <div class="menu-text">{{ $sub->name }}</div>
                                                    </a>
                                                </div>
                                            @elseif($sub->status_setting == 0 && $sub->status_keep_data == 1 && $sub->join_database == null)
                                                <div class="menu-item">
                                                    <a
                                                        href="{{ route('content.index', ['id' => $sub->id, 'mode' => 'sub']) }}">
                                                        <div class="menu-text">{{ $sub->name }}</div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                {{--                            @elseif($main->count_sub_show() > 0) --}}
                                {{--                                <div class="menu-item"> --}}
                                {{--                                    <a href="{{ route('content.index',['id'=>$main->id, 'mode'=>'main']) }}" --}}
                                {{--                                       class="menu-link"> --}}
                                {{--                                        <div class="menu-icon"> --}}
                                {{--                                            <i class="far fa-circle-dot"></i> --}}
                                {{--                                        </div> --}}
                                {{--                                        <div class="menu-text">{{ $main->name }}1161</div> --}}
                                {{--                                    </a> --}}
                                {{--                                </div> --}}
                            @elseif($main->status_keep_data == 1 && $main->count_sub_no_show() == 0)
                                <div class="menu-item">
                                    <a href="{{ route('content.index', ['id' => $main->id, 'mode' => 'main']) }}"
                                        class="menu-link">
                                        <div class="menu-icon">
                                            <i class="far fa-circle-dot"></i>
                                        </div>
                                        <div class="menu-text">{{ $main->name }} </div>
                                    </a>
                                </div>
                            @endif
                        @elseif($main->status_keep_data == 1 && $main->join_database == null)
                            <div class="menu-item">
                                <a href="{{ route('content.index', ['id' => $main->id, 'mode' => 'main']) }}"
                                    class="menu-link">
                                    <div class="menu-icon">
                                        <i class="far fa-circle-dot"></i>
                                    </div>
                                    <div class="menu-text">{{ $main->name }}</div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif

            {{--            @if (in_array(session()->get('user.permission'), [1, 2, 4, 5, 6])) --}}
            {{--                <div class="menu-header">Data Base</div> --}}
            {{--                <div class="menu-item"> --}}
            {{--                    <a href="{{route('base.form')}}" class="menu-link"> --}}
            {{--                        <div class="menu-icon"> --}}
            {{--                            <i class="far fa-image"></i> --}}
            {{--                        </div> --}}
            {{--                        <div class="menu-text">กรอกข้อมูลดิบ</div> --}}
            {{--                    </a> --}}
            {{--                </div> --}}
            {{--                <div class="menu-item"> --}}
            {{--                    <a href="{{route('base.data')}}" class="menu-link"> --}}
            {{--                        <div class="menu-icon"> --}}
            {{--                            <i class="far fa-image"></i> --}}
            {{--                        </div> --}}
            {{--                        <div class="menu-text">ข้อมูลรายวัน</div> --}}
            {{--                    </a> --}}
            {{--                </div> --}}
            {{--            @endif --}}
            @if (in_array(session()->get('user.permission'), [1, 2, 4, 5]))
                <div class="menu-header">Data Menu</div>
                {{-- @if (!empty(env('NSRU_NEWSPAPER')))
                    <div class="menu-item">
                        <a href="https://emp.nsru.ac.th/newspaper/{{ env('NSRU_NEWSPAPER') }}" class="menu-link"
                            target="_blank">
                            <div class="menu-icon">
                                <i class="fas fa-bookmark"></i>
                            </div>
                            <div class="menu-text">ข่าวประชาสัมพันธ์</div>
                        </a>
                    </div>
                @endif
                @if (!empty(env('NSRU_CALENDER')))
                    <div class="menu-item">
                        <a href="https://emp.nsru.ac.th/calendar/{{ env('NSRU_CALENDER') }}" class="menu-link"
                            target="_blank">
                            <div class="menu-icon">
                                <i class="far fa-calendar"></i>
                            </div>
                            <div class="menu-text">ข่าวกิจกรรม</div>
                        </a>
                    </div>
                @endif --}}
                @if (count(session()->get('main-menu.mode_article')) > 0)
                    @foreach (session()->get('main-menu.mode_article') as $mode_article)
                        <div class="menu-item">
                            <a href="{{ route('article.index', $mode_article->name_eng) }}" class="menu-link">
                                <div class="menu-icon">
                                    <i class="far fa-calendar"></i>
                                </div>
                                <div class="menu-text">{{ $mode_article->name }}</div>
                            </a>
                        </div>
                    @endforeach
                @endif
                @if (count(session()->get('main-menu.group')) > 0)
                    @php $group  = session()->get('main-menu.group') @endphp
                    <div class="menu-item has-sub">
                        <a href="javascript:;" class="menu-link">
                            <div class="menu-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="menu-text">ข้อมูลบุคคล</div>
                            <div class="menu-caret"></div>
                        </a>
                        <div class="menu-submenu">
                            @if (!empty($group[0]))
                                @foreach ($group as $row)
                                    @if ($row->status_setting == 1)
                                        <div class="menu-item">
                                            <a href="{{ route('content.borad', [$row->id]) }}" class="menu-link">
                                                <div class="menu-text">{{ $row->name }}</div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @elseif(!empty($group) && !is_array($group) && !empty($group->id))
                                <div class="menu-item">
                                    <a href="{{ route('content.borad', [$group->id]) }}" class="menu-link">
                                        <div class="menu-text">{{ $group->name }}</div>
                                    </a>
                                </div>

                            @endif
                        </div>
                    </div>
                @endif
                {{--                <div class="menu-item has-sub"> --}}
                {{--                    <a href="javascript:;" class="menu-link"> --}}
                {{--                        <div class="menu-icon"> --}}
                {{--                            <i class="fas fa-leaf"></i> --}}
                {{--                        </div> --}}
                {{--                        <div class="menu-text">ข้อมูลสถิติ</div> --}}
                {{--                        <div class="menu-caret"></div> --}}
                {{--                    </a> --}}
                {{--                    <div class="menu-submenu"> --}}
                {{--                        <div class="menu-item"> --}}
                {{--                            <a href="{{route('statistics.index')}}" class="menu-link"> --}}
                {{--                                <div class="menu-text">จัดการข้อมูล</div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}
                {{--                        <div class="menu-item"> --}}
                {{--                            <a href="{{route('statistics.setting')}}" class="menu-link"> --}}
                {{--                                <div class="menu-text">ตั้งค่า</div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}

                {{--                    </div> --}}
                {{--                </div> --}}
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="menu-text">ข้อมูลเอกสาร</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="{{ route('document.index', 'document') }}" class="menu-link">
                                <div class="menu-text">จัดการเอกสาร</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('document.setting', 'document') }}" class="menu-link">
                                {{--                            <a href="{{route('setting_document.index')}}" class="menu-link"> --}}
                                <div class="menu-text">ตั้งค่า</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="far fa-rectangle-list"></i>
                        </div>
                        <div class="menu-text">ข้อมูลหลักสูตร</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="{{ route('document.index', 'course') }}" class="menu-link">
                                <div class="menu-text">จัดการข้อมูล</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('document.setting', 'course') }}" class="menu-link">
                                {{--                            <a href="{{route('setting_document.index')}}" class="menu-link"> --}}
                                <div class="menu-text">ตั้งค่า</div>
                            </a>
                        </div>
                    </div>
                </div>

                {{--                <div class="menu-item has-sub"> --}}
                {{--                    <a href="javascript:;" class="menu-link"> --}}
                {{--                        <div class="menu-icon"> --}}
                {{--                            <i class="fas fa-leaf"></i> --}}
                {{--                        </div> --}}
                {{--                        <div class="menu-text">ข้อมูลการดำเนินงาน</div> --}}
                {{--                        <div class="menu-caret"></div> --}}
                {{--                    </a> --}}
                {{--                    <div class="menu-submenu"> --}}
                {{--                        <div class="menu-item"> --}}
                {{--                            <a href="{{route('document.index','green')}}" class="menu-link"> --}}
                {{--                                <div class="menu-text">จัดการข้อมูล</div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}
                {{--                        <div class="menu-item"> --}}
                {{--                            <a href="{{route('document.setting','green')}}" class="menu-link"> --}}
                {{--                                <div class="menu-text">ตั้งค่า</div> --}}
                {{--                            </a> --}}
                {{--                        </div> --}}

                {{--                    </div> --}}
                {{--                </div> --}}
                <div class="menu-header">Office Menu</div>
                <div class="menu-item">
                    <a href="{{ route('setting_index.index', ['top']) }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="far fa-image"></i>
                        </div>
                        <div class="menu-text">banner ด้านบน</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('setting_index.index', ['popup']) }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="far fa-image"></i>
                        </div>
                        <div class="menu-text">popup หน้าแรก</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ route('template.set') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="menu-text">ข้อมูลหน่วยงาน</div>
                    </a>
                </div>
                {{--            <div class="menu-item"> --}}
                {{--                <a href="{{route('setting.index')}}" class="menu-link"> --}}
                {{--                    <div class="menu-icon"> --}}
                {{--                        <i class="fab fa-simplybuilt"></i> --}}
                {{--                    </div> --}}
                {{--                    <div class="menu-text">banner ด้านขวา</div> --}}
                {{--                </a> --}}
                {{--            </div> --}}
            @endif
            @if (in_array(session()->get('user.permission'), [3, 4, 5]))
                @php $array_menu_direct = [['id' => 5, 'name' => 'สายตรงผู้อำนวยการ']]; @endphp
                @foreach ($array_menu_direct as $row)
                    <div class="menu-item">
                        <a href="{{ route('content.direct_show', ['name' => $row['name'], 'id' => $row['id']]) }}"
                            class="menu-link">
                            <div class="menu-icon">
                                <i class="fas fa-volume-high"></i>
                            </div>
                            <div class="menu-text">{{ $row['name'] }}</div>
                        </a>
                    </div>
                @endforeach
            @endif
            @if (in_array(session()->get('user.permission'), [2, 4, 5]))
                <div class="menu-item">
                    <a href="{{ route('member.index') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="menu-text">สิทธิ์การใช้งาน</div>
                    </a>
                </div>
            @endif
            @if (in_array(session()->get('user.permission'), [5]))
                <div class="menu-header">Dev Menu</div>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div class="menu-text">จัดการเมนู</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="{{ route('menu.index') }}" class="menu-link">
                                <div class="menu-text">Menu</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('people.index') }}" class="menu-link">
                                <div class="menu-text">people</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('template.set') }}" class="menu-link">
                                <div class="menu-text">content</div>
                            </a>
                        </div>

                    </div>
                </div>
            @endif

            <div class="menu-item">
                <a href="{{ route('logout') }}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </div>
                    <div class="menu-text">ออกจากระบบ</div>
                </a>
            </div>

            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
