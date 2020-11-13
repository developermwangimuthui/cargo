<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LicensePlateColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { return [
        'id ' =>  $this->id,
        'license_plate_color' =>  $this->license_plate_colors,
    ];
    }
}
