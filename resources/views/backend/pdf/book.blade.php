<!DOCTYPE HTML>
<html>

<head>
    <title>หนังสือร้องเรียน</title>
</head>
<style>
    .text-center {
        align-content: center;
        text-align: center;
    }

    .text-end {
        align-content: right;
        text-align: right;
    }

    .fw-bold {
        font-weight: bold;
    }
</style>

<body>
    <div class="container">
        <div class="col-md-12">
            <h4 class="text-center fw-bold" style="font-size: 18pt">แบบฟอร์มหนังสือร้องเรียน</h4>
            {{--        <div class="col-md-6 offset-md-6"> --}}
            <p class="text-end">วันที่ {{ $date }}</p>
            {{--        </div> --}}
            <div>
                <span>เรื่อง
                    @if ($detail->name_menu == 'ละเมิดและแพ่ง')
                        ร้องเรียน การทุจริต และประพฤติมิชอบ
                    @else
                        {{ $detail->name_menu }}
                    @endif
                </span>
            </div>
            <div>
                <span>เรียน {{ $md ?? '' }}</span>
            </div>
            <div style="text-align: justify1;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>ข้าพเจ้า {{ $detail->name_person }} เป็น
                    {{ $detail->name_type_person() }}</span>
                <span>
                    @if (!empty($detail->email_person))
                        อีเมล {{ $detail->email_person }}
                    @endif
                </span>
                <span>
                    @if (!empty($detail->phone_person))
                        หมายเลขโทรศัพท์ {{ $detail->phone_person }}
                    @endif
                </span>
                <span>ขอร้องเรียน @if (!empty($detail->person_direct))
                        {{ $detail->person_direct }}
                    @endif
                </span>
                <span>สังกัด {{ $agency }}</span>
                <span>มหาวิทยาลัยราชภัฎนครสวรรค์ </span>
                <span class="offset-md-1"> เรื่อง {{ $detail->title }}</span>
            </div>
            <div style="text-align: justify1;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>โดยมีรายละเอียดดังนี้ {{ $detail->detail }}</span>
                @if (!empty($detail->file))
                    <span>พร้อมนี้ ข้าพเจ้าได้แนบเอกสารเพื่อประกอบการพิจารณา </span>
                @endif
            </div>
            <div>
                <br>
                <span>จึงเรียนมาเพื่อโปรดพิจารณาดำเนินการให้ตามความประสงค์ ของข้าพเจ้าต่อไป</span>
            </div>
            <div class="col-md-12 text-center" style="margin-left: 8cm;">
                <br>
                <span>ขอแสดงความนับถือ</span><br>
                <span>{{ $detail->name_person }}</span><br>
                <span>อีเมล {{ $detail->email_person }}</span><br>
                <span>
                    @if (!empty($detail->phone_person))
                        หมายเลขโทรศัพท์ {{ $detail->phone_person }}
                    @endif
                </span>
            </div>
        </div>
    </div>
</body>

</html>
