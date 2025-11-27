
@extends('_partials.master')

@section('title', 'Devenir Partenaire | Bantou-Foundation')
@section('description', 'Rejoignez Bantou-Foundation en tant que partenaire pour étendre notre impact et transformer des vies ensemble.')

@section('styles')<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoindre Bantou-Foundation | Formulaire d'Adhésion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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


        .membership-container {
            max-width: 1200px;
            width: 100%;
            display: flex;
            background: var(--pure-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--shadow-medium);
            animation: fadeInUp 0.8s;
            margin: auto;
            margin-top: 15vh;
        }

        .illustration-side {
            flex: 1;
            background: linear-gradient(rgba(15, 26, 58, 0.85),
                    rgba(45, 74, 138, 0.9)),
                url("https://images.unsplash.com/photo-1551836026-d5c88ac6d6aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80") center/cover no-repeat;
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
            background: radial-gradient(circle,
                    rgba(255, 255, 255, 0.1) 0%,
                    rgba(255, 255, 255, 0) 70%);
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

        .features-list {
            list-style: none;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .features-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .features-list i {
            margin-right: 10px;
            color: var(--accent-gold);
            font-size: 1.2rem;
        }

        .login-link {
            color: var(--pure-white);
            text-align: center;
            margin-top: auto;
            position: relative;
            z-index: 1;
        }

        .login-link a {
            color: var(--accent-gold);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .form-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--pure-white);
            position: relative;
        }

        .logo-membership {
            text-align: center;
            margin-bottom: 30px;
            padding: 10px;
        }

        .logo-membership img {
            height: 70px;
            transition: var(--transition);
            cursor: pointer;
            max-width: 100%;
        }

        .logo-membership img:hover {
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

        .error-message {
            color: var(--medium-blue);
            font-size: 0.75rem;
            margin-top: 5px;
            display: none;
        }

        .membership-types {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .membership-type {
            flex: 1;
            min-width: 150px;
            border: 2px solid var(--bg-light);
            border-radius: var(--border-radius);
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .membership-type:hover {
            border-color: var(--medium-blue);
            transform: translateY(-5px);
            box-shadow: 0 5px 15px var(--shadow-light);
        }

        .membership-type.selected {
            border-color: var(--medium-blue);
            background: rgba(45, 74, 138, 0.05);
        }

        .membership-type i {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--medium-blue);
        }

        .membership-type h4 {
            margin-bottom: 5px;
            color: var(--text-dark);
        }

        .membership-type p {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .expertise-areas {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .expertise-area {
            flex: 1;
            min-width: 120px;
            border: 1px solid var(--bg-light);
            border-radius: var(--border-radius);
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 0.8rem;
        }

        .expertise-area:hover {
            border-color: var(--medium-blue);
        }

        .expertise-area.selected {
            background: var(--medium-blue);
            color: var(--pure-white);
            border-color: var(--medium-blue);
        }

        .commitment-message {
            background: rgba(45, 74, 138, 0.05);
            border-left: 4px solid var(--medium-blue);
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
        }

        .commitment-message h4 {
            color: var(--medium-blue);
            margin-bottom: 10px;
        }

        .commitment-message p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            margin-right: 10px;
            margin-top: 3px;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        /* Styles pour le formulaire multi-étapes */
        .form-steps-container {
            width: 100%;
        }

        .step-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .step-progress::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--bg-light);
            transform: translateY(-50%);
            z-index: 1;
        }

        .step-progress-bar {
            position: absolute;
            top: 50%;
            left: 0;
            height: 2px;
            background: var(--medium-blue);
            transform: translateY(-50%);
            transition: var(--transition);
            z-index: 2;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--text-light);
            position: relative;
            z-index: 3;
            transition: var(--transition);
        }

        .step.active {
            background: var(--medium-blue);
            color: var(--pure-white);
            transform: scale(1.1);
        }

        .step.completed {
            background: var(--medium-blue);
            color: var(--pure-white);
        }

        .step-label {
            position: absolute;
            top: 35px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 0.7rem;
            color: var(--text-light);
        }

        .step.active .step-label {
            color: var(--medium-blue);
            font-weight: 500;
        }

        .form-step {
            display: none;
            animation: fadeIn 0.5s;
        }

        .form-step.active {
            display: block;
        }

        .step-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .step-navigation .btn {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-navigation .btn-next {
            margin-left: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .membership-container {
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

            .membership-types {
                flex-direction: column;
            }

            .expertise-areas {
                flex-direction: column;
            }

            .logo-membership {
                margin-bottom: 20px;
            }

            .step-label {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .form-footer {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }

            .step-navigation {
                flex-direction: column;
                gap: 10px;
            }

            .step-navigation .btn {
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
    </style>
</head>
<body>
    <div class="membership-container">
        <!-- Illustration Side -->
        <div class="illustration-side">
            <div class="logo-membership">
                <img src="https://via.placeholder.com/150x70?text=Bantou+Foundation" alt="Logo Bantou Foundation"
                    loading="lazy" class="animate__animated animate__bounceIn">
            </div>

            <h2 class="animate__animated animate__fadeIn">Rejoignez Notre Grande Famille</h2>
            <p class="animate__animated animate__fadeIn animate__delay-1s">Bantou-Foundation est une communauté de femmes et d'hommes unis par une même conviction : servir la vie avec sincérité et compassion.</p>

            <ul class="features-list animate__animated animate__fadeIn animate__delay-2s">
                <li><i class="fas fa-heart"></i> Agir avec compassion et intégrité</li>
                <li><i class="fas fa-hands-helping"></i> Participer à des projets transformateurs</li>
                <li><i class="fas fa-users"></i> Rejoindre une communauté engagée</li>
                <li><i class="fas fa-seedling"></i> Contribuer à un avenir durable</li>
            </ul>

            <div class="login-link animate__animated animate__fadeIn animate__delay-3s">
                Vous préférez faire un don? <a href="#">Faites un don ici</a>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <!-- Logo repositionné en haut du formulaire -->
            <div class="logo-membership">
                <img src="https://via.placeholder.com/150x70?text=Bantou+Foundation" alt="Logo Bantou Foundation"
                    loading="lazy" class="animate__animated animate__bounceIn">
            </div>

            <div class="form-header">
                <h3>Rejoindre Bantou-Foundation</h3>
                <p>En rejoignant la fondation, vous devenez acteur du changement et portez la lumière dans vos communautés.</p>
            </div>

            <div class="form-steps-container">
                <!-- Barre de progression -->
                <div class="step-progress">
                    <div class="step-progress-bar" id="stepProgressBar"></div>
                    <div class="step active" data-step="1">
                        1
                        <span class="step-label">Informations personnelles</span>
                    </div>
                    <div class="step" data-step="2">
                        2
                        <span class="step-label">Contact & Profession</span>
                    </div>
                    <div class="step" data-step="3">
                        3
                        <span class="step-label">Expertise & Motivation</span>
                    </div>
                    <div class="step" data-step="4">
                        4
                        <span class="step-label">Engagement</span>
                    </div>
                </div>

                <!-- Formulaire multi-étapes -->
                <form method="POST" action="#" id="membershipForm">
                    <!-- Étape 1: Informations personnelles -->
                    <div class="form-step active" id="step1">
                        <div class="form-group">
                            <label for="full_name">Nom et Prénom<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="text" class="form-control" name="full_name" id="full_name" required>
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Date de naissance<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="date" class="form-control" name="birth_date" id="birth_date" required>
                        </div>

                        <div class="form-group">
                            <label for="gender">Genre<span style="color:var(--medium-blue);"> *</span></label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="">Sélectionnez votre genre</option>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Adresse complète (Ville, Pays)<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-outline" disabled>
                                <i class="fas fa-arrow-left"></i> Précédent
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-next="2">
                                Suivant <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Étape 2: Contact et profession -->
                    <div class="form-step" id="step2">
                        <div class="form-group">
                            <label for="email">Email<span style="color:var(--medium-blue);"> *</span></label>
                            <div class="input-with-icon">
                                <input type="email" class="form-control" name="email" id="email" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone / WhatsApp<span style="color:var(--medium-blue);"> *</span></label>
                            <div class="input-with-icon">
                                <input type="tel" class="form-control" name="phone" id="phone" required>
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profession">Profession / Compétence principale<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="text" class="form-control" name="profession" id="profession" required>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-outline btn-prev" data-prev="1">
                                <i class="fas fa-arrow-left"></i> Précédent
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-next="3">
                                Suivant <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Étape 3: Expertise et motivation -->
                    <div class="form-step" id="step3">
                        <div class="form-group">
                            <label>Domaines d'expertise sociale (cases à cocher)<span style="color:var(--medium-blue);"> *</span></label>
                            <div class="expertise-areas">
                                <div class="expertise-area" data-value="education">
                                    Éducation & Formation
                                </div>
                                <div class="expertise-area" data-value="health">
                                    Santé & Bien-être
                                </div>
                                <div class="expertise-area" data-value="environment">
                                    Environnement & Développement durable
                                </div>
                                <div class="expertise-area" data-value="social">
                                    Action sociale & Inclusion
                                </div>
                                <div class="expertise-area" data-value="communication">
                                    Communication & Mobilisation
                                </div>
                            </div>
                            <input type="hidden" name="expertise_areas" id="expertise_areas" required>
                        </div>

                        <div class="form-group">
                            <label for="motivation">Motivations personnelles<span style="color:var(--medium-blue);"> *</span></label>
                            <textarea class="form-control" name="motivation" id="motivation" rows="4"
                                placeholder="Pourquoi souhaitez-vous rejoindre Bantou-Foundation ?" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Type d'adhésion souhaité<span style="color:var(--medium-blue);"> *</span></label>
                            <div class="membership-types">
                                <div class="membership-type" data-value="volunteer">
                                    <i class="fas fa-hands-helping"></i>
                                    <h4>Membre bénévole</h4>
                                    <p>Participation active aux projets</p>
                                </div>

                                <div class="membership-type" data-value="active">
                                    <i class="fas fa-user-check"></i>
                                    <h4>Membre actif</h4>
                                    <p>Cotisation annuelle</p>
                                </div>

                                <div class="membership-type" data-value="supporter">
                                    <i class="fas fa-heart"></i>
                                    <h4>Sympathisant / Supporteur</h4>
                                    <p>Soutien occasionnel</p>
                                </div>
                            </div>
                            <input type="hidden" name="membership_type" id="membership_type" required>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-outline btn-prev" data-prev="2">
                                <i class="fas fa-arrow-left"></i> Précédent
                            </button>
                            <button type="button" class="btn btn-primary btn-next" data-next="4">
                                Suivant <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Étape 4: Engagement et finalisation -->
                    <div class="form-step" id="step4">
                        <div class="form-group">
                            <label for="id_document">Pièce d'identité (optionnel)</label>
                            <input type="file" class="form-control" name="id_document" id="id_document"
                                accept=".pdf,.jpg,.jpeg,.png">
                            <small style="color: var(--text-light); font-size: 0.8rem;">Formats acceptés: PDF, JPG, PNG (max 5MB)</small>
                        </div>

                        <div class="commitment-message">
                            <h4>Engagement</h4>
                            <p>Je m'engage à respecter les valeurs de Bantou-Foundation : sincérité, solidarité, intégrité, compassion et transparence.</p>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" id="commitment" name="commitment" required>
                            <label for="commitment">Je m'engage à respecter les valeurs de Bantou-Foundation<span style="color:var(--medium-blue);"> *</span></label>
                        </div>

                        <div class="step-navigation">
                            <button type="button" class="btn btn-outline btn-prev" data-prev="3">
                                <i class="fas fa-arrow-left"></i> Précédent
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Rejoindre la Fondation <i class="fas fa-user-plus"></i>
                            </button>
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
            let selectedMembershipType = null;
            let selectedExpertiseAreas = [];
            let currentStep = 1;
            const totalSteps = 4;

            // Mettre à jour la barre de progression
            function updateProgressBar() {
                const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
                $("#stepProgressBar").css("width", progressPercentage + "%");
            }

            // Mettre à jour les étapes actives
            function updateActiveStep() {
                $(".step").removeClass("active");
                $(`.step[data-step="${currentStep}"]`).addClass("active");

                // Marquer les étapes précédentes comme complétées
                for (let i = 1; i < currentStep; i++) {
                    $(`.step[data-step="${i}"]`).addClass("completed");
                }

                updateProgressBar();
            }

            // Afficher l'étape actuelle
            function showStep(stepNumber) {
                $(".form-step").removeClass("active");
                $(`#step${stepNumber}`).addClass("active");
                currentStep = stepNumber;
                updateActiveStep();
            }

            // Navigation entre les étapes
            $(".btn-next").on("click", function () {
                const nextStep = parseInt($(this).data("next"));

                // Validation de l'étape actuelle avant de passer à la suivante
                if (validateStep(currentStep)) {
                    showStep(nextStep);
                }
            });

            $(".btn-prev").on("click", function () {
                const prevStep = parseInt($(this).data("prev"));
                showStep(prevStep);
            });

            // Validation de chaque étape
            function validateStep(step) {
                let isValid = true;

                switch(step) {
                    case 1:
                        if (!$("#full_name").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Nom et Prénom" est requis.');
                            $("#full_name").focus();
                            isValid = false;
                        } else if (!$("#birth_date").val()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Date de naissance" est requis.');
                            $("#birth_date").focus();
                            isValid = false;
                        } else if (!$("#gender").val()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Genre" est requis.');
                            $("#gender").focus();
                            isValid = false;
                        } else if (!$("#address").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Adresse" est requis.');
                            $("#address").focus();
                            isValid = false;
                        }
                        break;

                    case 2:
                        if (!$("#email").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Email" est requis.');
                            $("#email").focus();
                            isValid = false;
                        } else {
                            const email = $("#email").val();
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(email)) {
                                showToast('warning', 'Email invalide', 'Veuillez entrer une adresse email valide.');
                                $("#email").focus();
                                isValid = false;
                            }
                        }

                        if (!$("#phone").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Téléphone" est requis.');
                            $("#phone").focus();
                            isValid = false;
                        }

                        if (!$("#profession").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Profession" est requis.');
                            $("#profession").focus();
                            isValid = false;
                        }
                        break;

                    case 3:
                        if (selectedExpertiseAreas.length === 0) {
                            showToast('warning', 'Domaines d\'expertise requis', 'Veuillez sélectionner au moins un domaine d\'expertise.');
                            isValid = false;
                        }

                        if (!$("#motivation").val().trim()) {
                            showToast('warning', 'Champ manquant', 'Le champ "Motivations personnelles" est requis.');
                            $("#motivation").focus();
                            isValid = false;
                        }

                        if (!selectedMembershipType) {
                            showToast('warning', 'Type d\'adhésion requis', 'Veuillez sélectionner un type d\'adhésion.');
                            isValid = false;
                        }
                        break;
                }

                return isValid;
            }

            // Gestion de la sélection du type d'adhésion
            $(".membership-type").on("click", function () {
                $(".membership-type").removeClass("selected");
                $(this).addClass("selected");

                selectedMembershipType = $(this).data("value");
                $("#membership_type").val(selectedMembershipType);
            });

            // Gestion de la sélection des domaines d'expertise
            $(".expertise-area").on("click", function () {
                $(this).toggleClass("selected");

                const value = $(this).data("value");
                if ($(this).hasClass("selected")) {
                    if (!selectedExpertiseAreas.includes(value)) {
                        selectedExpertiseAreas.push(value);
                    }
                } else {
                    selectedExpertiseAreas = selectedExpertiseAreas.filter(item => item !== value);
                }

                $("#expertise_areas").val(selectedExpertiseAreas.join(','));
            });

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
            $("#membershipForm").on("submit", function (e) {
                e.preventDefault();

                // Validation de l'engagement
                if (!$("#commitment").is(":checked")) {
                    showToast('warning', 'Engagement requis', 'Vous devez accepter de respecter les valeurs de Bantou-Foundation.');
                    return;
                }

                // Afficher le récapitulatif
                Swal.fire({
                    title: 'Confirmer votre adhésion',
                    html: `
                    <div style="text-align: left;">
                        <p><strong>Nom:</strong> ${$("#full_name").val()}</p>
                        <p><strong>Date de naissance:</strong> ${$("#birth_date").val()}</p>
                        <p><strong>Genre:</strong> ${$("#gender").val()}</p>
                        <p><strong>Adresse:</strong> ${$("#address").val()}</p>
                        <p><strong>Email:</strong> ${$("#email").val()}</p>
                        <p><strong>Téléphone:</strong> ${$("#phone").val()}</p>
                        <p><strong>Profession:</strong> ${$("#profession").val()}</p>
                        <p><strong>Domaines d'expertise:</strong> ${selectedExpertiseAreas.join(', ')}</p>
                        <p><strong>Type d'adhésion:</strong> ${getMembershipTypeName(selectedMembershipType)}</p>
                    </div>
                `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmer l\'adhésion',
                    cancelButtonText: 'Modifier',
                    confirmButtonColor: '#2d4a8a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Ici vous pouvez ajouter le traitement du formulaire
                        showToast('success', 'Adhésion envoyée!',
                            'Merci pour votre intérêt à rejoindre Bantou-Foundation! Nous vous contacterons rapidement.',
                            5000);

                        // Réinitialiser le formulaire après 3 secondes
                        setTimeout(() => {
                            resetForm();
                        }, 3000);
                    }
                });
            });

            function getMembershipTypeName(type) {
                const types = {
                    'volunteer': 'Membre bénévole',
                    'active': 'Membre actif',
                    'supporter': 'Sympathisant / Supporteur'
                };
                return types[type] || type;
            }

            function resetForm() {
                // Réinitialiser le formulaire
                $("#membershipForm")[0].reset();
                $(".membership-type").removeClass("selected");
                $(".expertise-area").removeClass("selected");

                // Réinitialiser les variables
                selectedMembershipType = null;
                selectedExpertiseAreas = [];

                // Revenir à la première étape
                showStep(1);
            }

            // Initialiser la barre de progression
            updateProgressBar();
        });
    </script>
</body>
</html>
@endsection
