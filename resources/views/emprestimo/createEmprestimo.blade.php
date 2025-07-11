<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Emprestimo</title>
</head>
<body>
@include('layouts.header')

<h1>Cadastrar Emprestimo</h1>

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

<form action="{{ url('/createmprestimo') }}" method="POST">
    @csrf

    <select name="leitor_id" required>
        <option value="">Selecione um leitor</option>
        @foreach ($leitor as $leitor)
            <option value="{{ $leitor->id }}">{{ $leitor->nome }}</option>
        @endforeach
    </select>

    <select name="livro_id" required>
        <option value="">Selecione um livro</option>
        @foreach ($livros as $livro)
            <option value="{{ $livro->id }}">{{ $livro->titulo }}</option>
        @endforeach
    </select>

    <p>
        <label>Data de Empréstimo:</label><br>
        <input type="date" name="data_emprestimo" value="{{ old('data_emprestimo') }}" required>
    </p>

    <p>
        <label>Data Prevista de Devolução:</label><br>
        <input type="date" name="data_prevista_devolucao" value="{{ old('data_prevista_devolucao') }}" required>
    </p>

    <p>
        <label>Data de Devolução:</label><br>
        <input type="date" name="data_devolucao" value="{{ old('data_devolucao') }}">
    </p>

    <p>
        <label>Status:</label><br>
        <select name="status" required>
            <option value="ativo">Ativo</option>
            <option value="devolvido">Devolvido</option>
            <option value="atrasado">Atrasado</option>
        </select>
    </p>

    <button type="submit">Cadastrar</button>
</form>
<script src="{{ asset('js/cpf.js') }}"></script>
</body>
</html>
