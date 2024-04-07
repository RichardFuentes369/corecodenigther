<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\{
    UserModel,
    AdminModel
};
 
 
class Register extends BaseController
{
    use ResponseTrait;
 
    public function admin()
    {
        $rules = [
            'firstName' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'lastName' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[admin.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]'],
            'isActive' => ['rules' => 'required|numeric|in_list[0,1]'],
        ];
  
        if($this->validate($rules)){
            $model = new AdminModel();
            $data = [
                'firstName'    => $this->request->getVar('firstName'),
                'lastName'    => $this->request->getVar('lastName'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'isActive'    => $this->request->getVar('isActive'),
            ];
            $model->save($data);
             
            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
        }
    }

    public function user()
    {
        $rules = [
            'firstName' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'lastName' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[user.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]'],
            'isActive' => ['rules' => 'required|numeric|in_list[0,1]'],
        ];
            
  
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'firstName'    => $this->request->getVar('firstName'),
                'lastName'    => $this->request->getVar('lastName'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'isActive'    => $this->request->getVar('isActive'),
            ];
            $model->save($data);
             
            return $this->respond(['message' => 'Registered Successfully'], 200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
             
        }
            
    }
}