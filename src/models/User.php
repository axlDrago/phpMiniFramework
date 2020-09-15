<?php 

class User extends Core {


    /**
     * Метод проверки 
     */
    public function login()
    {
        try
        {
            $connect = $this->getConnect();
            $params = $_POST;
            $login = $connect->quote($params['email']);
            $password = $connect->quote($params['password']);
            $passwordHash = crypt($password, $this->config['salt']);

            $sth = $connect->prepare("SELECT login, password, name FROM users WHERE login = :login");
            $sth->execute(array(':login' => $login));
            $result = $sth->fetchAll();

            if($result) {
                if($result[0]['password'] == $passwordHash) {
                    $_SESSION['id'] = session_id();
                    $_SESSION['isLogin'] = true;
                    echo json_encode(array('success' => 'succes'));
                } else {
                    echo json_encode(array('err' => 'Неверный пароль!'));
                }
            } else {
                echo json_encode(array('err' => 'Пользователь не найден!'));
            }
        } catch (PDOException $e)
        {
            echo json_encode(array('err' => 'Ошибка подключения к серверу</br>' . $e->getMessage()));
        }
    }

    public function isAuth(){
        $response = false;
        if($_SESSION['isLogin'])
        {
            $response = true;
        }
        return $response;
    }
    
}