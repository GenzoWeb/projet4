<?php
session_start();
require('controller/controllerFrontend.php');
require('controller/controllerBackend.php');

$begin = 0;
$chapterPerPage = 3;

try
{
	if (isset($_GET['action']))
	{
	    if ($_GET['action'] == 'listPosts')
	    {
	        listPosts($begin ,$chapterPerPage);
	    }
	    elseif ($_GET['action'] == 'post')
	    {
	        if (isset($_GET['id']) && $_GET['id'] > 0)
	        {
	            post();
	        }
	        else
	        {
	            throw new Exception('Aucun identifiant de chapitre envoyé');
	        }
	    }
	    elseif($_GET['action'] == 'addComment')
	    {
	    	if(isset($_GET['id']) && $_GET['id'] > 0)
	    	{
	    		if (!empty($_POST['author']) && !empty($_POST['comment']))
	    		{
	    			addComment($_GET['id'], $_POST['author'], $_POST['comment']);
	    		}
	    		else
	    		{
	    			$_SESSION['erreur'] = 'Veuillez remplir tout les champs';
	    			header('Location: index.php?action=post&id=' . $_GET['id']);
	    		}
	    	}
	    	else
	    	{
	    		throw new Exception('Aucun identifiant de chapitre envoyé');
	    	}
	    }
	    elseif(isset($_POST['submitAdmin']))
	    {
	    	if(!empty($_POST['login']) && !empty($_POST['pass']))
	    	{ 
	    		login($_POST['login']);
	    	}
	    	else
	    	{
		        $_SESSION['erreur'] = 'Veuillez remplir tout les champs';
		        require('view/frontend/login.php');
		    }	
	    }
	   	elseif($_GET['action'] == 'report')
	   	{
	    	if(isset($_GET['id']) && $_GET['id'] > 0)
	    	{
	    		if(isset($_GET['post_id']) && $_GET['post_id'] > 0)
	    		{
	    			if(isset($_GET['reporting']) && $_GET['reporting'] >= 0)
	    			{
	    				reportComment($_GET['id'], $_GET['post_id'], $_GET['reporting']);
	    			}
	    			else
	    			{
	    				throw new Exception('Ce chapitre n\'existe pas');
	    			}
	    		}
	    	}
	    }
	    elseif($_GET['action'] == 'error')
	    {
	    	require('view/frontend/404.php');
	    }
	    elseif($_GET['action'] == 'login' && (!isset($_SESSION['login'])))
	    {
			require('view/frontend/login.php');
		}		
		elseif(isset($_SESSION['login']))
		{
			if($_GET['action'] == 'admin')
			{
				listPosts($begin ,$chapterPerPage);
			}
			elseif($_GET['action'] == 'newPost')
			{
				require('view/backend/addPost.php');
			}
		    elseif($_GET['action'] == 'addPost')
		    {
		    	if (trim($_POST['title']) && trim($_POST['content']))
		    	{
					addPost($_POST['title'], $_POST['content']);
					listPosts($begin ,$chapterPerPage);
				}
				else
				{
					$_SESSION['erreur'] = 'Tous les champs ne sont pas remplis !';
					require('view/backend/addPost.php');
				}
		    }
		    elseif ($_GET['action'] == 'editPost' || $_GET['action'] == 'deletePost')
		    {
		        if (isset($_GET['id']) && $_GET['id'] > 0)
		        {
		            postAdmin();
		        }
		        else
		        {
		            throw new Exception('Aucun identifiant de chapitre envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'update')
		    {
		        if (isset($_GET['id']) && $_GET['id'] > 0)
		        {
		        	if (trim($_POST['title']) && trim($_POST['content']))
		        	{
		            	editPost($_GET['id'], $_POST['title'], $_POST['content']);
		            }
		            else
		            {
	    				$_SESSION['erreur'] = 'Tous les champs ne sont pas remplis !';
	    				header('Location: index.php?action=editPost&id=' . $_GET['id'] . '&page=' . $_GET['page']);
	    			}
		        }
		        else
		        {
		            throw new Exception('Aucun identifiant de chapitre envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'remove')
		    {
		     	if (isset($_GET['id']) && $_GET['id'] > 0)
		     	{
		     		removePost($_GET['id']);
		     	}
		     	else
		     	{
		     		throw new Exception('Aucun identifiant de chapitre envoyé');
		     	}   
		    }
		    elseif ($_GET['action'] == 'moderate')
		    {
		     	moderateComments();  
		    }
		    elseif($_GET['action'] == 'logout')
		    {
		    	logout();
		    }  
		    elseif ($_GET['action'] == 'deleteComment')
		    {
		        if (isset($_GET['id']) && $_GET['id'] > 0)
		        {
		            comment();
		        }
		        else
		        {
		            throw new Exception('Aucun identifiant de chapitre envoyé');
		        }
		    }
		    elseif ($_GET['action'] == 'removeComment')
		    {
		     	if (isset($_GET['id']) && $_GET['id'] > 0)
		     	{
		     		removeComment($_GET['id']);
		     	}
		     	else
		     	{
		     		throw new Exception('Aucun identifiant de chapitre envoyé');
		     	}   
		    }
		    elseif ($_GET['action'] == 'editComment')
		    {
		    	if (isset($_GET['id']) && $_GET['id'] > 0)
		    	{
		    		comment();
		    	}
		    	else
		    	{
		            throw new Exception('Aucun identifiant de chapitre envoyé');
		        }
		    }	
		    elseif ($_GET['action'] == 'updateComment')
		    {
		    	if (isset($_GET['id']) && $_GET['id'] > 0)
		    	{
		    		if (trim($_POST['comment']))
		    		{
		    			editComment($_GET['id'], $_POST['comment']);
		     		}
		     		else
		     		{
	    				$_SESSION['erreur'] = 'Tous les champs ne sont pas remplis !';
	    				header('Location: index.php?action=editComment&id=' . $_GET['id']);	    				
	    			}
		        }
		        else
		        {
		            throw new Exception('Aucun identifiant de chapitre envoyé');
		        }
		    }
		    else
		    {
		     	listPosts($begin ,$chapterPerPage);
		    }	
		}
		else
		{
			if(isset($_POST['login']))
			{
				login($_POST['login']);
			}
			else
			{
				require('view/frontend/login.php');
			}
		}
	}
	elseif(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0)
	{
		$_GET['page'] = intval($_GET['page']);
		$currentPage = $_GET['page'];
		$begin = ($currentPage - 1) * $chapterPerPage;

		listPosts($begin ,$chapterPerPage);
	}	
	else
	{
	    require('view/frontend/home.php');
	}
}
catch(Exception $e)
{
	$errorMessage = $e->getMessage();
	require('view/frontend/errorMessage.php');
}