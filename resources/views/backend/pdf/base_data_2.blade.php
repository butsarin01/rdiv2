<!DOCTYPE HTML>
<html>
<head>
    <title>บันทึกข้อมูลประจำเดือน {{$title_date['month_name']}}</title>
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

    .bg-yellow {
        background-color: #faeab2;
    }

    .bg-blue {
        background-color: #68a6d4;
    }

    .bg-green {
        background-color: #7ac16e;
    }

    .bg-orange {
        background-color: #e99e44;
    }

    .fw-bold {
        font-weight: bold;
    }

    table, td, th {
        border: 1px solid #4a4949;
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
<div class="text-center fw-bold" style="padding-top:50px;">
    <span>ตารางสรุปการใช้ไฟฟ้าและน้ำประปาประจำเดือน{{$title_date['month_name']}} {{$title_date['year']}}</span>
</div>
@foreach( $array_sum_data as $key_m => $row_m)
    <div style="text-align: center; align-content: center; margin-top:14px;">
        <table>
            <thead>
            <tr class="bg-yellow">
                <th class="text-center" colspan="{{!empty($row_m->sum_ct) ? 9 : 8}}">
                    สรุปการใช้{{$row_m->name}} {{$title_at['my_department']->name}} ประจำเดือน
                    <span>{{$title_date['month_name']}} {{$title_date['year']}}
                </th>
            </tr>
            <tr class="bg-gray">
                <th class="text-center" width="10%">อาคาร</th>
                <th class="text-center" width="12%">วันที่</th>
                <th class="text-center" width="10%">เลขมิเตอร์<br>ครั้งก่อน</th>
                <th class="text-center" width="10%">เลขมิเตอร์<br>ที่อ่าน</th>
                <th class="text-center {{!empty($row_m->sum_ct) ? '' : 'bg-blue'}}" width="10%">หน่วยที่ใช้/วัน</th>
                @if(!empty($row_m->sum_ct))
                    <th class="text-center bg-blue" width="10%">ค่า CT {{$title_at['my_department']->text_CT}} <br>
                        คูณ {{$title_at['my_department']->number_CT}}/หน่วย
                    </th>
                @endif
                <th class="text-center bg-green" width="10%">ลดลง/หน่วย</th>
                <th class="text-center bg-orange" width="10%">เพิ่มขึ้น/หน่วย</th>
                <th class="text-center">หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{$title_at['my_department']->name}}</td>
                <td class="text-center">{{!empty($row_m->day_last_month) ? $row_m->day_last_month->text_date() : '-'}}</td>
                <td class="text-center">{{!empty($row_m->day_old_month) ? $row_m->day_old_month->number_miter : '-'}}</td>
                <td class="text-center">{{!empty($row_m->day_last_month) ? $row_m->day_last_month->number_miter : '-'}}</td>
                <td class="text-center">{{$row_m->sum_value}}</td>
                @if(!empty($row_m->sum_ct))
                    <td class="text-center">{{number_format($row_m->sum_ct)}}</td>
                    @php($cal_ct = !empty($row_m->day_old_month) ? ($row_m->sum_ct - $row_m->sum_ct_old_month) : $row_m->sum_ct)
                @else
                    @php($cal_ct = !empty($row_m->day_old_month) ? ($row_m->sum_value - $row_m->sum_value_old_month) : $row_m->sum_value)
                @endif
                <td class="text-center">{{($cal_ct < 0 ) ? number_format(abs($cal_ct)) : '-'}}</td>
                <td class="text-center">{{($cal_ct > 0 ) ? number_format(abs($cal_ct)) : '-'}}</td>
                <td class="text-center1">
                       <span >
                          &nbsp;- บันทึกข้อมูลทั้งหมด {{$row_m->sum_day}} วัน
                       </span> <br>
                    @php($stop = count($array_data['th']) - $row_m->sum_day)
                    @if($stop > 0 )<span>&nbsp;- ปิดให้บริการ {{$stop}} วัน </span> @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    @if($key_m < (count($array_sum_data)-1))
        <br>
        <br>
    @endif
@endforeach

</body>
</html>
