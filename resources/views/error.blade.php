<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบยุติการใช้งานชั่วคราว</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
            position: relative;
        }

        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite linear;
        }

        .circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: -5s;
        }

        .circle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 30%;
            animation-delay: -10s;
        }

        .circle:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 70%;
            animation-delay: -15s;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.3;
            }
            100% {
                transform: translateY(0px) rotate(360deg);
                opacity: 0.7;
            }
        }

        .container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            /*backdrop-filter: blur(20px);*/
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            /*animation: slideUp 0.8s ease-out;*/
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-container {
            margin-bottom: 30px;
            position: relative;
        }

        .maintenance-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            background: linear-gradient(45deg, #ff6b6b, #ffa500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 40px rgba(255, 107, 107, 0.5);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
            }
        }

        .maintenance-icon::before {
            content: "⚠️";
            font-size: 50px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 1s ease-out 0.3s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
            animation: fadeIn 1s ease-out 0.9s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .info-card h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #ffd700;
        }

        .info-card p {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.5;
        }

        .contact-info {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideIn 1s ease-out 1.2s both;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .contact-info h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #ffd700;
        }

        .contact-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .contact-btn {
            padding: 10px 20px;
            background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.5);
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            padding: 15px 25px;
            background: rgba(255, 107, 107, 0.2);
            border: 1px solid rgba(255, 107, 107, 0.3);
            border-radius: 30px;
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 20px rgba(255, 107, 107, 0.5);
            }
            to {
                box-shadow: 0 0 30px rgba(255, 107, 107, 0.8);
            }
        }

        .status-dot {
            width: 12px;
            height: 12px;
            background: #ff6b6b;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 50% {
                opacity: 1;
            }
            51%, 100% {
                opacity: 0.3;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 30px 20px;
            }

            h1 {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .contact-links {
                flex-direction: column;
                align-items: center;
            }
        }

        .loading-animation {
            margin: 20px 0;
        }

        .loading-dots {
            display: inline-flex;
            gap: 5px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #ffd700;
            border-radius: 50%;
            animation: loading 1.4s infinite both;
        }

        .dot:nth-child(1) { animation-delay: -0.32s; }
        .dot:nth-child(2) { animation-delay: -0.16s; }
        .dot:nth-child(3) { animation-delay: 0s; }

        @keyframes loading {
            0%, 80%, 100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
            40% {
                transform: scale(1.2);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<div class="animated-bg">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div class="container">
    <div class="icon-container">
        <div class="maintenance-icon"></div>
    </div>

    <h1>ระบบยุติการใช้งานชั่วคราว</h1>

    <div class="status-indicator">
        <div class="status-dot"></div>
        <span>ระบบอยู่ระหว่างการบำรุงรักษา</span>
    </div>

    <p class="subtitle">
        ขออภัยในความไม่สะดวก เรากำลังปรับปรุงระบบเพื่อให้การใช้งานดียิ่งขึ้น<br>
        กรุณากลับมาใหม่ในอีกสักครู่
    </p>

    <div class="loading-animation">
        <div class="loading-dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <h3>🔧 สาเหตุ</h3>
            <p>ระบบอยู่ระหว่างการอัปเดตและปรับปรุงประสิทธิภาพ</p>
        </div>
{{--        <div class="info-card">--}}
{{--            <h3>⏱️ ระยะเวลา</h3>--}}
{{--            <p>คาดว่าจะใช้เวลาประมาณ 30-60 นาที</p>--}}
{{--        </div>--}}
{{--        <div class="info-card">--}}
{{--            <h3>📈 ประโยชน์</h3>--}}
{{--            <p>ระบบจะมีความเสถียรและรวดเร็วมากยิ่งขึ้น</p>--}}
{{--        </div>--}}
{{--        <div class="info-card">--}}
{{--            <h3>🔄 สถานะ</h3>--}}
{{--            <p>อัปเดตล่าสุด: <span id="last-update"></span></p>--}}
{{--        </div>--}}
    </div>

{{--    <div class="contact-info">--}}
{{--        <h3>ติดต่อสอบถาม</h3>--}}
{{--        <div class="contact-links">--}}
{{--            <a href="mailto:support@example.com" class="contact-btn">📧 อีเมล</a>--}}
{{--            <a href="tel:02-xxx-xxxx" class="contact-btn">📞 โทรศัพท์</a>--}}
{{--            <a href="#" class="contact-btn">💬 แชท</a>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

<script>
    // อัปเดตเวลาล่าสุด
    function updateTime() {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            timeZone: 'Asia/Bangkok'
        };
        const timeString = now.toLocaleDateString('th-TH', options);
        document.getElementById('last-update').textContent = timeString;
    }

    // เรียกใช้ทันทีและอัปเดตทุก 30 วินาที
    updateTime();
    setInterval(updateTime, 30000);

    // เพิ่มเอฟเฟกต์เมื่อ hover ที่ container
    // const container = document.querySelector('.container');
    // container.addEventListener('mousemove', function(e) {
    //     const rect = container.getBoundingClientRect();
    //     const x = e.clientX - rect.left;
    //     const y = e.clientY - rect.top;
    //
    //     const centerX = rect.width / 2;
    //     const centerY = rect.height / 2;
    //
    //     const rotateX = (y - centerY) / 20;
    //     const rotateY = -(x - centerX) / 20;
    //
    //     container.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    // });
    //
    // container.addEventListener('mouseleave', function() {
    //     container.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
    // });

    // เพิ่มการสั่นเบาๆ ให้กับไอคอน
    const icon = document.querySelector('.maintenance-icon');
    setInterval(() => {
        icon.style.transform = 'rotate(' + (Math.random() * 4 - 2) + 'deg)';
        setTimeout(() => {
            icon.style.transform = 'rotate(0deg)';
        }, 100);
    }, 3000);
</script>
</body>
</html>
