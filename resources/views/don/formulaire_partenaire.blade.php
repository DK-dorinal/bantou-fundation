@extends('_partials.master')

@section('title', 'Devenir Bénévole | Bantou-Foundation')

@section('styles')
<style>
    :root {
        --navy-blue: #0f1a3a;
        --dark-blue: #1a2b55;
        --medium-blue: #2d4a8a;
        --light-blue: #3a5fc0;
        --accent-gold: #d4af37;
        --pure-white: #ffffff;
        --text-dark: #1e293b;
        --text-light: #64748b;
        --bg-light: #f8fafc;
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    .volunteer-container {
        max-width: 1200px;
        width: 100%;
        display: flex;
        background: var(--pure-white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin: 100px auto 50px;
    }

    .illustration-side {
        flex: 1;
        background: linear-gradient(rgba(15, 26, 58, 0.85), rgba(45, 74, 138, 0.9)), url("https://images.unsplash.com/photo-1549924233-af2c4f544c2a") center/cover;
        color: white;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-side {
        flex: 1;
        padding: 50px;
        background: white;
    }

    .logo-volunteer { text-align: center; margin-bottom: 30px; }
    .logo-volunteer img { height: 80px; cursor: pointer; }

    .form-header { text-align: center; margin-bottom: 30px; }
    .form-header h3 { font-size: 1.8rem; color: var(--navy-blue); }

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
    }
    .progress-bar {
        position: absolute;
        top: 15px;
        left: 0;
        height: 3px;
        background: var(--medium-blue);
        transition: width 0.3s;
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
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    .step.active .step-number {
        background: var(--medium-blue);
        color: white;
        transform: scale(1.1);
    }
    .step-label { font-size: 0.8rem; color: var(--text-light); }
    .step.active .step-label { color: var(--medium-blue); font-weight: 600; }

    .form-step { display: none; animation: fadeIn 0.5s; }
    .form-step.active { display: block; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--bg-light);
        border-radius: 8px;
        background: var(--bg-light);
    }
    .form-control:focus {
        border-color: var(--medium-blue);
        outline: none;
    }
    .input-with-icon { position: relative; }
    .input-with-icon i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }
    select.form-control { appearance: none; }
    textarea.form-control { resize: vertical; min-height: 100px; }

    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.3s;
    }
    .btn-primary { background: var(--medium-blue); color: white; }
    .btn-primary:hover { background: var(--dark-blue); transform: translateY(-2px); }
    .btn-outline { background: transparent; color: var(--medium-blue); border: 1px solid var(--medium-blue); }

    .form-footer { display: flex; justify-content: space-between; margin-top: 30px; gap: 15px; }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 10px;
    }
    .skill-checkbox {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 2px solid var(--bg-light);
        border-radius: 8px;
        cursor: pointer;
    }
    .skill-checkbox.selected { border-color: var(--medium-blue); background: rgba(45, 74, 138, 0.05); }
    .skill-checkbox input { margin-right: 10px; }

    .availability-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 10px;
    }
    .availability-option {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 2px solid var(--bg-light);
        border-radius: 8px;
        cursor: pointer;
    }
    .availability-option.selected { border-color: var(--medium-blue); background: rgba(45, 74, 138, 0.05); }
    .availability-option input { margin-right: 10px; }

    .motivation-message {
        background: rgba(45, 74, 138, 0.05);
        border-left: 4px solid var(--medium-blue);
        padding: 15px;
        margin: 20px 0;
    }

    .benefits-list { list-style: none; margin: 20px 0; }
    .benefits-list li { margin-bottom: 15px; display: flex; align-items: center; }
    .benefits-list i { margin-right: 10px; color: var(--accent-gold); }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .volunteer-container { flex-direction: column; margin-top: 20px; }
        .skills-grid, .availability-options { grid-template-columns: 1fr; }
        .form-footer { flex-direction: column; }
        .btn { width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="volunteer-container">
    <div class="illustration-side">
        <h2>Rejoignez Notre Équipe de Bénévoles</h2>
        <p>Votre temps et vos compétences peuvent transformer des vies.</p>
        <ul class="benefits-list">
            <li><i class="fas fa-heart"></i> Faites une différence concrète</li>
            <li><i class="fas fa-users"></i> Rejoignez une communauté engagée</li>
            <li><i class="fas fa-graduation-cap"></i> Développez de nouvelles compétences</li>
        </ul>
    </div>

    <div class="form-side">
        <div class="logo-volunteer">
            <img src="{{ asset('images/logo.png') }}" onclick="window.location.href='{{ route('home') }}'">
        </div>
        <div class="form-header">
            <h3>Devenir Bénévole</h3>
            <p>Rejoignez notre mission pour l'éducation, la santé et le développement durable</p>
        </div>

        <div class="progress-steps">
            <div class="progress-bar" id="progressBar"></div>
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

        <form method="POST" action="{{ route('form.submit') }}" id="volunteerForm" enctype="multipart/form-data">
            @csrf

            <div class="form-step active" id="step1">
                <div class="form-group">
                    <label>Nom *</label>
                    <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="form-group">
                    <label>Prénom *</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <div class="input-with-icon">
                        <input type="email" class="form-control" name="email" id="email" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Téléphone *</label>
                    <div class="input-with-icon">
                        <input type="tel" class="form-control" name="phone" id="phone" required>
                        <i class="fas fa-phone"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pays *</label>
                    <select class="form-control" name="country" id="country" required>
                        <option value="">Sélectionnez</option>
                        <option value="Cameroun">Cameroun</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Sénégal">Sénégal</option>
                    </select>
                </div>
                <div class="motivation-message">
                    <h4>Pourquoi devenir bénévole?</h4>
                    <p>Votre engagement aide à créer un impact durable.</p>
                </div>
                <div class="form-footer">
                    <button type="button" class="btn btn-outline" onclick="nextStep(2)">Suivant <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="form-step" id="step2">
                <div class="form-group">
                    <label>Domaines d'intérêt *</label>
                    <div class="skills-grid">
                        <label class="skill-checkbox"><input type="checkbox" name="interests[]" value="education"> Éducation</label>
                        <label class="skill-checkbox"><input type="checkbox" name="interests[]" value="sante"> Santé</label>
                        <label class="skill-checkbox"><input type="checkbox" name="interests[]" value="environnement"> Environnement</label>
                        <label class="skill-checkbox"><input type="checkbox" name="interests[]" value="social"> Action sociale</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Compétences</label>
                    <div class="skills-grid">
                        <label class="skill-checkbox"><input type="checkbox" name="skills[]" value="enseignement"> Enseignement</label>
                        <label class="skill-checkbox"><input type="checkbox" name="skills[]" value="communication"> Communication</label>
                        <label class="skill-checkbox"><input type="checkbox" name="skills[]" value="informatique"> Informatique</label>
                        <label class="skill-checkbox"><input type="checkbox" name="skills[]" value="gestion"> Gestion de projet</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Expérience bénévole</label>
                    <textarea class="form-control" name="experience" rows="3"></textarea>
                </div>
                <div class="form-footer">
                    <button type="button" class="btn btn-outline" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i> Précédent</button>
                    <button type="button" class="btn btn-outline" onclick="nextStep(3)">Suivant <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="form-step" id="step3">
                <div class="form-group">
                    <label>Disponibilité *</label>
                    <div class="availability-options">
                        <label class="availability-option"><input type="radio" name="availability" value="ponctuel"> Ponctuelle</label>
                        <label class="availability-option"><input type="radio" name="availability" value="hebdomadaire"> Hebdomadaire</label>
                        <label class="availability-option"><input type="radio" name="availability" value="regulier"> Régulière</label>
                        <label class="availability-option"><input type="radio" name="availability" value="plein"> Temps plein</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Motivation *</label>
                    <textarea class="form-control" name="motivation" id="motivation" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Attentes</label>
                    <textarea class="form-control" name="expectations" rows="3"></textarea>
                </div>
                <div class="form-footer">
                    <button type="button" class="btn btn-outline" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i> Précédent</button>
                    <button type="submit" class="btn btn-primary">Soumettre <i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    let currentStep = 1;

    $(".skill-checkbox").click(function() {
        $(this).toggleClass("selected");
        $(this).find('input').prop("checked", $(this).hasClass("selected"));
    });

    $(".availability-option").click(function() {
        $(".availability-option").removeClass("selected");
        $(this).addClass("selected");
        $(this).find('input').prop("checked", true);
    });

    window.nextStep = function(step) {
        if (step === 2) {
            if (!$("#nom").val().trim()) return showToast('warning', 'Champ manquant', 'Nom requis');
            if (!$("#prenom").val().trim()) return showToast('warning', 'Champ manquant', 'Prénom requis');
            if (!$("#email").val().trim()) return showToast('warning', 'Champ manquant', 'Email requis');
            if (!$("#phone").val().trim()) return showToast('warning', 'Champ manquant', 'Téléphone requis');
        }
        if (step === 3) {
            if ($('input[name="interests[]"]:checked').length === 0) return showToast('warning', 'Domaine requis', 'Sélectionnez un domaine');
        }
        goToStep(step);
    };

    window.prevStep = function(step) { goToStep(step); };

    function goToStep(step) {
        $(".form-step").removeClass("active");
        $("#step" + step).addClass("active");
        $(".step").removeClass("active");
        $(`.step[data-step="${step}"]`).addClass("active");
        $("#progressBar").css("width", ((step - 1) / 2 * 100) + "%");
        currentStep = step;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showToast(icon, title, text) {
        Swal.fire({ icon, title, text, toast: true, position: 'top-end', showConfirmButton: false, timer: 4000 });
    }

    $("#volunteerForm").submit(function(e) {
        e.preventDefault();
        if (!$("#motivation").val().trim()) return showToast('warning', 'Champ manquant', 'Motivation requise');
        if (!$('input[name="availability"]:checked').val()) return showToast('warning', 'Champ manquant', 'Disponibilité requise');

        var formData = new FormData(this);
        Swal.fire({ title: 'Envoi...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        $.ajax({
            url: "{{ route('form.submit') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                Swal.fire({ icon: 'success', title: 'Succès!', text: response.message, confirmButtonColor: '#2d4a8a' })
                    .then(() =>window.location.href = "{{ route('user_dashboard') }}";
            },
            error: function(xhr) {
                Swal.close();
                let msg = xhr.responseJSON?.message || 'Erreur serveur';
                Swal.fire({ icon: 'error', title: 'Erreur', text: msg, confirmButtonColor: '#2d4a8a' });
            }
        });
    });
});
</script>
@endsection
