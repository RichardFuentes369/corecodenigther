<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\{
    UserModel,
    AdminModel
};

use function PHPUnit\Framework\isEmpty;

class Usuarios extends BaseController
{
    use ResponseTrait;

    public function __construct(Type $var = null) {
        $this->adminModel = new \App\Models\AdminModel();
        $this->userModel = new \App\Models\UserModel();
    }
     
    public function users()
    {
        $page = $this->request->getVar('page');
        $limit = $this->request->getVar('limit');
        $field = $this->request->getVar('field');
        $order = $this->request->getVar('order');
    
        $start = ($page == 1) ? 0 : ($page - 1) * $limit;
        $back = ($page == 1) ? null : ($page - 2) * $limit;
        $next = ($page * $limit);
        
        $data = [
            'result' => $this->paginacionConsulta("user", $start, $field, $order, $limit),
            'pagination' =>[
                'page' => $page,
                'perPage' => $limit,
                'previou' => ($back === null) ? null : strval($page - 1),
                'next' => (count($this->paginacionConsulta("user", $next, $field, $order, $limit)) > 0) ? strval($page + 1) :  null
            ],
            'order' => [
                "order"=> $order,
                "field"=> $field
            ]
        ];
        
        return $this->respond([$data], 200);
    }

    public function admins()
    {
        $page = $this->request->getVar('page');
        $limit = $this->request->getVar('limit');
        $field = $this->request->getVar('field');
        $order = $this->request->getVar('order');
    
        $start = ($page == 1) ? 0 : ($page - 1) * $limit;
        $back = ($page == 1) ? null : ($page - 2) * $limit;
        $next = ($page * $limit);
        
        $data = [
            'result' => $this->paginacionConsulta("admin", $start, $field, $order, $limit),
            'pagination' =>[
                'page' => $page,
                'perPage' => $limit,
                'previou' => ($back === null) ? null : strval($page - 1),
                'next' => (count($this->paginacionConsulta("admin", $next, $field, $order, $limit)) > 0) ? strval($page + 1) :  null
            ],
            'order' => [
                "order"=> $order,
                "field"=> $field
            ]
        ];
        
        return $this->respond([$data], 200);
    }

    public function user($id)
    {
        $data = $this->userModel->find($id);
        return $this->respond([$data], 200);
    }

    public function admin($id)
    {
        $data = $this->adminModel->find($id);
        return $this->respond([$data], 200);
    }
    
}