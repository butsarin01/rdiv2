<form method="POST" name="form_member" enctype="multipart/form-data"
      action="{{route('member.insert')}}">
    @csrf
    <div class="color_status alert fade show" style="background-color: #FFEBCD">
        <div class="form-group row m-b-10">
            <label class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-form-label font-weight-bold text-end">ค้นหาชื่อ
                :</label>
            <div class="col-lg-3 col-xl-3">
                <input id="search-input" type="search" class="form-control name_search"
                       name="name_search "/>
            </div>
            <div class="col-md-1">
                <button id="search-button" type="button" class="btn btn-primary btn-search ">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <label class="col-sm-1 col-md-1 col-lg-1 col-xl-1 col-form-label font-weight-bold">เลือกชื่อ :</label>
            <div class="col-lg-4 col-xl-4 pull-left">
                <select name="user_account" class="form-select select-search "></select>
                <small class="result-count-member hide">พบรายชื่อใกล้เคียง 35 รายการ</small>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 border border-default rounded-2">
            <h5 class="text-center mt-3">ข้อมูลผู้ใช้งาน</h5>
            <hr>
            <div class="form-group row mb-2">
                <label class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label fw-bold text-end">ชื่อเต็ม
                    :</label>
                <div class="col-lg-6 col-xl-6">
                    <input type="text" class="form-control mb-1" name="first_name" id="inputEmail4">
                    <input type="text" class="form-control mb-1 hide1" name="ldap" id="input_ldap"
                           readonly>
                    <input type="text" class="form-control  hide" name="id" id="input_id">
                </div>
            </div>

            <div class="form-group row mb-2">
                <label
                    class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label fw-bold text-end">สิทธิ์ในการเข้าถึง
                    :</label>
                <div class="col-lg-6 col-xl-6">
                    <select name="permission_id" class="form-select" disabled>
                        <option value="0">---เลือกสิทธิ์---</option>
                        @foreach($permissions as $permission)
                            <option
                                value="{{$permission->id}}">{{$permission->name_th}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-2 justify-content-center">
                <div class="col-md-3">
                <button type="submit" class="btn btn-primary m-r-10">บันทึก</button>
                <button type="reset" class="btn btn-danger">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>


</form>
