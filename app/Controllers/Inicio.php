<?php 
namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Inicio extends Controller{

    private $db;

    public function __construct()
    {
        $this->db = db_connect();                
    }

    public function Login()
    {
        
        $datos['titulo'] = ucfirst('Login');
        $datos['header'] = view('template/header', $datos);
        $datos['footer'] = view('template/footer');        
        return view('inicio/login', $datos);
        
    }

    public function Index()
    {
        $session = session();

        $builder = $this->db->table("producto as p");
        $builder->select('p.*, m.nombre as marca_nombre')->orderBy('p.codigo', 'ASC');
        $builder->join('marca as m', 'p.marca = m.codigo');
        $data = $builder->get()->getResult();

        $datos['productos'] = (array) $data;
        
        $builder = $this->db->table("producto as p");
        $builder->select('COUNT(p.codigo) AS n, m.nombre AS marca');
        $builder->join('marca as m', 'p.marca = m.codigo');
        $builder->groupBy('p.marca');
        
        $data = $builder->get()->getResult();

        $marcas =[];

        foreach($data as $row){
            $marcas[] = array(
                'marca' => $row->marca,
                'cantidad' => $row->n
            );
        }

        $datos['marcas'] = ($marcas);
        $datos['titulo'] = ucfirst('Bienvenido');
        $datos['header'] = view('template/header', $datos);
        $datos['footer'] = view('template/footer');
        $datos['usuario'] = $session->get('usuario');
        $datos['menu'] = view('template/menu', $datos);
        $datos['session'] = $session->get();
        $datos['mostrarProducto'] = view('producto/template/mostrarProducto', $datos);
        return view('inicio/index', $datos);
    }

    public function autentificar()
    {
        $session = session();

        $usuarioModel = new UsuarioModel();

        $usuario = $this->request->getVar('usuario');
        $clave = $this->request->getVar('clave');

        $verificar = $usuarioModel->where('usuario', $usuario)->first();

        if($verificar)
        {
            $contrasena = $verificar['contrasena'];
            
            if($clave === $contrasena)
            {
                $session_usuario = [
                    'usuario' => $verificar['usuario'],
                    'rol' => $verificar['rol'],
                    'estaLogeado' => TRUE
                ];

                $session->set($session_usuario);
                return redirect()->to('admin/index');
            }
            else
            {
                $session->setFlashdata('msg', 'La contraseña es incorrecta.');
                return redirect()->to('/');
            }
        }
        else
        {
            $session->setFlashdata('msg', 'El usuario es incorrecta o no existe.');
                return redirect()->to('/');
        }
    }

    public function logout(){        
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
    
    public function NoAuth()
    {
        return view('errors/html/error_401');
    }
}