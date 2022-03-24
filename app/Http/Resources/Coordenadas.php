<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Coordenadas extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // foreach (explode(',',$request->coordenadas) as $info) {
        //    return $info;
        // } 
        $lista = explode(',',$this->coordenadas);
        $listas =array_chunk($lista,2);
        
                return 
          $listas
            ;
        
           
        

        
    }
    }
