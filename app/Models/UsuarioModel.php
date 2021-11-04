<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $table      = 'usuario';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['usuario', 'contrasena', 'rol', 'estado'];
}