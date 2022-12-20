<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    use HasFactory;


    public function categoryName(){
		return $this->hasOne('App\Models\Category','id','category_id');
	}

}
