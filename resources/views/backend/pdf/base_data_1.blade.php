<!DOCTYPE HTML>
<html>
<head>
    <title>บันทึกข้อมูลของ{{$title_at['my_department']->name}} ประจำเดือน{{$title_date['month_name']}}</title>
</head>
<style>
    .footer-table {
        border-top: 1px solid #000;
    }

    .approve {
        border-left: 1px solid #000;
        text-indent: 40px;
    }

    .footer-border-left {
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
        text-indent: 5px;
    }

    .footer-tr {
        margin: 10px;
    }

    .footer-table tr td {
        padding: 2px;
    }

    .p-dotted {
        border-bottom: 1px dotted #000;
    }

    .t-border {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .text-danger {
        color: red;
    }

    .text-center {
        align-content: center;
        text-align: center;
    }

    .bg-gray {
        background-color: #e3e3e3;
    }

    .fw-bold {
        font-weight: bold;
    }

    table, td, th {
        border: 1px solid darkgray;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    /*th, td {*/
    /*    padding: 6px;*/
    /*}*/

</style>
<body>
@foreach( $array_sum_data as $key_m => $row_m)
    <div class="text-center fw-bold">
        <span>บันทึกข้อมูลการใช้{{$row_m->name}}รายวัน</span>
        <br>
        <span>
        ประจำเดือน <span>{{$title_date['month_name']}} {{$title_date['year']}}</span>
        ของ <span>{{$title_at['my_department']->name}}</span>
    </span>

    </div>

    <div style="text-align: center; align-content: center; margin-top:14px;">
        <table>
            <thead>
            <tr class="bg-gray">
                <th class="text-center" width="10%">วันที่</th>
                <th class="text-center" width="15%">เวลาที่บันทึก</th>
                <th class="text-center" width="18%">เลขมิเตอร์ที่อ่าน</th>
                <th class="text-center" width="18%">หน่วยที่ใช้/วัน</th>
                @if(!empty($row_m->sum_ct))
                    <th class="text-center" width="12%">ค่า CT</th>
                @endif
                <th class="text-center">หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($array_data['th'] as $key => $row)
                <tr class="text-center">
                    <td class="text-center">
                        {{($key+1)}}
                    </td>
                    <td class="text-center">
                        {{(!empty($array_data[$row_m->name_eng][$key]) ? $array_data[$row_m->name_eng][$key]->text_time() : '-')}}
                    </td>
                    <td class="text-center">
                        {{(!empty($array_data[$row_m->name_eng][$key]) ? $array_data[$row_m->name_eng][$key]->number_miter : '-')}}
                    </td>
                    <td class="text-center">
                        {{(!empty($array_data[$row_m->name_eng][$key]) ? $array_data[$row_m->name_eng][$key]->value_total : '-')}}
                    </td>
                    @if(!empty($row_m->sum_ct))
                        <td class="text-center">
                            {{(!empty($array_data[$row_m->name_eng][$key]) ? number_format($array_data[$row_m->name_eng][$key]->value_ct) : '-')}}
                        </td>
                    @endif
                    <td class="text-center">

                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfooter>
                <tr class="bg-gray">
                    <td colspan="3" class="text-center fw-bold">
                        รวมปริมาณการใช้{{$row_m->name}} (จำนวน {{$row_m->sum_day}} วัน)
                    </td>
                    <td class="text-center fw-bold">{{$row_m->sum_value}}</td>
                    @if(!empty($row_m->sum_ct))
                        <td class="text-center fw-bold">{{number_format($row_m->sum_ct)}}</td>
                    @endif
                    <td class="text-center"></td>
                </tr>
            </tfooter>
        </table>
    </div>
    @if($key_m < (count($array_sum_data)-1))
        <pagebreak>
    @endif
@endforeach
</body>
</html>
