 <?php 
 ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<h1>VOS ENCHERES </h1>
</body>
</html>




 <?php
require_once("Bdd.php");

$req = $dbh->prepare("SELECT * FROM produit ");  
    $req->execute();
    while($allVente = $req->fetch()){
      $degree=$allVente['TimeLeft'];
  
        echo <<<EOT
        
            
            <b><h2>{$allVente['Titre']}</h2> </b>

            <table>
                <tr>
                    <th>Prix :</th><td>{$allVente['Prix']}</td>
                </tr>
                <tr>
                    <th>Quantite :</th><td>{$allVente['Quantite']}</td>
                </tr>
                <tr>
                    <th>Provenance :</th><td>{$allVente['Provenance']}</td>
                </tr>
                <tr>
                    <th>Temps restant :
EOT;


?> </th><td>

   
</td></tr> <tr> </table>
  <?php  }?> 
 ?>


 <!DOCTYPE>
<html>
    <head>
      
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
                <meta http-equiv="Content-Language" content="fr" />
    </head>
       
    <body>
                               
                <script language="JavaScript">
               
                function t()
                {
            var compteur=document.getElementById('compteur');
           
            duree= 3600;
            s=duree;
            m=0;h=0;
            if(s<0)
                        {
                                compteur.innerHTML="terminé<br />"
                           
            }
                        else
                        {
                                if(s>59)
                                {
                                        m=Math.floor(s/60);
                                        s=s-m*60
                }
                                if(m>59)
                                {
                                        h=Math.floor(m/60);
                    m=m-h*60
                                }
                if(s<10)
                                {
                                        s="0"+s
                }
                if(m<10)
                                {
                    m="0"+m
                }
                  compteur.innerHTML=h+":"+m+":"+s;
            }
            duree=duree-1;
            window.setTimeout("t();",999);

        }
               
                </script>
                <div id="compteur"></div>
                <script language="JavaScript">
                        t();
                </script>
        </body>
</html>
