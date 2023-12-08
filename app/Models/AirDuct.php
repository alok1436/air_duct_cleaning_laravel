<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirDuct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['num_furnace','square_footage_min','square_footage_max','furnace_loc_sidebyside','furnace_loc_different','final_price'];
}
