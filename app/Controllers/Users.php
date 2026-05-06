<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        helper('form');

        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');
    }

    public function register()
    {
        helper('form');

        echo view('templates/header');
        echo view('register');
        echo view('templates/footer');
    }
}