<?php
require('controller/controllerFrontend.php');

try{
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }
	}
	else {
	    listPosts();
	}
}
catch(Exception $e){
	echo 'Erreur :' . $e->getMessage();
}	
