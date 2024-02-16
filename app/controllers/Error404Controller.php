<?php

use app\core\Controller;
class Error404 extends Controller{
    public function index(){
        $this->view('404');
    }
}