 <header id="header" class="header sticky-top">
     @php
         $menuData = cache('main-menu') ?? [];
         $template = $menuData['template'] ?? (object) [];
         $mainMenus = $menuData['main_menu_all'] ?? [];
     @endphp
     <div class="container-fluid container-xl position-relative">
         <div class="top-row d-flex align-items-center justify-content-between">
             <a href="{{ route('index') }}" class="logo d-flex align-items-center">
                 <!-- Uncomment the line below if you also wish to use an image logo -->
                 <img src="{{ asset('storage/template/' . $template->logo_main) }}" alt="">
                 <h1 class="sitename">{{ $template->title }}</h1>
             </a>

             <div class="d-flex align-items-center">
                 <div class="social-links">
                     <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                     <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                     <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                 </div>

                 <form class="search-form ms-4">
                     <input type="text" placeholder="Search..." class="form-control">
                     <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                 </form>
             </div>
         </div>

     </div>

     <div class="nav-wrap">
         <div class="container d-flex justify-content-center position-relative">
             <nav id="navmenu" class="navmenu">
                 <ul>
                     <li><a href="{{ route('index') }}" class="fw-bold active">หน้าหลัก</a></li>
                     @if (!empty($mainMenus))
                         @foreach ($mainMenus as $main)
                             @if ($main->status_setting == 1)
                                 @if (!empty($main->join_database))
                                     <li>
                                         <a href="{{ route($main->join_database, $main->join_database_id) }}"
                                             class="fw-bold">
                                             {{ $main->name }}
                                         </a>
                                     </li>
                                 @else
                                     @if ($main->sub_menu->isNotEmpty())
                                         <li class="dropdown">
                                             <a href="#">
                                                 <span class="fw-bold">{{ $main->name }}</span>
                                                 <i class="bi bi-chevron-down toggle-dropdown"></i>
                                             </a>
                                             <ul>
                                                 @foreach ($main->sub_menu as $sub)
                                                     @if ($sub->status_setting == 1)
                                                         @if (!empty($sub->join_database))
                                                             @if ($sub->join_database_id == 'year')
                                                                 @if (!empty($type_years[0]))
                                                                     @foreach ($type_years as $row)
                                                                         <li>
                                                                             <a
                                                                                 href="{{ route('index.document_detail', [$row->year]) }}">
                                                                                 <span><i
                                                                                         class="bi bi-dot me-2"></i>{{ $row->year }}</span>
                                                                             </a>
                                                                         </li>
                                                                     @endforeach
                                                                 @endif
                                                             @else
                                                                 <li>
                                                                     <a
                                                                         href="{{ route($sub->join_database, $sub->join_database_id) }}">
                                                                         <span class="fw-bold"><i
                                                                                 class="bi bi-dot me-2"></i>{{ $sub->name }}</span>
                                                                     </a>
                                                                 </li>
                                                             @endif
                                                         @else
                                                             <li>
                                                                 <a
                                                                     href="{{ route('index.content_show', ['sub', $sub->id]) }}">
                                                                     <span class="fw-bold"><i
                                                                             class="bi bi-dot me-2"></i>{{ $sub->name }}</span>
                                                                 </a>
                                                             </li>
                                                         @endif
                                                     @endif
                                                 @endforeach
                                             </ul>
                                         </li>
                                     @elseif(!empty($main->link))
                                         <li>
                                             <a href="{{ $main->link }}" target="_blank" class="fw-bold">
                                                 {{ $main->name }}
                                             </a>
                                         </li>
                                     @else
                                         <li>
                                             <a href="{{ route('index.content_show', ['main', $main->id]) }}"
                                                 class="fw-bold">
                                                 {{ $main->name }}
                                             </a>
                                         </li>
                                     @endif
                                 @endif
                             @endif
                         @endforeach
                     @endif
                 </ul>
                 <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
             </nav>
         </div>
     </div>

 </header>
