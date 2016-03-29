<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mon blog</title>
    <meta name="description" content="Petit blog pour m'initier à PHP">
    <meta name="author" content="Jean-philippe Lannoy">  
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="page-header well">
				<h1>Blog de <small>Bourhis Sébastien</small></h1>
        </div>
		  <div class="row">
          <div class="span8">
          <form method="post">
            <input type="text" name="search" placeholder="Votre mot clé de recherche...">
            <input type="submit" name="submit" value="Rechercher">
          </form>
	
	   <?php
          $mot = "";
          if(isset($_POST['submit'])) {
              $search = mysql_real_escape_string(htmlspecialchars(trim($_POST['search'])));
              if(empty($search)){
                  echo "Vous n'avez pas entré de mot clé";
              //si il y 2 caractère ou moins
              } else if(strlen($search) <= 2) { 
                  echo "Veuillez entré plus de caractères";
              } else{
                  $mot = "";
                  $search = preg_split('/[\s]/', $search); //on coupe les mots avec des espaces
                  $motscles = count($search); //on compte le nombre de mot clés
                  foreach ($search as $key => $searches) { // on boucle le nombre de mot clés trouvés et stock chaque mot dans searches key est son "id"
                      $mot .= "contenu LIKE '%$searches%'";  //
                      if($key != ($motscles-1)){ //quand il n'y a plus de mot clé, la valeur de key est différente donc on sort du if et de la boucle
                          $mot .=" AND ";
                      }
                  }
                  $query = mysql_query("SELECT * FROM articles WHERE $mot");
                  $ligne = mysql_num_rows($query);
                  if($ligne) {
                      while($data = mysql_fetch_assoc($query)) {
                          echo "<strong>Titre :</br>".$data['titre']."</strong/><br/>Contenu :<br/>".$data['contenu']."</br>";
                      }
                  } else {
                      echo "Pas de résultat trouvé...";
                  }

              }   
          }

          ?>