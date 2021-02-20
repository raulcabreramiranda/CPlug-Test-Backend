<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtributoRequest;
use Illuminate\Http\Response;
use App\Http\Resources\AtributoResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Atributo;

class AtributosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AtributoResource::collection(Atributo::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtributoRequest $request)
    {
        try {
            $atributo = new Atributo;
            $atributo->fill($request->validated())->save();

            return new AtributoResource($atributo);

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
        $atributo = Atributo::findOrfail($id);

        return new AtributoResource($atributo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AtributoRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $atributo = Atributo::find($id);
           $atributo->fill($request->validated())->save();

           return new AtributoResource($atributo);

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
        $atributo = Atributo::findOrfail($id);
        $atributo->delete();

        return response()->json(null, 204);
    }
}
