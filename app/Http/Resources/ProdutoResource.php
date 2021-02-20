<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $produtoVariacoes = array();

        foreach ($this->produtoVariacoes as $pv){
            $pv->atributoValores;
            $produtoVariacoes[] = $pv;
        }
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'codigo' => $this->codigo,
            'preco' => $this->preco,
            'produto_variacoes' => $produtoVariacoes,
            'atributos' => $this->atributos,
        ];
    }
}
