<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Http\Requests\ProdutoVariacaoRequest;
use Illuminate\Http\Response;
use App\Http\Resources\ProdutoVariacaoResource;
use App\Models\Produto;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\ProdutoVariacao;

class ProdutoVariacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProdutoVariacaoResource::collection(ProdutoVariacao::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoVariacaoRequest $request)
    {
        try {
            $produtoVariacao = new ProdutoVariacao;
            $produtoVariacao->fill($request->validated());

            $produto = Produto::find($request->produto['id']);
            $produto->produtoVariacoes()->save($produtoVariacao);
            

            return new ProdutoVariacaoResource($produtoVariacao);

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtoVariacao = ProdutoVariacao::findOrfail($id);

        return new ProdutoVariacaoResource($produtoVariacao);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoVariacaoRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
            
           $produtoVariacao = ProdutoVariacao::find($id);
           $produtoVariacao->fill($request->validated());

           $produto = Produto::find($request->produto['id']);
           $produto->produtoVariacoes()->save($produtoVariacao);

           return new ProdutoVariacaoResource($produtoVariacao);

        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produtoVariacao = ProdutoVariacao::findOrfail($id);
        $produtoVariacao->delete();

        return response()->json(null, 204);
    }
}
