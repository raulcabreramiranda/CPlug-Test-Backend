<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstoqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
            $this->produtoVariacao->atributoValores;
            $this->produtoVariacao->produto;
        return [
            'id' => $this->id,
            'quantidade' => $this->quantidade,
            'tipo_movimento' => $this->tipo_movimento,
            'data' => $this->created_at,
            'produto_variacao' => $this->produtoVariacao,
        ];
    }
}
