<?php
header("Content-Type: image/jpg");
$id= (int) $_GET['id'];
$imageSrc = dirname(__FILE__).'/data/image/'.$id.'.jpg';
$longueur=200;//defini la longueur

List($longueur_orig,$largeur_orig)= getimagesize($imageSrc);
$ratio= $longueur_orig/$longueur;//definie le ratio
$largeur= $largeur_orig/$ratio;

$image_copy= imagecreatetruecolor($longueur,$largeur);//redimention l'image
$image= imagecreatefromjpeg($imageSrc);//crée une nouvelle image a partir de l'image existante
imagecopyresampled($image_copy,$image,0,0,0,0, $longueur, $largeur, $longueur_orig, $largeur_orig);//copie & redimentionne l'image grâce au ratio
imagejpeg($image_copy, null,200);//création de  l'image final
?>