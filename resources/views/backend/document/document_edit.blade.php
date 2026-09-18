@extends('backend.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel ">
                <div class="panel-body">
                    <h4><span class="text-green-700"><i class="far fa-lg fa-fw me-2 fa-pen-to-square"></i>แก้ไขเอกสาร</span> </h4>
                    <hr class="my-3">
                    <h4 class="ms-2 pb-2 text-primary-800">{{$document->name}}</h4>
                    @include('backend.document.form')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_content')
    <script type="text/javascript">
        $.ajaxSetup({
            beforeSend: function (xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });


        // $(document).ready(function() {
        var select_value_type = $("input[name=select_value_type]").val();
        var select_value_category = $("input[name=select_value_category]").val();
        var select_value_title = $("input[name=select_value_title]").val();
        var select_value_subtitle = $("input[name=select_value_subtitle]").val();

        console.log(select_value_type + '---' + select_value_category + '---' + select_value_title + '---' + select_value_subtitle);

        // fetch_type(select_value_type);
        setTimeout(function () {
            fetch_category(select_value_category);
        }, 500);
        setTimeout(function () {
            fetch_title(select_value_title);
        }, 1000);
        setTimeout(function () {
            fetch_sub_title(select_value_subtitle);
        }, 1500);

        // var text_year = $('.dynamic_input_type option:selected').text();
        // var value_year = $('.dynamic_input_type option:selected').val();
        // $(".text-year").val(text_year);
        // $(".text-year-hide").val(value_year);
        // });

        $('.dynamic_input_type').change(function () {
            // var select = $(".dynamic_input_type option:selected").text();
            // var value = $(this).val();
            // var dependent = $(this).data('dependent');
            // var url = "{{route('dynamic_type.fetch')}}";

            // console.log("select = " + select + " value =" + value);
            // // dynamic_select(select,value,dependent,url);
            // dynamic_select(select,value,dependent,url);


            fetch_type();
            setTimeout(function () {
                fetch_category();
            }, 500);
            setTimeout(function () {
                fetch_title();
            }, 1000);
            setTimeout(function () {
                fetch_sub_title();
            }, 1500);

        });


        // $(document).on('change', '.dynamic_input_category', function(){
        $('.dynamic_input_category').change(function () {
            // var option = $('option:selected', this).attr('type_document_id');
            // var select = $(".dynamic_input_category option:selected").text();
            // var value = $(this).val();
            // var dependent = $(this).data('dependent');
            // var url = "{{route('dynamic_category.fetch')}}";
            // // console.log("select = " + select + " value =" + value);
            // dynamic_select(select,value,dependent,url);

            fetch_category();
            setTimeout(function () {
                fetch_title();
            }, 500);
            setTimeout(function () {
                fetch_sub_title();
            }, 1000);

        });
        // $(document).on('change', '.dynamic_input_title', function(){
        $('.dynamic_input_title').change(function () {
            // var select = $(".dynamic_input_title option:selected").text();
            // var value = $(this).val();
            // var dependent = $(this).data('dependent');
            // var url = "{{route('dynamic_title.fetch')}}";
            // // console.log(" select =" + select + "value=" + value);
            // dynamic_select(select,value,dependent,url);

            fetch_title();
            setTimeout(function () {
                fetch_sub_title();
            }, 500);
        });

        $('.dynamic_input_Subtitle').change(function () {
            // var select = $(".dynamic_input_title option:selected").text();
            // var value = $(this).val();
            // var dependent = $(this).data('dependent');
            // var url = "{{route('dynamic_sub_title.fetch')}}";
            // // console.log(" select =" + select + "value=" + value);
            // dynamic_select(select,value,dependent,url);

            fetch_sub_title();
        });

        function fetch_type(select_value_type) {
            var select_year = $(".dynamic_input_type option:selected").text();
            var value_year = $(".dynamic_input_type option:selected").val();

            var dependent_year = $(".dynamic_input_type").data('dependent');
            var url_year = "{{route('dynamic_type.fetch')}}";
            var name = 'type_document_id';
            // console.log("year = " + select_year + " value =" + value_year);
            dynamic_select(select_year, value_year, dependent_year, url_year, name, select_value_type);

        }

        function fetch_category(select_value_category) {
            var select_type = $(".dynamic_input_category option:selected").text();
            var value_type = $(".dynamic_input_category option:selected").val();

            var dependent_type = $(".dynamic_input_category").data('dependent');
            var url_type = "{{route('dynamic_category.fetch')}}";
            var name = 'category_document_id';
            // console.log(" select =" + select_type + "value=" +value_type );
            dynamic_select(select_type, value_type, dependent_type, url_type, name, select_value_category);

        }

        function fetch_title(select_value_title) {
            var select_category = $(".dynamic_input_title option:selected").text();
            var value_category = $(".dynamic_input_title option:selected").val();
            var dependent_category = $(".dynamic_input_title").data('dependent');
            var url_category = "{{route('dynamic_title.fetch')}}";
            var name = 'title_document_id';

            // console.log(" category =" + select_category + "value=" +value_category );
            dynamic_select(select_category, value_category, dependent_category, url_category, name, select_value_title);

        }

        function fetch_sub_title(select_value_subtitle) {
            var select_title = $(".dynamic_input_Subtitle option:selected").text();
            var value_title = $(".dynamic_input_Subtitle option:selected").val();
            var dependent_title = $(".dynamic_input_Subtitle").data('dependent');
            var url_title = "{{route('dynamic_sub_title.fetch')}}";
            var name = 'sub_title_document_id';

            // console.log(" title =" + select_title + "value=" +value_title );
            dynamic_select(select_title, value_title, dependent_title, url_title, name, select_value_subtitle);

        }

        function dynamic_select(select, value, dependent, url, name, data) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: url,
                method: "POST",
                data: {select: select, value: value, _token: _token, dependent: dependent},
                success: function (result) {
                    $('.' + dependent).html(result);
                    $("#loading_"+dependent).addClass('hide');
                    console.log(select + "---" + dependent + "---" + data);

                    if (data != '') {
                        console.log(name);
                        // // var select_value_type = $("input[name=select_value_type]").val();
                        $('select[name=' + name + '] option[value=' + data + ']').prop('selected', true);


                        // // var select_value_category = $("input[name=select_value_category]").val();
                        // $('.category_document_id option[value='+select_value_category+']').prop('selected', true);


                        // // var select_value_title = $("input[name=select_value_title]").val();
                        // $('.title_document_id option[value='+select_value_title+']').prop('selected', true);


                        // // var select_value_subtitle = $("input[name=select_value_subtitle]").val();
                        // $('.sub_title_document_id option[value='+select_value_subtitle+']').prop('selected', true);
                    }

                }
            });

        }


        $(document).on("click", ".add_file", function () {
            var i = $('.input-file').val();
            i++;
            $('.input-file').val(i);
            console.log(i);
            var html = '';
            html += '<div class="row p-t-5">';
            // html += '    <div class="col-md-2 col-sm-2">';
            // html += '        <input class="form-control ordinal_question" type="number" name="ordinal_question_array[]" value="'+i+'" />';
            // html += '    </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label" for="name">ชื่อเอกสาร:</label>';
            html += '   <div class="col-md-5 col-sm-5">';
            html += '       <input class="form-control" type="text" id="name" name="multiname[]" placeholder="" />';
            html += '   </div>';
            html += '   <label class="col-md-1 col-sm-1 col-form-label text-right" for="file">file :</label>';
            html += '   <div class="col-md-5 col-sm-5 ">';
            html += '      <div class="row ">';
            html += '           <div class="col-md-10 col-sm-10 ">';
            html += '           <input class="form-control" type="file"  name="multifilename[]" />';
            html += '       </div>';
            html += '       <div class="col-md-1 col-sm-1">';
            html += '           <button type="button" name="remove"  class="btn btn-danger btn_remove_question">';
            html += '           <i class="fas fa-lg fa-fw fa-minus-circle " ></i></button>';
            html += '       </div>';
            html += '      </div>';
            html += '   </div>';
            html += '</div>';
            $('.div-multifile').append(html);
        });
        $(document).on('click', '.btn_remove_question', function () {
            // console.log($(this).parent().parent().html());
            $(this).parent().parent().parent().parent().remove();
            var numItems = $('.ordinal_question').length;
            console.log(numItems);

            var j;
            $('.ordinal_question').each(function (i, obj) {
                j = i + 1;
                $(this).val(j);
            });

            // console.log('j: ' + j);
            $('.input-file').val(j);
        });
    </script>
@endsection

