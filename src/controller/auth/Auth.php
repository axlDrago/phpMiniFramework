<?php

class Auth extends Core
{
    public function index()
    {
        $model = new User;
        if($model->isAuth()){
            $this->redirect('/');
        } else {
            $this->renderTemplate('loginPage', ['css' => ['auth/loginPage'], 'js'=>['auth/auth']]);
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
        unset ($_SESSION['isLogin']);
        unset ($_SESSION['id']);
        session_destroy();
        $this->redirect('/');
    }
}