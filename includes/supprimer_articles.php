<?php
include('connexion.inc.php');
include('header.inc.php');
if(isset($_GET['id']))//si l'id de l'article existe
	{	
		$id=(int)$_GET['id'];
		$query= "SELECT * from articles WHERE id='".$id."';";// on selectionne l'article egale a l'id recupérer
		$result=mysql_query($query);
		$sql="DELETE FROM articles WHERE id='$id';";//on supprime cette article
		mysql_query($sql);
		unlink('../data/images/'.$id.'.jpg');//on supprime l'image
		header("Location: ../index.php");//on redirige vers index.php
	}
include('footer.inc.php');
?>