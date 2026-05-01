@extends('_partials.master')

@section('title', 'Connexion | Bantou-Foundation')
@section('description', 'Connectez-vous à votre compte Bantou-Foundation pour gérer vos dons, adhésions et bénévolat.')

@section('styles')
<style>
    :root {
        --navy-blue: #0f1a3a;
        --dark-blue: #1a2b55;
        --medium-blue: #2d4a8a;
        --light-blue: #3a5fc0;
        --accent-gold: #d4af37;
        --pure-white: #ffffff;
        --text-dark: #1e293b;
        --text-light: #64748b;
    }

    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-card {
        max-width: 450px;
        width: 100%;
        background: var(--pure-white);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo img {
        height: 70px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .logo img:hover {
        transform: scale(1.05);
    }

    .login-title {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-title h2 {
        font-size: 28px;
        color: var(--navy-blue);
        margin-bottom: 8px;
    }

    .login-title p {
        color: var(--text-light);
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 14px;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-group i {
        position: absolute;
        left: 15px;
        color: var(--text-light);
        font-size: 16px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--medium-blue);
        box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.1);
    }

    .checkbox-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .checkbox-label input {
        margin-right: 8px;
        cursor: pointer;
    }

    .checkbox-label span {
        font-size: 14px;
        color: var(--text-dark);
    }

    .forgot-link {
        font-size: 14px;
        color: var(--medium-blue);
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(45, 74, 138, 0.3);
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .register-link p {
        color: var(--text-light);
        font-size: 14px;
    }

    .register-link a {
        color: var(--medium-blue);
        text-decoration: none;
        font-weight: 600;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-danger {
        background: #fee2e2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
    }

    .alert-success {
        background: #d1fae5;
        color: #059669;
        border-left: 4px solid #059669;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 30px 20px;
        }

        .checkbox-group {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Bantou-Foundation" onclick="window.location.href='{{ route('home') }}'">
        </div>

        <div class="login-title">
            <h2>Connexion</h2>
            <p>Accédez à votre tableau de bord personnel</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle mr-2"></i>
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <div class="checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" value="1">
                    <span>Se souvenir de moi</span>
                </label>
                <a href="{{ route('password.request') }}" class="forgot-link">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
            </button>

            <div class="register-link">
                <p>Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
