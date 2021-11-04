<?php
namespace App\Controllers;

use App\Models\MarcaModel;
use CodeIgniter\Controller;

class Marca extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = session(); //session_start();
    }

    public function index()
    {
        $datos['titulo'] = ucfirst('Marcas');
        $datos['header'] = view('template/header', $datos);
        $datos['menu'] = view('template/menu');

        $marcas = new MarcaModel();
        $datos['marcas'] = $marcas->findAll();

        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');

        return view("marca/index", $datos);
    }

    public function agregar()
    {
        $datos['titulo'] = ucfirst('Agregar marca');
        $datos['header'] = view('template/header', $datos);
        $datos['menu'] = view('template/menu');
        $datos['footer'] = view('template/footer');

        return view("marca/agregar", $datos);
    }

    public function insertar()
    {
        if ($_POST) {
            $validar = $this->validate([
                'nombre' => 'required|alpha_numeric_space|min_length[2]|max_length[100]',
            ],
                [
                    'nombre' => [
                        'required' => 'El nombre de la marca es requerido.',
                        'alpha_numeric_space' => 'El formato del nombre de la marca es incorrecto(No caracteres especiales).',
                        'min_length' => 'El nombre de la marca tiene que tener como minimo 3 caracteres.',
                        'max_length' => 'El nombre de la marca tiene que tener como maximo 100 caracteres.',
                    ],
                ]);

            if ($validar) {
                $marca = new MarcaModel();

                $datos = [
                    'nombre' => $this->request->getVar('nombre'),
                    'estado' => 1,
                ];

                if ($marca->insert($datos)) {
                    $this->session->setFlashdata('alert', [
                        'msg' => 'Marca agregado con exito.',
                        'icon' => 'success',
                    ]);

                    return $this->response->redirect(site_url('admin/marca/index'));

                } else {
                    $this->session->setFlashdata('alert', [
                        'msg' => 'Marca no pudo ser agregado.',
                        'icon' => 'error',
                    ]);
                }
            }
        }

        return redirect()->back()->withInput()->with('errores', $this->validator);
    }

    public function editar($id = 0)
    {
        $datos['titulo'] = ucfirst('Editar marca');
        $datos['header'] = view('template/header', $datos);
        $datos['menu'] = view('template/menu');

        $marca = new MarcaModel();

        $datos['marca'] = $marca->where('codigo', $id)->first();

        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');

        return view("marca/editar", $datos);
    }

    public function eliminar($id = 0)
    {
        $marca = new MarcaModel();

        if ($marca->where('codigo', $id)->delete($id)) {
            $this->session->setFlashdata('alert', [
                'msg' => 'Marca eliminada con exito.',
                'icon' => 'success',
            ]);
            return $this->response->redirect(site_url('admin/marca/index'));
        } else {
            $this->session->setFlashdata('alert', [
                'msg' => 'Marca no se elimino.',
                'icon' => 'error',
            ]);
            return redirect()->back();
        }

    }

    public function modificar()
    {
        if ($_POST) {

            $validar = $this->validate([
                'nombre' => 'required|alpha_numeric_space|min_length[2]|max_length[100]',
            ],
                [
                    'nombre' => [
                        'required' => 'El nombre de la marca es requerido.',
                        'alpha_numeric_space' => 'El formato del nombre de la marca es incorrecto(No caracteres especiales).',
                        'min_length' => 'El nombre de la marca tiene que tener como minimo 3 caracteres.',
                        'max_length' => 'El nombre de la marca tiene que tener como maximo 100 caracteres.',
                    ],
                ]);

            if ($validar) {
                $marca = new MarcaModel();
                $id = $this->request->getVar('codigo');
                $datos = [
                    'nombre' => $this->request->getVar('nombre'),
                ];
                if ($marca->update($id, $datos)) {
                    $this->session->setFlashdata('alert', [
                        'msg' => 'Marca modificado con exito.',
                        'icon' => 'success',
                    ]);
                    return $this->response->redirect(site_url('admin/marca/index'));
                } else {
                    $this->session->setFlashdata('alert', [
                        'msg' => 'Marca no pudo ser modificado.',
                        'icon' => 'error',
                    ]);
                }
            }
        }

        return redirect()->back()->withInput()->with('errores', $this->validator);
    }

    public function darDeBaja($id = 0)
    {
        $marca = new marcaModel();
        $datos = [
            'estado' => 0,
        ];

        if ($marca->update($id, $datos)) {
            $this->session->setFlashdata('alert', [
                'msg' => 'La marca fue dada de baja.',
                'icon' => 'success',
            ]);
            return $this->response->redirect(site_url('admin/marca/index'));
        } else {
            $this->session->setFlashdata('alert', [
                'msg' => 'La marca no fue dada de baja.',
                'icon' => 'error',
            ]);
            return redirect()->back();
        }
    }

    public function darDeAlta($id = 0)
    {
        $marca = new marcaModel();
        $datos = [
            'estado' => 1,
        ];

        if ($marca->update($id, $datos)) {
            $this->session->setFlashdata('alert', [
                'msg' => 'La marca fue dada de alta.',
                'icon' => 'success',
            ]);
            return $this->response->redirect(site_url('admin/marca/index'));
        } else {
            $this->session->setFlashdata('alert', [
                'msg' => 'La marca no fue dada de alta.',
                'icon' => 'error',
            ]);
            return redirect()->back();
        }

    }
}
