<?php 
require_once("Bdd.php");
session_start();
$sErreur = "";
if(isset($_POST['submit'])){

if(!empty($_POST['pseudo'] && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['pswd']) && !empty($_POST['cpswd']) && !empty($_POST['mail'])&& !empty($_POST['cmail'])&& !empty($_POST['jour'])&& !empty($_POST['mois'] )&& !empty($_POST['annee'])&& !empty($_POST['lieu'])&& !empty($_POST['TypePers']))){
         $sPseudo = htmlentities($_POST['pseudo']);       
          $sPrenom = htmlentities($_POST['prenom']);
         $sNom = htmlentities($_POST['nom']);
         $sLieu = htmlentities($_POST['lieu']);
         $pass = sha1($_POST['pswd']);
         $cpass = sha1($_POST['cpswd']);     
         $iLengPsd = strlen($sPseudo);$iLengPre = strlen($sPrenom);$ixLengNom = strlen($sNom);$iLengLieu = strlen($sLieu);
          if($iLengPsd< 30 ){if($iLengPre <30){if($iLengNom<25){if($iLengLieu<75){
            if($pass == $cpass){
            $mail =  htmlspecialchars($_POST['mail']);
            $cmail = htmlspecialchars($_POST['cmail']);
            if($mail == $cmail){      
                if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                 $reqmail = $dbh->prepare("SELECT * FROM BddMain WHERE mail = ?");
                 $reqmail->execute(array($mail));
                 $mailonbdd =$reqmail->rowcount();
                 if($mailonbdd==0){
                  $reqPseudo = $dbh->prepare("SELECT * FROM BddMain WHERE pseudo = ?");
                  $reqPseudo->execute(array($sPseudo));
                  $Pseudo =$reqPseudo->rowcount();

                  if($Pseudo == 0){


                 $sQuery = "INSERT INTO BddMain (pseudo,password,mail,nom,prenom,lieu,jour,mois,annee,TypePers) values (:pseudo,:password,:mail,:nom,:prenom,:lieu,:jour,:mois,:annee,:TypePers)";
                 $stmt = $dbh->prepare($sQuery);
                 $stmt->bindParam(':pseudo',$sPseudo,PDO::PARAM_STR);
                 $stmt->bindParam(':password',$pass,PDO::PARAM_STR);
                 $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
                 $stmt->bindParam(':nom',$sNom,PDO::PARAM_STR);
                 $stmt->bindParam(':prenom',$sPrenom,PDO::PARAM_STR);
                 $stmt->bindParam(':lieu',$sLieu,PDO::PARAM_STR);
                 $stmt->bindParam(':jour',$_POST['jour'],PDO::PARAM_INT);
                 $stmt->bindParam(':mois',$_POST['mois'],PDO::PARAM_STR);
                 $stmt->bindParam(':annee',$_POST['annee'],PDO::PARAM_INT);
                 $stmt->bindParam(':TypePers',$_POST['TypePers'],PDO::PARAM_STR);
                 $_SESSION['Pseudo'] = $sPseudo;
                $_SESSION['Nom'] = $sNom;
                 $_SESSION['Prenom'] = $sPrenom;
                 header('Location:Connexion.php'); 
                   
                   if(!$stmt->execute()){
                   $sErreur = "<tr><td>erreur</tr></td>";
                  }else{
                     $sErreur = "<tr><td>utilisateur ajouté</tr></td>";
                   }
                  }else{
                    $sErreur = "<tr><td>Pseudo deja utilisé</tr></td>";
                  }
                   }else{

                      $sErreur = "<tr><td>adresse email deja utilisé</tr></td>";
                   }
               }else{
              $sErreur = "<tr><td>Votre adresse mail n'est pas valide ! </tr></td>";
               }
              }else{
              $sErreur="<tr><td>Les mails ne sont pas identiques !</tr></td>";
              }
            }else{
           $sErreur="<tr><td>Les Mots de passe ne sont pas identiques !</tr></td>";
         }
     
     }else{
      $sErreur="<tr><td>Le Lieu ne doit pas dépasser 30 caractère !</tr></td>";
    }
  }else{
     $sErreur="<tr><td>Le Nom ne doit pas dépasser 30 caractère !</tr></td>";
    }
  }else{
     $sErreur="<tr><td>Le Prenom ne doit pas dépasser 30 caractère !</tr></td>";
  }
      }else{
        $sErreur="<tr><td>Le Pseudo ne doit pas dépasser 30 caractère !</tr></td>";
      }
  }else{
    $sErreur="<tr><td>Tous les champs doivent être remplie !</tr></td>";
  }
}else{

$sErreur="";
}
 




?>


<!DOCTYPE>
<html>
<head>

<title>Inscription</title>

<h1>INSCRIPTION</h1>
<table  border="0"  align="center">
    <form method="post" action="" name="insc" >
     
      <tr>
        <td > Créez un nom de compte. </td>
        <td><input type="text" name="pseudo" size="25" maxlength="30" placeholder=<?php if(isset($sPseudo)){ echo "$sPseudo";}else{ echo "Pseudo";} ?>  ></td>
      </tr>
      <tr>
        <td> Nom. </td>
        <td><input type="text" name="nom" size="25" maxlength="30" placeholder=<?php if(isset($sNom)){ echo "$snom";}else{ echo "Nom"; }?> </td>
      </tr>
      <tr>
        <td > Prenom. </td>
        <td><input type="text" name="prenom" size="25" maxlength="25" placeholder=<?php if(isset($sPrenom)){ echo "$sPrenom";}else{ echo "Prenom";}
         ?> </td>
      </tr>
      <tr>
        <td >Choisissez un mot de passe. </td>
        <td><input type="password" name="pswd" size="25" maxlength="40">
        </td>
      </tr>
      <tr>
      <tr>
        <td >Confirmez le mot de passe. </td>
        <td><input type="password" name="cpswd" size="25" maxlength="40" >
        </td>
      </tr>
      <tr>
        <td >Votre adresse e-mail actuelle. </td>
        <td><input type="mail" name="mail" size="25" maxlength="40">
        </td>
      </tr>
      <tr>
        <td >Confirmez votre adresse e-mail. </td>
        <td><input type="mail" name="cmail" size="25" maxlength="40">
        </td>
      </tr>
      <tr>
        <td >Date de naissance</td>
        <td><select name="jour">
           <?php
    for($i=1;$i<32;$i++){

    	echo "<option value=".$i.">".$i;
    }

          ?>
</option>
          </select>
          /
          <select name="mois">
            <option value="janvier">janvier 
            <option value="fevier">fevrier
            <option value="mars">mars
            <option value="avril">avril
            <option value="mai">mais
            <option value="juin">juin
            <option value="juillet">juillet
            <option value="aout">aout
            <option value="semptembre">semptembre
            <option value="octobre">octobre
            <option value="novembre">novembre
            <option value="decembre">decembre </option>
          </select>
          /
          <select name="annee">
          <?php

    for($i=2015;$i>1900;$i--){

    	echo "<option value=".$i.">".$i;
    }

          ?>
           </option>
          </select>
        </td>
      </tr>
      <tr>
        <td > lieu de naissance </td>
        <td><select name="lieu">
<option value="Belgique" selected="selected">Belgique</option>

<option value="Afghanistan">Afghanistan </option>
<option value="Afrique_Centrale">Afrique_Centrale </option>
<option value="Afrique_du_sud">Afrique_du_Sud </option>
<option value="Albanie">Albanie </option>
<option value="Algerie">Algerie </option>
<option value="Allemagne">Allemagne </option>
<option value="Andorre">Andorre </option>
<option value="Angola">Angola </option>
<option value="Anguilla">Anguilla </option>
<option value="Arabie_Saoudite">Arabie_Saoudite </option>
<option value="Argentine">Argentine </option>
<option value="Armenie">Armenie </option>
<option value="Australie">Australie </option>
<option value="Autriche">Autriche </option>
<option value="Azerbaidjan">Azerbaidjan </option>

<option value="Bahamas">Bahamas </option>
<option value="Bangladesh">Bangladesh </option>
<option value="Barbade">Barbade </option>
<option value="Bahrein">Bahrein </option>
<option value="Belgique">Belgique </option>
<option value="Belize">Belize </option>
<option value="Benin">Benin </option>
<option value="Bermudes">Bermudes </option>
<option value="Bielorussie">Bielorussie </option>
<option value="Bolivie">Bolivie </option>
<option value="Botswana">Botswana </option>
<option value="Bhoutan">Bhoutan </option>
<option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
<option value="Bresil">Bresil </option>
<option value="Brunei">Brunei </option>
<option value="Bulgarie">Bulgarie </option>
<option value="Burkina_Faso">Burkina_Faso </option>
<option value="Burundi">Burundi </option>

<option value="Caiman">Caiman </option>
<option value="Cambodge">Cambodge </option>
<option value="Cameroun">Cameroun </option>
<option value="Canada">Canada </option>
<option value="Canaries">Canaries </option>
<option value="Cap_vert">Cap_Vert </option>
<option value="Chili">Chili </option>
<option value="Chine">Chine </option>
<option value="Chypre">Chypre </option>
<option value="Colombie">Colombie </option>
<option value="Comores">Colombie </option>
<option value="Congo">Congo </option>
<option value="Congo_democratique">Congo_democratique </option>
<option value="Cook">Cook </option>
<option value="Coree_du_Nord">Coree_du_Nord </option>
<option value="Coree_du_Sud">Coree_du_Sud </option>
<option value="Costa_Rica">Costa_Rica </option>
<option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
<option value="Croatie">Croatie </option>
<option value="Cuba">Cuba </option>

<option value="Danemark">Danemark </option>
<option value="Djibouti">Djibouti </option>
<option value="Dominique">Dominique </option>

<option value="Egypte">Egypte </option>
<option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
<option value="Equateur">Equateur </option>
<option value="Erythree">Erythree </option>
<option value="Espagne">Espagne </option>
<option value="Estonie">Estonie </option>
<option value="Etats_Unis">Etats_Unis </option>
<option value="Ethiopie">Ethiopie </option>

<option value="Falkland">Falkland </option>
<option value="Feroe">Feroe </option>
<option value="Fidji">Fidji </option>
<option value="Finlande">Finlande </option>
<option value="France">France </option>

<option value="Gabon">Gabon </option>
<option value="Gambie">Gambie </option>
<option value="Georgie">Georgie </option>
<option value="Ghana">Ghana </option>
<option value="Gibraltar">Gibraltar </option>
<option value="Grece">Grece </option>
<option value="Grenade">Grenade </option>
<option value="Groenland">Groenland </option>
<option value="Guadeloupe">Guadeloupe </option>
<option value="Guam">Guam </option>
<option value="Guatemala">Guatemala</option>
<option value="Guernesey">Guernesey </option>
<option value="Guinee">Guinee </option>
<option value="Guinee_Bissau">Guinee_Bissau </option>
<option value="Guinee equatoriale">Guinee_Equatoriale </option>
<option value="Guyana">Guyana </option>
<option value="Guyane_Francaise ">Guyane_Francaise </option>

<option value="Haiti">Haiti </option>
<option value="Hawaii">Hawaii </option>
<option value="Honduras">Honduras </option>
<option value="Hong_Kong">Hong_Kong </option>
<option value="Hongrie">Hongrie </option>

<option value="Inde">Inde </option>
<option value="Indonesie">Indonesie </option>
<option value="Iran">Iran </option>
<option value="Iraq">Iraq </option>
<option value="Irlande">Irlande </option>
<option value="Islande">Islande </option>
<option value="Israel">Israel </option>
<option value="Italie">italie </option>

<option value="Jamaique">Jamaique </option>
<option value="Jan Mayen">Jan Mayen </option>
<option value="Japon">Japon </option>
<option value="Jersey">Jersey </option>
<option value="Jordanie">Jordanie </option>

<option value="Kazakhstan">Kazakhstan </option>
<option value="Kenya">Kenya </option>
<option value="Kirghizstan">Kirghizistan </option>
<option value="Kiribati">Kiribati </option>
<option value="Koweit">Koweit </option>

<option value="Laos">Laos </option>
<option value="Lesotho">Lesotho </option>
<option value="Lettonie">Lettonie </option>
<option value="Liban">Liban </option>
<option value="Liberia">Liberia </option>
<option value="Liechtenstein">Liechtenstein </option>
<option value="Lituanie">Lituanie </option>
<option value="Luxembourg">Luxembourg </option>
<option value="Lybie">Lybie </option>

<option value="Macao">Macao </option>
<option value="Macedoine">Macedoine </option>
<option value="Madagascar">Madagascar </option>
<option value="Madère">Madère </option>
<option value="Malaisie">Malaisie </option>
<option value="Malawi">Malawi </option>
<option value="Maldives">Maldives </option>
<option value="Mali">Mali </option>
<option value="Malte">Malte </option>
<option value="Man">Man </option>
<option value="Mariannes du Nord">Mariannes du Nord </option>
<option value="Maroc">Maroc </option>
<option value="Marshall">Marshall </option>
<option value="Martinique">Martinique </option>
<option value="Maurice">Maurice </option>
<option value="Mauritanie">Mauritanie </option>
<option value="Mayotte">Mayotte </option>
<option value="Mexique">Mexique </option>
<option value="Micronesie">Micronesie </option>
<option value="Midway">Midway </option>
<option value="Moldavie">Moldavie </option>
<option value="Monaco">Monaco </option>
<option value="Mongolie">Mongolie </option>
<option value="Montserrat">Montserrat </option>
<option value="Mozambique">Mozambique </option>

<option value="Namibie">Namibie </option>
<option value="Nauru">Nauru </option>
<option value="Nepal">Nepal </option>
<option value="Nicaragua">Nicaragua </option>
<option value="Niger">Niger </option>
<option value="Nigeria">Nigeria </option>
<option value="Niue">Niue </option>
<option value="Norfolk">Norfolk </option>
<option value="Norvege">Norvege </option>
<option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
<option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

<option value="Oman">Oman </option>
<option value="Ouganda">Ouganda </option>
<option value="Ouzbekistan">Ouzbekistan </option>

<option value="Pakistan">Pakistan </option>
<option value="Palau">Palau </option>
<option value="Palestine">Palestine </option>
<option value="Panama">Panama </option>
<option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
<option value="Paraguay">Paraguay </option>
<option value="Pays_Bas">Pays_Bas </option>
<option value="Perou">Perou </option>
<option value="Philippines">Philippines </option>
<option value="Pologne">Pologne </option>
<option value="Polynesie">Polynesie </option>
<option value="Porto_Rico">Porto_Rico </option>
<option value="Portugal">Portugal </option>

<option value="Qatar">Qatar </option>

<option value="Republique_Dominicaine">Republique_Dominicaine </option>
<option value="Republique_Tcheque">Republique_Tcheque </option>
<option value="Reunion">Reunion </option>
<option value="Roumanie">Roumanie </option>
<option value="Royaume_Uni">Royaume_Uni </option>
<option value="Russie">Russie </option>
<option value="Rwanda">Rwanda </option>

<option value="Sahara Occidental">Sahara Occidental </option>
<option value="Sainte_Lucie">Sainte_Lucie </option>
<option value="Saint_Marin">Saint_Marin </option>
<option value="Salomon">Salomon </option>
<option value="Salvador">Salvador </option>
<option value="Samoa_Occidentales">Samoa_Occidentales</option>
<option value="Samoa_Americaine">Samoa_Americaine </option>
<option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
<option value="Senegal">Senegal </option>
<option value="Seychelles">Seychelles </option>
<option value="Sierra Leone">Sierra Leone </option>
<option value="Singapour">Singapour </option>
<option value="Slovaquie">Slovaquie </option>
<option value="Slovenie">Slovenie</option>
<option value="Somalie">Somalie </option>
<option value="Soudan">Soudan </option>
<option value="Sri_Lanka">Sri_Lanka </option>
<option value="Suede">Suede </option>
<option value="Suisse">Suisse </option>
<option value="Surinam">Surinam </option>
<option value="Swaziland">Swaziland </option>
<option value="Syrie">Syrie </option>

<option value="Tadjikistan">Tadjikistan </option>
<option value="Taiwan">Taiwan </option>
<option value="Tonga">Tonga </option>
<option value="Tanzanie">Tanzanie </option>
<option value="Tchad">Tchad </option>
<option value="Thailande">Thailande </option>
<option value="Tibet">Tibet </option>
<option value="Timor_Oriental">Timor_Oriental </option>
<option value="Togo">Togo </option>
<option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
<option value="Tristan da cunha">Tristan de cuncha </option>
<option value="Tunisie">Tunisie </option>
<option value="Turkmenistan">Turmenistan </option>
<option value="Turquie">Turquie </option>

<option value="Ukraine">Ukraine </option>
<option value="Uruguay">Uruguay </option>

<option value="Vanuatu">Vanuatu </option>
<option value="Vatican">Vatican </option>
<option value="Venezuela">Venezuela </option>
<option value="Vierges_Americaines">Vierges_Americaines </option>
<option value="Vierges_Britanniques">Vierges_Britanniques </option>
<option value="Vietnam">Vietnam </option>

<option value="Wake">Wake </option>
<option value="Wallis et Futuma">Wallis et Futuma </option>

<option value="Yemen">Yemen </option>
<option value="Yougoslavie">Yougoslavie </option>

<option value="Zambie">Zambie </option>
<option value="Zimbabwe">Zimbabwe </option>

</select>
        </td>
      </tr>
      <tr>
        <td > Sexe </td>
        <td><input type="radio" name="TypePers" value="Specialiste" >
          Spécialiste
          <input type="radio" name="TypePers" value="Client" checked>
          Client </td>
      </tr>     
      <tr>
      <tr>
      <tr>
       <td colspan="2"></td></tr>
      <tr align="center">
        <td colspan="2"><input name="submit" type="submit" value="Envoyer">
            <input name="reset" type=reset value="Annuler">
			<input type="hidden" value="2" name="OK" />
        </td>
      </tr>
    </form>
    <?php 

      echo $sErreur;

    ?>
  </table>

</body>
</html>
<?php




	?>