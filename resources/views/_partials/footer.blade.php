<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Bantou Holidays Amélioré</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables de couleurs */
        :root {
            --primary: #f39200;
            --secondary: #00ace9;
            --dark-bg: rgba(18, 18, 18, 1);
            --text-color: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.8);
            --border-color: rgba(255, 255, 255, 0.1);
        }

        /* Style général pour le footer */
        .bh-footer {
            background: linear-gradient(135deg, var(--dark-bg) 0%, rgba(0, 0, 0, 0.9) 100%);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Effet de fond subtil */
        .bh-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 20%, var(--primary)10 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, var(--secondary)10 0%, transparent 50%);
            opacity: 0.05;
            pointer-events: none;
        }

        .bh-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Section principale */
        .bh-main-content {
            padding: 3rem 0 2rem;
        }

        /* Grille responsive */
        .bh-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr 1fr;
            gap: 2.5rem;
            margin-bottom: 2rem;
        }

        /* Logo et description */
        .bh-about {
            padding-right: 1rem;
        }

        .bh-about img {
            max-width: 180px;
            margin-bottom: 1.5rem;
            filter: brightness(1.1);
        }

        .bh-about-text {
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            text-align: left;
        }

        /* Titres de section */
        .bh-section-title {
            font-size: 1.3rem;
            color: var(--secondary);
            margin-bottom: 1.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.5rem;
            text-align: left;
        }

        .bh-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 1px;
        }

        /* Liens */
        .bh-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .bh-links li {
            margin-bottom: 0.8rem;
        }

        .bh-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .bh-links a::before {
            content: '👉';
            margin-right: 8px;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .bh-links a:hover {
            color: var(--primary);
            transform: translateX(5px);
        }

        .bh-links a:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        /* Contact */
        .bh-contact-item {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .bh-contact-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: var(--secondary);
            border-radius: 50%;
            margin-right: 12px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .bh-contact-icon i {
            color: white;
            font-size: 0.9rem;
        }

        .bh-contact-text {
            text-align: left;
        }

        .bh-contact-text a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .bh-contact-text a:hover {
            color: var(--primary);
        }

        /* Icônes sociales */
        .bh-social {
            display: flex;
            gap: 0.8rem;
            margin-top: 1.5rem;
        }

        .bh-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .bh-social a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--secondary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .bh-social a i {
            position: relative;
            z-index: 1;
        }

        .bh-social a:hover {
            transform: translateY(-2px);
            border-color: var(--primary);
        }

        .bh-social a:hover::before {
            opacity: 1;
        }

        .bh-social a:hover i {
            color: white;
        }

        /* Newsletter */
        .bh-newsletter p {
            margin-bottom: 1.5rem;
            line-height: 1.6;
            color: var(--text-muted);
            font-size: 0.95rem;
            text-align: left;
        }

        .bh-newsletter-form {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .bh-newsletter-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-color);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .bh-newsletter-input:focus {
            outline: none;
            border-color: var(--secondary);
            background: rgba(255, 255, 255, 0.08);
        }

        .bh-newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .bh-newsletter-btn {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            background: var(--secondary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .bh-newsletter-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(243, 146, 0, 0.3);
        }

        /* Section bottom */
        .bh-bottom {
            border-top: 1px solid var(--border-color);
            padding: 2rem 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .bh-copyright {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .bh-bottom-logo img {
            max-width: 100px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .bh-bottom-logo img:hover {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .bh-grid {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .bh-main-content {
                padding: 2rem 0;
            }

            .bh-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2.5rem;
            }

            .bh-about {
                padding-right: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .bh-about-text {
                text-align: center;
                max-width: 90%;
                margin-left: auto;
                margin-right: auto;
            }

            .bh-section-title {
                text-align: center;
            }

            .bh-section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .bh-links ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .bh-links a {
                justify-content: center;
            }

            .bh-contact-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .bh-contact-icon {
                margin-right: 0;
                margin-bottom: 8px;
            }

            .bh-contact-text {
                text-align: center;
            }

            .bh-newsletter p {
                text-align: center;
            }

            .bh-newsletter-form {
                margin: 0 auto;
            }

            .bh-bottom {
                text-align: center;
                flex-direction: column;
            }
        }

        /* Animation d'entrée */
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

        .bh-grid > * {
            animation: fadeInUp 0.6s ease-out;
        }

        .bh-grid > *:nth-child(1) { animation-delay: 0.1s; }
        .bh-grid > *:nth-child(2) { animation-delay: 0.2s; }
        .bh-grid > *:nth-child(3) { animation-delay: 0.3s; }
        .bh-grid > *:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <footer class="bh-footer">
        <div class="bh-container">
            <div class="bh-main-content">
                <div class="bh-grid">
                    <!-- À propos -->
                    <div class="bh-about">
                        <img src="../logo BH_01.png" alt="Bantou Holidays Logo">
                        <p class="bh-about-text">
                            Découvrez l'Afrique authentique avec Bantou Holidays. Votre partenaire de confiance pour des expériences de voyage inoubliables au cœur du continent africain.
                        </p>

                        <div class="bh-social">
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-discord"></i></a>
                        </div>
                    </div>

                    <!-- Liens rapides -->
                    <div class="bh-links">
                        <h4 class="bh-section-title">Liens rapides</h4>
                        <ul>
                            <li><a href="">Expériences</a></li>
                            <li><a href="">Réservation</a></li>
                            <li><a href="">Nos Projets</a></li>
                            <li><a href="">Nos partenaires</a></li>
                            <li><a href="">Blog</a></li>
                            {{-- <li><a href="#" >À propos</a></li> --}}
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div class="bh-contact">
                        <h4 class="bh-section-title">Contactez-nous</h4>

                        <div class="bh-contact-item">
                            <div class="bh-contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="bh-contact-text">
                                Titi Garage, Yaoundé<br>Cameroun
                            </div>
                        </div>

                        <div class="bh-contact-item">
                            <div class="bh-contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="bh-contact-text">
                                <a href="tel:+393714660422">+39 371 466 04 22</a><br>
                                <a href="tel:+237674096883">+237 674 09 68 83</a>
                            </div>
                        </div>

                        <div class="bh-contact-item">
                            <div class="bh-contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="bh-contact-text">
                                <a href="mailto:welcome@bantou-holidays.com">welcome@bantou-holidays.com</a>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="bh-newsletter">
                        <h4 class="bh-section-title">Newsletter</h4>
                        <p>Restez informé de nos dernières offres et actualités voyage.</p>
                        <form class="bh-newsletter-form" onsubmit="handleNewsletterSubmit(event)">
                            <input
                                type="email"
                                class="bh-newsletter-input"
                                placeholder="votre@email.com"
                                required
                                name="email"
                            >
                            <button type="submit" class="bh-newsletter-btn">
                                S'abonner
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Section bottom -->
            <div class="bh-bottom">
                <div class="bh-copyright">
                    © 2025 Bantou Holidays. Tous droits réservés.
                </div>
                <div class="bh-bottom-logo">
                    <a href="/">
                        <img src="../by.png" alt="Bantou Holidays">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function handleNewsletterSubmit(event) {
            event.preventDefault();
            const email = event.target.email.value;

            // Simulation d'envoi
            const button = event.target.querySelector('.bh-newsletter-btn');
            const originalText = button.textContent;

            button.textContent = 'Inscription...';
            button.disabled = true;

            setTimeout(() => {
                button.textContent = 'Merci !';
                setTimeout(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                    event.target.reset();
                }, 2000);
            }, 1500);
        }
    </script>
</body>
</html>
