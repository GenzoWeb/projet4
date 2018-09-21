<?php

require_once('model/LoginManager.php');
require_once('model/PostManager.php');

function login($login)
{
	$loginManager = new LoginManager();
    $admin = $loginManager->getUser($login);

    $isPasswordCorrect = password_verify($_POST['pass'], $admin['pass']);
    if(($_POST['login'] == $admin['login']) && $isPasswordCorrect){
    	$_SESSION['login'] = $admin['login'];
    	header('Location: index.php?action=admin');
    }
    else{
    	$_SESSION['erreur'] = 'Mauvais identifiant ou mauvais mot de passe';
    	require('view/frontend/login.php');
    }
}

function addPost($title, $content)
{
	$postManager = new PostManager();
	$newPost = $postManager->createPost($title, $content);

	if($newPost === false){
		throw new Exception('Impossible d\'ajouter le chapitre !');
	}
	else {
		header('Location: index.php?action=admin');
	}
}

function postAdmin()
{
	$postManager = new PostManager();
    $postAdmin = $postManager->getPost($_GET['id']);

    $numberCharacters = strlen($postAdmin['content']);
	$string = $postAdmin['content'];
	$text = substr($string, 0, 450);
	$text = substr($text, 0, strrpos($text, ' '));

	if($numberCharacters < 300){
		$textPost = $string;
	}
	else{
		$textPost = $text . ' ...';
	}

    if($_GET['action'] == 'editPost'){
    	require('view/backend/editPost.php');
    }
    if($_GET['action'] == 'deletePost'){
    	require('view/backend/deletePost.php');
    }
}

function editPost($id, $title, $content)
{
	$postManager = new PostManager();
	$rewritePost = $postManager->updatePost($id, $title, $content);

	if($rewritePost === false){
		throw new Exception('Impossible de modifier le chapitre !');
	}
	else {
		header('Location: index.php?page=' . $_GET['page']);
	}			
}

function removePost($id)
{
	$postManager = new PostManager();
	$erasePost = $postManager->deletePost($id);

	if($erasePost === false){
		throw new Exception('Impossible de supprimer le chapitre !');
	}
	else {
		header('Location: index.php?action=admin');
	}	
}

function moderateComments()
{
	$commentManager = new CommentManager();
	$moderate = $commentManager->getCommentsAdmin();

	require('view/backend/moderate.php');
}

function comment()
{
	$commentManager = new CommentManager();
    $comment = $commentManager->getComment($_GET['id']);

    if($comment === false){
		throw new Exception('Ce commentaire n\'existe pas !');
	}
    elseif($_GET['action'] == 'editComment'){
    	require('view/backend/editComment.php');
	}
	elseif($_GET['action'] == 'deleteComment'){
    	require('view/backend/deleteComment.php');
	}
}

function removeComment($id)
{
	$commentManager = new CommentManager();
	$eraseComment = $commentManager->deleteComment($id);

	if($eraseComment === false){
		throw new Exception('Impossible de supprimer le commentaire !');
	}
	else {
		header('Location: index.php?action=moderate');
	}	
}

function editComment($id, $comment)
{
	$commentManager = new CommentManager();
	$rewriteComment = $commentManager->updateComment($id, $comment);

	if($rewriteComment === false){
		throw new Exception('Impossible de modifier le commentaire !');
	}
	else {
		header('Location: index.php?action=moderate');
	}	
}

function logout()
{
	$_SESSION = array();
	session_destroy();

	header('Location: index.php');
}