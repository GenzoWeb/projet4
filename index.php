<?php
session_start();
require('controller/controllerFrontend.php');
require('controller/controllerBackend.php');

try{
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && $_GET['id'] > 0) {
	            post();
	        }
	        else {
	            throw new Exception('Aucun identifiant de billet envoyé');
	        }
	    }
	    elseif($_GET['action'] == 'addComment') {
	    	if(isset($_GET['id']) && $_GET['id'] > 0){
	    		if (!empty($_POST['author']) && !empty($_POST['comment'])){
	    			addComment($_GET['id'], $_POST['author'], $_POST['comment']);
	    		}
	    		else{
	    			throw new Exception('Tous les champs ne sont pas remplis !');
	    		}
	    	}
	    	else{
	    		throw new Exception('Aucun identifiant de billet envoyé');
	    	}
	    }
	    elseif(isset($_POST['submitAdmin'])){
	    	if(!empty($_POST['login']) && !empty($_POST['pass'])){ 
	    		login($_POST['login']);
	    	}
	    	else{
		        throw new Exception('Veuillez remplir tout les champs');
		    }	
	    }
	   	elseif($_GET['action'] == 'report') {
	    	if(isset($_GET['id']) && $_GET['id'] > 0){
	    		if(isset($_GET['post_id']) && $_GET['post_id'] > 0){
	    			if(isset($_GET['reporting']) && $_GET['reporting'] >= 0){
	    				reportComment($_GET['id'], $_GET['post_id'], $_GET['reporting']);
	    			}
	    			else{
	    				throw new Exception('Ce billet n\'existe pas');
	    			}
	    		}
	    	}
	    }	
		elseif(isset($_SESSION['login'])){
			if($_GET['action'] == 'login'){
				require('view/backend/admin.php');
				listPosts();
			}
			elseif($_GET['action'] == 'newPost'){
				require('view/backend/addPost.php');
			}
		    elseif($_GET['action'] == 'addPost'){
		    	if (!empty($_POST['title']) && !empty($_POST['content'])){
					addPost($_POST['title'], $_POST['content']);
					listPosts();
				}
				else{
					throw new Exception('Tous les champs ne sont pas remplis !');
				}
		    }
		    elseif ($_GET['action'] == 'editPost') {
		        if (isset($_GET['id']) && $_GET['id'] > 0) {
		            postAdmin();
		        }
		        else {
		            throw new Exception('Aucun identifiant de billet envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'update') {
		        if (isset($_GET['id']) && $_GET['id'] > 0) {
		        	if (!empty($_POST['title']) && !empty($_POST['content'])){
		            	editPost($_GET['id'], $_POST['title'], $_POST['content']);
		            }
		            else{
	    				throw new Exception('Tous les champs ne sont pas remplis !');
	    			}
		        }
		        else {
		            throw new Exception('Aucun identifiant de billet envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'deletePost') {
		        if (isset($_GET['id']) && $_GET['id'] > 0) {
		            postAdmin();
		        }
		        else {
		            throw new Exception('Aucun identifiant de billet envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'remove'){
		     	if (isset($_GET['id']) && $_GET['id'] > 0) {
		     		removePost($_GET['id']);
		     	}
		     	else{
		     		throw new Exception('Aucun identifiant de billet envoyé');
		     	}   
		    } 	
		}
		else{
			if(isset($_POST['login'])){
				login($_POST['login']);
			}
			else{
				require('view/frontend/login.php');
			}
		}
	}
	else {
	    listPosts();
	}
}
catch(Exception $e){
	echo 'Erreur :' . $e->getMessage();
}