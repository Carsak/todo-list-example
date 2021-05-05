<?php

use App\Model\Admin;

class AdminControlller {

    public function signIn() {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if(Admin::PASSWORD === $password && Admin::USERNAME === $login) {
            $_SESSION['admin']['isAuthorized'] = true;
        }
    }
}
