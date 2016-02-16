<?php   
    session_start();//On démarre les sessions
    $_SESSION['token'] = (isset($_SESSION['token'])) ? $_SESSION['token'] : uniqid(rand(), true) ;//Génération de jeton unique
    $_SESSION['token_time'] = time();//Enregistrement d'un timestamp
?>
<!DOCTYPE HTML>

<?php
require("lang.php");
function spamcheck($field)
{
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL))    {
    return TRUE;
  }else{
	return FALSE;
  }
}
?>

<html lang="fr">
<head>
	<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="title" content="Recontact - reste en contact avec tes potes !"/>
	<meta name="description" content="Recontact - reste en contact avec tes potes !"/>
	<meta property="og:title" content="Recontact - reste en contact avec tes potes ! "/>
		<title>Recontact - reste en contact avec tes potes !</title>
	<link rel="shortcut icon" href="img/logo.png">  
	<link rel="index" title="Recontact" href="http://recontact.alwaysdata.net/"> 
	<link rel="canonical" href="http://recontact.alwaysdata.net/">
	<link href="css/recontact.css" rel="stylesheet"/>	
</head>

<body>
	<?php include_once("analyticstracking.php") ?>
	<div id="fondtransparent" class="looseScroll">
		<div id="header"> 
			<div id="w1logo"></div>
			<div id="name"><h1> R e c o n t a c t </h1></div>
		</div>

		<div id=lang-box>	
			<div id=lang-flag>
				<img src="<?php echo DRAPEAU; ?>" />
			</div>
            <div id=lang-name> <a class="lang-name" href=""  title="Change Language" style="font-weight: bold">
				<?php require("langchange.php"); echo LANGUE; ?></a><br/>
            </div>
          </div>
  
		<div id="coeur">
			<div id="slogan"><?php echo SLOGAN; ?>	</div>
			<div id="wanna">
<?php
	if (isset($_GET['done'])) {
	// On affiche les codes
	echo RECU;
    }else{
		if (!isset($_POST["submit"]))  {   ?>
			<h6><?php echo WANNA; ?></h6>
			<form id="form" name="form" method="post" action="traitementrecontact.php">
			<p>	<label for="mail">E-mail :</label>
			<input type="hidden" name="token" id="token" value="<?php echo $_SESSION['token'];?>"/>
			<input type="email" name="email" id="email" placeholder="mail@email.com" size="30" maxlength="50" />	
			<input type="submit" value="GO" />
			</p>
		<?php 
		}else{// the user has submitted the form
			if (isset($_POST["email"])) { // Check if the "from" input field is filled out
				$mail = htmlentities($email);  // virer les saloperies de code
				$mailcheck = spamcheck($_POST["mail"]); // Check if "email" email address is valid
				if ($mailcheck==FALSE) {
				echo "Invalid input";
				}else{
				$temps = 3600*24;   //Vous passez en argument le temps de validité (en secondes)
				
				$mail = $_POST["mail"]; // sender
				
				// send mail
		 ?>	</form>
		<?php 	echo "Thank you for sending us feedback";
				}
			}
		}
	} ?>
			</div>		
		</div>

		<div class="footer">
			<ul class="footerLinks clearfix">
				<li>&copy; Copyright Recontact by Pierre T. 2014</li>
				<li><a href="mailto:recontactme@gmail.com">recontactme@gmail.com</a><br/></li>
				<li><a href="https://www.facebook.com/pages/Recontact-Your-Friends/1395092844077348" target="_blank">Facebook</a></li>
			</ul>
		</div>

	</div>
</body>

</html>