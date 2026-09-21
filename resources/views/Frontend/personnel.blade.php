@extends('Frontend.master')

@section('content')
    @php
        $allPersonnel = $personnelGroups->sum(fn ($group) => $group->people->count()) + $ungroupedPeople->count();
    @endphp

    <style>
        .personnel-page{background:#f7f8fa;min-height:70vh;padding:4.5rem 0}.personnel-heading{max-width:760px;margin-bottom:2.25rem}.personnel-kicker{color:var(--accent-color);font-size:.8rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}.personnel-heading h1{margin:.45rem 0 .7rem;color:#172033;font-size:clamp(2rem,4vw,3.25rem);font-weight:800}.personnel-heading p{margin:0;color:#697386;line-height:1.8}.personnel-group{margin-top:2.5rem}.personnel-group-title{display:flex;align-items:center;gap:.8rem;margin-bottom:1.25rem;color:#172033;font-size:1.35rem;font-weight:800}.personnel-group-title::before{content:'';width:5px;height:28px;border-radius:4px;background:var(--accent-color)}.person-card{height:100%;overflow:hidden;border:1px solid rgba(23,32,51,.08);border-radius:18px;background:#fff;box-shadow:0 10px 30px rgba(23,32,51,.06);transition:.25s}.person-card:hover{transform:translateY(-4px);box-shadow:0 18px 42px rgba(23,32,51,.12)}.person-photo{width:100%;height:290px;object-fit:cover;object-position:center top;background:#e9ecef}.person-body{padding:1.25rem}.person-name{margin:0 0 .35rem;color:#172033;font-size:1.1rem;font-weight:800}.person-position{min-height:1.5rem;margin-bottom:.9rem;color:var(--accent-color);font-weight:700}.person-contact{display:grid;gap:.45rem;color:#697386;font-size:.92rem}.person-contact a{color:inherit}.person-contact i{width:1.15rem;color:var(--accent-color)}.person-profile{display:inline-flex;align-items:center;gap:.45rem;margin-top:1rem;font-weight:700}.personnel-empty{padding:4rem 1rem;border:1px dashed #ccd2da;border-radius:18px;background:#fff;color:#697386;text-align:center}
    </style>

    <section class="personnel-page">
        <div class="container">
            <header class="personnel-heading" data-aos="fade-up">
                <span class="personnel-kicker">Personnel</span>
                <h1>{{ $board->name }}</h1>
                <p>รายชื่อบุคลากรทั้งหมด {{ number_format($allPersonnel) }} คน</p>
            </header>

            @forelse ($personnelGroups as $group)
                <section class="personnel-group" data-aos="fade-up">
                    <h2 class="personnel-group-title">{{ $group->name }}</h2>
                    @if ($group->people->isNotEmpty())
                        <div class="row g-4">
                            @foreach ($group->people as $person)
                                @include('Frontend.partials.person-card', ['person' => $person])
                            @endforeach
                        </div>
                    @else
                        <div class="personnel-empty">ยังไม่มีข้อมูลบุคลากรในกลุ่มนี้</div>
                    @endif
                </section>
            @empty
            @endforelse

            @if ($ungroupedPeople->isNotEmpty())
                <section class="personnel-group" data-aos="fade-up">
                    @if ($personnelGroups->isNotEmpty())
                        <h2 class="personnel-group-title">บุคลากร</h2>
                    @endif
                    <div class="row g-4">
                        @foreach ($ungroupedPeople as $person)
                            @include('Frontend.partials.person-card', ['person' => $person])
                        @endforeach
                    </div>
                </section>
            @elseif ($personnelGroups->isEmpty())
                <div class="personnel-empty" data-aos="fade-up">ไม่พบข้อมูลบุคลากร</div>
            @endif
        </div>
    </section>
@endsection
