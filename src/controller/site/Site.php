<?php

class Site extends Core
{
    public function index()
    {
        $this->renderTemplate('main');    
    }

    public function about()
    {
        $about = new SiteModel;
        $template = $about->test();
        $this->renderTemplate($template);
    }

    public function contact()
    {
        $this->render('404'); 
    }

}