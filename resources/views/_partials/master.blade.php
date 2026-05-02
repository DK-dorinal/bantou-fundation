<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bantou-Foundation')</title>
    <meta name="description" content="@yield('description', 'Bantou-Foundation œuvre pour l\'éducation, la santé et le développement durable en Afrique.')">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons (pour les icônes comme bus, train, etc.) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Styles spécifiques à la page -->
    @yield('styles')
</head>

<body>
    <!-- Header avec Menu -->
    @include('_partials.menu')

    <!-- Contenu Principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('_partials.footer')
    @yield('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Initialisation de Lucide -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>
