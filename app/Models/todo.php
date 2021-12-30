<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    use HasFactory;


   protected $table = "todo";

   protected $fillable = ['title','description','added_by','startdate','enddate','updated_at','created_at','image'];

  // public $timestamps = false ;

}
