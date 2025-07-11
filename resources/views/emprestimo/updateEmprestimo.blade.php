<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Empréstimo</title>
</head>
<body>
@include('layouts.header')

<h1>Editar Empréstimo</h1>

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

<form action="{{ url('/updatemprestimo/' . $formedit->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
    <label>Leitor:</label><br>
    <select name="leitor_id" required>
        @foreach($leitor as $l)
            <option value="{{ $l->id }}" {{ $l->id == old('leitor_id', $formedit->leitor_id) ? 'selected' : '' }}>
                {{ $l->nome }}
            </option>
        @endforeach
    </select>
</p>

<p>
    <label>Livro:</label><br>
    <select name="livro_id" required>
        @foreach($livros as $livro)
            <option value="{{ $livro->id }}" {{ $livro->id == old('livro_id', $formedit->livro_id) ? 'selected' : '' }}>
                {{ $livro->titulo }}
            </option>
        @endforeach
    </select>
</p>


    <p>
        <label>Data de Empréstimo:</label><br>
        <input type="date" name="data_emprestimo" value="{{ old('data_emprestimo', $formedit->data_emprestimo) }}" required>
    </p>

    <p>
        <label>Data Prevista de Devolução:</label><br>
        <input type="date" name="data_prevista_devolucao" value="{{ old('data_prevista_devolucao', $formedit->data_prevista_devolucao) }}" required>
    </p>

    <p>
        <label>Data de Devolução:</label><br>
        <input type="date" name="data_devolucao" value="{{ old('data_devolucao', $formedit->data_devolucao) }}">
    </p>

    <p>
        <label>Status:</label><br>
        <select name="status" required>
            <option value="ativo">Ativo</option>
            <option value="devolvido">Devolvido</option>
            <option value="atrasado">Atrasado</option>
        </select>
    </p>

    <button type="submit">Atualizar</button>
</form>
<script src="{{ asset('js/cpf.js') }}"></script>
</body>
</html>
