<?php

namespace App\Service;

use App\Models\Usuario;

class UsuarioService
{
    public function create(array $dados)
    {
        $user = Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'password' => $dados['password']
        ]);

        return $user;
    }


    public function update(array $dados){
    $usuario =Usuario::find($dados['id']);
    if ($usuario == null){
        return [
            'status'=>false,
            'message'=>'Usuario nao encontrado'
        ];
    } 
    if(isset($dados['password'])){
        $usuario->password = $dados['password'];
        }
        if(isset($dados['nome'])){
        $usuario->nome = $dados['nome'];
        }
      if(isset($dados['email'])){
        $usuario->email = $dados['email']; 
      }

       $usuario->save();
       
       return[
        'status' =>true,
        'message'=>'Atualizado com sucesso'
       ];

    }


    public function delete($id){
    $usuario = Usuario::find($id);
    if($usuario == null){
        return [
            'status' =>false,
            'message' => 'Usuario nao encontrado'
        ];
    }
    $usuario->delete();
    return[
        'status'=>true,
        'message'=> 'Usuario excluido com sucesso'
    ];
    }

    public function findByld($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario == null) {
            return [
                'status' => 'false',
                'message' => 'usuario não encontrado'
            ];
        }

        return [
            'status' => 'true',
            'message' => 'usuario encontrado',
            'data' => $usuario
        ];
    }

    public function getAll()
    {
        $usuario = Usuario::all();
        return [
            'status' => true,
            'message' => 'pesquisa efetuada com secesso',
            'data' => $usuario

        ];
    }

    public function searchByName($nome)
    {
        $usuario = Usuario::where('nome', 'like', '%' . $nome . '%')->get();
        if ($usuario->isEmpty()) {
            return [
                'status' => false,
                'message' => 'sem resultado'
            ];

            return [
                'status' => true,
                'message' => 'resultado encontrado',
                'data' => $usuario
            ];
        }
    }

    public function searchByEmail($Email)
    {
        $usuario = Usuario::where('Email', 'like', '%' . $Email . '%')->get();
        if ($usuario->isEmpty()) {
            return [
                'status' => false,
                'message' => 'sem resultado'
            ];
        }
        return [
            'status' => true,
            'message' => 'resultado encontrado',
            'data' => $usuario
        ];
    }
}
