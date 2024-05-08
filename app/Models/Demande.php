<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable=[
      'nom',
        'prenom',
        'email',
        'telephone',
        'date_location',
        'etat',
        'slug'
    ];
    use HasFactory;

}
