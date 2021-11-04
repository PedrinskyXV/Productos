<?php 

namespace App\Filters;

use CodeIgniter\Exceptions\PageNotAuthorized;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Router\Exceptions\RedirectException;

class AuthGuard implements FilterInterface
{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('estaLogeado'))
        {
            //$session = session();
            session()->setFlashdata('msg', 'Debe de iniciar sesion primero.');
            return redirect()
                ->to('/');
        }

        $rol = session()->get('rol');
        
        if (strcmp($rol, '1')) //1 es admin
        {
            session()->setFlashdata('msg', 'No esta autorizado.');                        
            return redirect()
                ->to('/401');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}