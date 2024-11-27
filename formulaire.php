<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>S'inscrire à la newsletter</title>
	</head>
	<body>
		<?php
		//enregistrer le mail dans une base de donnée ou le recevoir par mail ?
		$queFaitOn = 'mail'; //'mail' ou 'bdd'

		//votre mail pour recevoir les nouvelles adresses:
		$mail_admin='mon@email.com';


		//si le bouton "S'inscrire" est cliqué, on traite le formulaire
		if(!empty($_POST['mail'])){
			
			//on vérifie la validité de l'adresse mail
			if(!preg_match("#^[-\w]+((\.[-\w]+){1,})?@[-\w]+\1?\.[a-z]{2,}$#i",$_POST['mail']))
				echo "<p>L'adresse mail est incorrecte.</p>";
			else {
				
				//soit on s'envoi le mail par courriel, soit un l'enregistre dans une base de données
				
				if($queFaitOn == 'mail'){
					
					//l'envoyer par mail
					mail($mail_admin,"Nouveau mail","Nouvelle inscription newsletter pour {$_SERVER['HTTP_HOST']} : ".$_POST['mail']);
				
				} else {
					
					//l'enregistrer en BDD
					
					//il vous faudra bien évidemment ouvrir un connexion MySQLi avec mysqli_connect() et créer la table newsletter
					
					//juste par sécurité, il vous faudra protéger contre les attaques de injections SQL mais avec la preg_match ya pas besoin :)
					mysqli_query($mysqli,"INSERT INTO newsletter SET mail='".$_POST['mail']."'");
				
				}
				
				echo "<p>Merci pour inscription, nous allons bientôt vous envoyer nos newsletters !</p>";
			}
			
		}


		?>
		<form method="post">
			Inscrivez-vous à notre Newsletter !
			<br/>
			<input type="text" name="mail" placeholder="Votre email" />
			<br/>
			<input type="submit" value="S'inscrire" />
		</form>
	</body>
</html>