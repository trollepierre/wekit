<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-49332901-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
 // Connexion à la base de données
$host = 'mysql1.alwaysdata.com';
    $database = 'recontact_mails';
    $user = 'recontact';
    $pass = 'kit';
try{
	$bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database , $user , $pass);
}catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

// Récupération des variables nécessaires à l'activation
$email = $_GET['email'];
$cle = $_GET['cle'];
 
// Récupération de la clé correspondant au $login dans la base de données
$stmt = $bdd->prepare("SELECT cle,actif FROM membres WHERE email like :email ");
if($stmt->execute(array(':email' => $email)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];	// Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $stmt = $dbh->prepare("UPDATE membres SET actif = 1 WHERE email like :email ");
          $stmt->bindParam(':email', $email);
          $stmt->execute();
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
 
 
//...	
// Fermeture de la connexion	
//...
// Votre code
//...
  