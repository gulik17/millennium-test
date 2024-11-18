<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        $vars = [
            'name' => 'Vovan',
            'age' => '34',
        ];
        echo json_encode($vars);
        //$this->view->render('Main Page', $vars);
    }

}
