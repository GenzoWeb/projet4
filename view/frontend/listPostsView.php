<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>BLOG</h1>
<p>Chapitres du blog</p>

<?php
echo 'Page : ';
if(!isset($_GET['page'])){
	$page = 1;
}
else{
	$page = $_GET['page'];
}

for($i = 1; $i <= $nbTotalPages ; $i++){
	if($i == $page){
		echo $i . ' ';
	}
	else{
    echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
	}
}

while($data = $posts->fetch())
{
	$numberCharacters = strlen($data['content']);
	$string = $data['content'];
	$text = substr($string, 0, 150);
	$text = substr($text, 0, strrpos($text, ' '));
?>

<h3>
	<?= htmlspecialchars($data['title'])?> le <?= $data['creation_date_fr']?>
	<?php 
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else{
		$page = 1;
	}
	
	if(isset($_SESSION['login'])){
	?>	
		<em>
			<a href="index.php?action=editPost&id=<?=$data['id']?>&page=<?=$page?>">Modifier</a>
		</em>
		<em>
			<a href="index.php?action=deletePost&id=<?=$data['id']?>">Supprimer</a>
		</em>	
	<?php	
		}
	?>
</h3>

<p>
	<?php
		if($numberCharacters < 300){
			echo $string;
		}
		else{
		echo $text;?> ... <a href="index.php?action=post&id=<?=$data['id']?>">lire la suite</a>
		<?php
		}
	?>
	<br />
	<em>
		<?php
		if($data['nb'] == 0){
		?>
			<a href="index.php?action=post&id=<?=$data['id']?>">Aucun commentaire</a>
		<?php	
		}
		elseif($data['nb'] == 1){
		?>
			<a href="index.php?action=post&id=<?=$data['id']?>"><?=$data['nb'] ?> commentaire</a>
		<?php
		}
		else{
		?>
			<a href="index.php?action=post&id=<?=$data['id']?>"><?=$data['nb'] ?> commentaires</a>
		<?php	
		}
		?>
	</em>
</p>

<?php
}

$posts->closeCursor();

$content = ob_get_clean();

require('template.php'); 
?>