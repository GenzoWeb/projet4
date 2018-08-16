<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addcomment($postId, $author, $comment)
{
	$commentManager = new CommentManager();
	
	$newComment = $commentManager->postComment($postId, $author, $comment);

	if($newComment === false){
		throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $postId);
	}
}
