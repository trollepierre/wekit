
	 <?php 
 	 
 	 if(isset($_COOKIE['lang'])) {
 	     $lang = $_COOKIE['lang'];
	 } else {
 	     // si aucune langue n'est d�clar�e on tente de reconnaitre la langue par d�faut du navigateur
	     $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
 }
 	 
 	 //script d'origine
 	 if ($lang=='fr') {           // si la langue est 'fr' (fran�ais) on inclut le fichier fr-lang.php
 	     include('lang/fr.php'); 
	 } elseif ($lang=='en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php
 	     include('lang/en.php'); 
	 }  else {                       // si aucune langue n'est d�clar�e on inclut le fichier en-lang.php par d�faut
		include('lang/en.php');
	}
 	 //fin du script d'origine
 	 
 	 //d�finition de la dur�e du cookie (1 an)
 	 $expire = 365*24*3600; 
 	 
	//enregistrement du cookie au nom de lang
 	 setcookie('lang', $lang, time() + $expire); 
 	 
 	 ?>