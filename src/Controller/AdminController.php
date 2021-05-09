<?php
namespace App\Controller;

use App\Model\Admin;

class AdminController extends BaseController
{
    public function signIn()
    {
        $pleaseTryAgain = $_SESSION['admin']['incorrectCredentials'] ?? false;
        unset($_SESSION['admin']);

        return $this->render('admin/signin', ['pleaseTryAgain' => $pleaseTryAgain]);
    }

    public function authorize()
    {
        $login = trim($_POST['login']);
        $password = (int) trim($_POST['password']);

        $isCredentialsCorrect = Admin::PASSWORD === $password && Admin::USERNAME === $login;

        if ($isCredentialsCorrect) {
            $_SESSION['admin']['isAuthorized'] = $isCredentialsCorrect;
            header('Location: /');
        } else {
            $_SESSION['admin']['incorrectCredentials'] = !$isCredentialsCorrect;
            header('Location: /admin/signin');
        }
    }
}
