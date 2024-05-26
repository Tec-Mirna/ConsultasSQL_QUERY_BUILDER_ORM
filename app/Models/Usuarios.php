<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedidos;

class Usuarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'phone'
    ];

    // Indica relación entre tablas
    public function pedidos()
    { // el método hasMany  define una relación uno a muchos.
        return $this->hasMany(Pedidos::class, 'user_id'); //hasMany  Un usuario puede tener muchos pedidos
    }
}
