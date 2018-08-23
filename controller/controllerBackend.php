<?php

require_once('model/LoginManager.php');
require_once('model/PostManager.php');

function login($login)
{
	$loginManager = new LoginManager();
    $admin = $loginManager->getUser($login);

    $isPasswordCorrect = password_verify($_POST['pass'], $admin['pass']);
    if((htmlspecialchars($_POST['login']) == $admin['login']) && $isPasswordCorrect){
    	session_start();
    	$_SESSION['login'] = $admin['login'];
    	header('Location: index.php?action=login');
    }
    else{
    	throw new Exception('Mauvais identifiant ou mauvais mot de passe');
    }

    require('view/frontend/login.php');
}

function addPost($title, $content)
{
	$postManager = new PostManager();
	$newPost = $postManager->createPost($title, $content);

	if($newPost === false){
		throw new Exception('Impossible d\'ajouter le billet !');
	}
	else {
		require('view/backend/admin.php');
	}
}