<?php

class Site extends Core
{
    public function index()
    {
        $model = new User;
        if($model->isAuth()){
            $this->renderTemplate('main');

        } else {
            $this->redirect('/auth');
        }
    }

    public function about()
    {
        $about = new SiteModel;
        $template = $about->test();
        $this->renderTemplate($template);
    }

}