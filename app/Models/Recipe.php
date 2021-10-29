<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $guarded = [];

    public function ingredient(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('count','id');
    }

    public function recipeStep(){
        return $this->hasMany(RecipeStep::class,"recipe_id","id");
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
