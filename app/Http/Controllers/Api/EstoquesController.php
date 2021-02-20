<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueRequest;
use Illuminate\Http\Response;
use App\Http\Resources\EstoqueResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Estoque;
use App\Models\ProdutoVariacao;

class EstoquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EstoqueResource::collection(Estoque::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstoqueRequest $request)
    {
        try {
            $estoque = new Estoque;
            $estoque->fill($request->validated());

            $produtoVariacao = ProdutoVariacao::find($request->produto_variacao['id']);
            $produtoVariacao->estoques()->save($estoque);
            

            return new EstoqueResource($estoque);

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
        $estoque = Estoque::findOrfail($id);

        return new EstoqueResource($estoque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstoqueRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $estoque = Estoque::find($id);
           $estoque->fill($request->validated());

           $produtoVariacao = ProdutoVariacao::find($request->produto_variacao['id']);
           $produtoVariacao->estoques()->save($estoque);

           return new EstoqueResource($estoque);

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
        $estoque = Estoque::findOrfail($id);
        $estoque->delete();

        return response()->json(null, 204);
    }
}
