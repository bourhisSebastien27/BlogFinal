<?php
include('includes/connexion.inc.php');
include('includes/header.inc.php');
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['mdp']))//test si le nom,prenom,email & mdp ne sont pas vide
{			
	$nom =mysql_real_escape_string($_POST['nom']);
	$prenom =mysql_real_escape_string($_POST['prenom']);
	$email =mysql_real_escape_string($_POST['email']);
	$mdp =mysql_real_escape_string(MD5($_POST['mdp']));
	$inscri="SELECT nom,prenom,email,mdp FROM utilisateurs WHERE nom='$nom' AND prenom='$prenom' AND email='$email' AND mdp='$mdp'";//récupère les personne deja inscrit
	$verif= mysql_query($inscri);
	$data=mysql_fetch_array($verif);
	if ($nom != $data['nom'] && $prenom != $data['prenom'] && $email != $data['email'] && $mdp != $data['mdp'])// test si le nouveau utilisateur n'existe pas
		{
	$sql= "INSERT INTO utilisateurs (email, mdp, nom, prenom) VALUES ('$email','$mdp','$nom','$prenom')";//si il existe pas on l'inscrit
	$insert= mysql_query($sql);?>
	<script>alert("<?php echo htmlspecialchars('félicitation vous êtes inscript ', ENT_QUOTES); ?>")</script>
	<?php

		}
		else {	?>	
	<script>alert("<?php echo htmlspecialchars('cette utilisateurs est déjà inscript ', ENT_QUOTES); ?>")</script>		
	
			<?php																				//sinon 
			$maj= "UPDATE utilisateurs SET nom='$nom'";
			mysql_query($maj);
		}	
	//$data= $mysql_fetch_array($insert);	
}


?>
<html>
	<head>
	<meta charset="utf-8">
		<title>Connexion</title>
	</head>
		<body>
			<form method="post">
				<div class="clearfix">
					<label for="nom">Nom</label>
					<div class="input"><input type="nom" id="nom" name="nom" value="" /></div>
					<label for="prenom">Prenom</label>
					<div class="input"><input type="prenom" id="prenom" name="prenom" value="" /></div>
					<label for="email">E-mail</label>
					<div class="input"><input type="email" id="email" name="email" value="" /></div>
					</div>
				<br>
					<div class="clearfix">
					<label for="password">Password</label>
					<div class="input"><input type="password" id="mdp" name="mdp" value="" /></div>
				</div>
				<br>
				<div class="button">
					<button type="submit">Inscription</button>
				</div>
			</form>
		</body>
</html>
<?php

include('includes/footer.inc.php');
?>



