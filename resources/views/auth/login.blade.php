{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Entrar')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h4 class="mb-3">Entrar</h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Lembrar-me</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
