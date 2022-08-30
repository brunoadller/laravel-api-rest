<?php

namespace App\Http\Controllers;
//SEMPRE INSTANCIAR A MODEL REFERENTE NO CONTROLLER
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //LISTA PRODUTOS
    public function index()
    {
        //traz todos os dados da tabela produtos
      return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //SALVA O PRODUTO NA TABELA
    public function store(Request $request)
    {   //VALIDANDO OS DADOS QUE SÃO OBRIGATORIOS
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);
        //retornado s dados para o banco
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //VERIFICA e MOSTRA PELO ID ESPECIFICO
    public function show($id)
    {
        //AQUI USA-SE O FIND QUE RECUERA UM MODELO POR SUA PRIMARY KEY
        //finorfail faz o mesmo que find mas retorn erro
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //SALVA A ATUALIZAÇÃO DO DADO
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json(["success" => true, "data"=> $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //IGUAL AO DELETE, REMOVE O DADO
    public function destroy($id)
    {
        if(Product::destroy($id) == 1){
            return response()->json(["success"=> true]);
        };
    }
    //FUNÇÃO PARA PESQUISAR POR NOME
    public function search($name){
        //BUSCANDO POR NOMES
        //WHERE FAZ A CONSULTA E GET TRAZ O RESULTADO
        //LIKE PARA ABRANGER MAIS NOMES
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
