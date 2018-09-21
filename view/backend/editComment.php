<?php 
$title = 'Modifiez commentaire';
ob_start();
?>

<div id="edit-comment" class="container">
	<div class="form-container">
		<h2>Modifiez commentaire</h2>
		<div id="form-edit-comment" class="form-container">
			<form action="index.php?action=updateComment&id=<?= $comment['id']?>" method="post">
			    <div class="form-group">
			        <label for="comment">Commentaire</label><br />
			        <textarea class="form-control" name="comment"><?= htmlspecialchars($comment['comment'])?></textarea>
			    </div>
			    <div>
			        <button class="btn btn-primary" type="submit" id="submit" name="submit">Envoyer</button>
			    </div>
			</form>
		</div>
	</div>

	<?php
	if(isset($_SESSION['erreur']))
	{
	?>
	    <div id="error" class="alert alert-block alert-danger">
	        <?php
	        echo $_SESSION['erreur'];
	        ?>
	    </div>
	<?php
	}
	?>
</div>

<?php
$content = ob_get_clean();

require('view/frontend/template.php');
?>