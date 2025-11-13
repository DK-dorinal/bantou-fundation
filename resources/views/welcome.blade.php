@extends('_partials.master')

@section('title', 'Bantou-Foundation / Accueil')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
<style>
    /* Variables CSS */
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
        --glass-bg-strong: rgba(255, 255, 255, 0.95);
        --shadow-light: rgba(15, 26, 58, 0.1);
        --shadow-medium: rgba(15, 26, 58, 0.2);
        --shadow-strong: rgba(15, 26, 58, 0.3);
        --border-radius: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Reset et styles de base */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background-color: var(--bg-light);
        overflow-x: hidden;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 28px;
        border-radius: var(--border-radius);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
        border: none;
        font-size: 1rem;
        gap: 8px;
    }

    .btn-primary {
        background-color: var(--accent-gold);
        color: var(--navy-blue);
    }

    .btn-primary:hover {
        background-color: var(--accent-light);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background-color: transparent;
        color: var(--pure-white);
        border: 2px solid var(--pure-white);
    }

    .btn-secondary:hover {
        background-color: var(--pure-white);
        color: var(--navy-blue);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Section Chiffres clés */
    .stats-section {
        padding: 2cm;
        background-color: var(--pure-white);
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
        font-size: 2.25rem;
        color: var(--navy-blue);
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background-color: var(--accent-gold);
        margin: 15px auto;
        border-radius: 2px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .stat-card {
        text-align: center;
        padding: 30px 20px;
        border-radius: var(--border-radius);
        background-color: var(--bg-light);
        box-shadow: 0 5px 15px var(--shadow-light);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px var(--shadow-medium);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--navy-blue);
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--text-light);
        text-align: justify;
    }

    /* Section Actions */
    .actions-section {
        padding: 2cm;
        background-color: var(--pure-white);
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .action-card {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px var(--shadow-light);
        transition: var(--transition);
        background-color: var(--pure-white);
    }

    .action-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px var(--shadow-medium);
    }

    .action-image {
        height: 200px;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        position: relative;
        overflow: hidden;
    }

    .action-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .action-image-placeholder {
        position: absolute;
        font-size: 3rem;
        opacity: 0.7;
    }

    .action-content {
        padding: 25px;
    }

    .action-title {
        font-size: 1.5rem;
        color: var(--navy-blue);
        margin-bottom: 15px;
        text-align: center;
    }

    .action-description {
        color: var(--text-light);
        margin-bottom: 20px;
        text-align: justify;
    }

    .action-link {
        color: var(--accent-gold);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
    }

    .action-link:hover {
        gap: 10px;
        color: var(--accent-light);
    }

    /* Section Impact */
    .impact-section {
        padding: 2cm;
        background-color: var(--pure-white);
    }

    .impact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .impact-text {
        padding-right: 20px;
    }

    .impact-text h2 {
        font-size: 2.25rem;
        color: var(--navy-blue);
        margin-bottom: 20px;
    }

    .impact-text p {
        color: var(--text-light);
        margin-bottom: 25px;
        text-align: justify;
        line-height: 1.7;
    }

    .impact-image {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 10px 30px var(--shadow-medium);
    }

    .impact-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Animations */
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes countUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            max-width: 250px;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .stats-section,
        .actions-section,
        .impact-section {
            padding: 1cm;
        }

        .impact-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .impact-text {
            padding-right: 0;
        }
    }

    @media (max-width: 480px) {
        .stats-section,
        .actions-section,
        .impact-section {
            padding: 0.5cm;
        }

        .section-title {
            font-size: 1.75rem;
        }

        .stats-grid,
        .actions-grid{
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
@include("_partials.hero")
<!-- Section Chiffres clés -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title">Nos Chiffres Clés</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" data-count="5608">5,608</div>
                <div class="stat-label">Enfants et familles soutenus grâce à nos programmes d'éducation et de santé, avec des résultats tangibles dans l'amélioration de leurs conditions de vie.</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-count="25">25</div>
                <div class="stat-label">Établissements équipés avec du matériel éducatif et des infrastructures améliorées pour offrir un environnement d'apprentissage de qualité.</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-count="45">45</div>
                <div class="stat-label">Micro-entreprises soutenues avec des formations, du mentorat et des financements pour stimuler l'économie locale et créer des emplois durables.</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-count="1000">1,000+</div>
                <div class="stat-label">Arbres plantés dans le cadre de nos initiatives de reboisement pour lutter contre la déforestation et promouvoir la biodiversité.</div>
            </div>
        </div>
    </div>
</section>

<!-- Section Impact -->
<section class="impact-section">
    <div class="container">
        <div class="impact-content">
            <div class="impact-text">
                <h2>Notre Impact</h2>
                <p>Depuis notre création, Bantou-Foundation a transformé la vie de milliers de personnes à travers l'Afrique. Nos programmes sont conçus pour créer un changement durable et mesurable dans les communautés que nous servons.</p>
                <p>Nous croyons en une approche holistique du développement, où l'éducation, la santé et la durabilité environnementale sont interconnectées. Chaque projet que nous mettons en œuvre est le fruit d'une collaboration étroite avec les communautés locales pour garantir sa pertinence et son efficacité à long terme.</p>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-chart-line"></i> Voir notre rapport d'impact
                </a>
            </div>
            <div class="impact-image">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Impact de Bantou-Foundation">
            </div>
        </div>
    </div>
</section>

<!-- Section Actions -->
<section class="actions-section">
    <div class="container">
        <h2 class="section-title">Nos Actions</h2>
        <div class="actions-grid">
            <div class="action-card">
                <div class="action-image">
                    <!-- Image en ligne pour l'éducation -->
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Éducation et Formation">
                    <div class="action-image-placeholder">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="action-content">
                    <h3 class="action-title">Éducation & Formation</h3>
                    <p class="action-description">Nous offrons des bourses d'études, des programmes d'alphabétisation, des formations numériques et entrepreneuriales pour autonomiser les jeunes et leur donner les outils nécessaires pour réussir dans un monde en constante évolution. Nos programmes sont conçus pour être inclusifs et accessibles à tous, indépendamment de leur origine ou de leur situation économique.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="action-card">
                <div class="action-image">
                    <!-- Image en ligne pour la santé -->
                    <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Santé et Bien-être">
                    <div class="action-image-placeholder">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                </div>
                <div class="action-content">
                    <h3 class="action-title">Santé & Bien-être</h3>
                    <p class="action-description">Nous mettons en place des programmes de prévention contre le VIH et d'autres maladies, apportons un soutien aux hôpitaux locaux et organisons des campagnes de sensibilisation pour améliorer la santé communautaire. Notre approche holistique vise à traiter non seulement les symptômes mais aussi les causes profondes des problèmes de santé dans les communautés que nous servons.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="action-card">
                <div class="action-image">
                    <!-- Image en ligne pour l'environnement -->
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Environnement et Développement durable">
                    <div class="action-image-placeholder">
                        <i class="fas fa-seedling"></i>
                    </div>
                </div>
                <div class="action-content">
                    <h3 class="action-title">Environnement & Développement durable</h3>
                    <p class="action-description">Nous menons des initiatives de reboisement, promouvons l'utilisation d'énergies renouvelables et améliorons la gestion des déchets pour construire un avenir plus vert et durable. Nos projets environnementaux sont conçus en collaboration avec les communautés locales pour assurer leur pertinence et leur durabilité à long terme, tout en créant des opportunités économiques.</p>
                    <a href="#" class="action-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@include("_partials.blog")
@endsection

@section('scripts')
<script>
    // Animation des chiffres
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const numberElement = entry.target;
                    const target = parseInt(numberElement.getAttribute('data-count'));
                    let current = 0;
                    const increment = target / 50;

                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        numberElement.textContent = Math.floor(current).toLocaleString();
                    }, 30);

                    observer.unobserve(numberElement);
                }
            });
        }, { threshold: 0.5 });

        statNumbers.forEach(number => {
            observer.observe(number);
        });
    });
</script>
@endsection
