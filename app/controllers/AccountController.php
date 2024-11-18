<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{
    public function loginAction(): void
    {
        $this->view->render('Login Page');
    }

    public function registerAction(): void
    {
        $this->view->render('Register Page');
    }

}
