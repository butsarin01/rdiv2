@extends('Frontend.master')

@section('content')
    @php
        $articleGroups = $articles ?? [];
        $researchItems = collect($articleGroups['research'] ?? []);
        $researchIds = $researchItems->pluck('id');
        $articleGroups['all'] = collect($articleGroups['all'] ?? [])->reject(
            fn($item) => $item instanceof \App\Models\document && $researchIds->contains($item->id)
        );
        $tabs = [
            'all' => ['label' => 'ทั้งหมด', 'icon' => 'bi-grid'],
            'result' => ['label' => 'ผลการพิจารณา', 'icon' => 'bi-award'],
            'news' => ['label' => 'ข่าวประชาสัมพันธ์', 'icon' => 'bi-megaphone'],
            'activity' => ['label' => 'กิจกรรม', 'icon' => 'bi-calendar-event'],
        ];
        $itemTitle = fn($item) => $item->title ?? $item->name ?? 'ไม่มีชื่อรายการ';
        $itemDate = function ($item) {
            $date = $item->date_announcement ?? $item->start_date ?? $item->created_at ?? null;
            return $date ? \Illuminate\Support\Carbon::parse($date)->locale('th')->translatedFormat('j M Y') : null;
        };
        $itemUrl = fn($item) => isset($item->category_document_id) || isset($item->type_document_id)
            ? route('index.content_show', ['document', $item->id])
            : route('index.content_detail', [$item->id]);
        $itemImage = fn($item) => !empty($item->thumbnail)
            ? asset('storage/content/' . $item->thumbnail)
            : asset('assets_f/img/illustration/illustration-15.webp');
        $grantSchedule = function ($item) {
            if (empty($item->date_announcement) || $item->date_announcement === '0000-00-00') {
                return ['state' => 'pending', 'days' => null, 'label' => 'รอประกาศวันเปิดรับสมัคร', 'date' => null];
            }

            try {
                $openDate = \Illuminate\Support\Carbon::parse($item->date_announcement)->startOfDay();
                $days = (int) now()->startOfDay()->diffInDays($openDate, false);
                $dateLabel = $openDate->locale('th')->translatedFormat('j F') . ' ' . ($openDate->year + 543);

                if ($days > 0) {
                    return ['state' => 'upcoming', 'days' => $days, 'label' => "เปิดรับสมัครในอีก {$days} วัน", 'date' => $dateLabel];
                }
                if ($days === 0) {
                    return ['state' => 'today', 'days' => 0, 'label' => 'เปิดรับสมัครวันนี้', 'date' => $dateLabel];
                }
                return ['state' => 'open', 'days' => abs($days), 'label' => 'เปิดรับสมัครแล้ว', 'date' => $dateLabel];
            } catch (\Throwable $e) {
                return ['state' => 'pending', 'days' => null, 'label' => 'รอประกาศวันเปิดรับสมัคร', 'date' => null];
            }
        };
    @endphp

    <style>
        .home-page{--home-accent:var(--accent-color,#dd3209);--home-ink:#172033;--home-muted:#697386;--home-soft:#f7f5f2;color:var(--home-ink);background:#fff}
        .home-hero{position:relative;min-height:530px;overflow:hidden;background:#191512}
        .home-hero .carousel-item,.home-hero .hero-fallback{min-height:530px;background-position:center;background-size:cover}
        .home-hero .carousel-item::before,.home-hero .hero-fallback::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,18,25,.92),rgba(15,18,25,.55) 55%,rgba(15,18,25,.12))}
        .home-hero .hero-fallback{position:relative;background:radial-gradient(circle at 80% 20%,color-mix(in srgb,var(--home-accent),transparent 35%),transparent 28%),linear-gradient(135deg,#201915,#453226)}
        .hero-content{position:absolute;z-index:2;inset:0;display:flex;align-items:center;pointer-events:none}
        .hero-copy{max-width:720px;color:#fff;pointer-events:auto}
        .hero-eyebrow{display:inline-flex;align-items:center;gap:.55rem;padding:.45rem .8rem;border:1px solid rgba(255,255,255,.35);border-radius:999px;background:rgba(255,255,255,.1);backdrop-filter:blur(8px);font-size:.82rem;letter-spacing:.08em}
        .hero-copy h1{margin:1.15rem 0 .9rem;color:#fff;font-size:clamp(2.25rem,5vw,4.65rem);line-height:1.08;font-weight:800;max-width:680px}
        .hero-copy p{max-width:610px;margin-bottom:1.65rem;color:rgba(255,255,255,.82);font-size:1.05rem;line-height:1.8}
        .hero-action{display:inline-flex;align-items:center;gap:.65rem;padding:.85rem 1.2rem;border-radius:10px;color:#fff;background:var(--home-accent);font-weight:700;transition:.25s}
        .hero-action:hover{color:#fff;transform:translateY(-2px)}
        .home-hero .carousel-indicators{z-index:3;justify-content:flex-end;margin-bottom:1.8rem}
        .home-hero .carousel-indicators [data-bs-target]{width:28px;height:4px;border:0;border-radius:4px}
        .quick-services{position:relative;z-index:4;margin-top:-44px}
        .quick-panel{padding:1rem;border:1px solid rgba(23,32,51,.08);border-radius:18px;background:rgba(255,255,255,.97);box-shadow:0 18px 55px rgba(23,32,51,.13)}
        .quick-link{display:flex;align-items:center;gap:.9rem;height:100%;padding:1rem;border-radius:12px;color:var(--home-ink)}
        .quick-link:hover{color:var(--home-accent);background:color-mix(in srgb,var(--home-accent),transparent 94%)}
        .quick-icon{display:grid;place-items:center;width:44px;height:44px;flex:0 0 44px;border-radius:11px;color:#fff;background:var(--home-accent);font-size:1.2rem}
        .quick-link strong{display:block;font-size:.97rem}.quick-link small{color:var(--home-muted)}
        .home-section{padding:88px 0}.home-section.soft{background:var(--home-soft)}
        .section-kicker{color:var(--home-accent);font-size:.8rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}
        .section-heading{margin:.45rem 0 0;color:var(--home-ink);font-size:clamp(1.75rem,3vw,2.55rem);font-weight:800}
        .section-lead{color:var(--home-muted);line-height:1.75}
        .news-tabs{gap:.45rem;border:0}.news-tabs .nav-link{border:0;border-radius:999px;padding:.62rem 1rem;color:var(--home-muted);background:#fff;font-weight:700}
        .news-tabs .nav-link.active,.news-tabs .nav-link:hover{color:#fff;background:var(--home-accent)}
        .news-card{height:100%;overflow:hidden;border:1px solid rgba(23,32,51,.08);border-radius:16px;background:#fff;box-shadow:0 10px 30px rgba(23,32,51,.06);transition:.3s ease}
        .news-card:hover{transform:translateY(-5px);box-shadow:0 18px 42px rgba(23,32,51,.12)}
        .news-thumb{width:100%;height:190px;object-fit:cover;background:#ece8e4}.news-body{padding:1.2rem}
        .news-meta{display:flex;align-items:center;gap:.45rem;margin-bottom:.65rem;color:var(--home-muted);font-size:.8rem}
        .news-title{display:-webkit-box;overflow:hidden;margin:0;color:var(--home-ink);font-size:1.02rem;font-weight:750;line-height:1.55;-webkit-box-orient:vertical;-webkit-line-clamp:2}
        .news-card:hover .news-title{color:var(--home-accent)}
        .empty-news{padding:3.5rem 1rem;border:1px dashed #d7d2cc;border-radius:16px;color:var(--home-muted);text-align:center;background:#fff}
        .empty-news i{display:block;margin-bottom:.75rem;color:#b6aea6;font-size:2rem}
        .grant-grid{margin-top:2rem}.grant-card{position:relative;height:100%;overflow:hidden;border:1px solid rgba(23,32,51,.09);border-radius:18px;background:#fff;box-shadow:0 12px 35px rgba(23,32,51,.07);transition:.3s}
        .grant-card:hover{transform:translateY(-5px);box-shadow:0 20px 48px rgba(23,32,51,.13)}
        .grant-top{display:flex;align-items:stretch;min-height:118px;border-bottom:1px solid rgba(23,32,51,.07)}
        .grant-countdown{display:flex;flex:0 0 118px;flex-direction:column;align-items:center;justify-content:center;padding:1rem;color:#fff;background:var(--home-accent);text-align:center}
        .grant-countdown strong{font-size:2.15rem;line-height:1}.grant-countdown span{margin-top:.35rem;font-size:.76rem}
        .grant-countdown.is-open{background:#198754}.grant-countdown.is-today{background:#e68a00}.grant-countdown.is-pending{background:#697386}
        .grant-heading{display:flex;align-items:center;padding:1.2rem}.grant-heading h3{display:-webkit-box;overflow:hidden;margin:0;color:var(--home-ink);font-size:1.05rem;font-weight:750;line-height:1.55;-webkit-box-orient:vertical;-webkit-line-clamp:3}
        .grant-info{padding:1.05rem 1.2rem}.grant-status{display:flex;align-items:center;justify-content:space-between;gap:1rem;color:var(--home-muted);font-size:.84rem}
        .grant-status strong{color:var(--home-accent)}.grant-more{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;color:var(--home-ink);font-weight:700}.grant-card:hover .grant-more{color:var(--home-accent)}
        .director-panel{position:sticky;top:120px;overflow:hidden;border-radius:20px;background:var(--home-ink);box-shadow:0 20px 50px rgba(23,32,51,.18)}
        .director-panel-photo{position:relative;height:330px;overflow:hidden;background:#e8e3de}
        .director-panel-photo::after{content:'';position:absolute;inset:auto 0 0;height:45%;background:linear-gradient(transparent,rgba(23,32,51,.72))}
        .director-panel-photo img{width:100%;height:100%;object-fit:cover;object-position:top center}
        .director-panel-label{position:absolute;z-index:1;left:1.25rem;bottom:1rem;color:#fff;font-size:.76rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
        .director-panel-body{padding:1.5rem;color:rgba(255,255,255,.72)}
        .director-panel-body h3{margin:0 0 .35rem;color:#fff;font-size:1.22rem;font-weight:800;line-height:1.5}
        .director-position{display:block;margin-bottom:1rem;color:color-mix(in srgb,var(--home-accent),#fff 30%);font-size:.9rem}
        .director-summary{margin:0 0 1.25rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,.12);font-size:.9rem;line-height:1.75}
        .director-contact{display:flex;align-items:center;justify-content:center;gap:.55rem;width:100%;padding:.85rem 1rem;border-radius:10px;color:#fff;background:var(--home-accent);font-weight:750;transition:.25s}
        .director-contact:hover{color:#fff;transform:translateY(-2px);filter:brightness(1.05)}
        @media(max-width:991.98px){.director-panel{position:relative;top:auto}.director-panel-photo{height:420px}}
        @media(max-width:767.98px){.home-hero,.home-hero .carousel-item,.home-hero .hero-fallback{min-height:480px}.home-hero .carousel-item::before,.home-hero .hero-fallback::before{background:rgba(15,18,25,.7)}.hero-copy p{font-size:.95rem}.quick-services{margin-top:-24px}.home-section{padding:62px 0}.news-tabs{flex-wrap:nowrap;overflow-x:auto;padding-bottom:.5rem}.news-tabs .nav-link{white-space:nowrap}.director-panel-photo{height:340px}}
    </style>

    <div class="home-page">
        <section class="home-hero" aria-label="ข่าวเด่น">
            @if (($banner_top ?? collect())->isNotEmpty())
                <div id="homeHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($banner_top as $banner)
                            <button type="button" data-bs-target="#homeHeroCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="สไลด์ {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($banner_top as $banner)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="background-image:url('{{ $banner->placeholder_img() }}')"></div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="hero-fallback"></div>
            @endif
            <div class="hero-content">
                <div class="container">
                    <div class="hero-copy" data-aos="fade-up">
                        <span class="hero-eyebrow"><i class="bi bi-stars"></i> Research &amp; Innovation</span>
                        <h1>{{ $template->title ?? 'งานวิจัยและนวัตกรรม' }}</h1>
                        <p>{{ $template->detail ?? 'แหล่งรวมข่าวสาร ทุนวิจัย ผลงาน และบริการด้านการวิจัย เพื่อขับเคลื่อนองค์ความรู้สู่การพัฒนาที่ยั่งยืน' }}</p>
                        <a href="#latest-updates" class="hero-action">ดูข่าวสารล่าสุด <i class="bi bi-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <div class="quick-services">
            <div class="container"><div class="quick-panel"><div class="row g-1">
                @foreach ([['research-grants','bi-lightbulb','ทุนวิจัย','โอกาสและประกาศทุน'],['result-tab','bi-award','ผลการพิจารณา','ติดตามผลทุนวิจัย'],['news-tab','bi-megaphone','ข่าวสาร','ข่าวและประกาศล่าสุด'],['activity-tab','bi-calendar-event','กิจกรรม','กิจกรรมที่น่าสนใจ']] as $quick)
                    <div class="col-6 col-lg-3"><a href="#{{ $quick[0] }}" class="quick-link"><span class="quick-icon"><i class="bi {{ $quick[1] }}"></i></span><span><strong>{{ $quick[2] }}</strong><small>{{ $quick[3] }}</small></span></a></div>
                @endforeach
            </div></div></div>
        </div>

        <section id="research-grants" class="home-section">
            <div class="container">
                <div class="row align-items-end g-4">
                    <div class="col-lg-7" data-aos="fade-up">
                        <span class="section-kicker">Research funding</span>
                        <h2 class="section-heading">ประกาศทุนวิจัยและกำหนดเปิดรับสมัคร</h2>
                        <p class="section-lead mt-3 mb-0">เตรียมความพร้อมและติดตามกำหนดเปิดรับข้อเสนอทุนวิจัยล่าสุด</p>
                    </div>
                    <div class="col-lg-5 text-lg-end" data-aos="fade-up" data-aos-delay="100">
                        <a href="#latest-updates" class="hero-action">ดูข่าวและผลทุนทั้งหมด <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="row g-4 grant-grid align-items-start">
                    <div class="col-lg-8">
                        @if ($researchItems->isNotEmpty())
                            <div class="row g-4">
                                @foreach ($researchItems->take(6) as $grant)
                                    @php($schedule = $grantSchedule($grant))
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 70 }}">
                                        <a href="{{ $itemUrl($grant) }}" class="grant-card d-block">
                                            <div class="grant-top">
                                                <div class="grant-countdown {{ $schedule['state'] === 'open' ? 'is-open' : ($schedule['state'] === 'today' ? 'is-today' : ($schedule['state'] === 'pending' ? 'is-pending' : '')) }}">
                                                    @if ($schedule['state'] === 'upcoming')
                                                        <strong>{{ $schedule['days'] }}</strong><span>วันก่อนเปิดรับ</span>
                                                    @elseif ($schedule['state'] === 'today')
                                                        <i class="bi bi-bell-fill fs-2"></i><span>เปิดรับวันนี้</span>
                                                    @elseif ($schedule['state'] === 'open')
                                                        <i class="bi bi-check-circle-fill fs-2"></i><span>เปิดรับแล้ว</span>
                                                    @else
                                                        <i class="bi bi-hourglass-split fs-2"></i><span>รอประกาศ</span>
                                                    @endif
                                                </div>
                                                <div class="grant-heading"><h3>{{ $itemTitle($grant) }}</h3></div>
                                            </div>
                                            <div class="grant-info">
                                                <div class="grant-status"><strong>{{ $schedule['label'] }}</strong>@if ($schedule['date'])<span><i class="bi bi-calendar3 me-1"></i>{{ $schedule['date'] }}</span>@endif</div>
                                                <span class="grant-more">รายละเอียดทุน <i class="bi bi-arrow-up-right"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-news"><i class="bi bi-lightbulb"></i>ยังไม่มีประกาศทุนวิจัยในขณะนี้</div>
                        @endif
                    </div>

                    @if (!empty($md))
                        <div class="col-lg-4" data-aos="fade-left" data-aos-delay="120">
                            <aside class="director-panel">
                                <div class="director-panel-photo">
                                    <img src="{{ $md->show_image() }}" alt="{{ trim(($md->name ?? '') . ' ' . ($md->lastname ?? '')) }}" loading="lazy">
                                    <span class="director-panel-label">Director</span>
                                </div>
                                <div class="director-panel-body">
                                    <h3>@if (!empty($md->prefix_id)){{ $md->prefix() }}@endif {{ $md->name ?? '' }} {{ $md->lastname ?? '' }}</h3>
                                    @if (!empty($md->position_id))<span class="director-position">{{ $md->position() }}</span>@endif
                                    <p class="director-summary">พร้อมรับฟังข้อเสนอแนะ ข้อคิดเห็น และประสานงานด้านการวิจัย เพื่อพัฒนาการให้บริการของสถาบันวิจัยและพัฒนา</p>
                                    <a href="{{ route('index.direct_line_show') }}" class="director-contact">
                                        <i class="bi bi-chat-dots-fill"></i> สายตรงผู้อำนวยการ
                                    </a>
                                </div>
                            </aside>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section id="latest-updates" class="home-section soft">
            <div class="container">
                <div class="row align-items-end g-4 mb-4">
                    <div class="col-lg-6" data-aos="fade-up"><span class="section-kicker">Latest updates</span><h2 class="section-heading">ข่าวสารและประกาศล่าสุด</h2></div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100"><p class="section-lead mb-0">ติดตามข่าวทุนวิจัย ผลการพิจารณา ข่าวประชาสัมพันธ์ และกิจกรรมสำคัญได้จากที่เดียว</p></div>
                </div>
                <ul class="nav news-tabs mb-4" role="tablist" data-aos="fade-up">
                    @foreach ($tabs as $key => $tab)
                        <li class="nav-item"><button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $key }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $key }}-pane" type="button"><i class="bi {{ $tab['icon'] }} me-1"></i>{{ $tab['label'] }}</button></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($tabs as $key => $tab)
                        @php($items = collect($articleGroups[$key] ?? [])->take(8))
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $key }}-pane">
                            @if ($items->isNotEmpty())
                                <div class="row g-4">
                                    @foreach ($items as $item)
                                        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                                            <a href="{{ $itemUrl($item) }}" class="news-card d-block">
                                                <img class="news-thumb" src="{{ $itemImage($item) }}" alt="{{ $itemTitle($item) }}" loading="lazy">
                                                <div class="news-body">@if ($itemDate($item))<div class="news-meta"><i class="bi bi-calendar3"></i>{{ $itemDate($item) }}</div>@endif<h3 class="news-title">{{ $itemTitle($item) }}</h3></div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-news"><i class="bi bi-inbox"></i>ยังไม่มีข้อมูลในหมวดนี้</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection

@section('script_content')
@endsection
