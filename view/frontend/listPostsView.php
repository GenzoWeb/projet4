<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>BLOG</h1>
<p>Billets du blog</p>

<?php
while($data = $posts->fetch())
{
?>

<h3>
	<?= htmlspecialchars($data['title'])?> le <?= $data['creation_date_fr']?>
</h3>

<p>
	<?= nl2br(htmlspecialchars($data['content']))?>
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