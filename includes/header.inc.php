<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Mon blog</title>
    <meta name="description" content="Petit blog pour m'initier à PHP">
    <meta name="author" content="Jean-philippe Lannoy">  
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

    <script src="assets/js/bjqs-1.3.min.js"></script>
    <script src="assets/js/bjqs-1.3.js"></script>
    <script src="assets/js/jquery.secret-source.min.js"></script>

    <link type="text/css" rel="Stylesheet" href="assets/css/bjqs.css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="page-header well">
		 <form  class ="navbar-form navbar-right inline-form" method="post">
				<h1>Blog  de Bourhis Sébastien</h1>	
				 <div class="form-group">
            <input type="search" name="search" class="input-sm form-control" placeholder="Votre recherche...">
            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Rechercher">
			</div>
          </form>
        </div>
		  <div class="row">
          <div class="span8">
         
	
	   <?php
          $mot = "";
          if(isset($_POST['submit'])) {
              $search = mysql_real_escape_string(htmlspecialchars(trim($_POST['search'])));
              if(empty($search)){
                  echo "Vous n'avez pas entré de mot clé";
              //si il y au moins 2 caractère 
              } else if(strlen($search) <= 2) { 
                  echo "Veuillez entré plus de caractères";
              } else{
                  $mot = "";
                  $search = preg_split('/[\s]/', $search); // coupe les mots avec des espaces
                  $motscles = count($search); // compte le nombre de mot clés
                  foreach ($search as $key => $searches) { // on stock tout les resultat 
                      $mot .= "contenu LIKE '%$searches%'";  //
                      if($key != ($motscles-1)){ //quand il n'y a plus de mot clé on sort de la boucle
                          $mot .=" AND ";
                      }
                  }
                  $query = mysql_query("SELECT * FROM articles WHERE $mot");// selectionne les articles
                  $ligne = mysql_num_rows($query);
                  if($ligne) {//si on trouve les article comprennend les mots
                      while($data = mysql_fetch_assoc($query)) {
                          echo "<h3></br>".$data['titre']."</h3/><br/><br/>".$data['contenu']."</br></br>";// affiche les articles comprennend les mot clés
                      }
                  } else { //sinon
                      echo "Pas de résultat trouvé...";
                  }

              }   
          }

          ?>