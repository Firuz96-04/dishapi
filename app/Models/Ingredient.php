<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['name','unit','icon'];

    public function recipe() {
        return $this->belongsToMany(Recipe::class,"ingredient_recipe","ingredient_id","recipe_id");

    }
}
