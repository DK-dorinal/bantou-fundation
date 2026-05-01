@extends('_partials.master')

@section('title', 'Devenir Partenaire | Bantou-Foundation')
@section('description', 'Rejoignez Bantou-Foundation en tant que partenaire pour étendre notre impact et transformer des vies ensemble.')

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
    background: linear-gradient(135deg, var(--navy-blue) 0%, var(--dark-blue) 100%);
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
    padding: 20px;
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
    margin: 0 auto;
    margin-top: 5vh;
    margin-bottom: 5vh;
}

.illustration-side {
    flex: 1;
    background: linear-gradient(rgba(15, 26, 58, 0.85),
            rgba(45, 74, 138, 0.9)),
        url("{{ asset('images/partnership-bg.jpg') }}") center/cover no-repeat;
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

.address-container {
    display: flex;
    gap: 10px;
    align-items: center;
}

.address-container .form-control {
    flex: 1;
}

.btn-location {
    background: linear-gradient(135deg, var(--medium-blue), var(--light-blue));
    color: var(--pure-white);
    border: none;
    border-radius: var(--border-radius);
    padding: 12px 15px;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.btn-location:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(45, 74, 138, 0.3);
}

.btn-location:active {
    transform: translateY(0);
}

.btn-location i {
    font-size: 1.2rem;
}

.location-loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid var(--pure-white);
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.location-info {
    margin-top: 8px;
    font-size: 0.75rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 8px;
}

.location-info i {
    font-size: 0.85rem;
}

.location-info.success {
    color: #10b981;
}

.location-info.error {
    color: #ef4444;
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

@media (max-width: 768px) {
    .membership-container {
        flex-direction: column;
        margin-top: 2vh;
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
    .address-container {
        flex-direction: column;
    }
    .btn-location {
        width: 100%;
        justify-content: center;
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

@section('content')
<div class="membership-container">
    <!-- Illustration Side -->
    <div class="illustration-side">
        <div class="logo-membership">
            @if($logo ?? false)
                <img src="{{ asset($logo) }}" alt="Logo Bantou Foundation" loading="lazy">
            @else
                <img src="{{ asset('images/bantou-logo.png') }}" alt="Logo Bantou Foundation" loading="lazy">
            @endif
        </div>

        <h2>Rejoignez Notre Grande Famille</h2>
        <p>Bantou-Foundation est une communauté de femmes et d'hommes unis par une même conviction : servir la vie avec sincérité et compassion.</p>

        <ul class="features-list">
            <li><i class="fas fa-heart"></i> Agir avec compassion et intégrité</li>
            <li><i class="fas fa-hands-helping"></i> Participer à des projets transformateurs</li>
            <li><i class="fas fa-users"></i> Rejoindre une communauté engagée</li>
            <li><i class="fas fa-seedling"></i> Contribuer à un avenir durable</li>
        </ul>

        <div class="login-link">
            Vous préférez faire un don? <a href="{{ route('don') }}">Faites un don ici</a>
        </div>
    </div>

    <!-- Form Side -->
    <div class="form-side">
        <div class="logo-membership">
            @if($logo ?? false)
                <img src="{{ asset($logo) }}" alt="Logo Bantou Foundation" loading="lazy">
            @else
                <img src="{{ asset('images/bantou-logo.png') }}" alt="Logo Bantou Foundation" loading="lazy">
            @endif
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

            <!-- Formulaire multi-étapes - ACTION CORRIGÉE -->
            <form method="POST" action="{{ route('form.submit') }}" id="membershipForm" enctype="multipart/form-data">
                @csrf

                <!-- Étape 1: Informations personnelles -->
                <div class="form-step active" id="step1">
                    <div class="form-group">
                        <label for="full_name">Nom et Prénom<span style="color:var(--medium-blue);"> *</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                               name="full_name" id="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Date de naissance<span style="color:var(--medium-blue);"> *</span></label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                               name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Genre<span style="color:var(--medium-blue);"> *</span></label>
                        <select class="form-control @error('gender') is-invalid @enderror"
                                name="gender" id="gender" required>
                            <option value="">Sélectionnez votre genre</option>
                            <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse complète (Ville, Pays)<span style="color:var(--medium-blue);"> *</span></label>
                        <div class="address-container">
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                   name="address" id="address" value="{{ old('address') }}"
                                   placeholder="Votre adresse complète" required>
                            <button type="button" class="btn-location" id="getLocationBtn">
                                <i class="fas fa-location-dot"></i>
                                <span>Me localiser</span>
                            </button>
                        </div>
                        <div id="locationInfo" class="location-info" style="display: none;">
                            <i class="fas fa-info-circle"></i>
                            <span id="locationMessage"></span>
                        </div>
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" id="email" value="{{ old('email') }}" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone / WhatsApp<span style="color:var(--medium-blue);"> *</span></label>
                        <div class="input-with-icon">
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" id="phone" value="{{ old('phone') }}" required>
                            <i class="fas fa-phone"></i>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="profession">Profession / Compétence principale<span style="color:var(--medium-blue);"> *</span></label>
                        <input type="text" class="form-control @error('profession') is-invalid @enderror"
                               name="profession" id="profession" value="{{ old('profession') }}" required>
                        @error('profession')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <input type="hidden" name="expertise_areas" id="expertise_areas" value="{{ old('expertise_areas') }}">
                    </div>

                    <div class="form-group">
                        <label for="motivation">Motivations personnelles<span style="color:var(--medium-blue);"> *</span></label>
                        <textarea class="form-control @error('motivation') is-invalid @enderror"
                                  name="motivation" id="motivation" rows="4"
                                  placeholder="Pourquoi souhaitez-vous rejoindre Bantou-Foundation ?" required>{{ old('motivation') }}</textarea>
                        @error('motivation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <input type="hidden" name="membership_type" id="membership_type" value="{{ old('membership_type') }}">
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
                        <input type="file" class="form-control @error('id_document') is-invalid @enderror"
                               name="id_document" id="id_document"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small style="color: var(--text-light); font-size: 0.8rem;">Formats acceptés: PDF, JPG, PNG (max 5MB)</small>
                        @error('id_document')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="commitment-message">
                        <h4>Engagement</h4>
                        <p>Je m'engage à respecter les valeurs de Bantou-Foundation : sincérité, solidarité, intégrité, compassion et transparence.</p>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="commitment" name="commitment" value="1" required>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
$(document).ready(function () {
    let selectedMembershipType = '{{ old("membership_type") }}';
    let selectedExpertiseAreas = '{{ old("expertise_areas") }}'.split(',').filter(Boolean);
    let currentStep = 1;
    const totalSteps = 4;

    // Initialiser les sélections existantes
    if (selectedMembershipType) {
        $(`.membership-type[data-value="${selectedMembershipType}"]`).addClass('selected');
        $("#membership_type").val(selectedMembershipType);
    }

    if (selectedExpertiseAreas.length > 0) {
        selectedExpertiseAreas.forEach(area => {
            $(`.expertise-area[data-value="${area}"]`).addClass('selected');
        });
        $("#expertise_areas").val(selectedExpertiseAreas.join(','));
    }

    // Fonction de géolocalisation (garde ton code existant)
    function getCurrentLocation() {
        // ... garde ton code de géolocalisation existant ...
        const locationInfo = $('#locationInfo');
        const locationMessage = $('#locationMessage');
        const getLocationBtn = $('#getLocationBtn');

        if (!navigator.geolocation) {
            showToast('error', 'Erreur', 'Votre navigateur ne supporte pas la géolocalisation');
            return;
        }

        const originalBtnText = getLocationBtn.html();
        getLocationBtn.html('<span class="location-loading"></span> Chargement...');
        getLocationBtn.prop('disabled', true);

        const options = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        };

        navigator.geolocation.getCurrentPosition(
            async function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                try {
                    const response = await axios.get(`https://nominatim.openstreetmap.org/reverse`, {
                        params: {
                            lat: latitude,
                            lon: longitude,
                            format: 'json',
                            addressdetails: 1,
                            'accept-language': 'fr'
                        }
                    });

                    if (response.data && response.data.display_name) {
                        const addressComponents = [];
                        if (response.data.address.road) addressComponents.push(response.data.address.road);
                        if (response.data.address.city || response.data.address.town || response.data.address.village) {
                            addressComponents.push(response.data.address.city || response.data.address.town || response.data.address.village);
                        }
                        if (response.data.address.state) addressComponents.push(response.data.address.state);
                        if (response.data.address.country) addressComponents.push(response.data.address.country);

                        const formattedAddress = addressComponents.join(', ');
                        $('#address').val(formattedAddress || response.data.display_name);

                        locationInfo.removeClass('error').addClass('success').show();
                        locationMessage.html(`📍 Localisation réussie !`);
                        showToast('success', 'Localisation réussie', 'Votre position a été détectée avec succès');
                    } else {
                        throw new Error('Adresse non trouvée');
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    $('#address').val(`Lat: ${latitude.toFixed(6)}, Lon: ${longitude.toFixed(6)}`);
                    locationInfo.removeClass('success').addClass('error').show();
                    locationMessage.html(`⚠️ Coordonnées détectées mais adresse non trouvée.`);
                }

                setTimeout(() => {
                    locationInfo.fadeOut();
                }, 5000);
            },
            function(error) {
                let errorMessage = '';
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        errorMessage = 'Accès à la position refusé.';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errorMessage = 'Position indisponible.';
                        break;
                    case error.TIMEOUT:
                        errorMessage = 'La demande a expiré.';
                        break;
                    default:
                        errorMessage = 'Erreur de localisation.';
                }
                locationInfo.removeClass('success').addClass('error').show();
                locationMessage.html(`⚠️ ${errorMessage}`);
                showToast('error', 'Erreur', errorMessage);
            },
            options
        ).finally(() => {
            getLocationBtn.html(originalBtnText);
            getLocationBtn.prop('disabled', false);
        });
    }

    $('#getLocationBtn').on('click', function(e) {
        e.preventDefault();
        getCurrentLocation();
    });

    function updateProgressBar() {
        const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
        $("#stepProgressBar").css("width", progressPercentage + "%");
    }

    function updateActiveStep() {
        $(".step").removeClass("active");
        $(`.step[data-step="${currentStep}"]`).addClass("active");
        for (let i = 1; i < currentStep; i++) {
            $(`.step[data-step="${i}"]`).addClass("completed");
        }
        updateProgressBar();
    }

    function showStep(stepNumber) {
        $(".form-step").removeClass("active");
        $(`#step${stepNumber}`).addClass("active");
        currentStep = stepNumber;
        updateActiveStep();
        $('html, body').animate({
            scrollTop: $(".form-side").offset().top - 20
        }, 300);
    }

    $(".btn-next").on("click", function () {
        const nextStep = parseInt($(this).data("next"));
        if (validateStep(currentStep)) {
            showStep(nextStep);
        }
    });

    $(".btn-prev").on("click", function () {
        const prevStep = parseInt($(this).data("prev"));
        showStep(prevStep);
    });

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
                    showToast('warning', 'Domaines requis', 'Sélectionnez au moins un domaine d\'expertise.');
                    isValid = false;
                } else if (!$("#motivation").val().trim()) {
                    showToast('warning', 'Champ manquant', 'Le champ "Motivations" est requis.');
                    $("#motivation").focus();
                    isValid = false;
                } else if (!selectedMembershipType) {
                    showToast('warning', 'Type d\'adhésion requis', 'Sélectionnez un type d\'adhésion.');
                    isValid = false;
                }
                break;
        }
        return isValid;
    }

    $(".membership-type").on("click", function () {
        $(".membership-type").removeClass("selected");
        $(this).addClass("selected");
        selectedMembershipType = $(this).data("value");
        $("#membership_type").val(selectedMembershipType);
    });

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

    // SOUMISSION CORRIGÉE AVEC AJAX
    $("#membershipForm").on("submit", function (e) {
        e.preventDefault(); // Empêcher la soumission normale

        if (!$("#commitment").is(":checked")) {
            showToast('warning', 'Engagement requis', 'Vous devez accepter de respecter les valeurs de Bantou-Foundation.');
            return;
        }

        // Créer FormData pour envoyer les fichiers
        var formData = new FormData(this);

        Swal.fire({
            title: 'Envoi en cours...',
            text: 'Veuillez patienter',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Envoyer avec AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
            },
// Dans la fonction success de chaque formulaire
success: function(response) {
    Swal.fire({
        icon: 'success',
        title: 'Succès!',
        text: response.message,
        confirmButtonColor: '#2d4a8a'
    }).then(() => {
        // Redirection vers le dashboard
        if (response.redirect) {
            window.location.href = response.redirect;
        } else {
            window.location.href = "{{ route('user_dashboard') }}";
        }
    });
},
            error: function(xhr) {
                Swal.close();
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errorHtml = '<ul style="text-align: left;">';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul>';
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de validation',
                        html: errorHtml,
                        confirmButtonColor: '#2d4a8a'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: xhr.responseJSON?.message || 'Une erreur est survenue lors de l\'enregistrement.',
                        confirmButtonColor: '#2d4a8a'
                    });
                }
                console.error('Erreur:', xhr);
            }
        });
    });

    function resetForm() {
        $("#membershipForm")[0].reset();
        $(".membership-type").removeClass("selected");
        $(".expertise-area").removeClass("selected");
        $("#locationInfo").hide();
        selectedMembershipType = null;
        selectedExpertiseAreas = [];
        showStep(1);
    }

    updateProgressBar();
});
</script>
@endsection
