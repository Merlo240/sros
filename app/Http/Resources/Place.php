<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Place extends JsonResource
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
            // 'Barrio'=>$this->calle->barrios->name,
            // 'Calle'=>$this->calle->name,
            'Barrio'=>$this->barrio,
            'Calle'=>$this->calle,
            'Numeracion'=>$this->numeracion,
            'Largo'=>$this->largo,
            'Ancho'=>$this->ancho,
            'Mts'=>$this->mts,
            'color'=>$this->status->color,
            'Estado'=>$this->status->name,
            'Tiempo'=>$this->created_at->diffForHumans(),
            'Fecha_Creacion'=>$this->created_at->toDateTimeString(),
            'Fecha_Modificacion'=>$this->updated_at->toDateTimeString(),
            ];
    }
}
