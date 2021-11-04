<?php 
namespace App\Models;

use CodeIgniter\Model;

class MarcaModel extends Model{
    protected $table      = 'marca';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['nombre', 'estado'];
}