{{-- resources/views/auth/passwordless-email.blade.php --}}
@extends('_partials.master')

@section('title', 'Connexion sans mot de passe | Bantou-Foundation')

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
        --bg-light: #f8fafc;
        --border-radius: 12px;
        --transition: all 0.3s ease;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .auth-container {
        max-width: 480px;
        width: 100%;
        background: var(--pure-white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        animation: fadeInUp 0.5s ease-out;
    }

    .auth-header {
        background: linear-gradient(135deg, var(--navy-blue), var(--dark-blue));
        padding: 40px 30px;
        text-align: center;
    }

    .auth-header img {
        height: 70px;
        margin-bottom: 20px;
        cursor: pointer;
        transition: var(--transition);
    }

    .auth-header img:hover { transform: scale(1.05); }

    .auth-header h2 {
        color: white;
        font-size: 1.6rem;
        margin-bottom: 8px;
    }

    .auth-header p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
    }

    .auth-body {
        padding: 40px 32px;
    }

    .info-message {
        background: rgba(45, 74, 138, 0.05);
        border-left: 4px solid var(--medium-blue);
        padding: 14px 16px;
        border-radius: var(--border-radius);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.85rem;
        color: var(--text-dark);
    }

    .info-message i {
        color: var(--medium-blue);
        font-size: 1.2rem;
    }

    .form-group { margin-bottom: 24px; }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .form-control {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid var(--bg-light);
        border-radius: var(--border-radius);
        font-size: 1rem;
        transition: var(--transition);
        background: var(--bg-light);
    }

    .form-control:focus {
        border-color: var(--medium-blue);
        outline: none;
        background: white;
        box-shadow: 0 0 0 3px rgba(45,74,138,0.1);
    }

    .btn {
        width: 100%;
        padding: 14px;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-primary {
        background: var(--medium-blue);
        color: white;
    }

    .btn-primary:hover {
        background: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(45,74,138,0.3);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 24px 0;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    .divider::before, .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--bg-light);
    }

    .divider::before { margin-right: 15px; }
    .divider::after { margin-left: 15px; }

    .alternative-link {
        text-align: center;
        margin-top: 20px;
    }

    .alternative-link a {
        color: var(--medium-blue);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .alternative-link a:hover { text-decoration: underline; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
        .auth-body { padding: 30px 24px; }
        .auth-header h2 { font-size: 1.3rem; }
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <img src="{{ asset('images/bantou-logo.png') }}" onclick="window.location.href='{{ route('home') }}'" alt="Logo">
        <h2>Connexion sans mot de passe</h2>
        <p>Recevez un code par email pour vous connecter</p>
    </div>

    <div class="auth-body">
        <div class="info-message">
            <i class="fas fa-shield-alt"></i>
            <span>Connexion sécurisée : un code unique vous sera envoyé par email.</span>
        </div>

        <form id="emailForm">
            @csrf
            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="exemple@email.com" required autocomplete="email">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn">
                <i class="fas fa-paper-plane"></i> Recevoir le code de connexion
            </button>
        </form>

        <div class="divider">ou</div>

        <div class="alternative-link">
            <a href="{{ route('login') }}">
                <i class="fas fa-lock"></i> Se connecter avec mot de passe
            </a>
        </div>

        <div class="alternative-link">
            <a href="{{ route('adhesion') }}">
                <i class="fas fa-user-plus"></i> Créer un compte
            </a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#emailForm').on('submit', function(e) {
        e.preventDefault();

        const email = $('#email').val().trim();

        if (!email) {
            Swal.fire({ icon: 'warning', title: 'Email requis', text: 'Veuillez entrer votre adresse email.', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            Swal.fire({ icon: 'warning', title: 'Email invalide', text: 'Veuillez entrer une adresse email valide.', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
            return;
        }

        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Envoi en cours...');

        $.ajax({
            url: "{{ route('passwordless.send') }}",
            type: 'POST',
            data: { email: email, _token: '{{ csrf_token() }}' },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Code envoyé !',
                    text: response.message,
                    confirmButtonColor: '#2d4a8a'
                }).then(() => {
                    window.location.href = response.redirect;
                });
            },
            error: function(xhr) {
                let message = 'Une erreur est survenue. Veuillez réessayer.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                Swal.fire({ icon: 'error', title: 'Erreur', text: message, confirmButtonColor: '#2d4a8a' });
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.html('<i class="fas fa-paper-plane"></i> Recevoir le code de connexion');
            }
        });
    });
});
</script>
@endsection
