@extends('_partials.master')

@section('title', 'Connexion | Bantou-Foundation')
@section('description', 'Connectez-vous à votre espace membre Bantou-Foundation avec votre adresse email.')

@section('styles')
    <style>
        :root {
            --navy-blue: #0f1a3a;
            --dark-blue: #1a2b55;
            --medium-blue: #2d4a8a;
            --light-blue: #3a5fc0;
            --accent-gold: #d4af37;
            --accent-light: #e6c34d;
            --pure-white: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --shadow-light: rgba(15, 26, 58, 0.1);
            --shadow-medium: rgba(15, 26, 58, 0.2);
            --border-radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .body {
            background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            max-width: 500px;
            width: 100%;
            background: var(--pure-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.6s ease-out;
        }

        .login-header {
            background: linear-gradient(135deg, var(--navy-blue), var(--dark-blue));
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header img {
            height: 70px;
            margin-bottom: 20px;
            transition: var(--transition);
            cursor: pointer;
        }

        .login-header img:hover {
            transform: scale(1.05);
        }

        .login-header h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
            background: var(--pure-white);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid var(--bg-light);
            border-radius: var(--border-radius);
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--bg-light);
        }

        .form-control:focus {
            border-color: var(--medium-blue);
            box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.1);
            outline: none;
            background: white;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border-radius: var(--border-radius);
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: var(--medium-blue);
            color: var(--pure-white);
        }

        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 74, 138, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-outline {
            background: transparent;
            color: var(--medium-blue);
            border: 2px solid var(--medium-blue);
        }

        .btn-outline:hover {
            background: rgba(45, 74, 138, 0.05);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--bg-light);
        }

        .divider::before {
            margin-right: 15px;
        }

        .divider::after {
            margin-left: 15px;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .register-link a {
            color: var(--medium-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-link a:hover {
            color: var(--medium-blue);
        }

        /* Animation */
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
            .login-body {
                padding: 30px 20px;
            }
            .login-header h2 {
                font-size: 1.4rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="body">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('images/bantou-logo.png') }}" onclick="window.location.href='{{ route('home') }}'"
                    alt="Bantou Foundation Logo">
                <h2>Espace Membre</h2>
                <p>Connectez-vous à votre compte Bantou-Foundation</p>
            </div>

            <div class="login-body">
                <div class="info-message">
                    <i class="fas fa-envelope"></i>
                    <span>Entrez votre adresse email pour recevoir un code de connexion sécurisé.</span>
                </div>

                <form id="emailForm">
                    @csrf
                    <div class="form-group">
                        <label for="email">Adresse Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="exemple@email.com" required autocomplete="email">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="sendCodeBtn">
                        <i class="fas fa-paper-plane"></i> Recevoir le code de connexion
                    </button>
                </form>

                <div class="divider">ou</div>

                <div class="register-link">
                    Vous n'avez pas de compte ? <a href="{{ route('adhesion') }}">Devenir membre</a>
                </div>

                <div class="back-link">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-arrow-left"></i> Retour à l'accueil
                    </a>
                </div>
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
                    Swal.fire({
                        icon: 'warning',
                        title: 'Email requis',
                        text: 'Veuillez entrer votre adresse email.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Email invalide',
                        text: 'Veuillez entrer une adresse email valide.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                const submitBtn = $('#sendCodeBtn');
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Envoi en cours...');

                $.ajax({
                    url: "{{ route('magic.login.send') }}",
                    type: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Stocker l'email en sessionStorage pour la page de vérification
                        sessionStorage.setItem('magic_email', email);

                        Swal.fire({
                            icon: 'success',
                            title: 'Code envoyé!',
                            text: response.message,
                            confirmButtonColor: '#2d4a8a'
                        }).then(() => {
                            window.location.href = "{{ route('verify.code') }}";
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Une erreur est survenue. Veuillez réessayer.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: errorMessage,
                            confirmButtonColor: '#2d4a8a'
                        });
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                        submitBtn.html('<i class="fas fa-paper-plane"></i> Recevoir le code de connexion');
                    }
                });
            });

            // Focus automatique sur le champ email
            $('#email').focus();
        });
    </script>
@endsection
