<?php

namespace App\Http\Controllers;

use App\Models\EmprestimoModel;
use App\Models\LeitorModel;
use App\Models\LivrosModel;
use Illuminate\Http\Request;

class emprestimoController extends Controller
{
    public function index()
    {
        $index = EmprestimoModel::all();
        return view('emprestimo.listEmprestimo', ['index' => $index]);
    }

    public function formcreate()
    {
        $leitor = LeitorModel::all();
        $livros = LivrosModel::all();
        return view('emprestimo.createEmprestimo', ['leitor' => $leitor, 'livros' => $livros]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'leitor_id' => 'required',
            'livro_id' => 'required',
            'data_emprestimo' => 'required|date',
            'data_prevista_devolucao' => 'required|date',
            'data_devolucao' => 'nullable|date',
            'status' => 'required|in:ativo,devolvido,atrasado',
        ]);

        $contadorLeitor = EmprestimoModel::where('leitor_id', $request->leitor_id)
            ->where('status', 'ativo')
            ->count();

        if ($contadorLeitor >= 3) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['leitor_id' => 'Este leitor já possui o máximo de emprestimos ativos'])
                ->with('info', 'Por favor, verifique os emprestimos deste leitor.')
                ->with([]);
        }

        $livro = LivrosModel::findOrFail($request->livro_id);

        $contadorEmprestimo = EmprestimoModel::where('livro_id', $request->livro_id)
            ->where('status', 'ativo')
            ->count();

        if ($request->status === 'ativo' && $contadorEmprestimo >= $livro->quantidade_total) {
            return redirect()
                ->back()
                ->withErrors(['livro_id' => 'Não há exemplares disponíveis deste livro para empréstimo.'])
                ->withInput();
        }
        EmprestimoModel::create($request->all());
        return redirect('/listaremprestimo')->with('success', 'Empréstimo criado com sucesso!');
    }

    public function formedit($id)
    {
        $formedit = EmprestimoModel::with(['leitor', 'livro'])->findOrFail($id);
        $leitor = LeitorModel::all();
        $livros = LivrosModel::all();
        return view('emprestimo.updateEmprestimo', ['formedit' => $formedit, 'leitor' => $leitor, 'livros' => $livros]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'leitor_id' => 'required',
            'livro_id' => 'required',
            'data_emprestimo' => 'required|date',
            'data_prevista_devolucao' => 'required|date',
            'data_devolucao' => 'nullable|date',
            'status' => 'required|in:ativo,devolvido,atrasado',
        ]);

        $contadorLeitor = EmprestimoModel::where('leitor_id', $request->leitor_id)
            ->where('status', 'ativo')
            ->where('id', '!=', $id)
            ->count();

        if ($request->status === 'ativo' && $contadorLeitor >= 3) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['leitor_id' => 'Este leitor já possui o máximo de emprestimos ativos'])
                ->with('info', 'Por favor, verifique os emprestimos deste leitor.')
                ->with([]);
        }

        $livro = LivrosModel::findOrFail($request->livro_id);

        $contadorEmprestimo = EmprestimoModel::where('livro_id', $request->livro_id)
            ->where('status', 'ativo')
            ->where('id', '!=', $id)
            ->count();

        if ($request->status === 'ativo' && $contadorEmprestimo >= $livro->quantidade_total) {
            return redirect()
                ->back()
                ->withErrors(['livro_id' => 'Não há exemplares disponíveis deste livro para empréstimo.'])
                ->withInput();
        }

        $updateEmprestimo = EmprestimoModel::findOrFail($id);
        $updateEmprestimo->update($request->all());
        return redirect('/listaremprestimo')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $deleteEmprestimo = EmprestimoModel::findOrFail($id);
        $deleteEmprestimo->delete();
        return redirect('/listEmprestimo')->with('success', 'Empréstimo deletado com sucesso!');
    }
}
