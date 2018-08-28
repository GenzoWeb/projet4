<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts($begin, $numberChapter)
{
	$postManager = new PostManager();
	$numberPosts = $postManager->countPosts($numberChapter);

	$nbTotalPages = ceil($numberPosts / $numberChapter);

	if(isset($_GET['page'])){
	    if($_GET['page'] <= $nbTotalPages){
	    	$start = $begin ;
	    }
	    else{
	    	$start = 0 ;
	    }
	}    
	else{
		$start = 0;
	}

	$posts = $postManager->getPosts($start, $numberChapter);

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

function reportComment($id, $postId, $reporting)
{
	$commentManager = new CommentManager();
	$report = $commentManager->updateReporting($id, $reporting);

	if($report === false){
		throw new Exception('Impossible de signaler le commentaire !');
	}
	else {
		header('Location: index.php?action=post&id=' . $postId);
	}	
}
