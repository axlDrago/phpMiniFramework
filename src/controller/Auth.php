<?php

class Auth extends Core
{
    public function index()
    {
        $model = new User;
        if($model->isAuth()){
            $this->redirect('/');
        } else {
            $this->renderTemplate('auth');
        }
    }

    public function login(){
        if($_POST) {
            $model = new User;
            $model->login();
        } else {
            $this->render('404');
        }
    }

    public function logout(){
        session_destroy();
        $this->redirect('/');
    }
}