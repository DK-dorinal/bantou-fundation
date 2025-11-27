<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous Rejoindre - Bantou-Foundation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --glass-bg: rgba(255, 255, 255, 0.9);
            --shadow-light: rgba(15, 26, 58, 0.1);
            --border-radius: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            text-align: center;
            color: var(--navy-blue);
            margin-bottom: 40px;
            font-size: 2.5rem;
            position: relative;
            padding-bottom: 15px;
        }

        .page-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--accent-gold);
            border-radius: 2px;
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .option-box {
            height: 350px;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px var(--shadow-light);
            transition: var(--transition);
        }

        .option-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .option-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: var(--transition);
            z-index: 1;
        }

        .option-box:hover .option-bg {
            transform: scale(1.05);
        }

        .option-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(15, 26, 58, 0.7), rgba(15, 26, 58, 0.9));
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: center;
            color: var(--pure-white);
        }

        .option-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--accent-gold);
        }

        .option-title {
            font-size: 1.8rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .option-text {
            font-size: 1rem;
            margin-bottom: 25px;
            opacity: 0.9;
            max-height: 60px;
            overflow: hidden;
        }

        .option-btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--accent-gold);
            color: var(--navy-blue);
            border: none;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .option-btn:hover {
            background: var(--accent-light);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        /* Images de fond pour chaque option */
        .don-bg {
            background-image: url('https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
        }

        .benevole-bg {
            background-image: url('https://images.unsplash.com/photo-1559027615-cfa462892979?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
        }

        .partenaire-bg {
            background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
        }

        .adhesion-bg {
            background-image: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .option-box {
                height: 300px;
            }

            .option-title {
                font-size: 1.5rem;
            }

            .option-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Rejoignez Bantou-Foundation</h1>

        <div class="options-grid">
            <!-- Faire un don -->
            <div class="option-box">
                <div class="option-bg don-bg"></div>
                <div class="option-overlay">
                    <div class="option-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h3 class="option-title">Faire un don</h3>
                    <p class="option-text">Soutenez nos actions avec un don financier pour transformer des vies.</p>
                    <a href="{{ route('don') }}" class="option-btn">Faire un don</a>
                </div>
            </div>

            <!-- Devenir bénévole -->
            <div class="option-box">
                <div class="option-bg benevole-bg"></div>
                <div class="option-overlay">
                    <div class="option-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                    <h3 class="option-title">Devenir bénévole</h3>
                    <p class="option-text">Offrez votre temps et compétences pour soutenir nos actions sur le terrain.</p>
                    <a href="{{ route('benevole') }}" class="option-btn">Devenir bénévole</a>
                </div>
            </div>

            <!-- Devenir partenaire -->
            <div class="option-box">
                <div class="option-bg partenaire-bg"></div>
                <div class="option-overlay">
                    <div class="option-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="option-title">Devenir partenaire</h3>
                    <p class="option-text">Entreprises et institutions, devenez partenaires et amplifiez notre impact.</p>
                    <a href="{{ route('partenaire') }}" class="option-btn">Devenir partenaire</a>
                </div>
            </div>

            <!-- Adhérer à la fondation -->
            <div class="option-box">
                <div class="option-bg adhesion-bg"></div>
                <div class="option-overlay">
                    <div class="option-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="option-title">Adhérer</h3>
                    <p class="option-text">Rejoignez officiellement la fondation et participez à notre gouvernance.</p>
                    <a href="{{ route('adhesion') }}" class="option-btn">Adhérer</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
