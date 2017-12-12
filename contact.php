<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1> Messagerie</h1>


<?php    
session_start();
require("Bdd.php");
$sErreur ="";
if(isset($_POST['submit'])){

$spseudo = htmlentities($_POST['pseudo']);
$sobjet = htmlentities($_POST['titre']);
$message = htmlentities($_POST['Message']);

$lengpseudo = strlen($spseudo);

if($lengpseudo <25){

if(strlen($sobjet) < 125){


if(strlen($message)<255){



$req = $dbh->prepare("SELECT pseudo FROM bddmain where pseudo=:pseudo");
         
         $req->bindParam(':pseudo',$spseudo,PDO::PARAM_STR);
        $req->execute(); 
        $ifindpseudo = $req->rowcount();

        if($ifindpseudo ==1){
        



        }    

    }else{
	  $sErreur="<tr><td> L'Expediteur ne doit pas dépasser 30 caractère !</tr></td>";

    }
}else{
	  $sErreur="<tr><td> L'objet ne doit pas dépasser 125 caractère !</tr></td>";

}
}else{
	$sErreur="<tr><td> le message  ne doit pas dépasser 255 caractère !</tr></td>";

}
}



?> 

<form method="post">
<table>
	
     <tr><td>Expediteur : </td> <td><input name =pseudo size="98"  maxlength="25" type="text" placeholder="à"></td></tr>  
     <tr><td>Objet : </td> <td><textarea  name="titre" rows ="1"   maxlength ="125" cols ="75" type="text" placeholder="Objet"></textarea></td></tr>
<tr><td>Message : </td> <td><textarea  name="Message" rows ="6"   maxlength ="255" cols ="75" type="text" placeholder="Message"></textarea></td></tr>
<tr colspan="2"><td colspan="2"><div id ="advertissement"> Le Message ne doit pas dépasser plus de 255 charactère.</div></td></tr>
<tr><td><input type=submit value="send it !"></td></tr>
</table>
</form>
</body>
</html>


<?php 





?>