<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK Agri Insani</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            font-family:'Inter',sans-serif;
        }

        body{
            min-height:100vh;
            overflow:hidden;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
                linear-gradient(
                    135deg,
                    #0F172A 0%,
                    #14532D 45%,
                    #22C55E 100%
                );

            position:relative;
        }

        /* =========================
            BLUR BACKGROUND
        ========================= */

        .blur-1,
        .blur-2,
        .blur-3{
            position:absolute;
            border-radius:999px;
            filter:blur(100px);
            opacity:.35;
        }

        .blur-1{
            width:320px;
            height:320px;
            background:#BBF7D0;
            top:-100px;
            left:-100px;
        }

        .blur-2{
            width:300px;
            height:300px;
            background:#4ADE80;
            bottom:-120px;
            right:-100px;
        }

        .blur-3{
            width:240px;
            height:240px;
            background:#DCFCE7;
            top:40%;
            left:50%;
            transform:translate(-50%,-50%);
        }

        /* =========================
            LOGIN CARD
        ========================= */

        .login-wrapper{
            position:relative;
            z-index:10;
            width:100%;
            max-width:460px;
            padding:20px;
        }

        .login-card{
            position:relative;
            overflow:hidden;

            background:rgba(255,255,255,.12);

            backdrop-filter:blur(20px);

            border:1px solid rgba(255,255,255,.15);

            border-radius:32px;

            padding:45px;

            box-shadow:
                0 25px 60px rgba(0,0,0,.25);
        }

        .login-card::before{
            content:'';

            position:absolute;

            width:220px;
            height:220px;

            border-radius:999px;

            background:rgba(255,255,255,.08);

            top:-100px;
            right:-100px;
        }

        /* =========================
            HEADER
        ========================= */

        .logo-box{
            width:90px;
            height:90px;

            border-radius:24px;

            margin:auto;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
                linear-gradient(
                    135deg,
                    #22C55E,
                    #166534
                );

            box-shadow:
                0 15px 30px rgba(34,197,94,.35);
        }

        .logo-box i{
            font-size:38px;
            color:white;
        }

        .login-title{
            margin-top:28px;

            text-align:center;

            font-size:34px;
            font-weight:900;

            color:white;

            letter-spacing:-1px;
        }

        .login-subtitle{
            margin-top:12px;

            text-align:center;

            color:rgba(255,255,255,.78);

            font-size:15px;
            line-height:1.8;
        }

        /* =========================
            FORM
        ========================= */

        .form-group{
            margin-top:24px;
        }

        .form-label{
            color:white;
            font-size:13px;
            font-weight:700;
            margin-bottom:10px;
        }

        .input-group-custom{
            position:relative;
        }

        .input-icon{
            position:absolute;
            top:50%;
            left:18px;
            transform:translateY(-50%);

            color:#16A34A;
            font-size:15px;
        }

        .form-control{
            height:58px;

            border:none !important;
            outline:none !important;

            border-radius:18px !important;

            background:rgba(255,255,255,.92);

            padding-left:50px;

            font-size:14px;

            box-shadow:none !important;
        }

        .form-control:focus{
            background:white;

            box-shadow:
                0 0 0 5px rgba(34,197,94,.18) !important;
        }

        /* =========================
            BUTTON
        ========================= */

        .login-btn{
            width:100%;
            height:60px;

            margin-top:30px;

            border:none;
            border-radius:20px;

            background:
                linear-gradient(
                    135deg,
                    #16A34A,
                    #22C55E
                );

            color:white;

            font-size:15px;
            font-weight:800;
            letter-spacing:.08em;

            transition:.35s ease;

            box-shadow:
                0 18px 40px rgba(34,197,94,.28);
        }

        .login-btn:hover{
            transform:translateY(-4px);

            box-shadow:
                0 24px 50px rgba(34,197,94,.35);
        }

        /* =========================
            ALERT
        ========================= */

        .custom-alert{
            border:none;
            border-radius:16px;

            background:rgba(239,68,68,.14);

            color:white;

            font-size:14px;

            padding:14px 18px;
        }

        /* =========================
            FOOTER
        ========================= */

        .login-footer{
            margin-top:28px;

            text-align:center;

            color:rgba(255,255,255,.7);

            font-size:13px;
        }

        /* =========================
            MOBILE
        ========================= */

        @media(max-width:576px){

            .login-card{
                padding:35px 24px;
                border-radius:28px;
            }

            .login-title{
                font-size:28px;
            }

        }

    </style>
</head>

<body>

    <!-- BLUR -->
    <div class="blur-1"></div>
    <div class="blur-2"></div>
    <div class="blur-3"></div>

    <!-- LOGIN -->
    <div class="login-wrapper">

        <div class="login-card">

            <!-- HEADER -->
            <div class="text-center">

                <div class="logo-box">
                    <i class="fas fa-user-shield"></i>
                </div>

                <h1 class="login-title">
                    Admin Panel
                </h1>

                <p class="login-subtitle">
                    SMK Agri Insani Management System
                </p>

            </div>

            <!-- ERROR -->
            @if($errors->any())
                <div class="alert custom-alert mt-4">
                    <i class="fas fa-circle-exclamation me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- EMAIL -->
                <div class="form-group">

                    <label class="form-label">
                        Email Admin
                    </label>

                    <div class="input-group-custom">

                        <i class="fas fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email..."
                            required
                            autofocus
                        >

                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-group-custom">

                        <i class="fas fa-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password..."
                            required
                        >

                    </div>

                </div>

                <!-- BUTTON -->
                <button type="submit" class="login-btn">

                    LOGIN ADMIN

                    <i class="fas fa-arrow-right ms-2"></i>

                </button>

            </form>

            <!-- FOOTER -->
            <div class="login-footer">
                © {{ date('Y') }} SMK Agri Insani • All Rights Reserved
            </div>

        </div>

    </div>

</body>
</html>