<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=[
        'nom',
        'demande_id'
    ];
    use HasFactory;

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
