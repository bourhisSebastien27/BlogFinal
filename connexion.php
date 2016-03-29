<?php
include('includes/connexion.inc.php');
include('includes/header.inc.php');
include('includes/verif_user.inc.php');  
	if( isset($_POST['email'])) //si l'e-mail existe est n'est pas vide
	{
		if(isset ($_POST['email']) && isset($_POST['mdp']))//et le mot de passe egalement
		{ // on compare l'e-mail et le mot de passe ecrit a celui existant dans la bdd
			$email= mysql_real_escape_string($_POST['email']);
			$mdp= mysql_real_escape_string(MD5($_POST['mdp']));
			$sql= "SELECT email,mdp from utilisateurs WHERE email='$email' AND mdp= '$mdp'";
			$result=mysql_query($sql);
			$data= mysql_fetch_array($result);
				//echo "premier test:";print_r($data);
				if($data['email'] = $email || $data['mdp'] = $mdp) // si c'est les même
				{//alors on met a jour la table utilisateurs en ajoutant un sid 
					$sid= MD5($email.time());
					$maj= "UPDATE utilisateurs SET sid='$sid' where email='$email'";
					mysql_query($maj);
					setcookie('id',$sid,time()+120);
					header("Location: index.php");	
				}
					else{echo "erreur de connection!";}
		}
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
					<button type="submit">Connexion</button>
				</div>
			</form>
		</body>
</html>

<?php
include('includes/footer.inc.php');
?>
