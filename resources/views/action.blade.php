@extends('_partials.master')

@section('title', 'Bantou-Foundation / Accueil')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
<style>
  .carousel-header{
    padding-top: 4rem;
  }
</style>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nos Actions | Bantou Foundation</title>
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

      .actions-main {
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        background-color: var(--bg-light);
        margin-top: 5vh;
      }

      /* Bannière statique */
      .static-banner {
        position: relative;
        height: 80vh;
        overflow: hidden;
        border-radius: var(--border-radius);
        margin-bottom: 4rem;
      }

      .static-banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .static-banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(15, 26, 58, 0.8) 0%, rgba(42, 67, 135, 0.6) 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: var(--pure-white);
        padding: 2rem;
      }

      .static-banner-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--pure-white);
      }

      .static-banner-subtitle {
        font-size: 1.2rem;
        font-weight: 400;
        max-width: 600px;
        color: var(--pure-white);
      }

      /* Sections générales */
      .section {
        padding: 5rem 0;
      }

      .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--navy-blue);
        margin-bottom: 3rem;
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

      .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
      }

      /* Section Axes d'intervention */
      .axes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
      }

      .axe-card {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 4px 20px var(--shadow-light);
        transition: var(--transition);
        border: 1px solid rgba(15, 26, 58, 0.1);
        position: relative;
        overflow: hidden;
      }

      .axe-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold), var(--accent-light));
      }

      .axe-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px var(--shadow-medium);
      }

      .axe-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, var(--light-blue), var(--medium-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        font-size: 2rem;
      }

      .axe-card h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--navy-blue);
        margin-bottom: 1rem;
      }

      .axe-card p {
        color: var(--text-light);
        line-height: 1.6;
      }

      /* Section Projets */
      .projets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
      }

      .projet-card {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 4px 20px var(--shadow-light);
        transition: var(--transition);
      }

      .projet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px var(--shadow-medium);
      }

      .projet-image {
        height: 250px;
        overflow: hidden;
      }

      .projet-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
      }

      .projet-card:hover .projet-image img {
        transform: scale(1.05);
      }

      .projet-content {
        padding: 2rem;
      }

      .projet-content h3 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--navy-blue);
        margin-bottom: 1rem;
      }

      .projet-content p {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 1.5rem;
      }

      .projet-stats {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(15, 26, 58, 0.1);
      }

      .projet-stat {
        text-align: center;
      }

      .projet-stat .number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent-gold);
        display: block;
      }

      .projet-stat .label {
        font-size: 0.9rem;
        color: var(--text-light);
      }

      /* Section Chiffres clés */
      .chiffres-section {
        background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
        color: var(--pure-white);
        padding: 5rem 0;
      }

      .chiffres-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
      }

      .chiffre-item {
        padding: 2rem;
      }

      .chiffre-icon {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 1rem;
      }

      .chiffre-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--pure-white);
        margin-bottom: 0.5rem;
      }

      .chiffre-label {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
      }

      /* Section Vision */
      .vision-content {
        background: var(--pure-white);
        border-radius: var(--border-radius);
        padding: 3rem;
        box-shadow: 0 4px 20px var(--shadow-light);
        text-align: center;
        position: relative;
        overflow: hidden;
      }

      .vision-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-gold), var(--accent-light));
      }

      .vision-content h3 {
        font-size: 2rem;
        color: var(--navy-blue);
        margin-bottom: 1.5rem;
      }

      .vision-content p {
        color: var(--text-light);
        line-height: 1.7;
        font-size: 1.1rem;
        margin-bottom: 2rem;
      }

      .cta-button {
        display: inline-block;
        background: linear-gradient(135deg, var(--accent-gold), var(--accent-light));
        color: var(--navy-blue);
        padding: 1rem 2rem;
        border-radius: var(--border-radius);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
      }

      .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        color: var(--navy-blue);
      }

      /* Responsive */
      @media (max-width: 768px) {
        .static-banner-title {
          font-size: 2rem;
        }

        .static-banner-subtitle {
          font-size: 1rem;
        }

        .section-title {
          font-size: 2rem;
        }

        .chiffre-number {
          font-size: 2rem;
        }

        .vision-content {
          padding: 2rem;
        }
      }
    </style>
  </head>
  <body class="actions-main">
    <main>
      <!-- Bannière d'en-tête statique -->
      <section class="carousel-header">
        <div class="container">
          <div class="static-banner">
            <img
              src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
              alt="Nos Actions Bantou Foundation"
              class="static-banner-image"
            />
            <div class="static-banner-overlay">
              <h1 class="static-banner-title">Nos Actions</h1>
              <p class="static-banner-subtitle">
                Découvrez les projets concrets qui transforment des vies et construisent un avenir meilleur
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION AXES D'INTERVENTION -->
      <section id="axes-intervention" class="section">
        <div class="container">
          <h2 class="section-title">Nos Axes d'Intervention</h2>
          <div class="axes-grid">
            <div class="axe-card">
              <div class="axe-icon">
                <i class="fas fa-graduation-cap"></i>
              </div>
              <h3>Éducation & Formation</h3>
              <p>
                Bourses scolaires, programmes d'alphabétisation, formation numérique
                et entrepreneuriale pour autonomiser les jeunes et les adultes.
              </p>
            </div>
            <div class="axe-card">
              <div class="axe-icon">
                <i class="fas fa-heartbeat"></i>
              </div>
              <h3>Santé & Bien-être</h3>
              <p>
                Prévention VIH/maladies, soutien aux hôpitaux, campagnes de sensibilisation
                et distribution de kits d'hygiène dans les communautés vulnérables.
              </p>
            </div>
            <div class="axe-card">
              <div class="axe-icon">
                <i class="fas fa-hands-helping"></i>
              </div>
              <h3>Développement Économique & Social</h3>
              <p>
                Micro-projets pour jeunes & femmes, coopératives locales,
                accompagnement vers l'autonomie économique durable.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION CHIFFRES CLÉS -->
      <section id="chiffres-cles" class="section chiffres-section">
        <div class="container">
          <h2 class="section-title" style="color: var(--pure-white);">Notre Impact en Chiffres</h2>
          <div class="chiffres-grid">
            <div class="chiffre-item">
              <div class="chiffre-icon">
                <i class="fas fa-child"></i>
              </div>
              <div class="chiffre-number counter" data-target="5608">0</div>
              <div class="chiffre-label">Enfants et familles soutenus</div>
            </div>
            <div class="chiffre-item">
              <div class="chiffre-icon">
                <i class="fas fa-school"></i>
              </div>
              <div class="chiffre-number counter" data-target="25">0</div>
              <div class="chiffre-label">Établissements équipés</div>
            </div>
            <div class="chiffre-item">
              <div class="chiffre-icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <div class="chiffre-number counter" data-target="45">0</div>
              <div class="chiffre-label">Micro-entreprises soutenues</div>
            </div>
            <div class="chiffre-item">
              <div class="chiffre-icon">
                <i class="fas fa-tree"></i>
              </div>
              <div class="chiffre-number counter" data-target="10000">0</div>
              <div class="chiffre-label">Arbres plantés</div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION PROJETS RÉALISÉS -->
      <section id="projets-realises" class="section">
        <div class="container">
          <h2 class="section-title">Projets Réalisés</h2>
          <div class="projets-grid">
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Projet Éducation"
                />
              </div>
              <div class="projet-content">
                <h3>Programme Éducatif Intégral</h3>
                <p>
                  Des centaines d'enfants ont reçu des bourses scolaires et du matériel éducatif
                  dans plusieurs communautés rurales et urbaines, leur offrant un accès à une éducation de qualité.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">500+</span>
                    <span class="label">Bourses</span>
                  </div>
                  <div class="projet-stat">
                    <span class="number">15</span>
                    <span class="label">Communautés</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Projet Santé"
                />
              </div>
              <div class="projet-content">
                <h3>Campagnes de Santé Communautaire</h3>
                <p>
                  Campagnes de vaccination, sensibilisation à la nutrition, soutien à des centres
                  de santé et distribution de kits d'hygiène pour améliorer la santé des communautés.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">10K+</span>
                    <span class="label">Personnes soignées</span>
                  </div>
                  <div class="projet-stat">
                    <span class="number">50+</span>
                    <span class="label">Campagnes</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Projet Environnement"
                />
              </div>
              <div class="projet-content">
                <h3>Initiative de Reboisement</h3>
                <p>
                  Plantation de milliers d'arbres, sensibilisation au tri des déchets et à la protection
                  des ressources naturelles pour un environnement plus sain et durable.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">10K</span>
                    <span class="label">Arbres plantés</span>
                  </div>
                  <div class="projet-stat">
                    <span class="number">8</span>
                    <span class="label">Régions</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION PROJETS EN COURS -->
      <section id="projets-cours" class="section" style="background-color: var(--bg-light);">
        <div class="container">
          <h2 class="section-title">Projets en Cours</h2>
          <div class="projets-grid">
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1581093458791-8a6a5d1d1d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Bibliothèques et centres numériques"
                />
              </div>
              <div class="projet-content">
                <h3>Centres Numériques Communautaires</h3>
                <p>
                  Construction de bibliothèques et centres numériques pour permettre aux jeunes
                  de se former aux métiers de demain et d'accéder aux ressources éducatives en ligne.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">5</span>
                    <span class="label">Centres prévus</span>
                  </div>
                  <div class="projet-stat">
                    <span class="label">En cours</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1551836026-d5c8ac72d44a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Coopératives locales"
                />
              </div>
              <div class="projet-content">
                <h3>Coopératives Féminines</h3>
                <p>
                  Déploiement de coopératives locales pour autonomiser économiquement les femmes
                  et jeunes grâce à des formations et un accompagnement personnalisé.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">12</span>
                    <span class="label">Coopératives</span>
                  </div>
                  <div class="projet-stat">
                    <span class="label">En cours</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="projet-card">
              <div class="projet-image">
                <img
                  src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                  alt="Sensibilisation environnementale"
                />
              </div>
              <div class="projet-content">
                <h3>Éducation Environnementale</h3>
                <p>
                  Lancement d'un programme de sensibilisation environnementale dans les écoles
                  et quartiers populaires pour former une génération éco-responsable.
                </p>
                <div class="projet-stats">
                  <div class="projet-stat">
                    <span class="number">30</span>
                    <span class="label">Écoles</span>
                  </div>
                  <div class="projet-stat">
                    <span class="label">En cours</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION VISION 2025-2030 -->
      <section id="vision-future" class="section">
        <div class="container">
          <div class="vision-content">
            <h3>Vision 2025-2030 : Devenir une ONG Internationale</h3>
            <p>
              Notre ambition est claire : passer d'association locale à <strong>ONG reconnue au niveau national et international</strong>,
              afin d'étendre notre impact à travers l'Afrique. Nous voulons devenir un catalyseur de transformation sociale,
              inspirant d'autres acteurs à travailler pour la vie, avec patience et sincérité.
            </p>
            <p>
              Création de partenariats avec d'autres ONG, institutions internationales et fondations pour multiplier nos actions
              et déployer des programmes transnationaux dans plusieurs pays africains.
            </p>
            <a href="#" class="cta-button">Soutenir Notre Vision</a>
          </div>
        </div>
      </section>
    </main>

    <script>
      // Animation des compteurs
      document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        counters.forEach(counter => {
          const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
              counter.innerText = Math.ceil(count + increment);
              setTimeout(updateCount, 1);
            } else {
              counter.innerText = target.toLocaleString();
            }
          };

          // Démarrer l'animation quand l'élément est visible
          const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                updateCount();
                observer.unobserve(entry.target);
              }
            });
          });

          observer.observe(counter);
        });
      });
    </script>
  </body>
</html>
@endsection
