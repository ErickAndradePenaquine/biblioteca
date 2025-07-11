<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Livro</title>
</head>

<body>
@include('layouts.header')
    <h1>Editar Livro</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('info'))
        <div style="color: blue;">
            {{ session('info') }}
        </div>
    @endif

    <form action="{{ url('/updatelivros/' . $formedit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="titulo">Título:</label><br />
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $formedit->titulo) }}" required maxlength="50" />
        </p>

        <p>
            <label for="autor">Autor:</label><br />
            <input type="text" name="autor" id="autor" value="{{ old('autor', $formedit->autor) }}" required maxlength="50" />
        </p>

        <p>
            <label for="genero">Gênero:</label><br />
            <input type="text" name="genero" id="genero" value="{{ old('genero', $formedit->genero) }}" required maxlength="50" />
        </p>

        <p>
            <label for="ano_publicacao">Ano de Publicação:</label><br />
            <input type="text" name="ano_publicacao" id="ano_publicacao" value="{{ old('ano_publicacao', $formedit->ano_publicacao) }}" required maxlength="10" />
        </p>

        <p>
            <label for="quantidade_total">Quantidade Total:</label><br />
            <input type="number" name="quantidade_total" id="quantidade_total" value="{{ old('quantidade_total', $formedit->quantidade_total) }}" required />
        </p>

        <button type="submit">Atualizar Livro</button>
    </form>
</body>

</html>
