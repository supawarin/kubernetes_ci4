<?php namespace App\Controllers;

use CodeIgniter\Controller;
#use App\Models\UserModel;

class Dashboard extends Controller
{
    public function index() {

        
        echo view('dashboard');
    }
}