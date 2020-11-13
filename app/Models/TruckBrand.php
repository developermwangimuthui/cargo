<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\Traits\UsesUUID;
use App\Models\TruckModel;
class TruckBrand extends Model
{

    use HasFactory, SoftDeletes, CascadeSoftDeletes,UsesUUID;
    public function TruckModel(){
        return $this->hasMany(TruckModel::class);
            }
}
