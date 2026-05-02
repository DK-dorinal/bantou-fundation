{{-- resources/views/blog.blade.php --}}
@extends('_partials.master')

@section('title', 'Blog & Actualités | GONAGO')
@section('description', 'Suivez l\'actualité de GONAGO : actualités des transports, conseils de voyage, destinations et innovations au Cameroun.')

@section('styles')
<style>
    :root {
        --primary-blue: #03045E;
        --accent-blue: #0077B6;
        --accent-cyan: #00B4D8;
        --light-bg: #FAFBFF;
        --gray-text: #6B7280;
        --dark-text: #0D0F2B;
        --border-light: #DDE1F0;
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.02);
        --shadow-md: 0 20px 60px rgba(0, 119, 182, 0.08);
        --shadow-lg: 0 30px 80px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Scroll Reveal */
    .reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* Hero Section */
    .blog-hero {
        position: relative;
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: 0;
    }
    .blog-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .blog-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.45);
    }
    .blog-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(3, 4, 94, 0.75) 0%, rgba(0, 119, 182, 0.55) 100%);
    }
    .blog-hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .blog-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0, 119, 182, 0.2);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 119, 182, 0.3);
        padding: 8px 20px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
        margin-bottom: 24px;
    }
    .blog-hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 20px;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }
    .blog-hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Category Pills */
    .categories-section {
        padding: 40px 0;
        background: white;
        border-bottom: 1px solid var(--border-light);
        position: sticky;
        top: 80px;
        z-index: 50;
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
    }
    .categories-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .category-pill {
        padding: 10px 24px;
        background: transparent;
        border: 1px solid var(--border-light);
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark-text);
        cursor: pointer;
        transition: var(--transition);
    }
    .category-pill:hover {
        border-color: var(--accent-blue);
        background: rgba(0, 119, 182, 0.05);
    }
    .category-pill.active {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
        color: white;
        box-shadow: 0 4px 12px rgba(0, 119, 182, 0.25);
    }

    /* Search Bar */
    .search-section {
        padding: 40px 0;
        background: var(--light-bg);
    }
    .search-container {
        max-width: 600px;
        margin: 0 auto;
        display: flex;
        gap: 12px;
    }
    .search-input {
        flex: 1;
        padding: 16px 24px;
        border: 2px solid var(--border-light);
        border-radius: 60px;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
    }
    .search-input:focus {
        outline: none;
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.15);
    }
    .search-btn {
        padding: 0 32px;
        background: var(--accent-blue);
        border: none;
        border-radius: 60px;
        color: white;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: var(--transition);
    }
    .search-btn:hover {
        background: var(--primary-blue);
        transform: translateY(-2px);
    }

    /* Featured Article Card */
    .featured-section {
        padding: 60px 0 40px;
    }
    .featured-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: white;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        transition: var(--transition);
    }
    .featured-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }
    .featured-image {
        height: 400px;
        overflow: hidden;
    }
    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .featured-card:hover .featured-image img {
        transform: scale(1.03);
    }
    .featured-content {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .featured-category {
        display: inline-block;
        padding: 6px 16px;
        background: var(--accent-blue);
        color: white;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: fit-content;
        margin-bottom: 20px;
    }
    .featured-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 16px;
        line-height: 1.3;
    }
    .featured-excerpt {
        color: var(--gray-text);
        margin-bottom: 24px;
        line-height: 1.7;
    }
    .featured-meta {
        display: flex;
        gap: 24px;
        margin-bottom: 24px;
        font-size: 0.85rem;
        color: var(--gray-text);
    }
    .featured-meta i {
        color: var(--accent-blue);
        margin-right: 8px;
    }
    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--accent-blue);
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
    }
    .read-more:hover {
        gap: 12px;
        color: var(--primary-blue);
    }

    /* Articles Grid */
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    .article-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid var(--border-light);
        transition: var(--transition);
    }
    .article-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
    }
    .article-image {
        height: 220px;
        overflow: hidden;
        position: relative;
    }
    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .article-card:hover .article-image img {
        transform: scale(1.05);
    }
    .article-category-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        padding: 6px 14px;
        background: var(--accent-blue);
        color: white;
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .article-content {
        padding: 24px;
    }
    .article-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .article-excerpt {
        color: var(--gray-text);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .article-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 0.75rem;
        color: var(--gray-text);
    }
    .article-meta i {
        color: var(--accent-blue);
        margin-right: 6px;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 50px;
    }
    .page-link {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--border-light);
        border-radius: 14px;
        color: var(--dark-text);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    .page-link:hover,
    .page-link.active {
        background: var(--accent-blue);
        border-color: var(--accent-blue);
        color: white;
    }

    /* Sidebar */
    .blog-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 50px;
        padding: 40px 0;
    }
    .sidebar {
        position: sticky;
        top: 140px;
        height: fit-content;
    }
    .sidebar-widget {
        background: white;
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 30px;
        border: 1px solid var(--border-light);
    }
    .widget-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--accent-blue);
        display: inline-block;
    }
    .recent-posts-list {
        list-style: none;
    }
    .recent-post-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid var(--border-light);
    }
    .recent-post-image {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        object-fit: cover;
    }
    .recent-post-info h4 {
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 6px;
    }
    .recent-post-info h4 a {
        color: var(--dark-text);
        text-decoration: none;
        transition: var(--transition);
    }
    .recent-post-info h4 a:hover {
        color: var(--accent-blue);
    }
    .recent-post-date {
        font-size: 0.7rem;
        color: var(--gray-text);
    }
    .tags-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .tag {
        padding: 8px 18px;
        background: var(--light-bg);
        border-radius: 100px;
        font-size: 0.8rem;
        color: var(--dark-text);
        text-decoration: none;
        transition: var(--transition);
    }
    .tag:hover {
        background: var(--accent-blue);
        color: white;
    }

    /* Newsletter Section */
    .newsletter-section {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
        border-radius: 32px;
        padding: 60px 40px;
        text-align: center;
        margin: 60px 0;
    }
    .newsletter-title {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 16px;
    }
    .newsletter-text {
        color: rgba(255, 255, 255, 0.85);
        max-width: 500px;
        margin: 0 auto 30px;
    }
    .newsletter-form {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
        gap: 12px;
    }
    .newsletter-input {
        flex: 1;
        padding: 16px 24px;
        border: none;
        border-radius: 60px;
        font-size: 1rem;
    }
    .newsletter-btn {
        padding: 0 32px;
        background: var(--accent-cyan);
        border: none;
        border-radius: 60px;
        color: var(--primary-blue);
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }
    .newsletter-btn:hover {
        background: white;
        transform: translateY(-2px);
    }

    /* Loading Skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f2fa 25%, #e2e6f5 50%, #f0f2fa 75%);
        background-size: 200% 100%;
        animation: shimmer 1.8s linear infinite;
        border-radius: 16px;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .blog-layout { grid-template-columns: 1fr; }
        .sidebar { position: static; }
        .featured-card { grid-template-columns: 1fr; }
        .featured-image { height: 300px; }
    }
    @media (max-width: 768px) {
        .blog-hero-title { font-size: 2rem; }
        .categories-section { top: 70px; overflow-x: auto; white-space: nowrap; }
        .categories-wrapper { flex-wrap: nowrap; justify-content: flex-start; padding: 0 20px; }
        .category-pill { white-space: nowrap; }
        .search-container { flex-direction: column; }
        .newsletter-form { flex-direction: column; }
        .articles-grid { grid-template-columns: 1fr; }
        .featured-title { font-size: 1.5rem; }
        .featured-content { padding: 24px; }
    }
</style>
@endsection

@section('content')
    {{-- HERO SECTION --}}
    <section class="blog-hero">
        <div class="blog-hero-bg">
            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1600"
                alt="Blog GONAGO" loading="eager">
            <div class="blog-hero-overlay"></div>
        </div>
        <div class="blog-hero-content reveal">
            <div class="blog-hero-badge">
                <i data-lucide="newspaper"></i> Actualités & Conseils
            </div>
            <h1 class="blog-hero-title">Blog & Actualités</h1>
            <p class="blog-hero-subtitle">Découvrez nos dernières actualités, conseils de voyage et destinations à explorer au Cameroun</p>
        </div>
    </section>

    {{-- CATEGORIES --}}
    <section class="categories-section">
        <div class="max-w-7xl mx-auto px-4">
            <div class="categories-wrapper">
                <button class="category-pill active" data-category="all">Tous</button>
                <button class="category-pill" data-category="actualites">Actualités</button>
                <button class="category-pill" data-category="conseils">Conseils Voyage</button>
                <button class="category-pill" data-category="destinations">Destinations</button>
                <button class="category-pill" data-category="partenaires">Partenaires</button>
                <button class="category-pill" data-category="temoignages">Témoignages</button>
            </div>
        </div>
    </section>

    {{-- SEARCH --}}
    <section class="search-section">
        <div class="max-w-7xl mx-auto px-4">
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un article...">
                <button id="searchBtn" class="search-btn">
                    <i data-lucide="search" class="w-5 h-5"></i> Rechercher
                </button>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-4">
        <div class="blog-layout">
            {{-- LEFT COLUMN --}}
            <div>
                {{-- Featured Article --}}
                <section class="featured-section reveal" id="featuredSection">
                    <div class="featured-card">
                        <div class="featured-image">
                            <img id="featuredImage"
                                src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=800"
                                alt="Article à la une">
                        </div>
                        <div class="featured-content">
                            <span class="featured-category" id="featuredCategory">Actualités</span>
                            <h2 class="featured-title" id="featuredTitle">
                                GONAGO révolutionne le transport au Cameroun
                            </h2>
                            <p class="featured-excerpt" id="featuredExcerpt">
                                Découvrez comment notre plateforme transforme la mobilité au Cameroun avec des réservations instantanées,
                                des paiements sécurisés et un réseau de partenaires de confiance.
                            </p>
                            <div class="featured-meta">
                                <span id="featuredDate"><i data-lucide="calendar"></i> 15 Janvier 2025</span>
                                <span><i data-lucide="user"></i> Par Équipe GONAGO</span>
                                <span><i data-lucide="eye"></i> 2.5k vues</span>
                            </div>
                            <a href="#" class="read-more" id="featuredLink">
                                Lire l'article <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Articles Grid --}}
                <section>
                    <h2 class="text-2xl font-bold text-[#03045E] mb-6 reveal">Articles récents</h2>
                    <div id="articlesLoading" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="rounded-2xl border border-[#DDE1F0] overflow-hidden p-4">
                                <div class="skeleton h-48 rounded-xl mb-4"></div>
                                <div class="skeleton h-5 w-1/3 mb-3"></div>
                                <div class="skeleton h-7 w-full mb-2"></div>
                                <div class="skeleton h-4 w-full mb-2"></div>
                                <div class="skeleton h-4 w-2/3"></div>
                            </div>
                        @endfor
                    </div>
                    <div id="articlesGrid" class="articles-grid hidden"></div>
                    <div id="articlesEmpty" class="hidden text-center py-16">
                        <div class="w-20 h-20 bg-[#EFF1FA] rounded-full flex items-center justify-center mx-auto mb-5">
                            <i data-lucide="search-x" class="w-10 h-10 text-[#0077B6]"></i>
                        </div>
                        <h3 class="text-xl font-bold text-[#03045E] mb-2">Aucun article trouvé</h3>
                        <p class="text-[#6B7280]">Essayez d'autres catégories ou mots-clés.</p>
                    </div>
                    <div id="pagination" class="pagination hidden"></div>
                </section>
            </div>

            {{-- RIGHT COLUMN - SIDEBAR --}}
            <aside class="sidebar">
                <div class="sidebar-widget reveal">
                    <h3 class="widget-title">Articles populaires</h3>
                    <ul class="recent-posts-list" id="popularPosts">
                        <li class="recent-post-item">
                            <div class="skeleton w-[70px] h-[70px] rounded-2xl"></div>
                            <div class="flex-1"><div class="skeleton h-5 w-full mb-2"></div><div class="skeleton h-3 w-1/2"></div></div>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-widget reveal reveal-delay-1">
                    <h3 class="widget-title">Catégories</h3>
                    <div class="tags-cloud" id="categoriesCloud">
                        <a href="#" class="tag" data-cat="actualites">Actualités</a>
                        <a href="#" class="tag" data-cat="conseils">Conseils Voyage</a>
                        <a href="#" class="tag" data-cat="destinations">Destinations</a>
                        <a href="#" class="tag" data-cat="partenaires">Partenaires</a>
                        <a href="#" class="tag" data-cat="temoignages">Témoignages</a>
                    </div>
                </div>

                <div class="sidebar-widget reveal reveal-delay-2">
                    <h3 class="widget-title">Archives</h3>
                    <ul class="recent-posts-list">
                        <li><a href="#" class="tag archive-link" style="display: block; margin-bottom: 10px;">Janvier 2025</a></li>
                        <li><a href="#" class="tag archive-link" style="display: block; margin-bottom: 10px;">Décembre 2024</a></li>
                        <li><a href="#" class="tag archive-link" style="display: block;">Novembre 2024</a></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

    {{-- NEWSLETTER --}}
    <div class="max-w-7xl mx-auto px-4">
        <div class="newsletter-section reveal">
            <h3 class="newsletter-title">Restez informés</h3>
            <p class="newsletter-text">Recevez nos dernières actualités, conseils de voyage et offres exclusives</p>
            <form class="newsletter-form" id="newsletterForm">
                <input type="email" class="newsletter-input" placeholder="Votre adresse email" required>
                <button type="submit" class="newsletter-btn">
                    <i data-lucide="send"></i> S'inscrire
                </button>
            </form>
        </div>
    </div>

    <script>
        // Données des articles
        const articlesData = [
            {
                id: 1,
                title: "GONAGO lance la réservation instantanée de billets de bus",
                excerpt: "Réservez vos billets en moins de 2 minutes depuis votre téléphone. Paiement sécurisé Mobile Money et confirmation immédiate.",
                category: "actualites",
                date: "2025-01-15",
                author: "Équipe GONAGO",
                views: 2500,
                image: "https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600",
                isFeatured: true
            },
            {
                id: 2,
                title: "Top 10 des destinations à visiter au Cameroun en 2025",
                excerpt: "De Kribi à Rhumsiki, découvrez les joyaux du Cameroun à ne pas manquer cette année.",
                category: "destinations",
                date: "2025-01-10",
                author: "Marie N.",
                views: 1890,
                image: "https://images.unsplash.com/photo-1588434481138-0d4e5a89ecc8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 3,
                title: "Conseils pour voyager pas cher en bus au Cameroun",
                excerpt: "Astuces et bons plans pour économiser sur vos déplacements tout en voyageant confortablement.",
                category: "conseils",
                date: "2025-01-08",
                author: "Paul Ekambi",
                views: 1340,
                image: "https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 4,
                title: "Nouveau partenariat avec 10 agences de transport",
                excerpt: "GONAGO étoffe son réseau avec 10 nouvelles agences partenaires à Douala et Yaoundé.",
                category: "partenaires",
                date: "2025-01-05",
                author: "Équipe GONAGO",
                views: 3450,
                image: "https://images.unsplash.com/photo-1557425529-b1ae9c141e7d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 5,
                title: "Témoignage : Jean, voyageur fréquent partage son expérience",
                excerpt: "\"Grâce à GONAGO, je n'ai plus jamais raté mon bus. L'application est simple et fiable.\"",
                category: "temoignages",
                date: "2024-12-20",
                author: "Jean-Paul M.",
                views: 2670,
                image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 6,
                title: "Comment suivre votre bus en temps réel",
                excerpt: "Découvrez la nouvelle fonctionnalité de géolocalisation pour suivre votre trajet en direct.",
                category: "actualites",
                date: "2024-12-15",
                author: "Tech Team",
                views: 980,
                image: "https://images.unsplash.com/photo-1526498460520-4c246339d76a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 7,
                title: "Les avantages du covoiturage pour vos trajets quotidiens",
                excerpt: "Économies, écologie et convivialité : pourquoi adopter le covoiturage au Cameroun.",
                category: "conseils",
                date: "2024-12-10",
                author: "Claire D.",
                views: 760,
                image: "https://images.unsplash.com/photo-1511632763433-adb9be1f14da?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 8,
                title: "Visitez Limbé : guide complet",
                excerpt: "Que faire à Limbé ? Plages, jardin botanique et cascades, tout ce qu'il faut savoir.",
                category: "destinations",
                date: "2024-12-05",
                author: "Marie N.",
                views: 1230,
                image: "https://images.unsplash.com/photo-1588434481138-0d4e5a89ecc8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            },
            {
                id: 9,
                title: "Interview du fondateur de GONAGO",
                excerpt: "Retour sur les débuts de l'aventure et les ambitions pour l'avenir du transport au Cameroun.",
                category: "actualites",
                date: "2024-11-28",
                author: "Équipe GONAGO",
                views: 2100,
                image: "https://images.unsplash.com/photo-1557804506-669a67965ba0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&w=600"
            }
        ];

        let currentPage = 1;
        const articlesPerPage = 6;
        let currentCategory = "all";
        let currentSearch = "";

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('fr-FR', options);
        }

        function getCategoryName(category) {
            const names = { actualites: "Actualités", conseils: "Conseils Voyage", destinations: "Destinations", partenaires: "Partenaires", temoignages: "Témoignages" };
            return names[category] || category;
        }

        function filterArticles() {
            let filtered = [...articlesData];
            if (currentCategory !== "all") filtered = filtered.filter(a => a.category === currentCategory);
            if (currentSearch) filtered = filtered.filter(a => a.title.toLowerCase().includes(currentSearch.toLowerCase()) || a.excerpt.toLowerCase().includes(currentSearch.toLowerCase()));
            return filtered.filter(a => !a.isFeatured);
        }

        function getFeaturedArticle() {
            return articlesData.find(a => a.isFeatured) || articlesData[0];
        }

        function updateFeaturedArticle() {
            const featured = getFeaturedArticle();
            document.getElementById('featuredImage').src = featured.image;
            document.getElementById('featuredCategory').textContent = getCategoryName(featured.category);
            document.getElementById('featuredTitle').textContent = featured.title;
            document.getElementById('featuredExcerpt').textContent = featured.excerpt;
            document.getElementById('featuredDate').innerHTML = '<i data-lucide="calendar" class="inline-block w-4 h-4 mr-1"></i> ' + formatDate(featured.date);
            document.getElementById('featuredLink').href = `/blog/${featured.id}`;
            lucide.createIcons();
        }

        function renderArticles() {
            const filtered = filterArticles();
            const totalPages = Math.ceil(filtered.length / articlesPerPage);
            const start = (currentPage - 1) * articlesPerPage;
            const paginated = filtered.slice(start, start + articlesPerPage);

            const loadingDiv = document.getElementById('articlesLoading');
            const gridDiv = document.getElementById('articlesGrid');
            const emptyDiv = document.getElementById('articlesEmpty');
            const paginationDiv = document.getElementById('pagination');

            loadingDiv.classList.add('hidden');
            gridDiv.classList.remove('hidden');
            emptyDiv.classList.add('hidden');

            if (paginated.length === 0) {
                gridDiv.classList.add('hidden');
                emptyDiv.classList.remove('hidden');
                paginationDiv.classList.add('hidden');
                return;
            }

            gridDiv.innerHTML = paginated.map(article => `
                <div class="article-card">
                    <div class="article-image">
                        <img src="${article.image}" alt="${article.title}" loading="lazy">
                        <span class="article-category-badge">${getCategoryName(article.category)}</span>
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">${article.title}</h3>
                        <p class="article-excerpt">${article.excerpt.substring(0, 100)}...</p>
                        <div class="article-meta">
                            <span><i data-lucide="calendar" class="inline-block w-3 h-3"></i> ${formatDate(article.date)}</span>
                            <span><i data-lucide="eye" class="inline-block w-3 h-3"></i> ${article.views}</span>
                        </div>
                        <a href="/blog/${article.id}" class="read-more">
                            Lire la suite <i data-lucide="arrow-right" class="inline-block w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            `).join('');
            lucide.createIcons();

            renderPagination(totalPages);
            renderPopularPosts();
        }

        function renderPagination(totalPages) {
            const paginationDiv = document.getElementById('pagination');
            if (totalPages <= 1) { paginationDiv.classList.add('hidden'); return; }
            paginationDiv.classList.remove('hidden');
            let html = '';
            if (currentPage > 1) html += `<a href="#" class="page-link" data-page="${currentPage - 1}"><i data-lucide="chevron-left" class="w-4 h-4"></i></a>`;
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1))
                    html += `<a href="#" class="page-link ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
                else if (i === currentPage - 2 || i === currentPage + 2)
                    html += `<span class="page-link">...</span>`;
            }
            if (currentPage < totalPages) html += `<a href="#" class="page-link" data-page="${currentPage + 1}"><i data-lucide="chevron-right" class="w-4 h-4"></i></a>`;
            paginationDiv.innerHTML = html;
            lucide.createIcons();
            document.querySelectorAll('.page-link[data-page]').forEach(link => link.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = parseInt(link.dataset.page);
                renderArticles();
                window.scrollTo({ top: 400, behavior: 'smooth' });
            }));
        }

        function renderPopularPosts() {
            const popular = [...articlesData].sort((a, b) => b.views - a.views).slice(0, 4);
            const container = document.getElementById('popularPosts');
            container.innerHTML = popular.map(post => `
                <li class="recent-post-item">
                    <img src="${post.image}" alt="${post.title}" class="recent-post-image">
                    <div class="recent-post-info">
                        <h4><a href="/blog/${post.id}">${post.title.substring(0, 45)}${post.title.length > 45 ? '...' : ''}</a></h4>
                        <span class="recent-post-date">${formatDate(post.date)}</span>
                    </div>
                </li>
            `).join('');
        }

        // Event Listeners
        document.querySelectorAll('.category-pill').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.category-pill').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentCategory = btn.dataset.category;
                currentPage = 1;
                renderArticles();
            });
        });

        document.getElementById('searchBtn').addEventListener('click', () => {
            currentSearch = document.getElementById('searchInput').value;
            currentPage = 1;
            renderArticles();
        });

        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                currentSearch = e.target.value;
                currentPage = 1;
                renderArticles();
            }
        });

        document.querySelectorAll('.tag[data-cat]').forEach(tag => {
            tag.addEventListener('click', (e) => {
                e.preventDefault();
                const cat = tag.dataset.cat;
                const categoryBtn = document.querySelector(`.category-pill[data-category="${cat}"]`);
                if (categoryBtn) categoryBtn.click();
            });
        });

        document.getElementById('newsletterForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = e.target.querySelector('input').value;
            alert(`Merci de vous être inscrit avec : ${email}`);
            e.target.reset();
        });

        // Scroll Reveal
        const revealEls = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('visible'); revealObserver.unobserve(entry.target); } });
        }, { threshold: 0.12 });
        revealEls.forEach(el => revealObserver.observe(el));

        // Initialisation
        updateFeaturedArticle();
        setTimeout(() => { renderArticles(); }, 500); // Simuler chargement
    </script>
@endsection
