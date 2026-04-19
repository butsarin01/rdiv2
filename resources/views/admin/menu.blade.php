<div id="header" class="header navbar-default">
    <div class="navbar-header">
        <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>RDI</b>-NSRU</a>
        <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{session()->get('user.image_user')}}" alt=""/>
                <span class="d-none d-md-inline">{{session()->get('user.ldap_username')}}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
            </div>
        </li>
    </ul>
</div>
<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
{{--                    <div class="image">--}}
{{--                        <img src="{{session()->get('user.image_user')}}" alt=""/>--}}
{{--                    </div>--}}
                    <div class="info">{{session()->get('user.full_name')}}
                        <small>{{session()->get('user.permisstion_name')}}
                            {{session()->get('user.permisstion')}}</small>
                    </div>
                </a>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Menu</li>
            <?php $per = session()->get('user.permisstion');?>
            @if($per == 1 || $per == 2 || $per == 3)

                @if(!empty($main_menu_all))
                    @foreach($main_menu_all as $main)
                        @if($main->status_setting == 1 && $main->join_database=='')
                            @if(!empty($main->submenu[0]))
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret"></b>
                                        <i class="fas fa-home fa-fw"></i>
                                        <span>{{ $main->name }} </span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach($main->submenu as $sub)
                                            @if($sub->status_setting == 1 && $sub->join_database=='')
                                                <li>
                                                    <a href="{{ route('content.index',['id'=>$sub->id, 'mode'=>'sub']) }}">
                                                    <!-- <a href="/content/{{$sub->id}}&&sub"> -->
                                                        <span>{{ $sub->name }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else

                                <li>
                                    <a href="{{ route('content.index',['id'=>$main->id, 'mode'=>'main']) }}">
                                    <!-- <a href="/content/{{$main->id}}&&main"> -->
                                        <i class="fas fa-home fa-fw"></i>
                                        <span>{{ $main->name }}</span>
                                    </a>
                                </li>
                            @endif

                        @endif
                    @endforeach
                @endif

                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-lg fa-fw m-r-10 fa-user-plus"></i>
                        <span>บุคคล</span>
                    </a>
                    <ul class="sub-menu">

                        @if(!empty($group[0]))
                            @foreach($group as $row)
                                @if($row->status_setting == 1)
                                    <li>
                                        <a href="{{ route('content.borad',[$row->id]) }}">
                                            <span>{{ $row->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @elseif(!empty($group) && !is_array($group) && !empty($group->id))
                            <li>
                                <a href="{{ route('content.borad',[$group->id]) }}">
                                    <span>{{ $group->name }}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>

                <li>
                    <a href="{{route('document.index')}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-building"></i>
                        <span>เอกสาร</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-cog fa-fw"></i>
                        <span>ประกันคุณภาพ</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{route('quality.index')}}">จัดการประกันคุณภาพ</a></li>
                        <li><a href="{{route('setting_documents.index')}}">ตั้งค่า</a></li>

                    </ul>
                </li>
                <!-- <li>
                    <a href="http://emp.nsru.ac.th/newspaper/32">
                        <i class="fas fa-lg fa-fw m-r-10 fa-bullhorn"></i>
                        <span>ข่าว/ประกาศ</span>
                    </a>
                </li> -->
                <li>
                    <a href="http://emp.nsru.ac.th/calendar/19">
                        <i class="fas fa-lg fa-fw m-r-10 fa-camera-retro"></i>
                        <span>กิจกรรม</span>
                    </a>
                </li>
            @endif
            @if($per == 4)
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-cog fa-fw"></i>
                        <span>ประกันคุณภาพ</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{route('quality.index')}}">จัดการประกันคุณภาพ</a></li>
                        <li><a href="{{route('setting_documents.index')}}">ตั้งค่า</a></li>

                    </ul>
                </li>
            @endif

            @if($per == 1 || $per == 2 || $per == 3)
{{--                <li>--}}
{{--                    <a href="{{route('setting.index_top')}}">--}}
{{--                        <i class="fas fa-lg fa-fw m-r-10 fa-camera-retro"></i>--}}
{{--                        <span>banner ด้านบน</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{route('setting.index')}}">--}}
{{--                        <i class="fas fa-lg fa-fw m-r-10 fa-camera-retro"></i>--}}
{{--                        <span>banner ด้านขวา</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-lg fa-fw fa-camera-retro"></i>
                        <span>banner</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{route('setting.index_top')}}">ด้านบน</a></li>
                        <li><a href="{{route('setting.index')}}">ด้านขวา</a></li>

                    </ul>
                </li>
                <li>
                    <a href="{{route('member.index')}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i>
                        <span>สิทธิ์การใช้งาน</span>
                    </a>
                </li>
            @endif

            @if($per == 5 || $per == 3 || $per == 2)
                <li class="nav-header">เอกสาร</li>
                <li>
                    <a href="{{route('document_rdi.show',[1])}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i>
                        <span>หนังสือออก (ภายนอก)</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('document_rdi.show',[2])}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i>
                        <span>หนังสือออก (ภายใน)</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('running.show')}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i>
                        <span>e-GP-Running</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('reference_naga.show')}}">
                        <i class="fas fa-lg fa-fw m-r-10 fa-unlock"></i>
                        <span>เลขอ้างอิง นากา</span>
                    </a>
                </li>
            @endif

            @if($per == 3)
                <li class="nav-header">ตั้งค่า</li>

                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="fas fa-cog fa-fw"></i>
                        <span>จัดการเมนู</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{route('menu.index')}}">Menu</a></li>
                        <li><a href="{{route('people.index')}}">people</a></li>
                        <li><a href="{{route('template.set')}}">content</a></li>

                    </ul>
                </li>
            @endif

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                            class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>