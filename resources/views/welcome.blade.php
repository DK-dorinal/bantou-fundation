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

    /* Section Hero améliorée */
    .hero-section {
        background: linear-gradient(rgba(15, 26, 58, 0.7), rgba(26, 43, 85, 0.7)), 
                    url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2072&q=80') no-repeat center center;
        background-size: cover;
        color: var(--pure-white);
        padding: 2cm;
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        padding: 2cm;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 20px;
        font-weight: 700;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease forwards;
        text-align: center;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        margin-bottom: 40px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease 0.3s forwards;
        text-align: justify;
        line-height: 1.8;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s ease 0.6s forwards;
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

    /* Section Témoignages - Carrousel */
    .testimonials-section {
        padding: 2cm;
        background-color: var(--bg-light);
        overflow: hidden;
    }

    .testimonials-container {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        overflow: hidden;
    }

    .testimonials-track {
        display: flex;
        transition: transform 0.5s ease;
        width: max-content;
    }

    .testimonial-card {
        background-color: var(--pure-white);
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: 0 5px 15px var(--shadow-light);
        position: relative;
        transition: var(--transition);
        min-width: 300px;
        margin: 0 15px;
        flex-shrink: 0;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-medium);
    }

    .testimonial-card::before {
        content: '"';
        font-size: 5rem;
        color: var(--accent-gold);
        position: absolute;
        top: -10px;
        left: 20px;
        opacity: 0.3;
        line-height: 1;
    }

    .testimonial-text {
        font-style: italic;
        margin-bottom: 20px;
        font-size: 1.1rem;
        line-height: 1.7;
        text-align: justify;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        font-weight: bold;
        font-size: 1.2rem;
    }

    .author-info h4 {
        color: var(--navy-blue);
        margin-bottom: 5px;
        text-align: center;
    }

    .author-info p {
        color: var(--text-light);
        font-size: 0.9rem;
        text-align: center;
    }

    .carousel-controls {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 30px;
    }

    .carousel-btn {
        background-color: var(--navy-blue);
        color: var(--pure-white);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .carousel-btn:hover {
        background-color: var(--accent-gold);
        color: var(--navy-blue);
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

    /* Section Blog */
    .blog-section {
        padding: 2cm;
        background-color: var(--bg-light);
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .blog-card {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px var(--shadow-light);
        transition: var(--transition);
        background-color: var(--pure-white);
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px var(--shadow-medium);
    }

    .blog-image {
        height: 200px;
        background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        position: relative;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-image-placeholder {
        position: absolute;
        font-size: 3rem;
        opacity: 0.7;
    }

    .blog-content {
        padding: 25px;
    }

    .blog-date {
        color: var(--accent-gold);
        font-size: 0.9rem;
        margin-bottom: 10px;
        display: block;
        text-align: center;
    }

    .blog-title {
        font-size: 1.25rem;
        color: var(--navy-blue);
        margin-bottom: 15px;
        line-height: 1.4;
        text-align: center;
    }

    .blog-excerpt {
        color: var(--text-light);
        margin-bottom: 20px;
        text-align: justify;
    }

    .blog-link {
        color: var(--accent-gold);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
    }

    .blog-link:hover {
        gap: 10px;
        color: var(--accent-light);
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

    @keyframes infiniteScroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            padding: 1cm;
        }
        
        .hero-content {
            padding: 1cm;
        }
        
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
        
        .testimonials-container {
            grid-template-columns: 1fr;
        }
        
        .stats-section,
        .testimonials-section,
        .actions-section,
        .blog-section {
            padding: 1cm;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 0.5cm;
        }
        
        .hero-content {
            padding: 0.5cm;
        }
        
        .section-title {
            font-size: 1.75rem;
        }
        
        .stats-grid,
        .actions-grid,
        .blog-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-section,
        .testimonials-section,
        .actions-section,
        .blog-section {
            padding: 0.5cm;
        }
    }
</style>
@endsection

@section('content')
<!-- Section Hero améliorée -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Bantou-Foundation</h1>
            <p class="hero-subtitle">Œuvrons ensemble pour l'éducation, la santé et le développement durable en Afrique. Notre mission est de créer un impact durable dans les communautés africaines en favorisant l'accès à l'éducation, en améliorant les conditions de santé et en promouvant des pratiques de développement durable. À travers nos programmes et initiatives, nous visons à autonomiser les individus et les communautés pour qu'ils puissent construire un avenir meilleur pour eux-mêmes et les générations futures.</p>
            <div class="hero-buttons">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-handshake"></i> Nous rejoindre
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-heart"></i> Faire un don
                </a>
            </div>
        </div>
    </div>
</section>

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

<!-- Section Témoignages -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title">Témoignages</h2>
        <div class="testimonials-container">
            <div class="testimonials-track" id="testimonials-track">
                <!-- Les témoignages seront dupliqués par JavaScript pour l'effet infini -->
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn" id="prev-btn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn" id="next-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
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

<!-- Section Blog -->
<section class="blog-section">
    <div class="container">
        <h2 class="section-title">Actualités & Blog</h2>
        <div class="blog-grid">
            <div class="blog-card">
                <div class="blog-image">
                    <!-- Image en ligne pour le blog éducation -->
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Méthodologies innovantes pour l'éducation">
                    <div class="blog-image-placeholder">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
                <div class="blog-content">
                    <span class="blog-date">10 Février 2026</span>
                    <h3 class="blog-title">Méthodologies innovantes pour l'éducation</h3>
                    <p class="blog-excerpt">Découvrez nos conseils pratiques pour les enseignants et parents, ainsi que des récits inspirants de réussite d'enfants soutenus par nos programmes éducatifs. Nous partageons également des stratégies éprouvées pour améliorer l'apprentissage dans des contextes à ressources limitées.</p>
                    <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="blog-card">
                <div class="blog-image">
                    <!-- Image en ligne pour le blog campagnes -->
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Campagnes de sensibilisation">
                    <div class="blog-image-placeholder">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="blog-content">
                    <span class="blog-date">15 Mars 2026</span>
                    <h3 class="blog-title">Campagnes de sensibilisation</h3>
                    <p class="blog-excerpt">Découvrez nos prochaines campagnes dans les quartiers et écoles pour promouvoir la santé et l'environnement. Nous détaillons nos approches participatives qui impliquent activement les communautés dans la conception et la mise en œuvre de nos initiatives de sensibilisation.</p>
                    <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="blog-card">
                <div class="blog-image">
                    <!-- Image en ligne pour le blog rapport -->
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Rapport d'impact 2025">
                    <div class="blog-image-placeholder">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="blog-content">
                    <span class="blog-date">5 Avril 2026</span>
                    <h3 class="blog-title">Rapport d'impact 2025</h3>
                    <p class="blog-excerpt">Découvrez comment vos dons ont transformé des vies et des communautés à travers l'Afrique. Ce rapport détaillé présente nos réalisations, les leçons apprises et notre vision pour l'avenir, avec des témoignages directs des bénéficiaires de nos programmes.</p>
                    <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
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

        // Carrousel infini pour les témoignages
        const testimonials = [
            {
                text: "Leur travail pour l'environnement m'a inspiré à planter des arbres avec mes voisins. Ensemble, nous avons redonné vie à notre quartier et créé un espace vert où les enfants peuvent jouer en sécurité. L'approche communautaire de Bantou-Foundation a véritablement transformé notre environnement et renforcé les liens entre voisins.",
                author: "Sammy Minlouka",
                role: "Partenaire communautaire",
                initials: "SM"
            },
            {
                text: "Grâce à Bantou-Foundation, j'ai pu envoyer mes enfants à l'école et créer ma petite entreprise de tissage. Aujourd'hui, nous vivons dignement et nos enfants rêvent grand. Le soutien financier et les formations en entrepreneuriat m'ont donné la confiance nécessaire pour développer mon activité et assurer un avenir meilleur à ma famille.",
                author: "Rowan Stephens",
                role: "Bénéficiaire",
                initials: "RS"
            },
            {
                text: "En tant que bénévole, j'ai vu de mes propres yeux l'impact de Bantou-Foundation. Chaque action, même petite, transforme des vies et donne de l'espoir. La transparence de l'organisation et son engagement envers les communautés locales m'ont convaincu de m'impliquer davantage dans leurs projets de développement durable.",
                author: "Amara Keita",
                role: "Bénévole",
                initials: "AK"
            },
            {
                text: "Leur approche holistique du développement communautaire a permis à notre village d'accéder à l'eau potable et à l'électricité solaire. Un véritable changement qui a amélioré la santé de notre communauté et créé de nouvelles opportunités économiques. La consultation régulière des habitants a assuré que les solutions répondent réellement à nos besoins.",
                author: "Fatou Diop",
                role: "Cheffe de communauté",
                initials: "FD"
            },
            {
                text: "Les formations en entrepreneuriat m'ont donné les outils pour lancer ma petite entreprise. Aujourd'hui, j'emploie trois personnes et je suis autonome financièrement. Le mentorat continu et l'accès à un réseau de soutien ont été déterminants pour surmonter les défis du démarrage et assurer la croissance durable de mon entreprise.",
                author: "Jean Kabeya",
                role: "Entrepreneur",
                initials: "JK"
            }
        ];

        const track = document.getElementById('testimonials-track');
        let currentPosition = 0;
        const cardWidth = 330; // Largeur d'une carte + marge
        let autoScrollInterval;

        // Fonction pour créer une carte de témoignage
        function createTestimonialCard(testimonial) {
            return `
                <div class="testimonial-card">
                    <p class="testimonial-text">"${testimonial.text}"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">${testimonial.initials}</div>
                        <div class="author-info">
                            <h4>${testimonial.author}</h4>
                            <p>${testimonial.role}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        // Dupliquer les témoignages pour l'effet infini
        const duplicatedTestimonials = [...testimonials, ...testimonials, ...testimonials];
        
        // Ajouter les cartes au track
        track.innerHTML = duplicatedTestimonials.map(createTestimonialCard).join('');

        // Fonction pour déplacer le carrousel
        function moveCarousel(direction) {
            const totalCards = duplicatedTestimonials.length;
            const maxPosition = -cardWidth * (totalCards - 3); // 3 cartes visibles à la fois
            
            if (direction === 'next') {
                currentPosition -= cardWidth;
                if (currentPosition < maxPosition) {
                    // Réinitialiser à la position de départ pour l'effet infini
                    currentPosition = 0;
                }
            } else if (direction === 'prev') {
                currentPosition += cardWidth;
                if (currentPosition > 0) {
                    // Aller à la fin pour l'effet infini
                    currentPosition = maxPosition;
                }
            }
            
            track.style.transform = `translateX(${currentPosition}px)`;
        }

        // Événements pour les boutons de navigation
        document.getElementById('next-btn').addEventListener('click', () => moveCarousel('next'));
        document.getElementById('prev-btn').addEventListener('click', () => moveCarousel('prev'));

        // Défilement automatique
        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                moveCarousel('next');
            }, 4000); // Défile toutes les 4 secondes
        }

        // Arrêter le défilement automatique au survol
        track.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });

        // Reprendre le défilement automatique quand la souris quitte
        track.addEventListener('mouseleave', () => {
            startAutoScroll();
        });

        // Démarrer le défilement automatique
        startAutoScroll();
    });
</script>
@endsection