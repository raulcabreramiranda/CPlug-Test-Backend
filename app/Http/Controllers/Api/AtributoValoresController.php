<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtributoValorRequest;
use Illuminate\Http\Response;
use App\Http\Resources\AtributoValorResource;
use App\Models\Atributo;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\AtributoValor;

class AtributoValoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AtributoValorResource::collection(AtributoValor::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtributoValorRequest $request)
    {
        try {
            $atributoValor = new AtributoValor;
            $atributoValor->fill($request->validated());
            
            $atributo = Atributo::find($request->atributo['id']);
            $atributo->atributoValores()->save($atributoValor);

            return new AtributoValorResource($atributoValor);

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
        $atributoValor = AtributoValor::findOrfail($id);

        return new AtributoValorResource($atributoValor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtributoValorRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
            $atributoValor = AtributoValor::find($id);
            $atributoValor->fill($request->validated());

            $atributo = Atributo::find($request->atributo['id']);
            $atributo->atributoValores()->save($atributoValor);

           return new AtributoValorResource($atributoValor);

        } catch(\Exception $exception) {

            echo "Invalid data - {$exception->getMessage()}";
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
        $atributoValor = AtributoValor::findOrfail($id);
        $atributoValor->delete();

        return response()->json(null, 204);
    }
}
