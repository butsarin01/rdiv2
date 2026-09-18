<div class="modal-body">
    <input type="hidden" name="mode" value="">
    <input type="hidden" name="table" value="">
    <input type="hidden" name="base" value="document">

{{--    <div class="form-group row mb-1">--}}
{{--        <label class="col-md-3 col-sm-3 col-form-label" for="name">ปี:</label>--}}
{{--        <div class="col-md-4 col-sm-4">--}}
{{--            <input class="form-control text-year" type="text" id="year"--}}
{{--                   name="year" readonly/>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="div-show-type hide" data-number_div="1">
        <input class="id_type text-type-id hide" type="text" name="id_type" value="">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="name">ประเภทของเอกสาร:</label>
            <div class="col-md-9 col-sm-9">
                <input class="form-control text-type-name" type="text" id="name_type"
                       name="name_type" placeholder=""/>
            </div>
        </div>
    </div>

    <div class="div-show-category hide" data-number_div="2">
        <input class="id_Category text-category-id hide" type="text" name="id_category" value="">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="name">หมวดหมู่:</label>
            <div class="col-md-9 col-sm-9">
                <input class="form-control text-category-name" type="text" id="name_category"
                       name="name_category" placeholder=""/>
            </div>
        </div>
    </div>

    <div class="div-show-title hide" data-number_div="3">
        <input class="id_title text-title-id hide" type="text" name="id_title" value="">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="name">หัวข้อ:</label>
            <div class="col-md-9 col-sm-9">
                <input class="form-control text-title-name" type="text" id="name_title"
                       name="name_title"
                       placeholder=""/>
            </div>
        </div>
    </div>

    <div class="div-show-Subtitle hide" data-number_div="4">
        <input class="id_Subtitle text-Subtitle-id hide" type="text" name="id_Subtitle" value="">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="name">หัวข้อย่อย:</label>
            <div class="col-md-9 col-sm-9">
                <input class="form-control text-Subtitle-name" type="text" id="name_Subtitle"
                       name="name_Subtitle"
                       placeholder=""/>
            </div>
        </div>
    </div>

    <div class="form-group row mb-1">
        <label class="col-md-3 col-sm-3 col-form-label" for="name">ลำดับการแสดง:</label>
        <div class="col-md-4 col-sm-4">
            <input class="form-control text-ordinal" type="number" id="ordinal"
                   name="ordinal" placeholder=""/>
        </div>
    </div>

    <div class="div-show-title hide" data-number_div="3">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="file">รายละเอียดเพิ่มเติม :</label>
            <div class="col-md-9 col-sm-9">
            <textarea class="form-control text-title-detail" rows="7"
                                          name="detail_title"></textarea>
            </div>
        </div>
    </div>

    <div class="div-show-Subtitle hide" data-number_div="4">
        <div class="form-group row mb-1">
            <label class="col-md-3 col-sm-3 col-form-label" for="file">รายละเอียดเพิ่มเติม1233 :</label>
            <div class="col-md-9 col-sm-9">
             <textarea class="form-control text-Subtitle-detail" rows="3"
                       name="detail_Subtitle"></textarea>
            </div>
        </div>
    </div>

</div>
