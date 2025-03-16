<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .email-container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #0d6efd;
            text-align: center;
            box-sizing: border-box;
        }

        .email-header img {
            max-width: 120px;
            margin-bottom: 15px;
        }

        .email-header h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .email-body {
            margin: 20px 0;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0b5ed7;
        }

        .email-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }

            .btn {
                width: 100%;
                padding: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Reset Password Anda</h2>
        </div>
        <div class="email-body">
            <p>Halo, {{ $user->name }}!</p>
            <p>Silahkan reset password baru anda dengan klik button di bawah ini</p>
            <p>
                <a href="{{ $url }}" class="btn" style="color: white;">Reset Password</a>
            </p>
            <p>Jika Anda tidak ingin reset password, abaikan email ini.</p>
        </div>
        <div class="email-footer">
            <p>Copyright &copy; Dev Academy 2025</p>
        </div>
    </div>
</body>

</html>
