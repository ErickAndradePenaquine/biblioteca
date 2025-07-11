<!DOCTYPE html>  
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Empréstimos</title>
</head>
<body>
@include('layouts.header')
    <h1>Lista de Empréstimos</h1>
    <a href="{{ url('/formcreatemprestimo') }}" class="btn btn-editar"> + Novo Empréstimo </a><br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Leitor</th>
                <th>Livro</th>
                <th>Data de Empréstimo</th>
                <th>Data Prevista de Devolução</th>
                <th>Data de Devolução</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($index as $emprestimo)
                @csrf
                <tr>
                    <td>{{ $emprestimo->id }}</td>
                    <td>{{ $emprestimo->leitor_id }}</td>
                    <td>{{ $emprestimo->livro_id }}</td>
                    <td>{{ $emprestimo->data_emprestimo }}</td>
                    <td>{{ $emprestimo->data_prevista_devolucao }}</td>
                    <td>{{ $emprestimo->data_devolucao }}</td>
                    <td>{{ $emprestimo->status }}</td>
                    <td>
                        <a href="{{ url('/formupdatemprestimo/' . $emprestimo->id) }}" class="btn btn-editar">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
