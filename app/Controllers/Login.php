<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Libraries\Hash;

class Login extends Controller {
    public function index() {
        // include helper form
        helper(['form']);
        echo view('login');
        
    }

    public function loginUser() {

        // Validate user input
        $validated = $this->validate([
            
            'email'=> [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required',
                    'valid_email' => 'Email is already used.',
                ]
            ],
            'password'=> [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required',
                    'min_length' => 'Password must be 5 charectars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                ]
            ],
            
        ]);

        if(!$validated)
        {
            return view('/login', ['validation' => $this->validator]);
        }
        else {
            // checking user details in database.
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password, $userInfo['password']);

            if(!$checkPassword)
            {
                session()->setFlashdata('fail', 'Incorrect password provided');
                return redirect()->to('/login');
            }
            else
            {
                // Proces user info.
                $userId = $userInfo['id'];

                session()->set('loggedInUser', $userId);
                return redirect()->to('/dashboard');
            }
        }
    }





}