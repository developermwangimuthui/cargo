<?php

namespace App\Models;

use App\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class PasswordReseting extends Model
{
    use HasFactory, SoftDeletes,UsesUUID;
    protected $table = 'password_resets';

}
