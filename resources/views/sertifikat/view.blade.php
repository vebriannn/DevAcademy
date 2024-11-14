<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Penghargaan {{ $name }}</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            width: 100%;
        }

        .certificate-container {
            position: relative;
            width: 100%;
            height: 680px;
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .certificate-logo img {
            width: 130px;
            height: auto;
            margin-bottom: 20px;
        }

        .certificate-title {
            font-size: 26px;
            font-weight: bold;
            color: #414142;
            margin: 5px 0 10px;
        }

        .certificate-subtitle {
            font-size: 18px;
            color: #666666;
            margin-bottom: 20px;
        }

        .certificate-award {
            font-size: 16px;
            color: #ffffff;
            background-color: #ffb703;
            padding: 6px 20px;
            border-radius: 15px;
            margin: 0 auto;
            margin-bottom: 30px;
            width: auto;
            display: inline-block;
        }

        .certificate-name {
            font-size: 32px;
            font-weight: bold;
            color: #FAA907;
            margin-bottom: 10px;
        }

        .certificate-desc {
            font-size: 16px;
            color: #816A6A;
            margin-bottom: 20px;
        }

        .certificate-date {
            font-size: 16px;
            color: #816A6A;
            margin-bottom: 40px;
        }

        .certificate-signature {
            font-size: 14px;
            color: #457b9d;
        }

        .content {
            position: absolute;
            padding: 20px;
            width: 100%;
            top: 66px;
        }

        .logo-groups-elips {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
        }

        .logo-groups-elips img {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            max-height: 100px;
        }

        .logo-groups-elips img:first-child {
            left: 0;
            transform: translateY(-50%);
        }

        .logo-groups-elips img:last-child {
            right: 0;
            transform: translateY(-50%) scaleX(-1);
        }

        /* Elips di pojok bawah kiri dan kanan */
        .logo-groups-elips-bottom {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
        }

        .logo-groups-elips-bottom img {
            position: absolute;
            bottom: 0;
            transform: translateY(50%) scaleX(1) scaleY(1);
            max-height: 100px;
        }

        .logo-groups-elips-bottom img:first-child {
            left: 0;
            transform: translateY(10%) scaleX(1) scaleY(-1);
        }

        .logo-groups-elips-bottom img:last-child {
            right: 0;
            transform: translateY(10%) scaleX(-1) scaleY(-1);
            ;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <!-- Logo Elips atas -->
        <div class="logo-groups-elips">
            <img src="{{ 'nemolab/member/img/sertifikat/elips-black.png' }}" alt="">
            <img src="{{ 'nemolab/member/img/sertifikat/elips-orange.png' }}" alt="">
        </div>

        <div class="content">
            <!-- Logo -->
            <div class="certificate-logo">
                <img src="{{ 'nemolab/member/img/sertifikat/icon-nemolab.png' }}" alt="Nemolab Logo"
                    style="width: 130px; height: auto;">
            </div>

            <!-- Title -->
            <div class="certificate-title">SERTIFIKAT PENGHARGAAN</div>
            <div class="certificate-subtitle">Sertifikat Pembelajaran Kelas</div>

            <!-- Awarded to -->
            <p class="certificate-award">diberikan kepada :</p>
            <p class="certificate-name">{{ $name }}</p>
            <hr style="width: 70%;"> <!-- Arah horizontal garis -->

            <!-- Description -->
            <div class="certificate-desc">
                Selamat atas keberhasilan anda dalam menyelesaikan kelas<br>
                <span style="font-weight: bold; color: #414142;">“{{ $course }}”</span>
            </div>

            <!-- Date -->
            <div class="certificate-date">{{ $date }}</div>

            <!-- Signature -->
            <div class="certificate-signature">
                <div class="name">Pri Anton Subardio</div>
                CEO Nemolab
            </div>
        </div>

        <!-- Logo Elips bawah -->
        <div class="logo-groups-elips-bottom">
            <img src="{{ 'nemolab/member/img/sertifikat/elips-black.png' }}" alt="">
            <img src="{{ 'nemolab/member/img/sertifikat/elips-orange.png' }}" alt="">
        </div>
    </div>
</body>

</html>
