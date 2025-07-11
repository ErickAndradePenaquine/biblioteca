<!DOCTYPE html>  
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Livros</title>
    <style>
        body {
            background-color: #ccd0ed;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
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
    <h1>Lista de Livros</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano de Publicação</th>
                <th>Quantidade Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($index as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->autor }}</td>
                    <td>{{ $livro->genero }}</td>
                    <td>{{ $livro->ano_publicacao }}</td>
                    <td>{{ $livro->quantidade_total }}</td>
                    <td>
                        <a href="{{ url('/formupdatelivros/' . $livro->id) }}" class="btn btn-editar">Editar</a>
                        <form action="{{ url('/deletelivros/' . $livro->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-excluir" onclick="return confirm('Deseja realmente excluir este livro?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
