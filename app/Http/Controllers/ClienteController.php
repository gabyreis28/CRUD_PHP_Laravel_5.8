<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private $clientes = [
        ['id' => 1, 'nome' => 'ademir'],
        ['id' => 2, 'nome' => 'joao'],
        ['id' => 3, 'nome' => 'maria'],
        ['id' => 4, 'nome' => 'aline']
    ];


    public function __construct(){
        $clientes = session('clientes'); //criando sessão

        if( !isset($clientes))
        session(['clientes' => $this->clientes]); //setar dados na array clientes
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //index:listar todos as informações
    public function index()
    {
        // $clientes = $this->clientes;
        $clientes = session('clientes'); //pegando da sessão
        // dd($clientes); debague
        return view('clientes.index', compact(['clientes']));   //chamando a view

        // ou return view('clientes.index', compact(['clientes' => $this->clientes]));

        // echo "<ol>";
        // foreach($this->clientes as $valor){
        //     echo "<li>" . $valor['nome'] . "</li>";
        // }
        // echo "</ol>";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //create: criar ou cadastrar uma nova informações
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store: salvar as informações
    public function store(Request $request)
    {
        $clientes = session('clientes'); //pegando da sessãos
        $id = count($clientes) +1; //pegar o prox. id da sessão
        $nome = $request->nome; //pegar o prox. nome
        $dados = [ "id" => $id, "nome" => $nome ]; // criar os dados na array
        $clientes[] = $dados;
        session(['clientes' => $clientes]); //seta dados na array e salva

        return redirect()->route('clientes.index'); //redirecionamento
        /*
        $id = count($this->clientes) +1; //pegar o prox. id
        $nome = $request->nome; //pegar o prox. nome
        $dados = [ "id" => $id, "nome" => $nome ]; // criar os dados na array
        $this->clientes[] = $dados;

        $clientes = $this->clientes;
        return view('clientes.index', compact(['clientes']));
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //show:visualizar informações
    public function show($id)
    {
        $clientes = session('clientes'); // recuperando todos os dados
        $cli = $clientes [ $id -1 ];  //recuperando os id('1') que esta na posição 0
        return view('clientes.info', compact(['cli'])); //passando as variaveis atraves do compact para a view,criando uma array e exibindo os dados


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //edit:editar informações
    public function edit($id)
    {
        $clientes = session('clientes'); // recuperando todos os dados
        $cli = $clientes [ $id -1 ];  //recuperando os id na posição 0
        return view('clientes.edit', compact(['cli']));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //update:atualizar informações
    public function update(Request $request, $id)
    {
        $clientes = session('clientes'); // recuperando todos os dados
        $cli = $clientes [ $id -1 ]['nome'] = $request->nome; //atualizando nome
        session(['clientes' => $clientes]); //seta dados na sessão e salvar

        return redirect()->route('clientes.index'); //redirecionamento
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //destroy:deletar informações
    public function destroy($id)
    {
        //
    }
}