<?php namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController {
    public function login() {
        return view('auth/login');
    }

    public function attemptLogin() {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ]);
            return redirect()->to(base_url('dashboard'));
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function register() {
        return view('auth/register');
    }
 

    
    public function attemptRegister() {
        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'cashier'
        ];
        $model->save($data);
        return redirect()->to(base_url('login'))->with('success', 'Registration Successful!');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}