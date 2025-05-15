<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController{

    public function login(){
        return view('auth/login');
    }

    public function authLogin(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();
        if($user){
            if(password_verify($password, $user['password'])){
                $session = session();
                $session->set('user_id', $user['user_id']);
                $session->set('name', $user['first_name'].' '.$user['last_name']);
                $session->set('isLoggedIn', true);
                return redirect()->to('/student/list')->with('success', 'Login successful!');
            } else {
                return redirect()->back()->with('error', 'Invalid password!');
            }
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }

    public function register(){

        return view('auth/signup');
    }

    public function authRegister(){
        $validation = \Config\Services::validation();

        $rules = [
            'username'   => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
            'first_name' => 'required|alpha',
            'last_name'  => 'required|alpha',
            'password'   => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $insertData = [
            'username' => $this->request->getPost('username'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'password' => $this->request->getPost('password'),
        ];

        $userModel = new UserModel();
        $userModel->insert($insertData);

        if($userModel->insertID()){
            return redirect()->to('/login')->with('success', 'User created successfully!');
        } else {
            return redirect()->to('/register')->with('error', 'User creation failed!');
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'Logout successful!');
    }
}


?>