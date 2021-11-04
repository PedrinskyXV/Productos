<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'producto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['nombre', 'marca', 'precio', 'estado'];

    protected $validationRules = [
        'nombre' => 'required|alpha_numeric_space|min_length[2]|max_length[60]',
        'marca' => 'required|is_natural_no_zero|min_length[1]|max_length[12]',
        'precio' => 'required|decimal|min_length[1]|max_length[8]',
        'estado' => 'required|is_natural|min_length[1]|max_length[1]',
    ];
    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del producto es requerido',
            'alpha_numeric_space' => 'El formato del nombre del producto es incorrecto(No caracteres especiales).',
            'min_length' => 'El nombre del producto tiene que tener como minimo 2 caracteres.',
            'max_length' => 'El nombre del producto tiene que tener como maximo 60 caracteres.'
        ],
        'marca' => [
            'required' => 'La marca es requerida',
            'is_natural_no_zero' => 'El código de la marca es incorrecto.',
            'min_length' => 'El código de la marca tiene que tener como minimo 1 caracteres.',
            'max_length' => 'El código de la marca tiene que tener como maximo 12 caracteres.'
        ],
        'precio' => [
            'required' => 'El precio del producto es requerido.',
            'decimal' => 'El formato del precio del producto es incorrecto.(Valor decimal)',
            'min_length' => 'El precio tiene que tener como minimo 1 caracteres.',
            'max_length' => 'El precio tiene que tener como maximo 8 caracteres.'
        ],
        'estado' => [            
            'required' => 'El estado es requerido',
            'is_natural' => 'El valor del estado es incorrecto.',
            'min_length' => 'El estado tiene que tener como minimo 1 caracteres.',
            'max_length' => 'El estado tiene que tener como maximo 1 caracteres.'
        ],
    ];

    protected $skipValidation = false;

    public function listarProductos()
    {
        $builder = $this->db->table("producto as p");
        $builder->select('p.*, m.nombre as marca_nombre')->orderBy('p.codigo', 'ASC');
        $builder->join('marca as m', 'p.marca = m.codigo');
        return $builder->get()->getResult();
    }
}
