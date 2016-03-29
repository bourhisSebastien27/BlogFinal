 Compte utilisateur : adresse E-mail: jp.lannoy@nilsine.fr   mdp: nilsine

inscription (code présent dans inscription.php): 

Tout d'abord je test si tout les champs du formulaire sont remplis,
ensuite je récupère tout les utilisateur de la table "utilisateur",
je test si les champs remplis ne sont pas identitque au champs utilisateur déjà inscrit
si il n'y as pas de concordance alors je crée l'utilisateur
sinon j'indique que cette utilisateur existe déjà et je met à jour l'utilisateur.

recherche (code présent dans header.inc.php) :
Tout d'abord nous récupérons les mot clés ecrit
ensuite on récupère tout les articles dans la base de donnée 
et on test si les mots clés écrit sont dans les articles
si oui on retourne le(s) titre(s) et l'article ou les articles
sinon on affiche un message d'erreur

