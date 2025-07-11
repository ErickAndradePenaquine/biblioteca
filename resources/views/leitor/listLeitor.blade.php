<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Leitores</title>
    <style>
        body {
            background-color: #ccd0ed;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        .btn {
            padding: 5px 12px;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 0.9em;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            line-height: 1;
            margin-right: 5px;
        }

        .btn-editar {
            background-color: #4CAF50;
        }

        .btn-editar:hover {
            background-color: #45a049;
        }

        .btn-excluir {
            background-color: #e53935;
        }

        .btn-excluir:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <h1>Lista de Leitores</h1>

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
                    <form action="{{ url('/deleteleitor/' . $leitor->id) }}" method="POST" style="display:inline">
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
