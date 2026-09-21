@extends('backend.master')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="panel-title">จัดการรูปแบบประกันคุณภาพ</h4></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('manage_document.insert') }}" class="card border-primary mb-4">
                        @csrf
                        <input type="hidden" name="table" value="quality">
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label class="form-label" for="name_quality">ชื่อรูปแบบประกันคุณภาพ</label>
                                    <input class="form-control" id="name_quality" name="name_quality"
                                        value="{{ old('name_quality') }}" maxlength="250" required>
                                </div>
                                <div class="col-md-4 mt-3 mt-md-0">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-plus-circle me-1"></i>เพิ่มรูปแบบประกันคุณภาพ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="bg-default">
                                <tr>
                                    <th width="8%" class="text-center">ลำดับ</th>
                                    <th>ชื่อรูปแบบประกันคุณภาพ</th>
                                    <th width="25%" class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($qualities as $index => $quality)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('manage_document.insert') }}" class="d-flex gap-2">
                                                @csrf
                                                <input type="hidden" name="table" value="quality">
                                                <input type="hidden" name="id_quality" value="{{ $quality->id }}">
                                                <input class="form-control" name="name_quality"
                                                    value="{{ $quality->name_th }}" maxlength="250" required>
                                                <button class="btn btn-warning text-nowrap" type="submit">
                                                    <i class="far fa-edit me-1"></i>บันทึก
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-danger" href="{{ route('quality.delete', $quality->id) }}"
                                                onclick="return confirm('ยืนยันการลบรูปแบบประกันคุณภาพนี้?')">
                                                <i class="far fa-trash-alt me-1"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center text-muted py-4">ยังไม่มีรูปแบบประกันคุณภาพ</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
