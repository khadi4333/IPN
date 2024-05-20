<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CatalogueProduit;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [

    ];

    public function catalogueProduits(){
        return $this->hasMany(CatelogueProduit::class,'idCategorie');
    }
}
