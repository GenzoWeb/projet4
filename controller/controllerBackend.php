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
    	header('Location: index.php?action=admin');
    }
    else{
    	throw new Exception('Mauvais identifiant ou mauvais mot de passe');
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

    if($_GET['action'] == 'editPost'){
    	require('view/backend/editPost.php');
    }
    if($_GET['action'] == 'deletePost'){
    	require('view/backend/deletePost.php');
    }
}

function editPost($postId, $title, $content)
{
	$postManager = new PostManager();
	$rewritePost = $postManager->updatePost($postId, $title, $content);

	if($rewritePost === false){
		throw new Exception('Impossible de modifier le chapitre !');
	}
	else {
		header('Location: index.php?action=admin');
	}	
}

function removePost($postId)
{
	$postManager = new PostManager();
	$erasePost = $postManager->deletePost($postId);

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

    if($_GET['action'] == 'editComment'){
    	require('view/backend/editComment.php');
	}
	if($_GET['action'] == 'deleteComment'){
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