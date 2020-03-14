<?php

class Site extends Core
{
    public function index()
    {
        $this->renderTemplate('main');    
    }

    public function about()
    {
        $this->renderTemplate('content');    
    }

    public function contact()
    {
        $this->render('404'); 
    }

}