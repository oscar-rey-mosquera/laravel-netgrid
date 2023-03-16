<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_name',
        'character_id',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
}
