 <footer id="footer" class="footer position-relative">
     @php
         $menuData = cache('main-menu') ?? [];
         $template = $menuData['template'] ?? (object) [];
         $mainMenus = $menuData['main_menu_all'] ?? [];
         $visitors = $menuData['visitors'] ?? [];
     @endphp
     <div class="container">
         <div class="row gy-5">

             <div class="col-lg-4">
                 <div class="footer-brand">
                     <a href="{{ route('index') }}" class="logo d-flex align-items-center mb-3">
                         <span class="sitename">{{ $template->title }}</span>
                     </a>
                     <p class="tagline">{{ $template->address }}</p>
                     <p class="mt-3"><strong>โทรศัพท์:</strong>
                         <span>{!! nl2br($template->telephone) !!}</span>
                     </p>
                     <p><strong>Email:</strong> <span>{{ $template->email }}</span></p>
                     {{-- <div class="social-links mt-4">
                         <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                         <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                         <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                         <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                         <a href="#" aria-label="Dribbble"><i class="bi bi-dribbble"></i></a>
                     </div> --}}
                 </div>
             </div>


             <div class="col-lg-6">
                 <div class="footer-links-grid">
                     <div class="row">
                         @php
                             $i = 0;
                         @endphp
                         @foreach ($mainMenus as $main)
                             @if (!empty($main->sub_menu[0]) && $i < 4)
                                 @php
                                     $i++;
                                 @endphp
                                 <div class="col-6 col-md-4">
                                     <h5>{{ $main->name }}</h5>
                                     <ul class="list-unstyled">
                                         @foreach ($main->sub_menu as $sub)
                                             @if (!empty($sub->join_database))
                                                 <li><a href="{{ route($sub->join_database, $sub->join_database_id) }}">
                                                         {{ $sub->name }}
                                                     </a></li>
                                             @else
                                                 <li>
                                                     <a href="{{ route('index.content_show', ['sub', $sub->id]) }}">
                                                         {{ $sub->name }}
                                                     </a>
                                                 </li>
                                             @endif
                                         @endforeach
                                     </ul>
                                 </div>
                             @endif
                         @endforeach
                     </div>
                 </div>
             </div>

             <div class="col-lg-2">
                 <div class="footer-cta">
                     <h5>สถิติผู้เยี่ยมชมเว็บไซต์</h5>
                     <ul class="list-unstyled">
                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>ผู้เข้าชมวันนี้</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['today']) }}
                             </span>
                         </li>

                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>ผู้เข้าชมเมื่อวาน</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['yesterday']) }}
                             </span>
                         </li>

                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>เดือนนี้</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['this_month']) }}
                             </span>
                         </li>

                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>เดือนที่แล้ว</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['last_month']) }}
                             </span>
                         </li>

                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>ปีนี้</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['this_year']) }}
                             </span>
                         </li>

                         <li class="d-flex justify-content-between border-bottom py-1">
                             <span>ปีที่แล้ว</span>
                             <span class="fw-bold">
                                 {{ number_format($visitors['last_year']) }}
                             </span>
                         </li>
                     </ul>
                 </div>
             </div>

         </div>
     </div>

     <div class="footer-bottom">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="footer-bottom-content">
                         <p class="mb-0">© <span class="sitename">Myebsite</span>. All rights reserved.</p>
                         <div class="credits">
                             <!-- All the links in the footer should remain intact. -->
                             <!-- You can delete the links only if you've purchased the pro version. -->
                             <!-- Licensing information: https://bootstrapmade.com/license/ -->
                             <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                             Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </footer>
