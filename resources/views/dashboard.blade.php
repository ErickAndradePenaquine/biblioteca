<!DOCTYPE html>  
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Livros</title>
</head>
<body>
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
@include('layouts.header')
    <h1>Lista de Livros</h1>
    <a href="{{ url('/formcreatelivros') }}" class="btn btn-editar"> + Novo Livro </a><br><br>

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
                        <form action="{{ url('/deletelivros/' . $livro->id) }}" class="btn btn-excluir" method="POST" style="display:inline">
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
