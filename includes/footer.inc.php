<?php 
include('connexion.inc.php');
include('verif_user.inc.php') ?>
  <script src="assets/js/jquery-1.8.2.js"></script>
  
  
  </div>
          
          <nav class="span4">
            <h2>Menu</h2>
            
             <ul style= "dispaly: none">
				<li><a href="index.php">Accueil</a></li>
				<?php if ($connecte==false){?>
				<li><a href="connexion.php">Connexion</a></li>
				<li><a href="inscription.php">Inscription</a></li>
				<?php } ?>
				<?php if($connecte==true){ // test de connection pour l'affichage de rediger article?>
                <li><a href="articles.php">Rédiger un article</a></li>				
				<?php }?>
					
				 <input type="email" id="email"  placeholder="votre email">
            	 <input type="button" id="ok" class="btn btn-primary btn-sm" value="ok">
            	 <p id="abonne" style="color:green; display: none;">Vous êtes  Abonné! </p>
            	 <p id="dejabo" style="color:blue; display: none;">Vous êtes Déjà Abonné! </p>
            	 <p id="invalide" style="color:red; display: none;">Email invalide! </p>
			</ul> 
          </nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; Nilsine & ULCO 2016</p>

      </footer>

    </div>
	
	
<script type="text/javascript">

$(document).ready(function(){ 
	 $('.span4').mouseenter(function(){  
			$('.span4 ul').slideDown();
	 });
	 $('.span4').mouseleave(function(){
			$('.span4 ul').slideUp(200);
			
	 });
});
$('#ok').click(function(){
	var xhr=	$.ajax ({
		url : 'newsletter.php',
		type:'POST',
		data: {email :  $('#email').val()},
	    success: function(){
	    	if(xhr.responseText== "OK"){
		    	$("#abonne").show().delay(4000).fadeOut();
		    	$("#dejabo").hide();
		    	$("#invalide").hide();

	    	}
	    	if(xhr.responseText=="FALSE"){
		    	$("#abonne").hide();
		    	$("#dejabo").show().delay(4000).fadeOut();
		    	$("#invalide").hide();
	    	}
	    	else if(xhr.responseText=="INVALIDE"){
		    	$("#abonne").hide();
		    	$("#dejabo").hide();
		    	$("#invalide").show().delay(4000).fadeOut();
	    	}
	    }
		});				
	});

</script>
  </body>
</html>