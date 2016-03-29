<?php
	include ('includes/connexion.inc.php') ;
	include('includes/header.inc.php') ;
	//Si titre existe
	if(isset($_POST['titre'])){
		//Sécurité des données
		$titre= mysql_real_escape_string($_POST['titre']);
		$contenu= mysql_real_escape_string($_POST['contenu']);
		
		//Si l'id existe
		if(isset($_POST['id'])){
		$id = (int)$_POST['id'];
			// modifier article
			$modif = "UPDATE articles SET titre='$titre', contenu='$contenu' WHERE id= '$id' ";
			mysql_query($modif) or die (' erreur SQL !'.$modif.'<br />'.mysql_error());
			}
			//Sinon insert un nouvel article
			else{
				$insert = 'INSERT INTO articles (titre,contenu,date) VALUES("'.$titre.'","'.$contenu.'", UNIX_TIMESTAMP() )';
				mysql_query ($insert) or die ('Erreur SQL !'.$insert.'<br />'.mysql_error());
				$idDernier = mysql_insert_id();
				$chemin_src= $_FILES['image']['tmp_name'];
				$chemin_dest=dirname(__FILE__).'/data/image/'.$idDernier.'.jpg';
				move_uploaded_file($chemin_src,$chemin_dest);
				}
			//Redirection vers index.php
			header('Location:index.php') ;
		}
		else{
			require_once('includes/header.inc.php') ;
			//Récupération des données de l'article pour afficher
			if(isset($_GET['id'])){
				$id = (int)$_GET['id'] ;
				$recup= 'SELECT * FROM articles WHERE id='.$id.';' ;
				$result= mysql_query($recup) or die ('Erreur SQL !'.$recup.'<br />'.mysql_error());
				$data=mysql_fetch_array($result);
				$titre = $data['titre'];
				$contenu = $data['contenu'] ;
			}
		}
?>

<h1> Rediger un article </h1>
<form action= "articles.php" method="post" enctype ="multipart/form-data"> 
		<?php if (isset($_GET['id'])){ ?>
			<input type="hidden" name="id" value="<?= $id ?>">
		<?php } ?>
	<h3> Titre </h3>
		<p><input type="text" name="titre" value = "<?php if(isset($_GET['id'])) echo $titre  ?>"/></p>
   <h3> Contenu </h3>
		<p><textarea name="contenu" rows ="20" cols ="60" > <?php if(isset($_GET['id'])) echo $contenu ?></textarea> </p>
		<input type ="file" name ="image"> 
		<input type ="submit" value ="Enregistrer"  />
		
</form>

	

<?php include('includes/footer.inc.php') ; 
?>