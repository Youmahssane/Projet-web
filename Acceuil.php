
<?php 

Session_Start();	
$body="";
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/style.css" />
	<title></title>
</head>
<body>
<?php
if(isset($_SESSION['pseudo'])){

	if( isset($_SESSION['TypePers'])){
     
?>   <h1 >Bienvenue <?php  echo $_SESSION['pseudo'] ?>. Vous êtes connecter en tant que <?php echo $_SESSION['TypePers']?> </h1><hr></body></html>
	      <?php



if($_SESSION['TypePers'] == "specialiste" ){
// -> la page pour le spécialiste se trouve ici 
?>
 <ul><li><a href="Acceuil.php">Acceuil</a></li><li><a href="enchere.php">placer une enchère</a></li><li><a href="vente.php">Objet en Vente</a></li><li><a href="Contact.php">Contact</a></li></ul>

 <span> <strong> EN CONSTRUCTION !!!en attente de monsieur ilyass  </strong> </span>
 <?php 

 
}else{

//-> la page pour le client ici

?>
 <ul><li><a href="Acceuil.php">Acceuil</a></li></li><li><a href="vente.php">Objet en Vente</a></li><li><a href="Contact.php">Contact</a></li></ul>

 <span> <strong> EN CONSTRUCTION !!!  en attente de monsieur ilyass </strong> </span>
 <?php 




?>         






<?php


}
	


}else{
	
	}






}else{
	?><h1>vous n'avez pas accès à cette page... <a href="Connexion.php">retour à la page de connexion</a></h1>
         <?php
}

 ?>


</body>


</html>