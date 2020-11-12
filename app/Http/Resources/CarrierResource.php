<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarrierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' =>  $this->name,
            'email ' =>  $this->email,
            'profile_pic' =>  url('CarrierProfilePics', $this->profile_pic),
            'id_front' =>  url('CarrierIDs', $this->id_front),
            'id_back' =>  url('CarrierIDs', $this->id_back),
            'national_id' =>  $this->national_id,
            'collected_points' =>  $this->collected_points,
            'coupon' =>  $this->coupon,
            'created_at' =>  $this->created_at->format('d M, yy'),
            'token' =>  $this->createToken('token')->accessToken
        ];
    }
}
