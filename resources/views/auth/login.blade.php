<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styling dasar */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
            position: relative; /* Position relative untuk input dan ikon */
        }

        .form-group label {
            display: block;
            margin-bottom: .5rem;
            font-size: 14px;
            font-weight: 600;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: .8rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2575fc;
        }

        .form-group button {
            width: 100%;
            padding: .8rem;
            background-color: #2575fc;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #6a11cb;
        }

        .form-group button:focus {
            outline: none;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
            text-align: center;
        }

        .register-link {
            margin-top: 1rem;
            font-size: 14px;
        }

        .register-link a {
            color: #2575fc;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            margin-top: 1rem;
            font-size: 14px;
        }

        .forgot-password a {
            color: #2575fc;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Styling untuk toggle visibility password */
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 70%;
            right: 0px;
            transform: translateY(-50%);
            color: #2575fc;
            cursor: pointer;
            font-size: 20px;
        }

    </style>
    <!-- Link ke Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="error">
                <ul style="list-style: none; padding-left: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.verify') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required autofocus placeholder="Masukkan email">
            </div>

            <div class="form-group password-container">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" required placeholder="Masukkan kata sandi">
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
            </div>

            <div class="form-group">
                <button type="submit">Masuk</button>
            </div>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang!</a>
        </div>
    </div>

    <script>
        // Toggle password visibility with eye icon
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            // Toggle the type between password and text
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Toggle the icon based on visibility
            togglePassword.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
