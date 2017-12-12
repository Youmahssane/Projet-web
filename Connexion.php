<!DOCTYPE html>
<?php 
require_once('Bdd.php');

session_start();

$sErreur ="";
$spseudo="";
if(isset($_GET['submit'])){
 $spseudo = htmlentities($_GET['pseudo']);

 $speudolength = strlen($spseudo);
$mdplength = strlen($_GET['mdp']);
 if($speudolength <30){ 
  if($mdplength <30){ 
     $smdp = sha1($_GET['mdp']); 
 $req = $dbh->prepare("SELECT * FROM BddMain WHERE pseudo=:pseudo AND password=:password");  
 $req->bindParam(':pseudo',$spseudo,PDO::PARAM_STR);
 $req->bindParam(':password',$smdp,PDO::PARAM_STR);
 $req->execute();
 $iNbResult = $req->rowCount();
 if($iNbResult ==1){
 	$userinfo = $req->fetch();
 	 $sErreur ="<tr><td>CONNEXION ok</tr></td>";
   $_SESSION['id'] = $userinfo['id'];
    $_SESSION['pseudo'] = $userinfo['pseudo'];
     $_SESSION['mail'] = $userinfo['mail'];
     $_SESSION['TypePers'] = $userinfo['TypePers'];
     header("Location: Acceuil.php");
  }else{
      $sErreur ="<tr><td>Nom de compte ou de mot de passe incorecte</tr></td>";
  }
}else{
    $sErreur ="<tr><td>Le mot de passe est trop long.</tr></td>";
}
}else{
      $sErreur ="<tr><td>Le pseudo est trop long.</tr></td>";
}
}
?>
<html>
<head>
<title>Connexion</title>
</head>
<body>
<h1>CONNEXION</h1>
<h2 align="center"> Connecter vous ! </h2>
    <form>
   <table  border="0"  align="center">
    <form method="get" action="" name="connex" >
     
      <tr>
        <td > Nom de compte. </td>
        <td><input type="text" name="pseudo" size="25" maxlength="30"  placeholder="pseudo"   ></td>
      </tr>
      <tr>
        <td> Mot de passe</td>
        <td><input type="password" name="mdp" size="25" maxlength="30" placeholder="Mot de passe"></td>
      </tr>
      <tr>
        <td colspan="2">Pas de compte ? <a href="inscription.php">clique ici ! </a></td></tr>
    <td colspan="2"><input name="submit" type="submit" value="Connectez-vous">
            <input name="reset" type=reset value="Annuler">
			<input type="hidden" value="2" name="OK" /></td>
        </td>
    
    
    </table>
    
    
    
    
    
    </form>


</body>
</html>



<?php




	echo $sErreur;






?>