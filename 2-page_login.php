<?php
$bdd = new PDO('mysql:host=10.0.0.1;dbname=proj_physique;charset=utf8', 'root', 'root');
$rep = $bdd->query('SELECT identifiant, mot_de_passe FROM enseignant');	

while ($reponse_bdd = $rep->fetch())
{		
    $identifiant = isset($_POST['identifiant']) ? $_POST['identifiant'] : null;
    $mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : null;
    if ($identifiant && $mot_de_passe ) {
        if ($reponse_bdd['identifiant'] === $identifiant &&
            $reponse_bdd['mot_de_passe'] === $mot_de_passe) 
			{
				header("Location: test.html");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier',
                $identifiant,
                $mot_de_passe);
        }
    }
}
?>