# phpMVC-miniEngine
Мини фраемворк с использованием паттерна MVC, используется phinx для миграции Базы данных

## I. Структура:

     |--config  - папка с файлом настроек
     |--controller - контроллеры
     |--engine - основное ядро
     |--migrations - миграции
     |--models - модели
     |--public
       |--assets
          |--css - папка для css файлов
          |--js - папка для js файлов
    |--view - папка с шаблонами
       |--site - шаблоны для контроллера site
       |--templates - глобальные шаблоны контроллера

## II. Запуск приложения
По умолчанию контроллер Site главный, все запросы переадресуются с localhost/site/action на localost/action/;
<br>
start из корня: <br>
1. composer install <br> 
2. docker-compose up <br> 
3. доступен по адресу localhost:8000

## III. Конфигурация
<br>В файле config.php указать

     $config = [
     'db' => [
       'host' => '', //адрес Базы Данных<br>
       'login' => 'admin', //логин для подключения к БД
       'password' => 'admin', //пароль для подключения к БД
       'port' => '3306'
     ],
     'controllers' => [
     //При добавлении нового контроллера необходимо его сконфигурировать, указать название шаблона контроллера и зависимости.
       'site' => [ //название контроллера, должен совпадать с названием файла контроллера
          'template' => 'site', //глобальный шаблон контроллера из папки view/templates
          'assets' => [
             'title'=>'PHPengineMVC',
             'css' => [mycss.min], //файлы указывать без расширения, путь начинается с assets/css || assets/js
             'js' => [myjs]
            ]
          ]
       ]
    ];

## IV. Методы
Шаблоны берутся из папки с названием контроллера<br>
Рендер шаблона<br>

     $this->renderTemplate('название шаблона из папки с контроллером', 
                            array(
                                  js=>array(//Файлы js для подключения к шаблону), 
                                  css=>array(//Файлы css для подключении), 
                                  $variable=>'Переменная для отображения в шаблоне'
                                )
                          );

     $this->render() - рендер шаблона из папки view

     $this->redirect('адрес редиректа');
<br>
Для выполнения GET запросов необходио указывать полный путь localhost/controller/action?get=<br>
<br>

## V. Шаблоны
Глобальный шаблон контроллера лежит в папке /public/template и должен !содержать переменную $content <br>
Шаблоны контроллера лежат в папке с названием контроллера!

## VI. Подключение к Базе Данных
Инициализация подключения вызывается методом $this->getConnect();
<br>
Пример подключения
     
     try
     {
        $connect = $this->getConnect();
        $sth = $connect->prepare("SELECT * FROM table WHERE var = :var");
        $sth->execute(array(':var' => $var));
        $result = $sth->fetchAll();
        
        echo json_encode(array('success' => $result);
      } catch (PDOException $e){
        echo json_encode(array('err' => 'Ошибка подключения к серверу</br>' . $e->getMessage()));
      }
