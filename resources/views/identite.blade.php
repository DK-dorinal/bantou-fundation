@extends('_partials.master')

@section('title', 'Bantou-Foundation / Accueil')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notre Identité | Bantou-Foundation</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
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
        --glass-bg-strong: rgba(255, 255, 255, 0.95);
        --shadow-light: rgba(15, 26, 58, 0.1);
        --shadow-medium: rgba(15, 26, 58, 0.2);
        --shadow-strong: rgba(15, 26, 58, 0.3);
        --border-radius: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: var(--text-dark);
        background-color: var(--bg-light);
      }

      .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
      }

      .section {
        padding: 5rem 0;
      }

      .section-alt {
        background-color: var(--pure-white);
      }

      .section-title {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: var(--navy-blue);
        position: relative;
      }

      .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold), var(--accent-light));
        border-radius: 2px;
      }

      /* Carousel Styles */
      .carousel-container {
        position: relative;
        width: 100%;
        height: 80vh;
        overflow: hidden;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        box-shadow: 0 10px 30px var(--shadow-medium);
        margin-top: 12vh;
      }

      .carousel-slide {
        display: flex;
        width: 300%;
        height: 100%;
        transition: transform 0.5s ease;
      }

      .slide {
        position: relative;
        width: 33.333%;
        height: 100%;
      }

      .slide-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .slide-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(15, 26, 58, 0.8), transparent);
        color: var(--pure-white);
        padding: 2rem;
      }

      .slide-title {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
      }

      .slide-sector {
        font-size: 1rem;
        opacity: 0.9;
      }

      .sector-indicator {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: var(--accent-gold);
        color: var(--navy-blue);
        padding: 0.5rem 1rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 0.9rem;
      }

      .carousel-control {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: var(--glass-bg-strong);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 15px var(--shadow-light);
        color: var(--navy-blue);
      }

      .carousel-control:hover {
        background-color: var(--accent-gold);
        color: var(--pure-white);
      }

      .carousel-control.prev {
        left: 20px;
      }

      .carousel-control.next {
        right: 20px;
      }

      .carousel-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
      }

      .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--pure-white);
        opacity: 0.5;
        cursor: pointer;
        transition: var(--transition);
      }

      .indicator.active {
        opacity: 1;
        background-color: var(--accent-gold);
      }

      /* Valeurs Grid */
      .valeurs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
      }

      .valeur-card {
        background: var(--pure-white);
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: 0 5px 15px var(--shadow-light);
        text-align: center;
        transition: var(--transition);
        border-top: 4px solid var(--medium-blue);
      }

      .valeur-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-medium);
      }

      .valeur-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--light-blue), var(--medium-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--pure-white);
        font-size: 1.8rem;
      }

      .valeur-card h3 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: var(--navy-blue);
      }

      .valeur-card p {
        color: var(--text-light);
        line-height: 1.7;
      }

      /* Team Grid */
      .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
      }

      .team-member {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px var(--shadow-light);
        transition: var(--transition);
        text-align: center;
      }

      .team-member:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-medium);
      }

      .team-photo {
        width: 100%;
        height: 250px;
        overflow: hidden;
      }

      .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
      }

      .team-member:hover .team-photo img {
        transform: scale(1.05);
      }

      .team-member h4 {
        margin: 1.5rem 0 0.5rem;
        color: var(--navy-blue);
        font-size: 1.3rem;
      }

      .team-role {
        color: var(--accent-gold);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 0.9rem;
      }

      .team-member p {
        padding: 0 1.5rem 1.5rem;
        color: var(--text-light);
        line-height: 1.6;
      }

      /* Stats Container */
      .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
      }

      .stat-card {
        background: var(--pure-white);
        padding: 2rem;
        border-radius: var(--border-radius);
        box-shadow: 0 5px 15px var(--shadow-light);
        text-align: center;
        transition: var(--transition);
      }

      .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-medium);
      }

      .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--light-blue);
        margin-bottom: 0.5rem;
      }

      .stat-label {
        color: var(--text-light);
        font-size: 1rem;
      }

      /* Conseil Grid */
      .conseil-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
      }

      .conseil-member {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px var(--shadow-light);
        transition: var(--transition);
        text-align: center;
      }

      .conseil-member:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-medium);
      }

      .conseil-photo {
        width: 100%;
        height: 200px;
        overflow: hidden;
      }

      .conseil-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
      }

      .conseil-member:hover .conseil-photo img {
        transform: scale(1.05);
      }

      .conseil-member h4 {
        margin: 1.5rem 0 0.5rem;
        color: var(--navy-blue);
        font-size: 1.2rem;
      }

      .conseil-role {
        color: var(--accent-gold);
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
      }

      /* Responsive */
      @media (max-width: 768px) {
        .carousel-container {
          height: 50vh;
        }

        .slide-title {
          font-size: 1.8rem;
        }

        .section-title {
          font-size: 2rem;
        }

        .valeurs-grid,
        .team-grid,
        .stats-container,
        .conseil-grid {
          grid-template-columns: 1fr;
        }
      }
      p{
        text-align: justify;
      }
    </style>
  </head>
  <body>
    <main>
      <!-- Bannière Hero -->
      <section class="carousel-container">
        <div class="carousel-slide">
          <!-- Slide 1 -->
          <div class="slide">
            <img
              src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
              alt="Communauté Bantou-Foundation"
              class="slide-image"
            />
            <div class="slide-overlay">
              <h2 class="slide-title">Notre Fondation</h2>
              <span class="slide-sector">Qui Sommes-Nous</span>
            </div>
            <div class="sector-indicator">Histoire</div>
          </div>

          <!-- Slide 2 -->
          <div class="slide">
            <img
              src="https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
              alt="Équipe Bantou-Foundation"
              class="slide-image"
            />
            <div class="slide-overlay">
              <h2 class="slide-title">Notre Équipe Engagée</h2>
              <span class="slide-sector">Qui Sommes-Nous</span>
            </div>
            <div class="sector-indicator">Équipe</div>
          </div>

          <!-- Slide 3 -->
          <div class="slide">
            <img
              src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
              alt="Valeurs Bantou-Foundation"
              class="slide-image"
            />
            <div class="slide-overlay">
              <h2 class="slide-title">Nos Valeurs Fondatrices</h2>
              <span class="slide-sector">Qui Sommes-Nous</span>
            </div>
            <div class="sector-indicator">Valeurs</div>
          </div>
        </div>

        <button class="carousel-control prev">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-control next">
          <i class="fas fa-chevron-right"></i>
        </button>

        <div class="carousel-indicators">
          <div class="indicator active"></div>
          <div class="indicator"></div>
          <div class="indicator"></div>
        </div>
      </section>

      <!-- SECTION HISTOIRE -->
      <section id="histoire" class="section">
        <div class="container">
          <h2 class="section-title">Notre Histoire</h2>
          <div class="valeurs-grid">
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-seedling"></i>
              </div>
              <h3>Notre Création</h3>
              <p>
                Bantou-Foundation est née d'un constat simple mais essentiel : la vie est la plus grande richesse que nous possédons.
                Elle est le souffle qui anime nos existences, la source de toutes les créations et de toutes les espérances.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-heart"></i>
              </div>
              <h3>Notre Mission</h3>
              <p>
                Notre mission est de préserver, nourrir et amplifier la vie sous toutes ses formes.
                Nous travaillons pour que chaque enfant ait accès à l'éducation, que chaque famille puisse bénéficier d'une santé digne.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-eye"></i>
              </div>
              <h3>Notre Vision</h3>
              <p>
                Notre vision est celle d'un monde où la vie est respectée et honorée comme le plus précieux des trésors.
                Un monde où les générations futures hériteront de la force, de la santé, de la joie et de la lumière.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION NOS VALEURS -->
      <section id="nos-valeurs" class="section section-alt" style="display:flex; align-items: center;justify-content:center;flex-direction: column;flex-wrap: wrap">
        <div class="container">
          <h2 class="section-title">Nos Valeurs</h2>
          <div class="valeurs-grid">
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-hands-helping"></i>
              </div>
              <h3>Compassion</h3>
              <p>
                Nous agissons avec intégrité, sans calcul, en nous mettant réellement à la place de ceux qui souffrent.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-people-carry"></i>
              </div>
              <h3>Solidarité</h3>
              <p>
                Nous croyons à la force du collectif, car la vie ne prend tout son sens que lorsqu'elle est partagée.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-lightbulb"></i>
              </div>
              <h3>Innovation</h3>
              <p>
                Créer sans cesse de nouvelles formes pour améliorer les conditions de vie.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-leaf"></i>
              </div>
              <h3>Durabilité</h3>
              <p>
                Protéger la vie, c'est aussi protéger la nature, l'environnement et les générations futures.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION CONSEIL D'ADMINISTRATION -->
      <section id="conseil-administration" class="section">
        <div class="container">
          <h2 class="section-title">Conseil d'Administration</h2>
          <p
            style="
              text-align: center;
              max-width: 800px;
              margin: 0 auto 3rem;
              color: var(--text-light);
            "
          >
            Notre Conseil d'administration est composé de femmes et d'hommes engagés, passionnés par la vie et convaincus que chaque action sincère peut changer le monde.
          </p>

          <div class="team-grid">
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1590086782792-42dd2350140d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Président de Bantou-Foundation"
                />
              </div>
              <h4>Berthe KENDZO</h4>
              <div class="team-role">Présidente Fondatrice</div>
              <p>
                Fondatrice visionnaire de Bantou-Foundation, elle incarne les valeurs de compassion et d'engagement qui animent notre organisation.
              </p>
            </div>
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Secrétaire de Bantou-Foundation"
                />
              </div>
              <h4>Marie Lambert</h4>
              <div class="team-role">Secrétaire Générale</div>
              <p>
                Garante de la transparence et de la rigueur administrative, elle veille au bon fonctionnement de la fondation.
              </p>
            </div>
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Trésorier de Bantou-Foundation"
                />
              </div>
              <h4>Jean Leroy</h4>
              <div class="team-role">Trésorier</div>
              <p>
                Expert en gestion financière, il assure la pérennité des ressources et la bonne utilisation des fonds.
              </p>
            </div>
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Chargée des programmes éducatifs"
                />
              </div>
              <h4>Sophie Martin</h4>
              <div class="team-role">Chargée des Programmes Éducatifs</div>
              <p>
                Spécialiste en éducation, elle développe et supervise nos programmes de formation et d'alphabétisation.
              </p>
            </div>
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Chargée des programmes santé"
                />
              </div>
              <h4>Claire Dubois</h4>
              <div class="team-role">Chargée des Programmes Santé</div>
              <p>
                Experte en santé communautaire, elle coordonne nos actions de prévention et d'accès aux soins.
              </p>
            </div>
            <div class="team-member">
              <div class="team-photo">
                <img
                  src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                  alt="Chargé du développement durable"
                />
              </div>
              <h4>Lucas Robert</h4>
              <div class="team-role">Chargé du Développement Durable</div>
              <p>
                Passionné par l'environnement, il pilote nos projets de reboisement et de gestion des déchets.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION MOT DU FONDATEUR -->
      <section id="mot-fondateur" class="section section-alt">
        <div class="container">
          <h2 class="section-title">Mot du Fondateur</h2>
          <div class="valeur-card" style="max-width: 900px; margin: 0 auto; text-align: left;">
            <div class="valeur-icon" style="margin: 0 0 1.5rem;">
              <i class="fas fa-quote-left"></i>
            </div>
            <p style="font-style: italic; line-height: 1.8; margin-bottom: 1.5rem;">
              "Bantou-Foundation est née d'une conviction simple et personnelle: <strong>la vraie magie, le vrai pouvoir, se trouve dans la vie que nous menons et dans l'amour que nous y mettons</strong>. Travailler pour soi seul, poursuivre uniquement des résultats immédiats, c'est comme semer dans un sol stérile : tout se perd. Mais travailler avec patience, avec sincérité, avec confiance pour les autres, pour la collectivité, pour la vie elle-même, c'est semer dans un terreau fertile… et les fruits reviendront, souvent de manière inattendue, mais toujours certaine."
            </p>
            <p style="line-height: 1.8; margin-bottom: 1.5rem;">
              "Chaque action que nous posons pour éduquer un enfant, soutenir une famille, protéger l'environnement ou promouvoir la santé et la dignité humaine, n'est jamais perdue. Même si les résultats tardent à se montrer, la vie elle-même, dans sa sagesse infinie, s'en chargera."
            </p>
            <p style="text-align: right; font-weight: 600; color: var(--navy-blue);">
              Berthe KENDZO<br>
              <span style="font-weight: normal; font-size: 0.9rem;">Fondatrice de Bantou-Foundation</span>
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION ENGAGEMENT TRANSPARENCE -->
      {{-- <section id="engagement-transparence" class="section">
        <div class="container">
          <h2 class="section-title">Engagement pour la Transparence</h2>
          <div class="stats-container">
            <div class="stat-card">
              <div class="stat-number">100%</div>
              <div class="stat-label">Transparence financière</div>
            </div>
            <div class="stat-card">
              <div class="stat-number">Rapports</div>
              <div class="stat-label">Publics annuels</div>
            </div>
            <div class="stat-card">
              <div class="stat-number">Suivi</div>
              <div class="stat-label">Rigoureux des projets</div>
            </div>
            <div class="stat-card">
              <div class="stat-number">Retours</div>
              <div class="stat-label">Des bénéficiaires</div>
            </div>
          </div>

          <div class="valeurs-grid">
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <h3>Rapports Détaillés</h3>
              <p>
                Publication annuelle de rapports complets sur nos actions, dépenses et résultats.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-search"></i>
              </div>
              <h3>Suivi et Évaluation</h3>
              <p>
                Mise en place d'un système rigoureux de suivi et d'évaluation pour chaque projet.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <h3>Utilisation des Dons</h3>
              <p>
                Garantie que chaque don contribue réellement à transformer des vies.
              </p>
            </div>
            <div class="valeur-card">
              <div class="valeur-icon">
                <i class="fas fa-comments"></i>
              </div>
              <h3>Amélioration Continue</h3>
              <p>
                Utilisation des retours des bénéficiaires et partenaires pour améliorer nos actions.
              </p>
            </div>
          </div>
        </div>
      </section> --}}
    </main>
    <script>
      // Carousel functionality
      document.addEventListener('DOMContentLoaded', function() {
        const slide = document.querySelector('.carousel-slide');
        const slides = document.querySelectorAll('.slide');
        const prevButton = document.querySelector('.carousel-control.prev');
        const nextButton = document.querySelector('.carousel-control.next');
        const indicators = document.querySelectorAll('.indicator');

        let currentSlide = 0;
        const totalSlides = slides.length;

        function goToSlide(n) {
          currentSlide = (n + totalSlides) % totalSlides;
          slide.style.transform = `translateX(-${currentSlide * (100 / totalSlides)}%)`;

          // Update indicators
          indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
          });
        }

        function nextSlide() {
          goToSlide(currentSlide + 1);
        }

        function prevSlide() {
          goToSlide(currentSlide - 1);
        }

        // Event listeners
        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        indicators.forEach((indicator, index) => {
          indicator.addEventListener('click', () => goToSlide(index));
        });

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
      });
    </script>
  </body>
</html>
@endsection
