@extends('_partials.master')

@section('title', 'Bantou-Foundation / Accueil')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Bénévole | Bantou-Foundation</title>
    <link rel="shortcut icon" href="../logo 2.png" type="image/x-icon">
    <!-- Meta tag CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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

        .body {
            font-family: "Poppins", sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .volunteer-container {
            max-width: 1200px;
            width: 100%;
            display: flex;
            background: var(--pure-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--shadow-medium);
            animation: fadeInUp 0.8s;
            margin-top: 12vh;
        }

        .illustration-side {
            flex: 1;
            background: linear-gradient(
                    rgba(15, 26, 58, 0.85),
                    rgba(45, 74, 138, 0.9)
                ),
                url("https://images.unsplash.com/photo-1549924233-af2c4f544c2a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80")
                    center/cover no-repeat;
            color: var(--pure-white);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .illustration-side::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(
                circle,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0) 70%
            );
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }

        @keyframes shine {
            0% {
                transform: rotate(30deg) translate(-10%, -10%);
            }
            100% {
                transform: rotate(30deg) translate(10%, 10%);
            }
        }

        .illustration-side h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .illustration-side p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .benefits-list {
            list-style: none;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .benefits-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .benefits-list i {
            margin-right: 10px;
            color: var(--accent-gold);
            font-size: 1.2rem;
        }

        .donation-link {
            color: var(--pure-white);
            text-align: center;
            margin-top: auto;
            position: relative;
            z-index: 1;
        }

        .donation-link a {
            color: var(--accent-gold);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .donation-link a:hover {
            text-decoration: underline;
        }

        .form-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--pure-white);
        }

        .logo-volunteer {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-volunteer img {
            height: 80px;
            transition: var(--transition);
        }

        .logo-volunteer img:hover {
            transform: scale(1.05);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h3 {
            font-size: 1.8rem;
            color: var(--navy-blue);
            margin-bottom: 10px;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-steps::before {
            content: "";
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--bg-light);
            z-index: 0;
        }

        .progress-bar {
            position: absolute;
            top: 15px;
            left: 0;
            height: 3px;
            background: var(--medium-blue);
            transition: var(--transition);
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--bg-light);
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            margin-bottom: 8px;
            transition: var(--transition);
        }

        .step.active .step-number {
            background: var(--medium-blue);
            color: var(--pure-white);
            transform: scale(1.1);
        }

        .step.completed .step-number {
            background: var(--light-blue);
            color: var(--pure-white);
        }

        .step-label {
            font-size: 0.8rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .step.active .step-label {
            color: var(--medium-blue);
            font-weight: 600;
        }

        .step.completed .step-label {
            color: var(--light-blue);
        }

        .form-step {
            display: none;
            animation: fadeIn 0.5s;
        }

        .form-step.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--bg-light);
            border-radius: var(--border-radius);
            font-family: "Poppins", sans-serif;
            font-size: 0.9rem;
            transition: var(--transition);
            background: var(--bg-light);
        }

        .form-control:focus {
            border-color: var(--medium-blue);
            box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.2);
            outline: none;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .select-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--bg-light);
            border-radius: var(--border-radius);
            font-family: "Poppins", sans-serif;
            font-size: 0.9rem;
            transition: var(--transition);
            background: var(--bg-light);
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }

        .select-control:focus {
            border-color: var(--medium-blue);
            box-shadow: 0 0 0 3px rgba(45, 74, 138, 0.2);
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--medium-blue);
            color: var(--pure-white);
        }

        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 74, 138, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--medium-blue);
            border: 1px solid var(--medium-blue);
        }

        .btn-outline:hover {
            background: rgba(45, 74, 138, 0.1);
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .skills-section {
            margin: 20px 0;
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .skill-checkbox {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 2px solid var(--bg-light);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .skill-checkbox:hover {
            border-color: var(--medium-blue);
        }

        .skill-checkbox.selected {
            border-color: var(--medium-blue);
            background: rgba(45, 74, 138, 0.05);
        }

        .skill-checkbox input {
            margin-right: 10px;
        }

        .availability-section {
            margin: 20px 0;
        }

        .availability-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .availability-option {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 2px solid var(--bg-light);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }

        .availability-option:hover {
            border-color: var(--medium-blue);
        }

        .availability-option.selected {
            border-color: var(--medium-blue);
            background: rgba(45, 74, 138, 0.05);
        }

        .availability-option input {
            margin-right: 10px;
        }

        .motivation-message {
            background: rgba(45, 74, 138, 0.05);
            border-left: 4px solid var(--medium-blue);
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        .motivation-message h4 {
            color: var(--medium-blue);
            margin-bottom: 10px;
        }

        .motivation-message p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .required-field {
            color: var(--medium-blue);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .volunteer-container {
                flex-direction: column;
            }

            .illustration-side {
                padding: 30px;
                text-align: center;
            }

            .form-side {
                padding: 30px;
            }

            .form-header h3 {
                font-size: 1.5rem;
            }

            .skills-grid,
            .availability-options {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .progress-steps {
                margin-bottom: 20px;
            }

            .step-label {
                display: none;
            }

            .form-footer {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-step:not(.active) {
            display: none !important;
        }

        .form-step.active {
            display: block !important;
        }
    </style>
</head>
<body>
    <div class="body">
      <div class="volunteer-container">
        <!-- Illustration Side -->
        <div class="illustration-side">
            <h2 class="animate__animated animate__fadeIn">Rejoignez Notre Équipe de Bénévoles</h2>
            <p class="animate__animated animate__fadeIn animate__delay-1s">Votre temps et vos compétences peuvent transformer des vies et contribuer au développement de l'Afrique.</p>

            <ul class="benefits-list animate__animated animate__fadeIn animate__delay-2s">
                <li><i class="fas fa-heart"></i> Faites une différence concrète</li>
                <li><i class="fas fa-users"></i> Rejoignez une communauté engagée</li>
                <li><i class="fas fa-graduation-cap"></i> Développez de nouvelles compétences</li>
                <li><i class="fas fa-handshake"></i> Créez des liens significatifs</li>
                <li><i class="fas fa-award"></i> Obtenez une expérience valorisante</li>
            </ul>

            <div class="donation-link animate__animated animate__fadeIn animate__delay-3s">
                Vous préférez faire un don? <a href="#">Faites un don ici</a>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="logo-volunteer">
                <img src="{{asset('./front/asset/img/logo.png')}}" onclick="window.location.href='{{ route('home') }}'" alt="Bantou-Foundation Logo" class="animate__animated animate__bounceIn">
            </div>

            <div class="form-header">
                <h3>Devenir Bénévole</h3>
                <p>Rejoignez notre mission pour l'éducation, la santé et le développement durable en Afrique</p>
            </div>

            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="progress-bar" id="progressBar" style="width: 33%;"></div>
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Informations</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Compétences</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Disponibilité</div>
                </div>
            </div>

            <form method="POST" action="#" id="volunteerForm">
                <!-- Step 1: Informations personnelles -->
                <div class="form-step active" id="step1">
                    <div class="form-group">
                        <label for="name">Nom <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="nom" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="surname">Prénom <span class="required-field">*</span></label>
                        <input type="text" class="form-control" name="prenom" id="surname" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse Email <span class="required-field">*</span></label>
                        <div class="input-with-icon">
                            <input type="email" class="form-control" name="email" id="email" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone <span class="required-field">*</span></label>
                        <div class="input-with-icon">
                            <input type="tel" class="form-control" name="phone" id="phone" required>
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="age">Âge</label>
                        <input type="number" class="form-control" name="age" id="age" min="16" max="100">
                    </div>

                    <div class="form-group">
                        <label for="profession">Profession</label>
                        <input type="text" class="form-control" name="profession" id="profession">
                    </div>

                    <div class="form-group">
                        <label for="city">Ville de résidence</label>
                        <input type="text" class="form-control" name="city" id="city">
                    </div>

                    <div class="form-group">
                        <label for="country">Pays <span class="required-field">*</span></label>
                        <select class="select-control" name="country" id="country" required>
                            <option value="">Sélectionnez votre pays</option>
                            <option value="cameroun">Cameroun</option>
                            <option value="cote-ivoire">Côte d'Ivoire</option>
                            <option value="senegal">Sénégal</option>
                            <option value="gabon">Gabon</option>
                            <option value="congo">Congo</option>
                            <option value="rdc">République Démocratique du Congo</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div class="motivation-message">
                        <h4>Pourquoi devenir bénévole?</h4>
                        <p>Votre engagement nous aide à atteindre plus de personnes dans le besoin et à créer un impact durable dans les communautés africaines.</p>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="nextStep(2)">Suivant <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 2: Compétences et domaines d'intérêt -->
                <div class="form-step" id="step2">
                    <div class="skills-section">
                        <label>Domaines d'intérêt <span class="required-field">*</span></label>
                        <div class="skills-grid">
                            <label class="skill-checkbox" data-skill="education">
                                <input type="checkbox" name="interests[]" value="education">
                                <span>Éducation</span>
                            </label>
                            <label class="skill-checkbox" data-skill="sante">
                                <input type="checkbox" name="interests[]" value="sante">
                                <span>Santé</span>
                            </label>
                            <label class="skill-checkbox" data-skill="environnement">
                                <input type="checkbox" name="interests[]" value="environnement">
                                <span>Environnement</span>
                            </label>
                            <label class="skill-checkbox" data-skill="developpement">
                                <input type="checkbox" name="interests[]" value="developpement">
                                <span>Développement communautaire</span>
                            </label>
                            <label class="skill-checkbox" data-skill="urgence">
                                <input type="checkbox" name="interests[]" value="urgence">
                                <span>Aide d'urgence</span>
                            </label>
                            <label class="skill-checkbox" data-skill="soutien">
                                <input type="checkbox" name="interests[]" value="soutien">
                                <span>Soutien scolaire</span>
                            </label>
                        </div>
                    </div>

                    <div class="skills-section">
                        <label>Compétences spécifiques</label>
                        <div class="skills-grid">
                            <label class="skill-checkbox" data-skill="enseignement">
                                <input type="checkbox" name="skills[]" value="enseignement">
                                <span>Enseignement</span>
                            </label>
                            <label class="skill-checkbox" data-skill="medical">
                                <input type="checkbox" name="skills[]" value="medical">
                                <span>Soins médicaux</span>
                            </label>
                            <label class="skill-checkbox" data-skill="informatique">
                                <input type="checkbox" name="skills[]" value="informatique">
                                <span>Informatique</span>
                            </label>
                            <label class="skill-checkbox" data-skill="communication">
                                <input type="checkbox" name="skills[]" value="communication">
                                <span>Communication</span>
                            </label>
                            <label class="skill-checkbox" data-skill="gestion">
                                <input type="checkbox" name="skills[]" value="gestion">
                                <span>Gestion de projet</span>
                            </label>
                            <label class="skill-checkbox" data-skill="traduction">
                                <input type="checkbox" name="skills[]" value="traduction">
                                <span>Traduction</span>
                            </label>
                            <label class="skill-checkbox" data-skill="art">
                                <input type="checkbox" name="skills[]" value="art">
                                <span>Arts créatifs</span>
                            </label>
                            <label class="skill-checkbox" data-skill="sport">
                                <input type="checkbox" name="skills[]" value="sport">
                                <span>Activités sportives</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="experience">Expérience bénévole antérieure</label>
                        <textarea class="form-control" name="experience" id="experience" rows="3" placeholder="Décrivez votre expérience précédente en tant que bénévole..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="languages">Langues parlées</label>
                        <input type="text" class="form-control" name="languages" id="languages" placeholder="Ex: Français, Anglais, Lingala...">
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i> Précédent</button>
                        <button type="button" class="btn btn-outline" onclick="nextStep(3)">Suivant <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 3: Disponibilité et engagement -->
                <div class="form-step" id="step3">
                    <div class="availability-section">
                        <label>Disponibilité <span class="required-field">*</span></label>
                        <div class="availability-options">
                            <label class="availability-option" data-availability="ponctuel">
                                <input type="radio" name="availability" value="ponctuel">
                                <span>Ponctuelle</span>
                            </label>
                            <label class="availability-option" data-availability="hebdomadaire">
                                <input type="radio" name="availability" value="hebdomadaire">
                                <span>Quelques heures/semaine</span>
                            </label>
                            <label class="availability-option" data-availability="regulier">
                                <input type="radio" name="availability" value="regulier">
                                <span>Régulière</span>
                            </label>
                            <label class="availability-option" data-availability="plein">
                                <input type="radio" name="availability" value="plein">
                                <span>Temps plein</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="engagement">Type d'engagement préféré</label>
                        <select class="select-control" name="engagement" id="engagement">
                            <option value="">Sélectionnez votre type d'engagement</option>
                            <option value="presentiel">En présentiel</option>
                            <option value="distanciel">À distance</option>
                            <option value="mixte">Mixte (présentiel et distance)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duration">Durée d'engagement souhaitée</label>
                        <select class="select-control" name="duration" id="duration">
                            <option value="">Sélectionnez la durée</option>
                            <option value="court">Court terme (moins de 3 mois)</option>
                            <option value="moyen">Moyen terme (3-6 mois)</option>
                            <option value="long">Long terme (plus de 6 mois)</option>
                            <option value="ponctuel">Mission ponctuelle</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="motivation">Motivation personnelle <span class="required-field">*</span></label>
                        <textarea class="form-control" name="motivation" id="motivation" rows="4" placeholder="Pourquoi souhaitez-vous devenir bénévole avec Bantou-Foundation?" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="expectations">Attentes et objectifs</label>
                        <textarea class="form-control" name="expectations" id="expectations" rows="3" placeholder="Qu'attendez-vous de cette expérience de bénévolat?"></textarea>
                    </div>

                    <div class="motivation-message">
                        <h4>Prochaines étapes</h4>
                        <p>Après soumission de votre candidature, notre équipe vous contactera dans les 48 heures pour discuter des opportunités disponibles.</p>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i> Précédent</button>
                        <button type="submit" class="btn btn-primary">Soumettre ma candidature <i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function () {
        let currentStep = 1;

        // Gestion des cases à cocher pour les compétences
        $(".skill-checkbox").on("click", function () {
            $(this).toggleClass("selected");
            const checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop("checked", !checkbox.prop("checked"));
        });

        // Gestion des boutons radio pour la disponibilité
        $(".availability-option").on("click", function () {
            $(".availability-option").removeClass("selected");
            $(this).addClass("selected");
            $(this).find('input[type="radio"]').prop("checked", true);
        });

        // Navigation entre les étapes
        window.nextStep = function (step) {
            // Validation de l'étape 1
            if (step === 2) {
                const requiredFields = [
                    { id: '#name', name: 'Nom' },
                    { id: '#surname', name: 'Prénom' },
                    { id: '#email', name: 'Email' },
                    { id: '#phone', name: 'Téléphone' },
                    { id: '#country', name: 'Pays' }
                ];

                for (let field of requiredFields) {
                    if (!$(field.id).val().trim()) {
                        showToast('warning', 'Champ manquant', `Le champ "${field.name}" est requis.`);
                        $(field.id).focus();
                        return;
                    }
                }

                // Validation de l'email
                const email = $("#email").val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    showToast('warning', 'Email invalide', 'Veuillez entrer une adresse email valide.');
                    $("#email").focus();
                    return;
                }
            }

            // Validation de l'étape 2
            if (step === 3) {
                const interests = $('input[name="interests[]"]:checked');
                if (interests.length === 0) {
                    showToast('warning', 'Domaine requis', 'Veuillez sélectionner au moins un domaine d\'intérêt.');
                    return;
                }
            }

            goToStep(step);
        };

        window.prevStep = function (step) {
            goToStep(step);
        };

        function goToStep(step) {
            // Cacher toutes les étapes
            $(".form-step").removeClass("active");

            // Afficher l'étape appropriée
            $("#step" + step).addClass("active");

            // Mettre à jour les indicateurs d'étape
            $(".step").removeClass("active");
            $(`.step[data-step="${step}"]`).addClass("active");

            // Mettre à jour la barre de progression
            const progressPercentage = (step / 3) * 100;
            $(".progress-bar").css("width", progressPercentage + "%");

            currentStep = step;

            // Scroll to top for better UX
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Fonction pour afficher les toasts SweetAlert
        function showToast(icon, title, text, timer = 4000) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true
            });
        }

        // Soumission du formulaire
        $("#volunteerForm").on("submit", function (e) {
            e.preventDefault();

            // Validation finale
            const motivation = $("#motivation").val().trim();
            if (!motivation) {
                showToast('warning', 'Motivation requise', 'Veuillez expliquer votre motivation pour devenir bénévole.');
                $("#motivation").focus();
                return;
            }

            const availability = $('input[name="availability"]:checked').val();
            if (!availability) {
                showToast('warning', 'Disponibilité requise', 'Veuillez sélectionner votre disponibilité.');
                return;
            }

            // Récupérer les données du formulaire
            const formData = {
                nom: $("#name").val().trim(),
                prenom: $("#surname").val().trim(),
                email: $("#email").val().trim(),
                phone: $("#phone").val().trim(),
                age: $("#age").val().trim(),
                profession: $("#profession").val().trim(),
                city: $("#city").val().trim(),
                country: $("#country").val(),
                interests: $('input[name="interests[]"]:checked').map(function() { return this.value; }).get(),
                skills: $('input[name="skills[]"]:checked').map(function() { return this.value; }).get(),
                experience: $("#experience").val().trim(),
                languages: $("#languages").val().trim(),
                availability: availability,
                engagement: $("#engagement").val(),
                duration: $("#duration").val(),
                motivation: motivation,
                expectations: $("#expectations").val().trim(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Afficher le récapitulatif
            Swal.fire({
                title: 'Confirmer votre candidature',
                html: `
                    <div style="text-align: left;">
                        <p><strong>Nom:</strong> ${formData.prenom} ${formData.nom}</p>
                        <p><strong>Email:</strong> ${formData.email}</p>
                        <p><strong>Téléphone:</strong> ${formData.phone}</p>
                        <p><strong>Pays:</strong> ${formData.country}</p>
                        <p><strong>Domaines d'intérêt:</strong> ${formData.interests.join(', ') || 'Aucun'}</p>
                        <p><strong>Disponibilité:</strong> ${getAvailabilityLabel(formData.availability)}</p>
                        <p><strong>Motivation:</strong> ${formData.motivation.substring(0, 100)}${formData.motivation.length > 100 ? '...' : ''}</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Confirmer',
                cancelButtonText: 'Modifier',
                confirmButtonColor: '#2d4a8a'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Afficher le loading
                    Swal.fire({
                        title: 'Envoi en cours...',
                        text: 'Veuillez patienter pendant le traitement de votre candidature',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simuler l'envoi (remplacer par votre logique d'envoi réelle)
                    setTimeout(() => {
                        Swal.close();
                        showToast('success', 'Candidature envoyée!',
                            'Merci pour votre intérêt! Nous vous contacterons dans les 48 heures.',
                            5000);

                        // Réinitialiser le formulaire après 3 secondes
                        setTimeout(() => {
                            resetForm();
                        }, 3000);
                    }, 2000);
                }
            });
        });

        function getAvailabilityLabel(availability) {
            const labels = {
                'ponctuel': 'Ponctuelle',
                'hebdomadaire': 'Quelques heures/semaine',
                'regulier': 'Régulière',
                'plein': 'Temps plein'
            };
            return labels[availability] || availability;
        }

        function resetForm() {
            // Réinitialiser le formulaire
            $("#volunteerForm")[0].reset();
            $(".skill-checkbox").removeClass("selected");
            $(".availability-option").removeClass("selected");

            // Retourner à l'étape 1
            goToStep(1);

            // Réinitialiser les variables
            currentStep = 1;
        }

        // Initialisation
        $(".skill-checkbox").each(function() {
            if ($(this).find('input[type="checkbox"]').prop('checked')) {
                $(this).addClass('selected');
            }
        });

        $(".availability-option").each(function() {
            if ($(this).find('input[type="radio"]').prop('checked')) {
                $(this).addClass('selected');
            }
        });
    });
    </script>
</body>
</html>
@endsection
