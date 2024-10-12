<?php

namespace Geekbrains\Application1\Application;

class Auth {

    public static function getPasswordHash(string $rawPassword): string {
        return password_hash($rawPassword, PASSWORD_BCRYPT);
    }

    public function proceedAuth(string $login, string $password): bool{
        $sql = "SELECT id_user, user_name, user_lastname, user_password_hash FROM users WHERE user_login = :login";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['login' => $login]);
        $result = $handler->fetchAll();
        $success = !empty($result) && password_verify($password, $result[0]['user_password_hash']);
        if($success){
            $_SESSION['user_name'] = $result[0]['user_name'];
            $_SESSION['user_lastname'] = $result[0]['user_lastname'];
            $_SESSION['id_user'] = $result[0]['id_user'];
        }
        return $success;
    }

    public static function addSessionData(array $templateVariables) : array {
        if (isset($_SESSION['user_name'])) {
            $templateVariables['islogin'] = true;
            $templateVariables['username'] = $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname'];
        }
        return $templateVariables;
    }
      public function restoreSession(): void
    {
        if (isset($_COOKIE['auth_token']) && !isset($_SESSION['auth']['user_name'])) {
            $userData = User::verifyToken($_COOKIE['auth_token']);


            if (!empty($userData)) {
                $_SESSION['auth']['user_name'] = $userData['user_name'];
                $_SESSION['auth']['user_lastname'] = $userData['user_lastname'];
                $_SESSION['auth']['id_user'] = $userData['id_user'];
            }
        }
    }
      public function generateToken(int $userId): string
    {
        $bytes = random_bytes(16);
        return bin2hex($bytes);
    }
}