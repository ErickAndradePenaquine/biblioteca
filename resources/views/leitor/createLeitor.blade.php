<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Leitor</title>
</head>
<body>
@include('layouts.header')

<h1>Cadastrar Leitor</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if(session('info'))
    <div style="color: blue;">
        {{ session('info') }}
    </div>
@endif

<form action="{{ url('/createleitor') }}" method="POST">
    @csrf

    <p>
        <label>Nome:</label><br>
        <input type="text" name="nome" value="{{ old('nome') }}" required>
    </p>

    <p>
        <label>CPF:</label><br>
        <input type="text" name="cpf" value="{{ old('cpf') }}" required>
    </p>

    <p>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </p>

    <p>
        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="{{ old('telefone') }}" required>
    </p>

    <button type="submit">Cadastrar</button>
</form>
<script src="{{ asset('js/cpf.js') }}"></script>
</body>
</html>
