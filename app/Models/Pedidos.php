<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product', 
        'quantity', 
        'total'
    ];

    // indica relación  de tablas, cada pedido pertenece a un usuario
    public function usuario()
    { //belongsTo relación inversa
        return $this->belongsTo(Usuarios::class, 'user_id');
    }
}
