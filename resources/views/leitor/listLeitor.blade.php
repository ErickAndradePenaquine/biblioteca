<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Leitores</title>
</head>

<body>
    @include('layouts.header')

    <h1>Lista de Leitores</h1>
    <a href="{{ url('/formcreatemprestimo') }}" class="btn btn-editar"> + Novo Leitor </a><br><br>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($index as $leitor)
            <tr>
                <td>{{ $leitor->id }}</td>
                <td>{{ $leitor->nome }}</td>
                <td>{{ $leitor->cpf }}</td>
                <td>{{ $leitor->email }}</td>
                <td>{{ $leitor->telefone }}</td>
                <td>
                    <a href="{{ url('/formupdateleitor/' . $leitor->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ url('/deleteleitor/' . $leitor->id) }}" class="btn btn-excluir" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-excluir" onclick="return confirm('Deseja realmente excluir este leitor?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
