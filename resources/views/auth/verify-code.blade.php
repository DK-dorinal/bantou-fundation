@extends('_partials.master')

@section('title', 'Validation du code | Bantou-Foundation')
@section('description', 'Entrez le code de validation reçu par email pour finaliser votre connexion.')

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
        --success-green: #10b981;
        --error-red: #ef4444;
        --shadow-light: rgba(15, 26, 58, 0.1);
        --shadow-medium: rgba(15, 26, 58, 0.2);
        --border-radius: 12px;
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
        position: relative;
        overflow-x: hidden;
    }

    .body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 80%, rgba(212, 175, 55, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .verify-container {
        max-width: 550px;
        width: 100%;
        background: var(--pure-white);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        animation: slideInUp 0.5s ease-out;
        position: relative;
        z-index: 1;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .verify-header {
        background: linear-gradient(135deg, var(--navy-blue), var(--dark-blue));
        padding: 35px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .verify-header::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .verify-header img {
        height: 70px;
        margin-bottom: 20px;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        z-index: 1;
    }

    .verify-header img:hover {
        transform: scale(1.05);
    }

    .verify-header h1 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        font-weight: 600;
        color: white;
        position: relative;
        z-index: 1;
    }

    .verify-header p {
        font-size: 0.9rem;
        opacity: 0.9;
        color: rgba(255, 255, 255, 0.9);
        position: relative;
        z-index: 1;
    }

    .verify-body {
        padding: 40px 35px;
        background: var(--pure-white);
    }

    .email-info {
        background: linear-gradient(135deg, rgba(45, 74, 138, 0.05), rgba(45, 74, 138, 0.02));
        border-radius: var(--border-radius);
        padding: 15px 20px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid rgba(45, 74, 138, 0.1);
    }

    .email-icon {
        width: 45px;
        height: 45px;
        background: rgba(45, 74, 138, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .email-icon i {
        font-size: 1.3rem;
        color: var(--medium-blue);
    }

    .email-details {
        flex: 1;
    }

    .email-details .label {
        font-size: 0.75rem;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .email-details .value {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 0.95rem;
        word-break: break-all;
    }

    .edit-email {
        color: var(--medium-blue);
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition);
        white-space: nowrap;
    }

    .edit-email:hover {
        text-decoration: underline;
    }

    .code-section {
        margin-bottom: 30px;
    }

    .code-label {
        display: block;
        margin-bottom: 15px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 0.95rem;
        text-align: center;
    }

    .code-inputs {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .code-input {
        width: 65px;
        height: 75px;
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        font-family: 'Poppins', monospace;
        border: 2px solid var(--bg-light);
        border-radius: var(--border-radius);
        background: var(--bg-light);
        transition: var(--transition);
        color: var(--navy-blue);
    }

    .code-input:focus {
        border-color: var(--medium-blue);
        box-shadow: 0 0 0 4px rgba(45, 74, 138, 0.15);
        outline: none;
        background: white;
        transform: scale(1.02);
    }

    .code-input.error {
        border-color: var(--error-red);
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .btn-verify {
        width: 100%;
        padding: 15px;
        border-radius: var(--border-radius);
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        color: white;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .btn-verify::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-verify:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-verify:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(45, 74, 138, 0.3);
    }

    .btn-verify:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .resend-section {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid var(--bg-light);
    }

    .resend-btn {
        background: none;
        border: none;
        color: var(--medium-blue);
        cursor: pointer;
        font-weight: 500;
        font-size: 0.9rem;
        padding: 8px 16px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 20px;
    }

    .resend-btn:hover:not(:disabled) {
        background: rgba(45, 74, 138, 0.05);
    }

    .resend-btn:disabled {
        color: var(--text-light);
        cursor: not-allowed;
    }

    .timer {
        margin-top: 12px;
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .timer span {
        font-weight: 600;
        color: var(--medium-blue);
    }

    .extra-links {
        margin-top: 25px;
        text-align: center;
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .extra-links a {
        color: var(--text-light);
        text-decoration: none;
        font-size: 0.8rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .extra-links a:hover {
        color: var(--medium-blue);
    }

    .info-message {
        background: rgba(45, 74, 138, 0.05);
        border-left: 4px solid var(--medium-blue);
        padding: 12px 15px;
        margin-bottom: 25px;
        border-radius: var(--border-radius);
        font-size: 0.85rem;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-message i {
        color: var(--medium-blue);
        font-size: 1rem;
    }

    .info-message.warning {
        background: rgba(239, 68, 68, 0.05);
        border-left-color: var(--error-red);
    }

    .info-message.warning i {
        color: var(--error-red);
    }

    .info-message.success {
        background: rgba(16, 185, 129, 0.05);
        border-left-color: var(--success-green);
    }

    .info-message.success i {
        color: var(--success-green);
    }

    @media (max-width: 550px) {
        .verify-body {
            padding: 30px 20px;
        }
        .code-input {
            width: 48px;
            height: 55px;
            font-size: 1.5rem;
        }
        .code-inputs {
            gap: 8px;
        }
        .verify-header h1 {
            font-size: 1.4rem;
        }
        .email-info {
            flex-wrap: wrap;
        }
        .edit-email {
            width: 100%;
            text-align: center;
            margin-top: 5px;
        }
    }

    @media (max-width: 400px) {
        .code-input {
            width: 42px;
            height: 50px;
            font-size: 1.3rem;
        }
        .code-inputs {
            gap: 6px;
        }
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .fa-spinner {
        animation: spin 1s linear infinite;
    }
</style>
@endsection

@section('content')
<div class="body">
    <div class="verify-container">
        <div class="verify-header">
            <img src="{{ asset('images/bantou-logo.png') }}" onclick="window.location.href='{{ route('home') }}'" alt="Bantou Foundation Logo">
            <h1>Validation du code</h1>
            <p>Entrez le code à 6 chiffres reçu par email</p>
        </div>

        <div class="verify-body">
            <div class="email-info">
                <div class="email-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="email-details">
                    <div class="label">Code envoyé à</div>
                    <div class="value" id="userEmail"></div>
                </div>
                <a href="{{ route('login') }}" class="edit-email">
                    <i class="fas fa-pen"></i> Modifier
                </a>
            </div>

            <div id="infoMessage" class="info-message">
                <i class="fas fa-info-circle"></i>
                <span>Un code de validation à 6 chiffres a été envoyé à votre adresse email. Valable 10 minutes.</span>
            </div>

            <form id="codeForm">
                @csrf
                <input type="hidden" id="email" name="email">

                <div class="code-section">
                    <div class="code-label">Code de vérification</div>
                    <div class="code-inputs" id="codeInputs">
                        <input type="text" maxlength="1" class="code-input" data-index="0" autocomplete="off" inputmode="numeric">
                        <input type="text" maxlength="1" class="code-input" data-index="1" autocomplete="off" inputmode="numeric">
                        <input type="text" maxlength="1" class="code-input" data-index="2" autocomplete="off" inputmode="numeric">
                        <input type="text" maxlength="1" class="code-input" data-index="3" autocomplete="off" inputmode="numeric">
                        <input type="text" maxlength="1" class="code-input" data-index="4" autocomplete="off" inputmode="numeric">
                        <input type="text" maxlength="1" class="code-input" data-index="5" autocomplete="off" inputmode="numeric">
                    </div>
                    <input type="hidden" id="fullCode" name="code">
                </div>

                <button type="submit" class="btn-verify" id="verifyBtn">
                    <i class="fas fa-check-circle"></i> Vérifier et me connecter
                </button>
            </form>

            <div class="resend-section">
                <button type="button" id="resendBtn" class="resend-btn" disabled>
                    <i class="fas fa-redo-alt"></i> Renvoyer le code
                </button>
                <div class="timer" id="timer">
                    <i class="far fa-clock"></i> Nouveau code disponible dans <span id="timerSeconds">60</span> secondes
                </div>
            </div>

            <div class="extra-links">
                <a href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Accueil
                </a>
                <a href="{{ route('adhesion') }}">
                    <i class="fas fa-user-plus"></i> Devenir membre
                </a>
                <a href="#" id="contactSupport">
                    <i class="fas fa-headset"></i> Support
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    let resendTimer = null;
    let timerSeconds = 60;
    let isResendDisabled = true;
    let remainingAttempts = 3;
    let isSubmitting = false;

    // Récupérer l'email depuis sessionStorage
    const storedEmail = sessionStorage.getItem('magic_email');

    if (storedEmail) {
        $('#email').val(storedEmail);
        $('#userEmail').text(storedEmail);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Session expirée',
            text: 'Veuillez recommencer la connexion.',
            confirmButtonColor: '#2d4a8a'
        }).then(() => {
            window.location.href = "{{ route('login') }}";
        });
        return;
    }

    function initCodeInputs() {
        $('.code-input').on('input', function(e) {
            const value = $(this).val();
            const index = parseInt($(this).data('index'));

            if (value && !/^\d+$/.test(value)) {
                $(this).val('');
                return;
            }

            if (value && value.length > 1) {
                $(this).val(value.charAt(0));
            }

            $(this).removeClass('error');
            updateFullCode();

            if (value && value.length === 1 && index < 5) {
                $(`.code-input[data-index="${index + 1}"]`).focus();
            }

            if (index === 5 && value && value.length === 1) {
                const fullCode = getFullCode();
                if (fullCode.length === 6) {
                    $('#codeForm').submit();
                }
            }
        });

        $('.code-input').on('keydown', function(e) {
            const index = parseInt($(this).data('index'));

            if (e.key === 'Backspace') {
                if ($(this).val() === '' && index > 0) {
                    $(`.code-input[data-index="${index - 1}"]`).focus();
                }
            }

            if (e.key === 'Enter') {
                e.preventDefault();
                const fullCode = getFullCode();
                if (fullCode.length === 6) {
                    $('#codeForm').submit();
                }
            }

            if (e.key === 'ArrowLeft' && index > 0) {
                e.preventDefault();
                $(`.code-input[data-index="${index - 1}"]`).focus();
            }
            if (e.key === 'ArrowRight' && index < 5) {
                e.preventDefault();
                $(`.code-input[data-index="${index + 1}"]`).focus();
            }
        });

        $('.code-input').on('paste', function(e) {
            e.preventDefault();
            const pastedData = e.originalEvent.clipboardData.getData('text');
            const cleanedData = pastedData.replace(/\D/g, '').slice(0, 6);

            if (cleanedData) {
                const digits = cleanedData.split('');
                $('.code-input').each(function(index) {
                    if (digits[index]) {
                        $(this).val(digits[index]);
                    }
                });
                updateFullCode();

                const lastFilledIndex = Math.min(digits.length - 1, 5);
                if (lastFilledIndex >= 0 && lastFilledIndex < 6) {
                    $(`.code-input[data-index="${lastFilledIndex}"]`).focus();
                }

                if (getFullCode().length === 6) {
                    $('#codeForm').submit();
                }
            }
        });
    }

    function getFullCode() {
        let code = '';
        $('.code-input').each(function() {
            code += $(this).val() || '';
        });
        return code;
    }

    function updateFullCode() {
        const fullCode = getFullCode();
        $('#fullCode').val(fullCode);
    }

    function clearCodeInputs() {
        $('.code-input').val('');
        $('.code-input').first().focus();
        updateFullCode();
        removeErrorClass();
    }

    function removeErrorClass() {
        $('.code-input').removeClass('error');
    }

    function showErrorOnInputs() {
        $('.code-input').addClass('error');
        setTimeout(() => {
            $('.code-input').removeClass('error');
        }, 500);
    }

    function startTimer() {
        timerSeconds = 60;
        isResendDisabled = true;
        $('#resendBtn').prop('disabled', true);
        $('#timerSeconds').text(timerSeconds);
        $('#timer').html('<i class="far fa-clock"></i> Nouveau code disponible dans <span id="timerSeconds">60</span> secondes');

        if (resendTimer) clearInterval(resendTimer);

        resendTimer = setInterval(function() {
            timerSeconds--;
            $('#timerSeconds').text(timerSeconds);

            if (timerSeconds <= 0) {
                clearInterval(resendTimer);
                isResendDisabled = false;
                $('#resendBtn').prop('disabled', false);
                $('#timer').html('<i class="fas fa-envelope"></i> Vous pouvez demander un nouveau code');
            }
        }, 1000);
    }

    function showToast(icon, title, text, timer = 4000) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: timer,
            timerProgressBar: true
        });
    }

    function updateInfoMessage(type, message) {
        const $infoMsg = $('#infoMessage');
        $infoMsg.removeClass('warning success');

        if (type === 'warning') {
            $infoMsg.addClass('warning');
            $infoMsg.html(`<i class="fas fa-exclamation-triangle"></i><span>${message}</span>`);
        } else if (type === 'success') {
            $infoMsg.addClass('success');
            $infoMsg.html(`<i class="fas fa-check-circle"></i><span>${message}</span>`);
        } else {
            $infoMsg.removeClass('warning success');
            $infoMsg.html(`<i class="fas fa-info-circle"></i><span>${message}</span>`);
        }
    }

    // Vérification du code (URL CORRIGÉE)
    $('#codeForm').on('submit', function(e) {
        e.preventDefault();

        if (isSubmitting) return;

        const code = getFullCode();
        const email = $('#email').val();

        if (code.length !== 6) {
            showToast('warning', 'Code incomplet', 'Veuillez entrer les 6 chiffres du code de validation.');
            showErrorOnInputs();
            return;
        }

        isSubmitting = true;
        const submitBtn = $('#verifyBtn');
        const originalBtnHtml = submitBtn.html();
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Vérification en cours...');

        $.ajax({
            url: "{{ route('magic.login.verify') }}",
            type: 'POST',
            data: {
                email: email,
                code: code,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                updateInfoMessage('success', 'Code validé avec succès ! Redirection en cours...');

                Swal.fire({
                    icon: 'success',
                    title: 'Connexion réussie !',
                    text: response.message || 'Redirection vers votre espace membre...',
                    confirmButtonColor: '#2d4a8a',
                    timer: 2000,
                    showConfirmButton: false
                });

                sessionStorage.removeItem('magic_email');

                setTimeout(() => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        window.location.href = "{{ route('user_dashboard') }}";
                    }
                }, 1500);
            },
            error: function(xhr) {
                remainingAttempts--;

                let errorMessage = 'Code invalide ou expiré.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                if (remainingAttempts > 0) {
                    errorMessage += ` Il vous reste ${remainingAttempts} tentative${remainingAttempts > 1 ? 's' : ''}.`;
                } else {
                    errorMessage = 'Trop de tentatives infructueuses. Veuillez demander un nouveau code.';
                    updateInfoMessage('warning', errorMessage);
                    $('#resendBtn').prop('disabled', false);
                }

                showToast('error', 'Code invalide', errorMessage);
                showErrorOnInputs();
                clearCodeInputs();
                updateInfoMessage('warning', errorMessage);
            },
            complete: function() {
                isSubmitting = false;
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnHtml);
            }
        });
    });

    // Renvoyer le code (URL CORRIGÉE)
    $('#resendBtn').on('click', function() {
        if (isResendDisabled) return;

        const email = $('#email').val();

        const resendBtn = $('#resendBtn');
        const originalBtnHtml = resendBtn.html();
        resendBtn.prop('disabled', true);
        resendBtn.html('<i class="fas fa-spinner fa-spin"></i> Envoi...');

        $.ajax({
            url: "{{ route('magic.login.resend') }}",
            type: 'POST',
            data: {
                email: email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                showToast('success', 'Code renvoyé!', response.message || 'Un nouveau code a été envoyé à votre adresse email.');
                clearCodeInputs();
                startTimer();
                remainingAttempts = 3;
                updateInfoMessage('success', 'Un nouveau code a été envoyé à votre adresse email. Valable 10 minutes.');

                setTimeout(() => {
                    updateInfoMessage('info', 'Entrez le code à 6 chiffres reçu par email pour vous connecter.');
                }, 5000);
            },
            error: function(xhr) {
                let errorMessage = 'Impossible de renvoyer le code. Réessayez plus tard.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showToast('error', 'Erreur', errorMessage);
                startTimer();
                updateInfoMessage('warning', errorMessage);
            },
            complete: function() {
                resendBtn.html(originalBtnHtml);
            }
        });
    });

    $('#contactSupport').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Contact Support',
            html: `
                <p style="text-align: left;">Pour toute assistance, contactez-nous :</p>
                <ul style="text-align: left; margin-top: 10px;">
                    <li><i class="fas fa-envelope"></i> support@bantou-foundation.org</li>
                    <li><i class="fab fa-whatsapp"></i> +237 6XX XXX XXX</li>
                </ul>
            `,
            confirmButtonText: 'Fermer',
            confirmButtonColor: '#2d4a8a'
        });
    });

    initCodeInputs();
    startTimer();

    setTimeout(() => {
        $('.code-input').first().focus();
    }, 100);
});
</script>
@endsection
