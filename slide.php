<div id="my-slideshow">
	<ul class="bjqs">
		<?php
	$result=mysql_query("SELECT * FROM articles ORDER BY date desc LIMIT 3");
	
	while($data= mysql_fetch_array($result)){// on retourne les articles 1 par 1
		echo '<li><div><h3>'.$data['titre'].'</h3>';
		$id=$data['id'];
		
	$img= dirname(__FILE__).'/data/image/'.$id.'.jpg';
	if(file_exists($img))	//on test si il y a bien une image enregistré pour l'article de cette id
	{	//si oui on l'affiche
		?>
		<img src="vignette.jpg.php?id=<?php echo $id ;?>" class= pull-left style= margin-right:10px>
		<?php
		}
		else 'lol';
		echo '<p>'.nl2br(htmlspecialchars($data['contenu'])).'</p></div></li>';		
	}
	?>
	</ul>
</div>

	<script>  
	jQuery(document).ready(function($) {
	$('#my-slideshow').bjqs({
		'height' : 420,
		'width' : 620,
		'responsive' : true,
		'prevtext': '<<',
		'nexttext' :'>>',
		'showmarkers'     : false
	});
});
</script>