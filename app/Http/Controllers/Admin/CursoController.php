<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
class CursoController extends Controller
{
    public function index(){
        $rows = Curso::all();

        return view('admin.cursos.index', compact('rows'));
    }

    public function adicionar(){
        return view('admin.cursos.adicionar');
    }

    public function salvar(Request $request){
       $dados = $request->all();
        
        if($request->hasFile('arquivo')){
            $imagem = $request->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/cursos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem'] = $dir.$nomeImagem;
        }
        Curso::create($dados);
        return redirect()->route('admin.cursos');
    }

    public function editar($id){
        $row = Curso::find($id);
        return view('admin.cursos.editar', compact('row'));
    }

    public function atualizar(Request $request, $id){
        $dados = $request->all();
        
        if($request->hasFile('arquivo')){
            $imagem = $request->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/cursos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem'] = $dir.$nomeImagem;
        }
        Curso::find($id)->update($dados);
        return redirect()->route('admin.cursos');
    } 

    public function excluir($id){
        Curso::find($id)->delete();
        return redirect()->route('admin.cursos');
    }
}
