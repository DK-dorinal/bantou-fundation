<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Variables CSS - Couleurs Bantou Foundation */
    :root {
        --navy-blue: #0f1a3a;
        --dark-blue: #1a2b55;
        --medium-blue: #2d4a8a;
        --light-blue: #3a5fc0;
        --accent-gold: #d4af37;
        --accent-light: #e6c34d;
        --pure-white: #ffffff;
        --text-dark: #1e293b;
        --text-light: #fff;
        --bg-light: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-bg-strong: rgba(255, 255, 255, 0.95);
        --shadow-light: rgba(15, 26, 58, 0.1);
        --shadow-medium: rgba(15, 26, 58, 0.2);
        --shadow-strong: rgba(15, 26, 58, 0.3);
        --border-radius: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Style général pour le footer */
    .bh-footer {
        background: var(--navy-blue);
        color: var(--pure-white);
        font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        position: relative;
        overflow: hidden;
        border-radius: 10px 10px 0 0;
        height: 50vh;
    }

    /* Effet de fond subtil */
    .bh-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 20%, var(--medium-blue) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, var(--accent-gold) 0%, transparent 50%);
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
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        text-align: left;
        height: 3vh;
        overflow: scroll;
        scrollbar-width: none;
    }

    /* Titres de section */
    .bh-section-title {
        font-size: 1.3rem;
        color: var(--accent-gold);
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
        background: var(--accent-gold);
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
        color: var(--text-light);
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
        color: var(--accent-gold);
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
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .bh-contact-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: var(--medium-blue);
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
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .bh-contact-text a:hover {
        color: var(--accent-gold);
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
        border: 1px solid var(--medium-blue);
        border-radius: 8px;
        color: var(--text-light);
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
        background: var(--medium-blue);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .bh-social a i {
        position: relative;
        z-index: 1;
    }

    .bh-social a:hover {
        transform: translateY(-2px);
        border-color: var(--accent-gold);
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
        color: var(--text-light);
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
        border: 1px solid var(--medium-blue);
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        color: var(--pure-white);
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .bh-newsletter-input:focus {
        outline: none;
        border-color: var(--accent-gold);
        background: rgba(255, 255, 255, 0.08);
    }

    .bh-newsletter-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .bh-newsletter-btn {
        width: 100%;
        margin-top: 10px;
        padding: 12px;
        background: var(--accent-gold);
        color: var(--navy-blue);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .bh-newsletter-btn:hover {
        background: var(--accent-light);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    /* Section bottom */
    .bh-bottom {
        border-top: 1px solid var(--medium-blue);
        padding: 2rem 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .bh-copyright {
        color: var(--text-light);
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

    .bh-grid>* {
        animation: fadeInUp 0.6s ease-out;
    }

    .bh-grid>*:nth-child(1) {
        animation-delay: 0.1s;
    }

    .bh-grid>*:nth-child(2) {
        animation-delay: 0.2s;
    }

    .bh-grid>*:nth-child(3) {
        animation-delay: 0.3s;
    }

    .bh-grid>*:nth-child(4) {
        animation-delay: 0.4s;
    }
</style>
<!-- Footer Bantou Foundation -->
<footer class="bh-footer">
    <div class="bh-container">
        <div class="bh-main-content">
            <div class="bh-grid">
                <!-- À propos -->
                <div class="bh-about">
                    <img src="{{ asset("../asset/img/logo/BFund/logo BH BF-05.png") }}" alt="Bantou Foundation Logo">
                    <p class="bh-about-text">
                        La Fondation Bantou œuvre pour le développement durable et l'autonomisation des communautés en
                        Afrique.
                        Nous nous engageons à créer un impact positif à travers nos actions dans les domaines de la
                        santé,
                        l'éducation et le développement économique.
                    </p>

                    <div class="bh-social">
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Liens rapides -->
                <div class="bh-links">
                    <h4 class="bh-section-title">Liens rapides</h4>
                    <ul>
                        <li><a href="{{ route('identite') }}">Notre Identité</a></li>
                        <li><a href="{{ route('action') }}">Nos Actions</a></li>
                        <li><a href="">Blog & Actualités</a></li>
                        <li><a href="{{ route('don') }}">Faire un don</a></li>
                        <li><a href="{{ route('benevole') }}">Devenir bénévole</a></li>
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
                            Yaoundé, Cameroun
                        </div>
                    </div>

                    <div class="bh-contact-item">
                        <div class="bh-contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="bh-contact-text">
                            <a href="tel:+237XXXXXXXX">+237 XX XX XX XX</a>
                        </div>
                    </div>

                    <div class="bh-contact-item">
                        <div class="bh-contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="bh-contact-text">
                            <a href="mailto:contact@bantou-foundation.org">contact@bantou-foundation.org</a>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bh-newsletter">
                    <h4 class="bh-section-title">Newsletter</h4>
                    <p>Restez informé de nos dernières actions et actualités.</p>
                    <form class="bh-newsletter-form" onsubmit="handleNewsletterSubmit(event)">
                        <input type="email" class="bh-newsletter-input" placeholder="votre@email.com" required
                            name="email">
                        <button type="submit" class="bh-newsletter-btn">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    // JavaScript pour le menu hamburger
    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        const dropdowns = document.querySelectorAll('.dropdown');

        // Toggle menu mobile
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Gestion des dropdowns en mobile
        dropdowns.forEach(dropdown => {
            const link = dropdown.previousElementSibling;

            link.addEventListener('click', function (e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        });

        // Fermer le menu en cliquant sur un lien
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    hamburger.classList.remove('active');
                    navMenu.classList.remove('active');
                    dropdowns.forEach(d => d.classList.remove('active'));
                }
            });
        });

        // Fermer le menu en redimensionnant la fenêtre
        window.addEventListener('resize', function () {
            if (window.innerWidth > 768) {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                dropdowns.forEach(d => d.classList.remove('active'));
            }
        });
    });

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
