<?php 
$title = 'Mon blog';
ob_start();
?>

<div id="banner" class="container-fluid">
	<img class="image" src="public/images/alaska-banner.jpg"/>
</div>
<div id="list-posts" class="container">	
	<?php
	while($data = $posts->fetch())
	{
	?>
	<div id="posts" class="row">	
		<div id="resume-post" class="row">
			<div id="posts-row" class="title-post row">			
				<div class="col-xs-12 col-sm-8">
					<a id="title-post2" href="index.php?action=post&id=<?=$data['id']?>"><?= htmlspecialchars($data['title'])?> le <?= $data['creation_date_fr']?></a>
				</div>
				<?php			
				if(isset($_SESSION['login']))
				{
				?>	
					<div class="col-xs-12 col-md-3 pull-right">
						<em>
							<a id="modif-post" href="index.php?action=editPost&id=<?=$data['id']?>&page=<?=$page?>">Modifier</a>
							<a id="clear-post" href="index.php?action=deletePost&id=<?=$data['id']?>">Supprimer</a>
						</em>	
					</div>	
				<?php	
				}
				?>	
			</div>	
			<p>
				<?php
				$numberCharacters = strlen($data['content']);
				$string = $data['content'];
				$text = substr($string, 0, 450);
				$text = substr($text, 0, strrpos($text, ' '));
				if($numberCharacters < 300)
				{
					echo $string;
				}
				else
				{
				echo $text;?> ...  <a id="read-more" href="index.php?action=post&id=<?=$data['id']?>">Lire la suite</a>
				<?php
				}
				?>
			</p>
			<em class="pull-right">
				<a id="link-com" href="index.php?action=post&id=<?=$data['id']?>">
					<?php
					if($data['nb'] == 0)
					{
					?>
						Aucun commentaire
					<?php	
					}
					elseif($data['nb'] == 1)
					{
					?>
						<?=$data['nb'] ?> commentaire
					<?php
					}
					else
					{
					?>
						<?=$data['nb'] ?> commentaires
					<?php	
					}
					?>
				</a>
			</em>
		</div>
	</div>
	<?php
	}
	?>
	<div class="row">
		<div id ="pagination" class="center-block">
			<?php
			for($i = 1; $i <= $nbTotalPages ; $i++)
			{
				if($i == $page)
				{
				?>
					<span id="link-activ" class="btn btn-info"><?= $i ?></span>
				<?php
				}
				else
				{
				?>
			    	<a id="link-page" class="btn btn-info" href="index.php?page=<?= $i ?>"><?= $i ?></a>
			    <?php
				}
			}
			?>
		</div>
	</div>
</div>

<?php
$posts->closeCursor();
$content = ob_get_clean();

require('template.php'); 
?>