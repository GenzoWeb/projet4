<?php
require_once("model/Manager.php");

class LoginManager extends Manager
{
    public function getUser($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, login, pass FROM user WHERE login = ?');
        $req->execute(array($login));
        $user = $req->fetch();
        
        return $user;
    }
}