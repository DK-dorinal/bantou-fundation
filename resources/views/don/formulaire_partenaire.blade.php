@extends('_partials.master')

@section('title', 'Devenir Partenaire | Bantou-Foundation')
@section('description', 'Rejoignez Bantou-Foundation en tant que partenaire pour étendre notre impact et transformer des vies ensemble.')

@section('styles')
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Devenir Partenaire | Bantou-Foundation</title>
        <link rel="shortcut icon" href="../logo 2.png" type="image/x-icon">
        <!-- Meta tag CSRF -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
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

            .partnership-container {
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

            /* Logo repositionné sans position absolue */
            .logo-partnership {
                text-align: center;
                margin-bottom: 30px;
                padding: 10px;
            }

            .logo-partnership img {
                height: 70px;
                transition: var(--transition);
                cursor: pointer;
                max-width: 100%;
            }

            .logo-partnership img:hover {
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

            .partnership-types {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                margin-bottom: 20px;
            }

            .partnership-type {
                flex: 1;
                min-width: 150px;
                border: 2px solid var(--bg-light);
                border-radius: var(--border-radius);
                padding: 15px;
                text-align: center;
                cursor: pointer;
                transition: var(--transition);
            }

            .partnership-type:hover {
                border-color: var(--medium-blue);
                transform: translateY(-5px);
                box-shadow: 0 5px 15px var(--shadow-light);
            }

            .partnership-type.selected {
                border-color: var(--medium-blue);
                background: rgba(45, 74, 138, 0.05);
            }

            .partnership-type i {
                font-size: 1.5rem;
                margin-bottom: 10px;
                color: var(--medium-blue);
            }

            .partnership-type h4 {
                margin-bottom: 5px;
                color: var(--text-dark);
            }

            .partnership-type p {
                font-size: 0.8rem;
                color: var(--text-light);
            }

            .impact-message {
                background: rgba(45, 74, 138, 0.05);
                border-left: 4px solid var(--medium-blue);
                padding: 15px;
                margin: 20px 0;
                border-radius: 0 var(--border-radius) var(--border-radius) 0;
            }

            .impact-message h4 {
                color: var(--medium-blue);
                margin-bottom: 10px;
            }

            .impact-message p {
                font-size: 0.9rem;
                color: var(--text-light);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .partnership-container {
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

                .partnership-types {
                    flex-direction: column;
                }

                .logo-partnership {
                    margin-bottom: 20px;
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
            <div class="partnership-container">
                <!-- Illustration Side -->
                <div class="illustration-side">
                    <div class="logo-partnership">
                        <img src="{{ asset("../asset/img/logo/BFund/logo BH BF-05.png") }}" alt="Logo Bantou Foundation"
                            loading="lazy" onclick="window.location.href='{{ route('home') }}'" alt="Bantou-Foundation Logo"
                            class="animate__animated animate__bounceIn">
                    </div>

                    <h2 class="animate__animated animate__fadeIn">Ensemble, Changeons des Vies</h2>
                    <p class="animate__animated animate__fadeIn animate__delay-1s">Votre partenariat nous permettra
                        d'étendre notre impact et de transformer davantage de vies à travers l'Afrique.</p>

                    <ul class="features-list animate__animated animate__fadeIn animate__delay-2s">
                        <li><i class="fas fa-handshake"></i> Collaboration stratégique</li>
                        <li><i class="fas fa-chart-line"></i> Impact mesurable</li>
                        <li><i class="fas fa-users"></i> Réseau de partenaires engagés</li>
                        <li><i class="fas fa-globe-africa"></i> Expansion en Afrique</li>
                    </ul>

                    <div class="login-link animate__animated animate__fadeIn animate__delay-3s">
                        Vous préférez faire un don? <a href="{{ route('don') }}">Faites un don ici</a>
                    </div>
                </div>

                <!-- Form Side -->
                <div class="form-side">
                    <!-- Logo repositionné en haut du formulaire -->
                    <div class="logo-partnership">
                        <img src="{{ asset("../asset/img/logo/BFund/logo BH BF-05.png") }}" alt="Logo Bantou Foundation"
                            loading="lazy" onclick="window.location.href='{{ route('home') }}'" alt="Bantou-Foundation Logo"
                            class="animate__animated animate__bounceIn">
                    </div>

                    <div class="form-header">
                        <h3>Devenir Partenaire de Bantou-Foundation</h3>
                        <p>Ensemble, nous pouvons étendre notre impact, transformer des vies et bâtir un avenir durable</p>
                    </div>

                    <!-- Progress Steps -->
                    <div class="progress-steps">
                        <div class="progress-bar" id="progressBar" style="width: 33%;"></div>
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-label">Organisation</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-label">Partenariat</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-label">Message</div>
                        </div>
                    </div>

                    <form method="POST" action="#" id="partnershipForm">
                        <!-- Step 1: Informations de l'organisation -->
                        <div class="form-step active" id="step1">
                            <div class="form-group">
                                <label for="organization_name">Nom de l'organisation / entreprise<span
                                        style="color:var(--medium-blue);"> *</span></label>
                                <input type="text" class="form-control" name="organization_name" id="organization_name"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="sector">Secteur d'activité<span style="color:var(--medium-blue);">
                                        *</span></label>
                                <input type="text" class="form-control" name="sector" id="sector" required>
                            </div>

                            <div class="form-group">
                                <label for="contact_name">Personne de contact (Nom et Prénom)<span
                                        style="color:var(--medium-blue);"> *</span></label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" required>
                            </div>

                            <div class="form-group">
                                <label for="position">Fonction<span style="color:var(--medium-blue);"> *</span></label>
                                <input type="text" class="form-control" name="position" id="position" required>
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-outline" onclick="nextStep(2)">Suivant <i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 2: Coordonnées et type de partenariat -->
                        <div class="form-step" id="step2">
                            <div class="form-group">
                                <label for="email">Adresse Email<span style="color:var(--medium-blue);"> *</span></label>
                                <div class="input-with-icon">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">Téléphone<span style="color:var(--medium-blue);"> *</span></label>
                                <div class="input-with-icon">
                                    <input type="tel" class="form-control" name="phone" id="phone" required>
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city_country">Pays / Ville<span style="color:var(--medium-blue);">
                                        *</span></label>
                                <input type="text" class="form-control" name="city_country" id="city_country" required>
                            </div>

                            <div class="form-group">
                                <label>Type de partenariat souhaité<span style="color:var(--medium-blue);"> *</span></label>

                                <div class="partnership-types">
                                    <div class="partnership-type" data-value="financial">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        <h4>Partenariat financier</h4>
                                        <p>Soutien financier aux projets</p>
                                    </div>

                                    <div class="partnership-type" data-value="material">
                                        <i class="fas fa-truck-loading"></i>
                                        <h4>Partenariat matériel</h4>
                                        <p>Fourniture de matériel/logistique</p>
                                    </div>

                                    <div class="partnership-type" data-value="technical">
                                        <i class="fas fa-cogs"></i>
                                        <h4>Partenariat technique</h4>
                                        <p>Expertise et compétences</p>
                                    </div>

                                    <div class="partnership-type" data-value="event">
                                        <i class="fas fa-calendar-alt"></i>
                                        <h4>Partenariat événementiel</h4>
                                        <p>Organisation d'événements</p>
                                    </div>
                                </div>

                                <input type="hidden" name="partnership_type" id="partnership_type" required>
                            </div>

                            <div class="form-group" id="other-partnership" style="display: none;">
                                <label for="other_partnership_type">Précisez le type de partenariat</label>
                                <input type="text" class="form-control" name="other_partnership_type"
                                    id="other_partnership_type">
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-outline" onclick="prevStep(1)"><i
                                        class="fas fa-arrow-left"></i> Précédent</button>
                                <button type="button" class="btn btn-outline" onclick="nextStep(3)">Suivant <i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 3: Message et pièce jointe -->
                        <div class="form-step" id="step3">
                            <div class="form-group">
                                <label for="message">Message<span style="color:var(--medium-blue);"> *</span></label>
                                <textarea class="form-control" name="message" id="message" rows="4"
                                    placeholder="Décrivez votre proposition de partenariat, vos motivations et comment vous souhaitez collaborer avec Bantou-Foundation..."
                                    required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="attachment">Présentation de l'organisation (optionnel)</label>
                                <input type="file" class="form-control" name="attachment" id="attachment"
                                    accept=".pdf,.doc,.docx">
                                <small style="color: var(--text-light); font-size: 0.8rem;">Formats acceptés: PDF, DOC, DOCX
                                    (max 5MB)</small>
                            </div>

                            <div class="impact-message">
                                <h4>L'impact de votre partenariat</h4>
                                <p>Votre collaboration avec Bantou-Foundation permettra de soutenir nos actions dans les
                                    domaines de l'éducation, la santé, le développement économique et la protection de
                                    l'environnement en Afrique.</p>
                            </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-outline" onclick="prevStep(2)"><i
                                        class="fas fa-arrow-left"></i> Précédent</button>
                                <button type="submit" class="btn btn-primary">Devenir Partenaire <i
                                        class="fas fa-handshake"></i></button>
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
                let selectedPartnershipType = null;

                // Gestion de la sélection du type de partenariat
                $(".partnership-type").on("click", function () {
                    $(".partnership-type").removeClass("selected");
                    $(this).addClass("selected");

                    selectedPartnershipType = $(this).data("value");
                    $("#partnership_type").val(selectedPartnershipType);

                    // Afficher le champ "autre" si nécessaire
                    if (selectedPartnershipType === "other") {
                        $("#other-partnership").slideDown(300);
                    } else {
                        $("#other-partnership").slideUp(300);
                    }
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

                // Navigation entre les étapes
                window.nextStep = function (step) {
                    // Validation de l'étape 1
                    if (step === 2) {
                        const requiredFields = [
                            { id: '#organization_name', name: 'Nom de l\'organisation' },
                            { id: '#sector', name: 'Secteur d\'activité' },
                            { id: '#contact_name', name: 'Personne de contact' },
                            { id: '#position', name: 'Fonction' }
                        ];

                        for (let field of requiredFields) {
                            if (!$(field.id).val().trim()) {
                                showToast('warning', 'Champ manquant', `Le champ "${field.name}" est requis.`);
                                $(field.id).focus();
                                return;
                            }
                        }
                    }

                    // Validation de l'étape 2
                    if (step === 3) {
                        const requiredFields = [
                            { id: '#email', name: 'Email' },
                            { id: '#phone', name: 'Téléphone' },
                            { id: '#city_country', name: 'Pays/Ville' }
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

                        // Validation du type de partenariat
                        if (!selectedPartnershipType) {
                            showToast('warning', 'Type de partenariat requis', 'Veuillez sélectionner un type de partenariat.');
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

                // Soumission du formulaire
                $("#partnershipForm").on("submit", function (e) {
                    e.preventDefault();

                    // Validation finale de l'étape 3
                    if (!$("#message").val().trim()) {
                        showToast('warning', 'Champ manquant', 'Le champ "Message" est requis.');
                        $("#message").focus();
                        return;
                    }

                    // Afficher le récapitulatif
                    Swal.fire({
                        title: 'Confirmer votre demande de partenariat',
                        html: `
                        <div style="text-align: left;">
                            <p><strong>Organisation:</strong> ${$("#organization_name").val()}</p>
                            <p><strong>Secteur:</strong> ${$("#sector").val()}</p>
                            <p><strong>Contact:</strong> ${$("#contact_name").val()}</p>
                            <p><strong>Fonction:</strong> ${$("#position").val()}</p>
                            <p><strong>Email:</strong> ${$("#email").val()}</p>
                            <p><strong>Téléphone:</strong> ${$("#phone").val()}</p>
                            <p><strong>Localisation:</strong> ${$("#city_country").val()}</p>
                            <p><strong>Type de partenariat:</strong> ${getPartnershipTypeName(selectedPartnershipType)}</p>
                        </div>
                    `,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Confirmer la demande',
                        cancelButtonText: 'Modifier',
                        confirmButtonColor: '#2d4a8a'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Ici vous pouvez ajouter le traitement du formulaire
                            showToast('success', 'Demande envoyée!',
                                'Merci pour votre intérêt à devenir partenaire de Bantou-Foundation! Nous vous contacterons rapidement.',
                                5000);

                            // Réinitialiser le formulaire après 3 secondes
                            setTimeout(() => {
                                resetForm();
                            }, 3000);
                        }
                    });
                });

                function getPartnershipTypeName(type) {
                    const types = {
                        'financial': 'Partenariat financier',
                        'material': 'Partenariat matériel/logistique',
                        'technical': 'Partenariat technique/expertise',
                        'event': 'Partenariat événementiel',
                        'other': 'Autre type de partenariat'
                    };
                    return types[type] || type;
                }

                function resetForm() {
                    // Réinitialiser le formulaire
                    $("#partnershipForm")[0].reset();
                    $(".partnership-type").removeClass("selected");
                    $("#other-partnership").hide();

                    // Retourner à l'étape 1
                    goToStep(1);

                    // Réinitialiser les variables
                    selectedPartnershipType = null;
                }
            });
        </script>
    </body>

    </html>
@endsection
