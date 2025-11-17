<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel PETI')</title>

    <!-- bootstrap via cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 600; }
        .card { border-radius: 8px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">

        <a class="navbar-brand" href="{{ route('dashboard') }}">Painel PETI</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPETI">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarPETI">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.index') }}">Projetos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('canvas.index') }}">Canvas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">Serviços</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('objectives.index') }}">Objetivos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('principles.index') }}">Princípios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('architecture.index') }}">Arquitetura</a>
                </li>

                <li class="nav-item mx-2">
                    <span class="navbar-text text-white-50">
                        Olá, {{ auth()->user()->name ?? 'Usuário' }}
                    </span>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-light">Sair</button>
                    </form>
                </li>

            </ul>
        </div>

    </div>
</nav>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
