<?php
namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Producto extends Controller
{
    private $db;
    private $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = session();
    }

    public function index()
    {
        $datos['titulo'] = ucfirst('Productos');
        $datos['header'] = view('template/header', $datos);
        $datos['usuario'] = session()->get('usuario');
        $datos['menu'] = view('template/menu', $datos);

        $producto = new ProductoModel();
        $datos['productos'] = $producto->listarProductos();
        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');
        $datos['mostrarProducto'] = view('producto/template/mostrarProducto', $datos);

        return view("producto/index", $datos);
    }

    public function agregar()
    {
        $datos['titulo'] = ucfirst('Agregar Producto');
        $datos['header'] = view('template/header', $datos);
        $datos['usuario'] = session()->get('usuario');
        $datos['menu'] = view('template/menu', $datos);

        $builder = $this->db->table("marca as m");
        $builder->select('m.*');
        $data = $builder->get()->getResult();
        $datos['marcas'] = (array) $data;
        $datos['footer'] = view('template/footer');

        return view("producto/agregar", $datos);
    }

    public function insertar()
    {
        if ($_POST) {
            $producto = new ProductoModel();

            $datos = [
                'nombre' => $this->request->getVar('nombre'),
                'marca' => $this->request->getVar('marca'),
                'precio' => $this->request->getVar('precio'),
                'estado' => 1,
            ];

            if ($producto->insert($datos)) {
                $this->session->setFlashdata('alert', [
                    'msg' => 'Producto agregado con exito.',
                    'icon' => 'success',
                ]);

                return $this->response->redirect(site_url('admin/producto/index'));
            } else {
                $this->session->setFlashdata('alert', [
                    'msg' => 'Producto no pudo ser agregado.',
                    'icon' => 'error',
                ]);
            }
        }

        return redirect()->back()->withInput()->with('errores', $producto->errors());
    }

    public function editar($id = 0)
    {
        $datos['titulo'] = ucfirst('Editar Producto');
        $datos['header'] = view('template/header', $datos);
        $datos['usuario'] = session()->get('usuario');
        $datos['menu'] = view('template/menu', $datos);

        $producto = new ProductoModel();
        $builder = $this->db->table("marca as m");
        $builder->select('m.*');
        $data = $builder->get()->getResult();
        $datos['marcas'] = (array) $data;

        $datos['producto'] = $producto->where('codigo', $id)->first();

        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');

        return view("producto/editar", $datos);
    }

    public function eliminar($id = 0)
    {
        $producto = new ProductoModel();
        //$datos = $producto->where('codigo', $id)->first();
        $producto->where('codigo', $id)->delete($id);

        return $this->response->redirect(site_url('admin/producto/index'));
    }

    public function modificar()
    {
        if ($_POST) {
            $producto = new ProductoModel();
            $id = $this->request->getVar('codigo');
            $datos = [
                'nombre' => $this->request->getVar('nombre'),
                'marca' => $this->request->getVar('marca'),
                'precio' => $this->request->getVar('precio'),
                'estado' => $this->request->getVar('estado'),
            ];
            if ($producto->update($id, $datos)) {
                $this->session->setFlashdata('alert', [
                    'msg' => 'Producto modificado con exito.',
                    'icon' => 'success',
                ]);
                return $this->response->redirect(site_url('admin/producto/index'));
            } else {
                $this->session->setFlashdata('alert', [
                    'msg' => 'Producto no pudo ser modificado.',
                    'icon' => 'error',
                ]);
            }
        }

        return redirect()->back()->withInput()->with('errores', $producto->errors());
    }

    public function darDeBaja($id = 0)
    {
        $producto = new ProductoModel();
        $datos = [
            'estado' => 0,
        ];

        if ($producto->update($id, $datos)) {
            $this->session->setFlashdata('alert', [
                'msg' => 'El producto fue dado de baja.',
                'icon' => 'success',
            ]);
            return $this->response->redirect(site_url('admin/producto/index'));
        } else {
            $this->session->setFlashdata('alert', [
                'msg' => 'El producto no fue dado de baja.',
                'icon' => 'error',
            ]);
            return redirect()->back();
        }
    }

    public function darDeAlta($id = 0)
    {
        $producto = new ProductoModel();
        $datos = [
            'estado' => 1,
        ];

        if ($producto->update($id, $datos)) {
            $this->session->setFlashdata('alert', [
                'msg' => 'El producto fue dado de alta.',
                'icon' => 'success',
            ]);
            return $this->response->redirect(site_url('admin/producto/index'));
        } else {
            $this->session->setFlashdata('alert', [
                'msg' => 'El producto no fue dado de alta.',
                'icon' => 'error',
            ]);
            return redirect()->back();
        }

    }
}
