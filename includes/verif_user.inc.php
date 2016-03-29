<?php
$connecte= false;
if(isset($_COOKIE['id']) &&  !empty($_COOKIE['id']))//test si le cookie de l'utilisateur existe
{//si il existe alors
$sid= $_COOKIE['id'];
	$sql= "SELECT email from utilisateurs WHERE sid='$sid'";//on selectionne l'e-mail de cette utilisateur
	$query = mysql_query($sql);
	$data= mysql_fetch_array($query);
	if($data){//on accepte la connection
		$connecte = true;
		$email_util=$data['email'];//ecrit l'e-mail de l'utilisateur dans $email_util
		
	}		
}

?>
