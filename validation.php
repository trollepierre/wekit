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
 // Connexion � la base de donn�es
$host = 'mysql1.alwaysdata.com';
    $database = 'recontact_mails';
    $user = 'recontact';
    $pass = 'kit';
try{
	$bdd = new PDO('mysql:host=' . $host . ';dbname=' . $database , $user , $pass);
}catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

// R�cup�ration des variables n�cessaires � l'activation
$email = $_GET['email'];
$cle = $_GET['cle'];
 
// R�cup�ration de la cl� correspondant au $login dans la base de donn�es
$stmt = $bdd->prepare("SELECT cle,actif FROM membres WHERE email like :email ");
if($stmt->execute(array(':email' => $email)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];	// R�cup�ration de la cl�
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif r�cup�r� dans la BDD
if($actif == '1') // Si le compte est d�j� actif on pr�vient
  {
     echo "Votre compte est d�j� actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux cl�s	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien �t� activ� !";
 
          // La requ�te qui va passer notre champ actif de 0 � 1
          $stmt = $dbh->prepare("UPDATE membres SET actif = 1 WHERE email like :email ");
          $stmt->bindParam(':email', $email);
          $stmt->execute();
       }
     else // Si les deux cl�s sont diff�rentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut �tre activ�...";
       }
  }
 
 
//...	
// Fermeture de la connexion	
//...
// Votre code
//...
  