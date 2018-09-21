<?php
$title = "BLOG Jean Forteroche";
ob_start();
?>

<div id="home">
	<img class="image-home" src="public/images/alaska.jpg"/>
	<a id="link-home" href="index.php?action=listPosts">
		<div
		<?php 
        if (isset($_SESSION['login']))
        {
        ?>
         class="t-home-admin"
        <?php
        }
        else
        {
        ?>
         class="t-home"
        <?php
        }
	    ?>
	    >   		
			<p class="text-home">Bienvenue sur mon blog</p>
			<h1 class="text-home">Billet simple pour l'Alaska</h1>
			<p class="text-home">Cliquez pour entrer dans l'aventure</p>
		</div>
	</a>

	<div id="biography" class="container">
		<div class="col-md-4">
			<p class="bio"><img id="image-bio" src="public/images/jean.jpg"></p>
		</div>
		<div class="col-md-8">
			<p>D'un autre côté, un véritable culte s'est progressivement instauré autour de l'écrivain et de son œuvre, d'abord dans le monde anglo-saxon, mais le débordant maintenant, et la culture populaire s'est emparée de l'univers qu'elle a créé. Jane Austen écrit pour ses contemporains, déployant ses intrigues dans le cadre relativement étroit du monde qu'elle connaît et dans lequel elle vit, mais Georgette Heyer s'en est inspirée pour inventer le roman d'amour « Régence » en 1935. Depuis le deuxième tiers du XXe siècle des adaptations théâtrales, puis cinématographiques et télévisuelles donnent corps à ses créatures de papier, dans des interprétations différentes en fonction de l'époque où elles sont mises en scène. Des ouvrages « modernes » reprennent et transposent ses intrigues, comme le Journal de Bridget Jones, des préquelles et des suites sont inventées autour de ses personnages par des admirateurs parfois célèbres, comme John Kessel et P. D. James, ou des écrivains de romances, et le phénomène s'est amplifié avec internet et les sites en ligne. </p>
		</div>
	</div>
</div>

<?php
$content = ob_get_clean(); 

require('template.php'); 
?>