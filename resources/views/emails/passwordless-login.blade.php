{{-- resources/views/emails/passwordless-login.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de connexion - Bantou-Foundation</title>
    <style>
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 520px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        .header {
            background: linear-gradient(135deg, #0f1a3a 0%, #1a2b55 100%);
            padding: 32px 24px;
            text-align: center;
        }
        .header img {
            height: 60px;
            margin-bottom: 16px;
        }
        .header h1 {
            color: white;
            font-size: 24px;
            margin: 0;
            font-weight: 600;
        }
        .content {
            padding: 32px 28px;
        }
        .greeting {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .message {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 28px;
        }
        .code-container {
            background: #f8fafc;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin: 24px 0;
            border: 1px solid #e2e8f0;
        }
        .code {
            font-size: 38px;
            letter-spacing: 12px;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            color: #2d4a8a;
            background: white;
            display: inline-block;
            padding: 16px 28px;
            border-radius: 12px;
            border: 1px solid #cbd5e1;
        }
        .expiry {
            color: #ef4444;
            font-size: 13px;
            margin-top: 12px;
        }
        .footer {
            background: #f8fafc;
            padding: 20px 28px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #94a3b8;
        }
        .footer a {
            color: #2d4a8a;
            text-decoration: none;
        }
        @media (max-width: 520px) {
            .code { font-size: 28px; letter-spacing: 8px; padding: 12px 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/bantou-logo.png') }}" alt="Bantou Foundation">
            <h1>Connexion sécurisée</h1>
        </div>

        <div class="content">
            <div class="greeting">Bonjour,</div>

            <div class="message">
                Vous avez demandé à vous connecter à votre espace membre Bantou-Foundation.<br>
                Utilisez le code ci-dessous pour valider votre connexion :
            </div>

            <div class="code-container">
                <div class="code">{{ $code }}</div>
                <div class="expiry">⏱️ Ce code expire dans {{ $expiresInMinutes }} minutes</div>
            </div>

            <div class="message" style="font-size: 13px;">
                Si vous n'êtes pas à l'origine de cette demande, ignorez cet email.<br>
                Pour des raisons de sécurité, ne partagez jamais ce code.
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Bantou-Foundation - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
