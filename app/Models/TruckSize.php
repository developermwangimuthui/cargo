<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use App\Traits\UsesUUID;
class TruckSize extends Model
{

    use HasFactory, SoftDeletes, CascadeSoftDeletes,UsesUUID;
}
