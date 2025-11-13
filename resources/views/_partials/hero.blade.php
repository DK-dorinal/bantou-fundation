<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Variables CSS - Couleurs Bantou Foundation */
    :root {
        --bleu-marine: #0f1a3a;
        --bleu-fonce: #1a2b55;
        --bleu-moyen: #2d4a8a;
        --bleu-clair: #3a5fc0;
        --accent-or: #d4af37;
        --accent-or-clair: #e6c34d;
        --blanc-pur: #ffffff;
        --texte-fonce: #1e293b;
        --texte-clair: #64748b;
        --arriere-plan-clair: #f8fafc;
        --verre-arriere-plan: rgba(255, 255, 255, 0.9);
        --verre-arriere-plan-fort: rgba(255, 255, 255, 0.95);
        --ombre-legere: rgba(15, 26, 58, 0.1);
        --ombre-moyenne: rgba(15, 26, 58, 0.2);
        --ombre-forte: rgba(15, 26, 58, 0.3);
        --bordure-arrondie: 8px;
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
        color: var(--texte-fonce);
        background-color: var(--arriere-plan-clair);
    }

    /* Section avec effet glass professionnel */
    .section-navigation {
        background: var(--verre-arriere-plan);
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        box-shadow: 0 4px 20px var(--ombre-legere);
        width: 100%;
        z-index: 1000;
        border-bottom: 3px solid var(--bleu-marine);
        transition: var(--transition);
        will-change: transform, background, box-shadow;
        border-radius: 0 0 10px 10px;
        margin-bottom: 40px;
    }

    .section-navigation.defile {
        background: var(--verre-arriere-plan-fort);
        backdrop-filter: blur(15px) saturate(200%);
        -webkit-backdrop-filter: blur(15px) saturate(200%);
        box-shadow: 0 8px 32px var(--ombre-moyenne);
        border-bottom-color: var(--accent-or);
    }

    .conteneur-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
        height: 80px;
    }

    /* Logo optimisé */
    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: var(--transition);
        position: relative;
        padding: 8px 16px;
        border-radius: var(--bordure-arrondie);
    }

    .logo:hover {
        transform: translateY(-2px);
    }

    .logo img {
        height: 50px;
        width: auto;
        transition: var(--transition);
    }

    .logo:hover img {
        transform: scale(1.05);
    }

    /* Contenu de la section */
    .contenu-section {
        padding: 60px 20px;
        max-width: 1280px;
        margin: 0 auto;
        text-align: center;
    }

    .titre-section {
        font-size: 2.5rem;
        color: var(--bleu-marine);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .sous-titre-section {
        font-size: 1.2rem;
        color: var(--texte-clair);
        margin-bottom: 30px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Bouton Faire un Don optimisé */
    .bouton-don {
        background: linear-gradient(45deg, var(--accent-or), var(--accent-or-clair));
        color: var(--bleu-marine);
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: var(--transition);
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .bouton-don::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: all 0.5s ease;
    }

    .bouton-don:hover::before {
        left: 100%;
    }

    .bouton-don:hover,
    .bouton-don:focus {
        background: linear-gradient(45deg, var(--accent-or-clair), #e0b42e);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        border-color: var(--bleu-marine);
        outline: none;
    }

    .icone-bouton {
        font-size: 15px;
        transition: var(--transition);
    }

    .bouton-don:hover .icone-bouton {
        animation: rebond 0.6s ease-in-out;
    }

    @keyframes rebond {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-3px);
        }

        60% {
            transform: translateY(-1.5px);
        }
    }

    /* Section Hero alignée à gauche */
    .section-hero {
        display: flex;
        align-items: center;
        min-height: 80vh;
        padding: 20px 20px;
        max-width: 1280px;
        margin: 0 auto;
    }

    .contenu-hero {
        flex: 1;
        max-width: 600px;
        padding-right: 40px;
    }

    .titre-hero {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--bleu-marine);
        margin-bottom: 20px;
        line-height: 1.1;
    }

    .sous-titre-hero {
        font-size: 1.25rem;
        color: var(--texte-clair);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .image-hero {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .image-hero img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Effet de pulsation sur le bouton don */
    @keyframes pulsation {
        0% {
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        50% {
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.5);
        }

        100% {
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }
    }

    .bouton-don {
        animation: pulsation 3s infinite;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .titre-hero {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 768px) {
        .section-hero {
            flex-direction: column;
            text-align: center;
            padding: 60px 20px;
        }

        .contenu-hero {
            padding-right: 0;
            margin-bottom: 40px;
        }

        .titre-hero {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 480px) {
        .conteneur-navigation {
            padding: 0 15px;
            height: 70px;
        }

        .logo img {
            height: 40px;
        }

        .titre-hero {
            font-size: 2rem;
        }

        .sous-titre-hero {
            font-size: 1.1rem;
        }

        .titre-section {
            font-size: 2rem;
        }
    }

    /* Accessibilité */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    .bouton-don:focus-visible {
        outline: 2px solid var(--accent-or);
        outline-offset: 2px;
    }

    /* Amélioration des performances */
    .section-navigation,
    .bouton-don {
        will-change: transform;
    }
</style>

<!-- Section de navigation Bantou Foundation -->
<section class="section-navigation" id="section-navigation">
<!-- Section Hero alignée à gauche -->
<section class="section-hero">
    <div class="contenu-hero">
        <h1 class="titre-hero">Bantou-Foundation</h1>
        <p class="sous-titre-hero">Une organisation dédiée au développement durable et à l'autonomisation des communautés
            en Afrique. Nous œuvrons pour l'éducation, la santé et le développement économique.</p>
        <a href="#" class="bouton-don" style="display: inline-flex; width: auto;">
            <i class="fas fa-hands-helping icone-bouton"></i> Découvrir nos actions
        </a>
    </div>
    <div class="image-hero">
        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmYWZjIi8+PHJlY3QgeD0iMTAiIHk9IjEwIiB3aWR0aD0iNTgwIiBoZWlnaHQ9IjM4MCIgZmlsbD0iIzBhMWIzZCIgcng9IjgiLz48dGV4dCB4PSIzMDAiIHk9IjIwMCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjI0IiBmaWxsPSIjZmZmIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIj5JbWFnZSBoZXJvIEJhbnRvdTwvdGV4dD48L3N2Zz4="
            alt="Bantou Foundation - Développement communautaire">
    </div>
</section>

<script>
    // JavaScript pour l'effet de défilement
    document.addEventListener('DOMContentLoaded', function() {
        // Effet de scroll sur la section
        window.addEventListener('scroll', function() {
            const section = document.getElementById('section-navigation');
            if (window.scrollY > 50) {
                section.classList.add('defile');
            } else {
                section.classList.remove('defile');
            }
        });
    });
</script>
