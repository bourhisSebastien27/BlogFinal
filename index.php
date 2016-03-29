<?php
include('includes/connexion.inc.php');
include('includes/header.inc.php');
include('includes/verif_user.inc.php');
include('slide.php');
?>



<?php
	$result=mysql_query("SELECT * FROM articles");
	while($data= mysql_fetch_array($result)){// on retourne les articles 1 par 1
		echo '<h3>'.$data['titre'].'</h3>';
		
	$img= dirname(__FILE__).'/data/image/'.$data['id'].'.jpg';
	if(file_exists($img))	//on test si il y a bien une image enregistré pour l'article de cette id
	{	//si oui on l'affiche
		echo '<img src="data/image/'.$data['id'].'.jpg" class= pull-left style= margin-right:10px>';
		}
		else echo"☺☻"; //sinon on affiche des caractère spéciaux
		
		echo '<p>'.nl2br(htmlspecialchars($data['contenu'])).'</p>';
		echo date("M d Y H:i",$data['date']);
		$prenom=$data['id_util'];
		$prenomutilisateur = mysql_query("SELECT prenom FROM utilisateurs WHERE id_util='$prenom'");
		$prenomutil=mysql_fetch_array($prenomutilisateur);
		echo ' écrit par '.$prenomutil['prenom'];
		
		if($connecte==true){// si on est connecter alors on affiche les boutons
		echo '<a class ="btn btn-primary" href="articles.php?id='.$data['id'].'" value="<?php echo $id ?>"> modifier</a>';
		echo '<a class ="btn btn-primary" href="includes/supprimer_articles.php?id='.$data['id'].'" value="<?php echo $id ?>"> supprimer</a>';
			}
			echo"<br>";
			echo '<a class="jaime" id="like" onClick="like()">like</a>';
			
			
		echo '<div style="clear:both;"></div>';// utiliser pour retourner a la ligne a chaque fin d'article
			
	}

include('includes/footer.inc.php');
?>
<script type="text/javascript">

var Jaime = {
	evenements: function() {
//		$('a.jaime').click(this.click);
		$('a.jaime').click(Jaime.click);
	},
	precharger: function() {
		var jaimes = $('a.jaime');
		l = jaimes.length
		for(var i = 0 ; i < l; i++) {
			$.ajax({
				context: jaimes[i], // $(this)
				type: 'POST',
				url: 'vote.php',
				data: 'cle=' + encodeURIComponent($(jaimes[i]).attr('title')),
				success: function(data) {
					var votes = parseInt(data);
					if(isNaN(votes)) {votes = '-1';}
					if(votes > 0) {
						$(this).html('Jaime <em>(' + votes + ')</em>');
					} else {
						$(this).html('Jaime');
					}
				}
			});
		} // for
	},
	click: function(event) {
		var element = event.currentTarget; // comme this ( et non: event.target )
		$(element).unbind('click'); // stopper les multi-clicks
		$(element).click(function() { return false; }); // blocage du lien
		
		$.ajax({
			context: element, // $(this)
			type: 'POST',
			url: 'vote.php',
			data: 'vote=&cle=' + encodeURIComponent($(element).attr('title')),
			success: function(data) {
				var votes = parseInt(data);
				if(isNaN(votes)) {votes = '-1';}
				if(votes > 1) {
					$(this).html(votes + ' personnes aiment &ccedil;a');
				} else {
					$(this).html(votes + ' personne aime &ccedil;a');
				}
				$(this).animate({'opacity':1}, {'duration':'slow'});
			},
			error: function() {
				alert('Une erreur s\'est produite, merci de recharger votre page');
			}
		});
		return false;
	}
};

$(document).ready(function() {
	Jaime.evenements();
	Jaime.precharger();
});


</script>
