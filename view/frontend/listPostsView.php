<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>BLOG</h1>
<p>Billets du blog</p>

<?php
echo 'Page : ';
for($i = 1; $i <= $nbTotalPages ; $i++){
    echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
}

while($data = $posts->fetch())
{
?>

<h3>
	<?= htmlspecialchars($data['title'])?> le <?= $data['creation_date_fr']?>
	<?php 
		if(isset($_SESSION['login'])){
	?>	
		<em>
			<a href="index.php?action=editPost&id=<?=$data['id']?>">Modifier</a>
		</em>
		<em>
			<a href="index.php?action=deletePost&id=<?=$data['id']?>">Supprimer</a>
		</em>	
	<?php	
		}
	?>
</h3>

<p>
	<?= $data['content']?>
	<br />
	<em>
		<a href="index.php?action=post&id=<?=$data['id']?>">Commentaires</a>
	</em>
</p>

<?php
}

$posts->closeCursor();

$content = ob_get_clean();

require('template.php'); 
?>