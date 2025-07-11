<?php

namespace App\Http\Controllers;

use App\Models\LeitorModel;
use Illuminate\Http\Request;

class leitorController extends Controller
{
    public function index (){
        $index = LeitorModel::all();
        return view('leitor.listLeitor', ['index' => $index]);
    }

    public function formcreate (){
        return view('/leitor/createLeitor');
    }

    public function store (Request $request){
        $request->validate([
            'nome' => 'required|max:50',
            'cpf' => ['required','regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/'],
            'email' => 'required|email|unique:leitor,email',
            'telefone' => 'required|max:20',
        ]);

        LeitorModel::create($request->all());
        return redirect('/listleitor')->with('success', 'Leitor criado com sucesso!');
    }

    public function formedit ($id){
        $formedit = LeitorModel::findOrFail($id);
        return view('leitor.updateLeitor', ['formedit' => $formedit]);
    }

    public function update (Request $request, $id){
        $request->validate([
            'nome' => 'required|max:50',
            'cpf' => ['required','regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/'],
            'email' => 'required|email|unique:leitor,email,' . $id,
            'telefone' => 'required|max:20',
        ]);

        $updateLeitor = LeitorModel::findOrFail($id);
        $updateLeitor->update($request->all());
        return redirect('/listleitor')->with('success', 'Leitor atualizado com sucesso!');
    }

    public function destroy ($id){
        $destroyLeitor = LeitorModel::findOrFail($id);
        $destroyLeitor->delete();
        return redirect('/listleitor')->with('success', 'Leitor excluído com sucesso!');
    }
}
