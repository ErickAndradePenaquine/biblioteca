<?php

namespace App\Http\Controllers;
use App\Models\LivrosModel;
use Illuminate\Http\Request;

class livrosController extends Controller
{
    public function index (){
        $index = LivrosModel::all();
        return view('dashboard', ['index' => $index]);
    }

    public function formcreate (){
        return view('/livros/createLivros');
    }

    public function store (Request $request){
        $request->validate([
            'titulo' => 'required|max:50',
            'autor' => 'required|max:50',
            'genero' => 'required|max:50',
            'ano_publicacao' => 'required|max:10',
            'quantidade_total' => 'required',  
        ]);

        LivrosModel::create($request->all());
        return redirect('/dashboard')->with('success', 'Livro criado com sucesso!');
    }

    public function formedit ($id){
        $formedit = LivrosModel::findOrFail($id);
        return view('livros.updateLivros', ['formedit' => $formedit]);
    }

    public function update (Request $request, $id){
        $request->validate([
            'titulo' => 'required|max:50',
            'autor' => 'required|max:50',
            'genero' => 'required|max:50',
            'ano_publicacao' => 'required|max:10',
            'quantidade_total' => 'required',  
        ]);

        $updateLivro = LivrosModel::findOrFail($id);
        $updateLivro->update($request->all());
        return redirect('dashboard')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy ($id){
        $destroyLivro = LivrosModel::findOrFail($id);
        $destroyLivro->delete();
        return redirect('dashboard')->with('success', 'Livro excluído com sucesso!');
    }
}
