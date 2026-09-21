@extends('backend.master')
@section('content')
<div class="rdi-register">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div><h1 class="h3 mb-1">เลขอ้างอิงนากา</h1><p class="text-muted mb-0">เลือกปีงบประมาณเพื่อดูรายการที่เกี่ยวข้อง</p></div>
        <span class="badge bg-primary fs-6">ทั้งหมด {{ number_format($totalCount) }} รายการ</span>
    </div>
    <div class="panel"><div class="panel-body">
        <nav class="nav nav-pills gap-2" aria-label="ปีงบประมาณ">
            <a href="{{ route('reference_naga.show', ['year' => 'all']) }}" class="nav-link {{ $selectedYear === 'all' ? 'active' : '' }}" @if ($selectedYear === 'all') aria-current="page" @endif>
                ทุกปี <span class="badge bg-secondary ms-1">{{ number_format($totalCount) }}</span>
            </a>
            @foreach ($years as $yearSummary)
                <a href="{{ route('reference_naga.show', ['year' => $yearSummary->year]) }}" class="nav-link {{ $selectedYear === (string) $yearSummary->year ? 'active' : '' }}" @if ($selectedYear === (string) $yearSummary->year) aria-current="page" @endif>
                    {{ $yearSummary->year === 'unassigned' ? 'ไม่ระบุปี' : 'ปี '.$yearSummary->year }}
                    @if ($yearSummary->year !== 'unassigned' && !preg_match('/^[0-9]{4}$/', (string) $yearSummary->year))
                        <span class="badge bg-warning text-dark">ตรวจสอบปี</span>
                    @endif
                    <span class="badge bg-secondary ms-1">{{ number_format($yearSummary->total) }}</span>
                </a>
            @endforeach
        </nav>
    </div></div>
    <div class="panel"><div class="panel-body">@include('backend.rdi_document.form_naga')</div></div>
    <div class="panel"><div class="panel-body">
        <h2 class="h5 mb-3">
            {{ $selectedYear === 'all' ? 'รายการทุกปี' : ($selectedYear === 'unassigned' ? 'รายการที่ไม่ระบุปี' : 'ปีงบประมาณ '.$selectedYear) }}
            <span class="badge bg-primary ms-1">{{ number_format($document->count()) }} รายการ</span>
        </h2>
        <div class="table-responsive">
            <table @if ($document->isNotEmpty()) id="data-table-keytable" @endif class="table table-striped table-bordered table-td-valign-middle w-100">
                <thead><tr><th>ลำดับ</th><th>ปีงบประมาณ</th><th>เลขอ้างอิง</th><th>ชื่อเอกสาร</th><th>โครงการ</th><th>งบประมาณ (บาท)</th><th>จัดการ</th></tr></thead>
                <tbody>
                @forelse ($document as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td><td>{{ trim((string) $row->year) ?: 'ไม่ระบุปี' }}</td>
                        <td>{{ $row->string_number }}</td><td>{{ $row->title }}</td><td>{{ $row->type }}</td>
                        <td class="text-end">{{ is_numeric($row->budget) ? number_format((float) $row->budget, 2) : ($row->budget ?: '-') }}</td>
                        <td><a class="btn btn-red btn-sm" href="{{ route('reference_naga.delete', $row->id) }}">ลบ</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">ไม่พบรายการในปีที่เลือก</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</div>
@endsection
