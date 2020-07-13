<?php

require_once '../config/config.php';

class Core {
    
    protected $config;

    public function __construct() {
        global $config;
        $this->config = $config;
    }

    /**
     * Метод запуска
     */
    public function startApp ()
    {
        $this->autoRequire($this->config['dir']);
        $this->controllers();
    }

    /**
     * Метод автоподключения 
     */
    public function autoRequire ($dir = []) 
    {
        foreach ($dir as $key => $value) {
            $scan = scandir($value);
            $d = $dir[$key];
            foreach($scan as $key => $val) 
            {
                if($key !== 0 & $key !== 1 & preg_match('/(\.php)/', $val) === 0)
                {
                    $scan2 = scandir($value .'/'.$val);
                    $path = $d . '/' . $val;
                    $this->require($scan2, $path);
                }
            }
            $this->require($scan, $d);
        }
    }
    /**
     * Метод подключения
     */
    protected function require ($scan, $path){
        foreach($scan as $key => $value) 
        {
            if($key !== 0 & $key !== 1 & preg_match('/(\.php)/', $value) !== 0) {
                require_once(__DIR__ . '/' . $path. '/' . $value);
            }
        }
    }

    /**
     * Рендер шаблона из корня ./view/
     */
    public function render($template, $e = array()) 
    {
        extract($e);
        ob_start();
        require ('../view/' . $template . '.php'); 
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

    /**
     * Метод подготовки контента для рендера
     */
    public function preparation($template, $path,  $e = array()) {
        ob_start();
        extract($e);
        include ('../view/' . $path . '/' . $template . '.php'); 
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
    /**
     * Метод рендера шаблона
     */
    public function renderTemplate($template, $e = array())
    {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if($path[1] == '') {
            $path[1] = 'site';
        }
        $config = $this->config['controllers'][$path[1]];
        extract($config['assets']);
        if(array_key_exists('js', $e)){
            $js = array_merge($js, $e['js']);
        }
        if(array_key_exists('css', $e)){
            $css = array_merge($css, $e['css']);
        }
        ob_start();

        $content = $this->preparation($template, $path[1], $e);
        require ('../view/templates/' . $config['template'] . '.php');
        $render = ob_get_contents();
        ob_end_clean();
        echo $render;
    }

    /**
     * Метод обработки url и запуск контроллеров
     */
    protected function controllers()
    {
        $url = explode('?', $_SERVER['REQUEST_URI']);
        $path = explode('/', $url[0]);

        $controllers = scandir('../controller');
        $result = false;

        foreach($controllers as $key => $value) {
            $value = explode('.', $value);
            if($path[1] == "")
            {
                break;
            }
            else if(mb_strtolower($path[1]) == mb_strtolower($value[0]))
            {   
                $result = true;
                break;
            }
        }
        if ($result) {
            $controller = ucfirst($path[1]);

            if (!key_exists(2, $path) || trim($path[2]) == ""){
                $controller = new $controller;
                $controller->index();
            } else {
                $b = count($path) - 1;
                $method = $path[$b];
                $controller = new $controller;

                if (method_exists($controller, $path[$b])) {
                    $controller->$method();
                } else {
                    $this->render('404');
                }
            }
        } else if (trim($path[1]) == "") {
            $controller = new Site;
            $controller->index();
        } else {
            $this->render('404');
        }
    }

    /**
     * Метод подключения к базе данных
     */

    private static function pdoConnect () 
    {
        global $config;
        $config =  $config['db'];
        $connect = new PDO(
            'mysql:'
            .'host=' . $config['host'] . ';'
            .'dbname=' . $config['dbname'] . ';'
            .'charset=' . $config['charset'],
            $config['login'], 
            $config['password']
        );

        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $connect;
    }

    public static function getConnect() {
        return self::pdoConnect();
    }

    /**
     * Метод переадресации
     */
    function Redirect($url, $permanent = false)
    {   
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        die();
    }
}