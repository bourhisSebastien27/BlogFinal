<?php
include('includes/connexion.inc.php');
if(isset($_POST['cle'])) {
$cle = $_POST['cle'];
$sql= "SELECT * FROM articles where votes='$cle'";
$result=mysql_query($sql);
if(mysql_num_rows($result)!=0){
$up="UPDATE articles SET votes= votes + 1 WHERE votes='$cle'";
mysql_query($up);
}
else {
echo"erreur";
}




	}
