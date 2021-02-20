<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Http\Response;
use App\Http\Resources\ProdutoResource;
use App\Models\Atributo;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Produto;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProdutoResource::collection(Produto::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        try {
            $produto = new Produto;
            $produto->fill($request->validated())->save();

            return new ProdutoResource($produto);

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
        $produto = Produto::findOrfail($id);

        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $produto = Produto::find($id);
           $produto->fill($request->validated())->save();

           $produto->atributos()->detach();
           foreach($request->atributos as $atributoId){
                  $atributo = Atributo::find($atributoId['id']);
                  if($atributo){
                    $produto->atributos()->save($atributo);
                  }
           }



           return new ProdutoResource($produto);

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
        $produto = Produto::findOrfail($id);
        $produto->delete();

        return response()->json(null, 204);
    }
}
