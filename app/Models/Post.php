<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion', 
        'imagen',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']); // le pongo en el select lo que quiero extraer
    }

    public function comentarios() // un post tiene múltiples comentarios
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user) 
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
