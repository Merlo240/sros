<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cloaca extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'Nombre'=>$this->nombre,
            'Metros'=>$this->metros,
            'Ancho'=>$this->ancho,
            'color'=>$this->status->color,
            'hex' =>$this->status->Hex,
            'Estado'=>$this->status->name,
            'Tiempo'=>$this->created_at->diffForHumans(),
            'Fecha_Creacion'=>$this->created_at->toDateTimeString(),
            'Fecha_Modificacion'=>$this->updated_at->toDateTimeString(),
            ];
    }
}
