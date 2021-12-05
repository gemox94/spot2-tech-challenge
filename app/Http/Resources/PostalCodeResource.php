<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostalCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'settlement' => $this->settlement,
            'settlement_type' => $this->settlement_type,
            'municipality' => $this->municipality,
            'city' => $this->city,
            'zone' => $this->zone,
            'state' => new StateResource($this->state)
        ];
    }
}
