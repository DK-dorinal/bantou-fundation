@extends('_partials.master')
@section('title', 'Notre Identité - Bantou Foundation')
@section('root', 'notre identité')
@section('main')
<style>
  .slider-wrapper{
    width: 90%;
    margin: auto;
    margin: 2rem 0 2rem 0;
    margin: auto;
  }

  /* Variables CSS - Cohérence avec Bantou Foundation */
  :root {
    --clr-main: #0f1a3a;
    --clr-gold: #d4af37;
    --clr-blue: #2d4a8a;
    --clr-dark: #1e293b;
    --clr-muted: #64748b;
    --clr-surface: #f8fafc;
    --clr-white: #ffffff;
    --radius-default: 8px;
    --elevation-sm: 0 4px 6px rgba(0, 0, 0, 0.1);
    --elevation-md: 0 10px 15px rgba(0, 0, 0, 0.1);
  }

  /* Styles globaux */
  .page-identity * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .page-identity {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: var(--clr-dark);
    background-color: var(--clr-surface);
  }

  .page-identity .wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .page-identity .block {
    padding: 4rem 0;
  }

  .page-identity .block-alternate {
    background-color: var(--clr-white);
  }

  .page-identity .block-heading {
    text-align: center;
    font-size: 2.5rem;
    color: var(--clr-main);
    margin-bottom: 3rem;
    position: relative;
  }

  .page-identity .block-heading::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background-color: var(--clr-gold);
    margin: 15px auto;
    border-radius: 2px;
  }

  /* Carousel Styles */
  .page-identity .slider-wrapper {
    position: relative;
    width: 100%;
    height: 70vh;
    overflow: hidden;
    border-radius: 10px;
    margin: 2rem 0;
  }

  .page-identity .slider-track {
    display: flex;
    width: 300%;
    height: 100%;
    transition: transform 0.5s ease-in-out;
  }

  .page-identity .slider-item {
    position: relative;
    width: 33.333%;
    height: 100%;
  }

  .page-identity .slider-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .page-identity .slider-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: white;
    padding: 2rem;
  }

  .page-identity .slider-heading {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
  }

  .page-identity .slider-subtitle {
    font-size: 1rem;
    opacity: 0.8;
  }

  .page-identity .slider-badge {
    position: absolute;
    top: 2rem;
    right: 2rem;
    background: var(--clr-gold);
    color: var(--clr-main);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
  }

  .page-identity .slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.8);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.3s ease;
  }

  .page-identity .slider-btn:hover {
    background: white;
    transform: translateY(-50%) scale(1.1);
  }

  .page-identity .slider-btn-left {
    left: 2rem;
  }

  .page-identity .slider-btn-right {
    right: 2rem;
  }

  .page-identity .slider-dots {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 1rem;
  }

  .page-identity .slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .page-identity .slider-dot.current {
    background: white;
    transform: scale(1.2);
  }

  /* Valeurs Grid */
  .page-identity .cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
  }

  .page-identity .info-card {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-default);
    box-shadow: var(--elevation-sm);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .page-identity .info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--elevation-md);
  }

  .page-identity .info-card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--clr-gold), #e6c34d);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--clr-main);
    font-size: 2rem;
  }

  .page-identity .info-card h3 {
    color: var(--clr-main);
    margin-bottom: 1rem;
    font-size: 1.25rem;
  }

  .page-identity .info-card p {
    color: var(--clr-muted);
    line-height: 1.6;
  }

  /* Team Grid */
  .page-identity .members-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
  }

  .page-identity .member-card {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-default);
    box-shadow: var(--elevation-sm);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .page-identity .member-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--elevation-md);
  }

  .page-identity .member-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 1.5rem;
    border: 4px solid var(--clr-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--clr-surface);
  }

  .page-identity .member-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .page-identity .member-card h4 {
    color: var(--clr-main);
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
  }

  .page-identity .member-position {
    color: var(--clr-gold);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .page-identity .member-card p {
    color: var(--clr-muted);
    line-height: 1.6;
  }

  /* Stats Container */
  .page-identity .metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
  }

  .page-identity .metric-box {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-default);
    box-shadow: var(--elevation-sm);
    text-align: center;
    border-top: 4px solid var(--clr-gold);
  }

  .page-identity .metric-value {
    font-size: 3rem;
    font-weight: 700;
    color: var(--clr-main);
    margin-bottom: 0.5rem;
  }

  .page-identity .metric-title {
    color: var(--clr-muted);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Conseil Grid */
  .page-identity .board-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
  }

  .page-identity .board-member {
    text-align: center;
  }

  .page-identity .board-photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 1rem;
    border: 4px solid var(--clr-gold);
  }

  .page-identity .board-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .page-identity .board-member h4 {
    color: var(--clr-main);
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
  }

  .page-identity .board-title {
    color: var(--clr-blue);
    font-weight: 600;
    font-size: 0.9rem;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .page-identity .slider-wrapper {
      height: 50vh;
    }

    .page-identity .slider-heading {
      font-size: 1.8rem;
    }

    .page-identity .block-heading {
      font-size: 2rem;
    }

    .page-identity .slider-btn {
      width: 40px;
      height: 40px;
      font-size: 1rem;
    }

    .page-identity .cards-grid,
    .page-identity .members-grid,
    .page-identity .metrics-grid,
    .page-identity .board-grid {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 480px) {
    .page-identity .slider-wrapper {
      height: 40vh;
    }

    .page-identity .slider-heading {
      font-size: 1.5rem;
    }

    .page-identity .block {
      padding: 2rem 0;
    }
  }
</style>

<div class="page-identity">
  <!-- CAROUSEL HERO -->
  <section class="hero-banner">
    <div class="slider-wrapper">
      <div class="slider-track">
        <!-- Slide 1 -->
        <div class="slider-item">
          <img
            src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
            alt="Équipe Bantou Foundation"
            class="slider-img"
          />
          <div class="slider-caption">
            <h2 class="slider-heading">Notre Équipe Engagée</h2>
            <span class="slider-subtitle">Notre Identité</span>
          </div>
          <div class="slider-badge">Équipe</div>
        </div>

        <!-- Slide 2 -->
        <div class="slider-item">
          <img
            src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
            alt="Mission Bantou Foundation"
            class="slider-img"
          />
          <div class="slider-caption">
            <h2 class="slider-heading">Notre Mission en Action</h2>
            <span class="slider-subtitle">Notre Identité</span>
          </div>
          <div class="slider-badge">Mission</div>
        </div>

        <!-- Slide 3 -->
        <div class="slider-item">
          <img
            src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
            alt="Valeurs Bantou Foundation"
            class="slider-img"
          />
          <div class="slider-caption">
            <h2 class="slider-heading">Nos Valeurs Fondatrices</h2>
            <span class="slider-subtitle">Notre Identité</span>
          </div>
          <div class="slider-badge">Valeurs</div>
        </div>
      </div>

      <button class="slider-btn slider-btn-left">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="slider-btn slider-btn-right">
        <i class="fas fa-chevron-right"></i>
      </button>

      <div class="slider-dots">
        <div class="slider-dot current"></div>
        <div class="slider-dot"></div>
        <div class="slider-dot"></div>
      </div>
    </div>
  </section>

  <!-- SECTION HISTOIRE & CRÉATION -->
  <section id="about-history" class="block">
    <div class="wrapper">
      <h2 class="block-heading">Histoire & Création</h2>
      <div class="cards-grid">
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-seedling"></i>
          </div>
          <h3>Nos Origines</h3>
          <p>
            Fondée en 2010 par des professionnels africains et de la diaspora,
            Bantou Foundation est née de la conviction que le développement
            durable passe par l'autonomisation des communautés locales.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-route"></i>
          </div>
          <h3>Notre Parcours</h3>
          <p>
            De nos premiers projets éducatifs au Cameroun à notre présence
            actuelle dans 8 pays africains, nous avons construit une expertise
            solide dans le développement communautaire intégré.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-hands-helping"></i>
          </div>
          <h3>Notre Approche</h3>
          <p>
            Notre méthodologie unique combine expertise technique et
            connaissance approfondie des contextes locaux pour un impact
            durable et mesurable.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-chart-line"></i>
          </div>
          <h3>Croissance & Impact</h3>
          <p>
            En 14 ans d'activité, nous avons touché directement plus de 50,000
            bénéficiaires et développé des partenariats stratégiques avec
            plus de 100 organisations locales et internationales.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Notre Équipe</h3>
          <p>
            Une équipe multiculturelle de 45 professionnels dédiés, combinant
            expertise internationale et ancrage local pour maximiser notre
            impact sur le terrain.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-trophy"></i>
          </div>
          <h3>Reconnaissance</h3>
          <p>
            Lauréate de plusieurs prix internationaux pour l'innovation
            sociale et l'excellence dans la mise en œuvre de projets de
            développement durable en Afrique.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION MISSION & VISION -->
  <section id="about-mission" class="block block-alternate">
    <div class="wrapper">
      <h2 class="block-heading">Mission & Vision</h2>
      <div class="members-grid">
        <div class="member-card">
          <div class="member-avatar">
            <i class="fas fa-bullseye" style="font-size: 3rem; color: #d4af37;"></i>
          </div>
          <h4>Notre Mission</h4>
          <div class="member-position">Raison d'être</div>
          <p>
            Accompagner le développement durable des communautés africaines
            à travers des programmes intégrés d'éducation, de santé et de
            développement économique, en favorisant l'autonomie et la
            résilience des populations.
          </p>
        </div>
        <div class="member-card">
          <div class="member-avatar">
            <i class="fas fa-eye" style="font-size: 3rem; color: #2d4a8a;"></i>
          </div>
          <h4>Notre Vision</h4>
          <div class="member-position">Ambition</div>
          <p>
            Une Afrique où chaque individu a accès à une éducation de qualité,
            à des soins de santé essentiels et à des opportunités économiques
            durables, dans le respect de l'environnement et des cultures locales.
          </p>
        </div>
        <div class="member-card">
          <div class="member-avatar">
            <i class="fas fa-compass" style="font-size: 3rem; color: #3a5fc0;"></i>
          </div>
          <h4>Notre Approche</h4>
          <div class="member-position">Méthodologie</div>
          <p>
            Participation communautaire, innovation locale et durabilité sont
            les trois piliers de notre méthodologie, garantissant la pertinence
            et l'impact à long terme de nos interventions.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION NOS VALEURS -->
  <section id="about-values" class="block">
    <div class="wrapper">
      <h2 class="block-heading">Nos Valeurs</h2>
      <div class="cards-grid">
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>Intégrité</h3>
          <p>
            Nous agissons avec transparence, honnêteté et responsabilité dans
            toutes nos actions et relations, en maintenant les plus hauts
            standards éthiques.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Solidarité</h3>
          <p>
            Nous croyons en la force de la communauté et œuvrons pour
            l'entraide et le soutien mutuel, en plaçant l'intérêt collectif
            au cœur de nos actions.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-star-of-life"></i>
          </div>
          <h3>Respect</h3>
          <p>
            Nous respectons les cultures, les traditions et la dignité de
            chaque individu et communauté, en valorisant la diversité comme
            une richesse.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-lightbulb"></i>
          </div>
          <h3>Innovation</h3>
          <p>
            Nous encourageons la créativité et recherchons constamment des
            solutions nouvelles et adaptées aux défis du développement.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-seedling"></i>
          </div>
          <h3>Durabilité</h3>
          <p>
            Nous concevons des projets qui ont un impact à long terme,
            respectueux de l'environnement et économiquement viables.
          </p>
        </div>
        <div class="info-card">
          <div class="info-card-icon">
            <i class="fas fa-balance-scale"></i>
          </div>
          <h3>Équité</h3>
          <p>
            Nous œuvrons pour un accès équitable aux opportunités, sans
            discrimination, en particulier pour les populations les plus
            vulnérables.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION GOUVERNANCE -->
  <section id="about-governance" class="block block-alternate">
    <div class="wrapper">
      <h2 class="block-heading">Gouvernance</h2>
      
      <div class="metrics-grid">
        <div class="metric-box">
          <div class="metric-value">7</div>
          <div class="metric-title">Membres du Conseil</div>
        </div>
        <div class="metric-box">
          <div class="metric-value">100%</div>
          <div class="metric-title">Transparence</div>
        </div>
        <div class="metric-box">
          <div class="metric-value">4</div>
          <div class="metric-title">Comités spécialisés</div>
        </div>
        <div class="metric-box">
          <div class="metric-value">98%</div>
          <div class="metric-title">Taux de participation</div>
        </div>
      </div>

      <div class="members-grid" style="margin-top: 4rem">
        <div class="member-card">
          <div class="member-avatar">
            <img
              src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Président du Conseil"
            />
          </div>
          <h4>Dr. Samuel N'Gom</h4>
          <div class="member-position">Président du Conseil</div>
          <p>
            Expert en développement international avec 25 ans d'expérience
            dans la gestion de projets humanitaires en Afrique subsaharienne.
          </p>
        </div>
        <div class="member-card">
          <div class="member-avatar">
            <img
              src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Vice-Présidente"
            />
          </div>
          <h4>Mme Aminata Diallo</h4>
          <div class="member-position">Vice-Présidente</div>
          <p>
            Économiste du développement, spécialiste des questions de
            microfinance et d'autonomisation économique des femmes.
          </p>
        </div>
        <div class="member-card">
          <div class="member-avatar">
            <img
              src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Trésorière"
            />
          </div>
          <h4>Mme Chantal Kouamé</h4>
          <div class="member-position">Trésorière</div>
          <p>
            Experte-comptable et auditrice, elle assure la rigueur financière
            et la transparence de nos opérations.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION CONSEIL D'ADMINISTRATION -->
  <section id="about-board" class="block">
    <div class="wrapper">
      <h2 class="block-heading">Conseil d'Administration</h2>
      <p
        style="
          text-align: center;
          max-width: 800px;
          margin: 0 auto 3rem;
          color: var(--clr-muted);
        "
      >
        Notre Conseil d'Administration réunit des experts internationaux et
        des leaders locaux pour définir la stratégie et assurer la bonne
        gouvernance de Bantou Foundation.
      </p>

      <div class="board-grid">
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1590086782792-42dd2350140d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Président du conseil"
            />
          </div>
          <h4>Dr. Samuel N'Gom</h4>
          <div class="board-title">Président</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Vice-présidente"
            />
          </div>
          <h4>Mme Aminata Diallo</h4>
          <div class="board-title">Vice-Présidente</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Trésorière"
            />
          </div>
          <h4>Mme Chantal Kouamé</h4>
          <div class="board-title">Trésorière</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1567532939604-b6b5b0db1604?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Secrétaire général"
            />
          </div>
          <h4>M. Jean-Baptiste Ouedraogo</h4>
          <div class="board-title">Secrétaire Général</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Représentant des partenaires"
            />
          </div>
          <h4>M. Thomas Moreau</h4>
          <div class="board-title">Représentant des Partenaires</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Expert en éducation"
            />
          </div>
          <h4>Dr. Fatoumata Bâ</h4>
          <div class="board-title">Expert en Éducation</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1552058544-f2b08422138a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Expert en santé"
            />
          </div>
          <h4>Dr. Michel Konaté</h4>
          <div class="board-title">Expert en Santé Publique</div>
        </div>
        <div class="board-member">
          <div class="board-photo">
            <img
              src="https://images.unsplash.com/photo-1614289371518-722f2615943d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
              alt="Représentant des bénéficiaires"
            />
          </div>
          <h4>M. Pierre Sarr</h4>
          <div class="board-title">Représentant des Bénéficiaires</div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  // Carousel functionality
  document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.slider-track');
    const items = document.querySelectorAll('.slider-item');
    const dots = document.querySelectorAll('.slider-dot');
    const btnLeft = document.querySelector('.slider-btn-left');
    const btnRight = document.querySelector('.slider-btn-right');
    
    let activeIndex = 0;
    const totalItems = items.length;

    function refreshSlider() {
      track.style.transform = `translateX(-${activeIndex * (100 / totalItems)}%)`;
      
      // Update dots
      dots.forEach((dot, idx) => {
        dot.classList.toggle('current', idx === activeIndex);
      });
    }

    function goToNext() {
      activeIndex = (activeIndex + 1) % totalItems;
      refreshSlider();
    }

    function goToPrev() {
      activeIndex = (activeIndex - 1 + totalItems) % totalItems;
      refreshSlider();
    }

    // Event listeners
    btnRight.addEventListener('click', goToNext);
    btnLeft.addEventListener('click', goToPrev);

    // Dot clicks
    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        activeIndex = idx;
        refreshSlider();
      });
    });

    // Auto-advance every 5 seconds
    setInterval(goToNext, 5000);
  });
</script>
@endsection