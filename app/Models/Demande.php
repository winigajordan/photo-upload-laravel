<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{

    use HasFactory;
    protected $fillable=[
      'nom',
        'prenom',
        'email',
        'telephone',
        'date_location',
        'etat',
        'slug'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
