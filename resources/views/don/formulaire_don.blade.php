@extends('_partials.master')

@section('title', 'Faire un Don | Bantou-Foundation')
@section('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')

@section('styles')
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

    .donation-container {
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
            url("https://images.unsplash.com/photo-1551524164-6ca5c3bbb4bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80")
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
    }

    .logo-donation {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-donation img {
        height: 80px;
        transition: var(--transition);
        cursor: pointer;
    }

    .logo-donation img:hover {
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

    .donation-options {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .donation-amount {
        flex: 1;
        min-width: 120px;
        border: 2px solid var(--bg-light);
        border-radius: var(--border-radius);
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .donation-amount:hover {
        border-color: var(--medium-blue);
        transform: translateY(-5px);
        box-shadow: 0 5px 15px var(--shadow-light);
    }

    .donation-amount.selected {
        border-color: var(--medium-blue);
        background: rgba(45, 74, 138, 0.05);
    }

    .donation-amount i {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: var(--medium-blue);
    }

    .donation-amount h4 {
        margin-bottom: 5px;
        color: var(--text-dark);
    }

    .donation-amount p {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .custom-amount {
        margin-top: 20px;
    }

    .custom-amount-input {
        display: flex;
        align-items: center;
    }

    .currency {
        padding: 12px 15px;
        background: var(--bg-light);
        border: 1px solid var(--bg-light);
        border-right: none;
        border-radius: var(--border-radius) 0 0 var(--border-radius);
        font-weight: 500;
    }

    .custom-amount-input input {
        border-radius: 0 var(--border-radius) var(--border-radius) 0;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 2px solid var(--bg-light);
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
    }

    .payment-option:hover {
        border-color: var(--medium-blue);
    }

    .payment-option.selected {
        border-color: var(--medium-blue);
        background: rgba(45, 74, 138, 0.05);
    }

    .payment-option input {
        margin-right: 15px;
    }

    .payment-icon {
        margin-right: 15px;
        font-size: 1.5rem;
        width: 50px;
        text-align: center;
    }

    .payment-icon img {
        width: 100%;
        height: auto;
    }

    .payment-details {
        flex: 1;
    }

    .payment-details h4 {
        margin-bottom: 5px;
        color: var(--text-dark);
    }

    .payment-details p {
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

    .anonymous-donor {
        margin: 20px 0;
        padding: 15px;
        background: rgba(45, 74, 138, 0.05);
        border-radius: var(--border-radius);
        border: 1px solid var(--bg-light);
    }

    .anonymous-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .anonymous-checkbox input {
        margin-right: 10px;
    }

    .anonymous-checkbox span {
        font-size: 0.9rem;
        color: var(--text-dark);
    }

    .anonymous-info {
        margin-top: 10px;
        padding: 10px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: var(--border-radius);
        font-size: 0.8rem;
        color: var(--text-light);
        display: none;
    }

    @media (max-width: 768px) {
        .donation-container {
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

        .donation-options {
            flex-direction: column;
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
@endsection

@section('content')
<div class="body">
    <div class="donation-container">
        <!-- Illustration Side -->
        <div class="illustration-side">
            <h2 class="animate__animated animate__fadeIn">Votre Don Fait la Différence</h2>
            <p class="animate__animated animate__fadeIn animate__delay-1s">Votre générosité permet de soutenir notre mission éducative et d'offrir des opportunités aux jeunes défavorisés.</p>

            <ul class="features-list animate__animated animate__fadeIn animate__delay-2s">
                <li><i class="fas fa-heart"></i> Soutenez l'éducation des jeunes</li>
                <li><i class="fas fa-graduation-cap"></i> Financez des bourses d'études</li>
                <li><i class="fas fa-tools"></i> Améliorez nos infrastructures</li>
                <li><i class="fas fa-hands-helping"></i> Participez à notre mission sociale</li>
            </ul>

            <div class="login-link animate__animated animate__fadeIn animate__delay-3s">
                Vous préférez devenir bénévole? <a href="{{ route('benevole') }}">Inscrivez-vous ici</a>
            </div>
        </div>

        <!-- Form Side -->
        <div class="form-side">
            <div class="logo-donation">
                <img src="{{asset('./front/asset/img/logo.png')}}" onclick="window.location.href='{{ route('home') }}'" alt="Bantou-Foundation Logo" class="animate__animated animate__bounceIn">
            </div>

            <div class="form-header">
                <h3>Faire un Don à Bantou-Foundation</h3>
                <p>Votre soutien contribue à l'éducation, la santé et au développement durable en Afrique</p>
            </div>

            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="progress-bar" id="progressBar" style="width: 33%;"></div>
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Montant</div>
                </div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Informations</div>
                </div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Paiement</div>
                </div>
            </div>

            <!-- FORMULAIRE COMPLET -->
            <form method="POST" action="{{ route('form.submit') }}" id="donationForm" enctype="multipart/form-data">
                @csrf

                <!-- ============================================ -->
                <!-- CHAMPS CACHÉS OBLIGATOIRES POUR LE SERVEUR  -->
                <!-- ============================================ -->
                <input type="hidden" name="donation_amount" id="donation_amount_input" value="5000">
                <input type="hidden" name="payment_method" id="payment_method_input" value="">
                <input type="hidden" name="donation_type" value="don">
                <input type="hidden" name="is_anonymous" id="is_anonymous_input" value="0">

                <!-- Step 1: Montant du don -->
                <div class="form-step active" id="step1">
                    <div class="form-group">
                        <label>Sélectionnez le montant de votre don<span style="color:var(--medium-blue);"> *</span></label>

                        <div class="donation-options">
                            <div class="donation-amount selected" data-amount="5000">
                                <i class="fas fa-book"></i>
                                <h4>5 000 FCFA</h4>
                                <p>Finance un kit scolaire</p>
                            </div>

                            <div class="donation-amount" data-amount="15000">
                                <i class="fas fa-graduation-cap"></i>
                                <h4>15 000 FCFA</h4>
                                <p>Finance une bourse partielle</p>
                            </div>

                            <div class="donation-amount" data-amount="50000">
                                <i class="fas fa-building"></i>
                                <h4>50 000 FCFA</h4>
                                <p>Finance une infrastructure</p>
                            </div>
                        </div>

                        <div class="custom-amount">
                            <label for="customAmount">Ou saisissez un montant personnalisé</label>
                            <div class="custom-amount-input">
                                <div class="currency">FCFA</div>
                                <input type="number" class="form-control" id="customAmount" placeholder="Autre montant">
                            </div>
                        </div>
                    </div>

                    <div class="impact-message">
                        <h4>L'impact de votre don</h4>
                        <p>Votre contribution de <span id="impactAmount">5 000</span> FCFA permettra de <span id="impactDescription">financer un kit scolaire complet pour un étudiant</span>.</p>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="nextStep(2)">Suivant <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 2: Informations personnelles -->
                <div class="form-step" id="step2">
                    <div class="anonymous-donor">
                        <label class="anonymous-checkbox">
                            {{-- ✅ CORRECTION BUG 4 : ajout de name="anonymous_donor" et value="1"
                                 Sans name=, le champ n'est jamais transmis en POST --}}
                            <input type="checkbox" id="anonymousDonor" name="anonymous_donor" value="1">
                            <span>Je souhaite faire un don anonyme</span>
                        </label>
                        <div class="anonymous-info" id="anonymousInfo">
                            <i class="fas fa-info-circle"></i> Votre don apparaîtra comme "Donateur anonyme" dans nos registres. Vos informations personnelles resteront confidentielles.
                        </div>
                    </div>

                    <div id="donorInfo">
                        <div class="form-group">
                            <label for="name">Nom<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="text" class="form-control" name="nom" id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="surname">Prénom<span style="color:var(--medium-blue);"> *</span></label>
                            <input type="text" class="form-control" name="prenom" id="surname" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse Email<span style="color:var(--medium-blue);"> *</span></label>
                            <div class="input-with-icon">
                                <input type="email" class="form-control" name="email" id="email" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <div class="input-with-icon">
                                <input type="tel" class="form-control" name="phone" id="phone">
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profession">Profession</label>
                            <input type="text" class="form-control" name="profession" id="profession">
                        </div>

                        <div class="form-group">
                            <label for="message">Message d'encouragement (optionnel)</label>
                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Votre message de soutien..."></textarea>
                        </div>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i> Précédent</button>
                        <button type="button" class="btn btn-outline" onclick="nextStep(3)">Suivant <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

                <!-- Step 3: Paiement -->
                <div class="form-step" id="step3">
                    <div class="form-group">
                        <label>Sélectionnez votre mode de paiement<span style="color:var(--medium-blue);"> *</span></label>
                        <p style="margin-bottom: 15px; font-size: 0.9rem;">Montant du don: <strong class="payment-amount" id="donationAmountDisplay">5 000 FCFA</strong></p>

                        <div class="payment-options">
                            <div class="payment-option" data-value="orange_money">
                                <div class="payment-icon">
                                    <img src="{{asset('./front/paiement/OM.png')}}" style="width:40px;" alt="Orange Money">
                                </div>
                                <div class="payment-details">
                                    <h4>Orange Money</h4>
                                    <p>Paiement sécurisé via Orange Money</p>
                                </div>
                            </div>

                            <div class="payment-option" data-value="mtn_money">
                                <div class="payment-icon">
                                    <img src="{{asset('./front/paiement/MOMO.png')}}" style="width:40px;" alt="MTN Money">
                                </div>
                                <div class="payment-details">
                                    <h4>MTN Mobile Money</h4>
                                    <p>Paiement sécurisé via MTN Mobile Money</p>
                                </div>
                            </div>

                            <div class="payment-option" data-value="card">
                                <div class="payment-icon">
                                    <img src="{{asset('./front/paiement/cart.png')}}" style="width:40px;" alt="Carte Bancaire">
                                </div>
                                <div class="payment-details">
                                    <h4>Carte Bancaire</h4>
                                    <p>Paiement sécurisé par carte bancaire</p>
                                </div>
                            </div>

                            <div class="payment-option" data-value="paypal">
                                <div class="payment-icon">
                                    <i class="fab fa-paypal" style="font-size: 2rem; color: #0070ba;"></i>
                                </div>
                                <div class="payment-details">
                                    <h4>PayPal</h4>
                                    <p>Paiement sécurisé via PayPal</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="payment-details" style="display: none;">
                        <div id="orange-details">
                            <div class="form-group">
                                <label for="orange_number">Numéro Orange Money</label>
                                <input type="tel" class="form-control" name="orange_number" id="orange_number">
                            </div>
                        </div>

                        <div id="mtn-details">
                            <div class="form-group">
                                <label for="mtn_number">Numéro MTN Mobile Money</label>
                                <input type="tel" class="form-control" name="mtn_number" id="mtn_number">
                            </div>
                        </div>

                        <div id="card-details">
                            <div class="form-group">
                                <label for="card_number">Numéro de carte</label>
                                <input type="text" class="form-control" name="card_number" id="card_number" placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="form-group">
                                <label for="card_expiry">Date d'expiration</label>
                                <input type="text" class="form-control" name="card_expiry" id="card_expiry" placeholder="MM/AA">
                            </div>
                            <div class="form-group">
                                <label for="card_cvc">Code de sécurité (CVC)</label>
                                <input type="text" class="form-control" name="card_cvc" id="card_cvc" placeholder="123">
                            </div>
                        </div>
                    </div>

                    <div class="impact-message">
                        <h4>Merci pour votre générosité!</h4>
                        <p>Votre don permettra de continuer notre mission éducative et d'offrir des opportunités à ceux qui en ont le plus besoin.</p>
                    </div>

                    <div class="form-footer">
                        <button type="button" class="btn btn-outline" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i> Précédent</button>
                        <button type="submit" class="btn btn-primary" id="submitDonation">Faire un Don <i class="fas fa-heart"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    let currentStep = 1;
    let selectedAmount = 5000;
    let selectedPaymentMethod = null;
    let isAnonymous = false;

    // Gestion de la sélection du montant
    $(".donation-amount").on("click", function () {
        $(".donation-amount").removeClass("selected");
        $(this).addClass("selected");
        selectedAmount = parseInt($(this).data("amount"));
        updateImpactMessage();
        $("#customAmount").val('');
    });

    // Gestion du montant personnalisé
    $("#customAmount").on("input", function () {
        const customAmount = $(this).val();
        if (customAmount && parseInt(customAmount) > 0) {
            $(".donation-amount").removeClass("selected");
            selectedAmount = parseInt(customAmount);
            updateImpactMessage();
        }
    });

    // Gestion du donateur anonyme
    $("#anonymousDonor").on("change", function () {
        isAnonymous = $(this).is(":checked");
        if (isAnonymous) {
            $("#donorInfo").slideUp(300);
            $("#anonymousInfo").slideDown(300);
            $("#name, #surname, #email").removeAttr('required');
            $("#is_anonymous_input").val('1');
        } else {
            $("#donorInfo").slideDown(300);
            $("#anonymousInfo").slideUp(300);
            $("#name, #surname, #email").attr('required', 'required');
            $("#is_anonymous_input").val('0');
        }
    });

    // Mise à jour du message d'impact
    function updateImpactMessage() {
        $("#impactAmount").text(selectedAmount.toLocaleString());
        $("#donationAmountDisplay").text(selectedAmount.toLocaleString() + " FCFA");

        // Mettre à jour le champ caché donation_amount
        $("#donation_amount_input").val(selectedAmount);

        console.log('Montant mis à jour:', selectedAmount);

        let impactDescription = "";
        if (selectedAmount >= 50000) {
            impactDescription = "construire ou rénover une infrastructure éducative ou médicale";
        } else if (selectedAmount >= 15000) {
            impactDescription = "offrir une bourse partielle pour un étudiant défavorisé";
        } else {
            impactDescription = "financer un kit scolaire complet pour un enfant";
        }
        $("#impactDescription").text(impactDescription);
    }

    // Gestion des options de paiement
    $(".payment-option").on("click", function () {
        $(".payment-option").removeClass("selected");
        $(this).addClass("selected");
        selectedPaymentMethod = $(this).data("value");

        // Mettre à jour le champ caché payment_method
        $("#payment_method_input").val(selectedPaymentMethod);

        console.log('Méthode de paiement sélectionnée:', selectedPaymentMethod);

        // Afficher les détails de paiement
        $("#payment-details > div").hide();
        if (selectedPaymentMethod === "orange_money") {
            $("#orange-details").show();
            $("#payment-details").show();
        } else if (selectedPaymentMethod === "mtn_money") {
            $("#mtn-details").show();
            $("#payment-details").show();
        } else if (selectedPaymentMethod === "card") {
            $("#card-details").show();
            $("#payment-details").show();
        } else {
            $("#payment-details").hide();
        }
    });

    // Navigation entre les étapes
    window.nextStep = function (step) {
        if (step === 2) {
            if (selectedAmount <= 0) {
                showToast('warning', 'Montant requis', 'Veuillez sélectionner ou saisir un montant de don.');
                return;
            }
        }
        if (step === 3 && !isAnonymous) {
            if (!$("#name").val().trim()) {
                showToast('warning', 'Champ manquant', 'Le champ "Nom" est requis.');
                $("#name").focus();
                return;
            }
            if (!$("#surname").val().trim()) {
                showToast('warning', 'Champ manquant', 'Le champ "Prénom" est requis.');
                $("#surname").focus();
                return;
            }
            if (!$("#email").val().trim()) {
                showToast('warning', 'Champ manquant', 'Le champ "Email" est requis.');
                $("#email").focus();
                return;
            }
            const email = $("#email").val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showToast('warning', 'Email invalide', 'Veuillez entrer une adresse email valide.');
                $("#email").focus();
                return;
            }
        }
        goToStep(step);
    };

    window.prevStep = function (step) {
        goToStep(step);
    };

    function goToStep(step) {
        $(".form-step").removeClass("active");
        $("#step" + step).addClass("active");
        $(".step").removeClass("active");
        $(`.step[data-step="${step}"]`).addClass("active");
        const progressPercentage = (step / 3) * 100;
        $("#progressBar").css("width", progressPercentage + "%");
        currentStep = step;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showToast(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
    }

    // SOUMISSION
    $("#donationForm").on("submit", function (e) {
        e.preventDefault();

        // Vérifications finales
        if (selectedAmount <= 0) {
            showToast('warning', 'Montant requis', 'Veuillez sélectionner un montant de don.');
            return;
        }

        if (!selectedPaymentMethod) {
            showToast('warning', 'Méthode de paiement requise', 'Veuillez sélectionner une méthode de paiement.');
            return;
        }

        // S'assurer que les champs cachés sont à jour
        $("#donation_amount_input").val(selectedAmount);
        $("#payment_method_input").val(selectedPaymentMethod);

        var formData = new FormData(this);

        // Forcer les valeurs dans FormData
        formData.set('donation_amount', selectedAmount);
        formData.set('payment_method', selectedPaymentMethod);

        // LOG DE DÉBOGAGE
        console.log('=== SOUMISSION FORMULAIRE ===');
        console.log('donation_amount:', selectedAmount);
        console.log('payment_method:', selectedPaymentMethod);
        console.log('is_anonymous:', isAnonymous);
        console.log('nom:', $("#name").val());
        console.log('prenom:', $("#surname").val());
        console.log('email:', $("#email").val());

        console.log('=== FORM DATA ===');
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        Swal.fire({
            title: 'Envoi en cours...',
            text: 'Veuillez patienter',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "{{ route('form.submit') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('=== RÉPONSE SUCCÈS ===', response);
                Swal.fire({
                    icon: 'success',
                    title: 'Succès!',
                    text: response.message,
                    confirmButtonColor: '#2d4a8a'
                }).then(() => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        window.location.href = "{{ route('user_dashboard') }}";
                    }
                });
            },
            error: function(xhr) {
                console.error('=== ERREUR ===');
                console.error('Status:', xhr.status);
                console.error('Response:', xhr.responseText);
                Swal.close();

                let errorMessage = 'Une erreur est survenue.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    errorMessage = xhr.responseText.substring(0, 200);
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: errorMessage,
                    confirmButtonColor: '#2d4a8a'
                });
            }
        });
    });

    // Initialisation
    updateImpactMessage();
});
</script>
@endsection
