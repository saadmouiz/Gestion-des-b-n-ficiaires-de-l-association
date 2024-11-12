<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global styles */
        body {
            background: linear-gradient(135deg, #6c757d, #343a40);
            font-family: 'Roboto', sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background-color: #2c3e50;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-box h2 {
            color: #fff;
            margin-bottom: 1.5rem;
            font-weight: bold;
            font-size: 2rem;
        }

        .login-box .form-control {
            background-color: #34495e;
            border: 1px solid #34495e;
            color: #fff;
            border-radius: 10px;
            font-size: 16px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .login-box .form-control:focus {
            border-color: #1abc9c;
            box-shadow: 0 0 8px rgba(26, 188, 156, 0.6);
        }

        .login-box .btn-primary {
            background-color: #1abc9c;
            border-color: #1abc9c;
            border-radius: 10px;
            padding: 12px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .login-box .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
            cursor: pointer;
        }

        .forgot-password {
            color: #ccc;
            font-size: 14px;
            text-decoration: none;
            margin-top: 1rem;
            display: inline-block;
        }

        .forgot-password:hover {
            color: #1abc9c;
            text-decoration: underline;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h2>Connexion Admin</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
        <a href="#" class="forgot-password">Mot de passe oublié ?</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
