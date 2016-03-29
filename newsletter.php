<?php
include('includes/connexion.inc.php');

if(isset($_POST['email'])){
	$email=mysql_real_escape_string($_POST['email']);
	$selectEmail=mysql_query("SELECT * FROM newsletter WHERE email= '$email'");
	$emailBdd=mysql_fetch_array($selectEmail);

			if($emailBdd){
				echo "FALSE";
			}
				elseif(preg_match("#([a-z 0-9\.\-_]+@[a-z 0-9\.\-_]+\.[a-z]+)#", $email)){
					mysql_query("INSERT INTO newsletter(email) VALUES ('$email')");
					echo "OK";
				}
				else {echo "INVALIDE";}
		}