<?php 

require_once 'esame_auth.php';
 
if (!$userid = checkAuth()) {
    header("Location: esame_login.php");
    exit;
}

?>


<!DOCTYPE html>
<html>

<head>

<title>Broken</title>
<link rel='stylesheet' href='esame_thankyou.css'>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='esame_thankyou.js' defer></script>
<meta name="robots" content="noindex">
<meta charset="utf-8">
<meta content="IE=Edge" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="iframe" content="standalone">
<script type="text/javascript" src="https://books.google.com/books/previewlib.js"></script>





<script nonce="PeH85XN7hBKm2l5JbEuMigCWm5FLPy">
  (function(){
    window.framebox=window.framebox||function(){(window.framebox.q=window.framebox.q||[]).push(arguments)};
    
    var a={},b=function(){(window.framebox.dq=window.framebox.dq||[]).push(arguments)};
    ['getUrl','handleLinkClicksInParent','initAutoSize','navigate','pushState','replaceState',
     'requestQueryAndFragment','sendEvent','updateSize'].forEach(function(x){a[x]=function(){
      b(x,arguments)}});
    window.devsite={framebox:{AutoSizeClient:a}};
  })();
  
  (function(d,e,v,s,i,t,E){d['GoogleDevelopersObject']=i;
    t=e.createElement(v);t.async=1;t.src=s;E=e.getElementsByTagName(v)[0];
    E.parentNode.insertBefore(t,E);})(window, document, 'script',
    'https://www.gstatic.com/devrel-devsite/prod/v1a2d2d725c48303ffd65eb7122e57032dbf9bb148227658cacdfddf0dcae1e46/developers/js/app_loader.js', '[1,"it",null,"/js/devsite_app_module.js","https://www.gstatic.com/devrel-devsite/prod/v1a2d2d725c48303ffd65eb7122e57032dbf9bb148227658cacdfddf0dcae1e46","https://www.gstatic.com/devrel-devsite/prod/v1a2d2d725c48303ffd65eb7122e57032dbf9bb148227658cacdfddf0dcae1e46/developers","https://developers-dot-devsite-v2-prod.appspot.com",null,1,null,1,null,[1,6,8,12,14,17,21,25,40,50,63,70,75,76,80,87,91,92,93,97,98,100,101,102,103,104,105,107,108,109,110,111,112,113,115,117,118,120,122,124,125,126,127,129,130,131,132,133,134,135,136,138,140,141,144,147,148,149,150,151,152,154,155,156,157,158,159,161,163,164,165,168,169,170,172,173,179,180,182,183,186,191,193],"AIzaSyAP-jjEJBzmIyKR4F-3XITp8yM9T1gEEI8","AIzaSyB6xiKGDR5O3Ak2okS4rLkauxGUG7XP0hg","developers.google.com","AIzaSyAQk0fBONSGUqCNznf6Krs82Ap1-NV6J4o","AIzaSyCCxcqdrZ_7QMeLCRY20bh_SXdAYqy70KY"]')
  
  </script>

<?php ob_start(); ?> 

</head>

<div id="wrap">
    <div class="header">
        <a id=logo>Viviscuola</a>
        <a href="www.instagram.it">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
        <a href="www.facebook.it">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="www.whatsapp.it">
          <i class="fa fa-whatsapp" aria-hidden="true"></i>
        </a>
    </div>


    <div class="topnav" id="myTopnav">
      <a href="esame_home.php">Home</a>
      <!--<a href="#news">News</a>-->
      <a href="#about">Informazioni</a>
      <a href="esame_cart.php" class="active">Carrello</a>
      <a href='esame_logout.php'>Esci dalla sessione</a>
      <a href='esame_login.php'>Accedi</a>
      <a href='esame_signup.php'>Iscriviti</a>

      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
        <body onload="search()">

         <!--<div id="cont">


 <div id ="myContainer">

  <i class="fa fa-shopping-basket" aria-hidden="true"></i>
</div>-->

  <main>

<?php 

$conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
$ordinestato = $_COOKIE["ordinefattostato"];
$ordinefattoid = $_COOKIE["ordinefattoid"];
$ordinefattoidlibro = $_COOKIE["ordinefattoidlibro"];
$ordinefattoquantita = $_COOKIE["ordinefattoquantita"];
$ordinefattoprezzotot = $_COOKIE["ordinefattoprezzotot"];
$ordinefattodata = $_COOKIE["ordinefattodata"];
$ordinefattoindirizzo = $_COOKIE["ordinefattoindirizzo"];
$ordinefattocitta = $_COOKIE["ordinefattocitta"];
$ordinefattonazione = $_COOKIE["ordinefattonazione"];
$ordinefattocodicepostale = $_COOKIE["ordinefattocodicepostale"];
$ordinefattofullname = $_COOKIE["ordinefattofullname"];
//echo "ordine stato: ", ($ordinestato), " \n";
//echo "ordine id: ", ($ordinefattoid), "\n";
//echo"id libro: ", ($ordinefattoidlibro), "\n";
//echo "quantita: ", ($ordinefattoquantita), "\n";
//echo "prezzo: ", ($ordinefattoprezzotot), "\n";
//echo "data: ", ($ordinefattodata), "\n";
//echo "userid: ", ($userid), "\n";
//echo "indirizzo: ", ($ordinefattoindirizzo), "\n";
//echo "citta: ", ($ordinefattocitta), "\n";
//echo "nazione: ", ($ordinefattonazione), "\n";
//echo "codice postale: ", ($ordinefattocodicepostale), "\n";
//echo "nome completo: ", ($ordinefattofullname), "\n";
$queryinsordricevuto = "INSERT into ordine_ricevuto(userid, id_ordine, ordine_stato, id_libro, quantita, prezzo, data, nome_completo, citta, codice_postale, nazione) VALUES('$userid','$ordinefattoid','$ordinestato','$ordinefattoidlibro','$ordinefattoquantita','$ordinefattoprezzotot','$ordinefattodata', '$ordinefattofullname', '$ordinefattocitta', '$ordinefattocodicepostale', '$ordinefattonazione')";
//echo $queryinsordricevuto;
$insordricevuto = mysqli_query($conn, $queryinsordricevuto) or die(mysqli_error($conn));
setcookie("ordinefattostato","",null);
setcookie("ordinefattoid","",null);
setcookie("ordinefattoidlibro","",null);
setcookie("ordinefattoquantita","",null);
setcookie("ordinefattoprezzotot","",null);
setcookie("ordinefattodata","",null);
setcookie("ordinefattoindirizzo","",null);
setcookie("ordinefattocitta","",null);
setcookie("ordinefattonazione","",null);
setcookie("ordinefattocodicepostale","",null);
setcookie("ordinefattofullname","",null);
header("refresh:5; url=http://localhost/programmazione_web/esame/esame_home.php");
//exit;


?>

<div class="thanks">
<p >Grazie per aver acquistato da noi, <br>
   verrai reindirizzato tra <span id="time">05</span> secondi alla homepage.</p>
</div>
</main>



<!--</div>-->
</body>
<footer>
<div id="logo">
Viviscuola
<div>
<a href="www.instagram.it">
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </a>
      <a href="www.facebook.it">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>
      <a href="www.whatsapp.it">
        <i class="fa fa-whatsapp" aria-hidden="true"></i>
      </a>
</div>

</div>
<p>    
Realizzato da Gianluca Trovato.<br/>
Matricola: O46002295.
</p>
</footer>
</div>


</html>