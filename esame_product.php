<?php 


require_once 'esame_auth.php';
 
if (!$userid = checkAuth()) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Broken</title>
<link rel='stylesheet' href='esame_product.css'>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='esame_product.js' defer></script>
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

        <div id="cont">


<div id ="myContainer">

  <i class="fa fa-shopping-basket" aria-hidden="true"></i>
</div>

  <main>


  <div id="data" style="margin-left: 5em;"></div>

  <form  name='adding' method='post' enctype="multipart/form-data" autocomplete="off" class="container">
      <div class="quantita">
          <div><label for='quantità'>quantita</label></div>
          <div><input id="quant" type='text' name='quantita' <?php if(isset($_POST["quantita"])){echo "value=".$_POST["quantita"];} ?>></div>
      </div>
      <div class="submit">
          <input type='submit' value="Aggiorna quantità" id="submit" class="buttoN">

      </div>
      <div class="svuoto">
          <div><input type="submit" value="Svuota carrello" name="svuoto" class="buttoN"<?php if(isset($_POST["svuoto"])){echo $_POST["svuoto"] ? "checked" : "";} ?>></div>

      </div>
      <div class="place">
          <div><input type="submit" onclick="myMove()" value="Piazza ordine" name="placeorder" class="buttoN"></div>

      </div>
  </form>


  <?php 
  echo "<div id=prez>" , "prezzo finale: ", $_COOKIE["prezzo"], "€","</div>";
  $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
  $query1 = "SELECT * FROM libro";
  $res = mysqli_query($conn, $query1) or die("Errore: ".mysqli_error($conn));
  $palle=array();
  $titoli = array();
  $prezzi = array(); 
  while($row = mysqli_fetch_object($res))
  {
      array_push($palle, $row->codice);
      array_push($titoli, $row->titolo);
      array_push($prezzi, $row->prezzo);

  }
  $codici= implode(' ',$palle);

  ?>
</main>
</div>
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
  
  <script>






/**
* This function is the call-back function for the JSON scripts which
* executes a Google book search response.
*
* @param {JSON} booksInfo is the JSON object pulled from the Google books service.
*/
var myVar;
function listEntries(booksInfo) {
// Clear any old data to prepare to display the Loading... message.
var div = document.getElementById("data");
if (div.firstChild) div.removeChild(div.firstChild);

//myVar= setTimeout(showPage,2000);
//move();

var mainDiv = document.createElement("div");

var titoli = <?php echo json_encode($_COOKIE["tit"], JSON_HEX_TAG); ?>;

var prezzi = <?php echo json_encode($_COOKIE["prez"], JSON_HEX_TAG); ?>;

var cod=<?php echo json_encode($palle, JSON_HEX_TAG); ?>;
var j=-1;

for (i in booksInfo) {
// Create a DIV for each book
j++;
var book = booksInfo[i];
var thumbnailDiv = document.createElement("div");
thumbnailDiv.className = "thumbnail";

//Add a link to each book's informtaion page
var a = document.createElement("p");
a.href = book.info_url; //link info
a.href=book.preview_url; //link info

a.append(book.bib_key) ;

var a2 = document.createElement("p");
a2.id="titolo";
var p1 = document.createElement("p");
prezzi="prezzo singolo articolo: "+prezzi+"€";
console.log(titoli);
console.log(prezzi);
a2.append(titoli);
p1.append(prezzi);

// Display a thumbnail of the book's cover
var img = document.createElement("img");
var div1 = document.createElement("div");
img.src = book.thumbnail_url;
div1.append(img);
div1.id="immagine";
var buttonadd=document.createElement("a");

buttonadd.innerHTML="aggiungi al carrello";
buttonadd.id=cod[j]+"-ADD";

buttonadd.href="http://localhost/programmazione_web/esame/esame_product.php";
buttonadd.class="button";




thumbnailDiv.appendChild(a);
thumbnailDiv.appendChild(div1);
thumbnailDiv.appendChild(a2);
thumbnailDiv.appendChild(p1);



// Alert the user that the book is not previewable
var p = document.createElement("a");
p.innerHTML = book.preview;

if (p.innerHTML == "noview"){
p.style.fontWeight = "bold";
p.style.color = "#f00";
}
else if(book.preview == "full" || book.preview == "partial")
{
document.write('<a href="' + book.preview_url + '">');
      document.write('<img '
        + 'src="/books/images/' + buttonImg + '" '
        + 'style="border:0; margin:3px;" />');
      document.write('<\/a>');
      break;
}

mainDiv.appendChild(thumbnailDiv);
}
div.appendChild(mainDiv);

}

/**
*
* @param {DOM object} query The form element containing the
*                     input parameters "isbns"
*/
function search(query) {
var data = <?php echo json_encode($_COOKIE["ciao"], JSON_HEX_TAG); ?>;

// Clear any old data to prepare to display the Loading... message.
var div = document.getElementById("data");
if (div.firstChild) div.removeChild(div.firstChild);

// Show a "Loading..." indicator.
var div = document.getElementById('data');
var p = document.createElement('p');
p.appendChild(document.createTextNode('Loading...'));
div.appendChild(p);


// Delete any previous Google Booksearch JSON queries.
var jsonScript = document.getElementById("jsonScript");
if (jsonScript) {
jsonScript.parentNode.removeChild(jsonScript);
}

// Add a script element with the src as the user's Google Booksearch query.
// JSON output is specified by including the alt=json-in-script argument
// and the callback funtion is also specified as a URI argument.
var scriptElement = document.createElement("script");


scriptElement.setAttribute("id", "jsonScript");
scriptElement.setAttribute("src",
"https://books.google.com/books?bibkeys=" +
data + "&jscmd=viewapi&callback=listEntries");
scriptElement.setAttribute("type", "text/javascript");


// make the request to Google booksearch
document.documentElement.firstChild.appendChild(scriptElement);
}
//-->


function setCookie(cname, cvalue, exdays) {
const d = new Date();
d.setTime(d.getTime() + (exdays*24*60*60*1000));
let expires = "expires="+ d.toUTCString();
document.cookie = cname + "=" + cvalue + ";" + expires + "path=/";
}







</script>


<?php 
$flag =0;

$codlibro = $_COOKIE["ciao"];
$conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));

$userid = mysqli_real_escape_string($conn, $userid);


if($_COOKIE["ciao"]!="no" and !empty($_COOKIE["ciao"]))
{

$codicel=$_COOKIE["ciao"];
$querygetinstock = "SELECT giacenza from libro where codice='$codicel'";
$getinstock= mysqli_query($conn, $querygetinstock) or die(mysqli_error($conn));
$instockobj=mysqli_fetch_object($getinstock);
$instock = $instockobj->giacenza;
$querylibro= "SELECT prezzo FROM libro where codice = $_COOKIE[ciao]";
$querylibro;
$libroc=mysqli_query($conn, $querylibro) or die(mysqli_error($conn));
$libro=mysqli_fetch_object($libroc);
$libro->prezzo;

if(!empty($_POST["quantita"]) and $_POST["quantita"]>0 and $_POST["quantita"]<=$instock and empty($_POST["svuoto"]) and empty($_POST["placeorder"]))
{
   $querygetidordine="SELECT MAX(id) as id FROM ordini";
  $getidordine = mysqli_query($conn, $querygetidordine) or die(mysqli_error($conn));
  $idordineo = mysqli_fetch_object($getidordine);
   $idordineo->id;
  $querynotex="SELECT CASE WHEN EXISTS(SELECT * FROM esercitazione1.dettaglio_ordini) THEN 0 ELSE 1 END AS IsEmpty";
  $notex = mysqli_query($conn,$querynotex);
  $notexa = mysqli_fetch_object($notex);

   !$notexa->IsEmpty;
  if(!$notexa->IsEmpty)
  {
     $querydeletedett= "DELETE FROM dettaglio_ordini where id_ordine = $idordineo->id";
    $deletedett=mysqli_query($conn, $querydeletedett) or die("Errore: ".mysqli_error($conn));
     $querydeletord= "DELETE FROM ordini where id =$idordineo->id";
    $deletord=mysqli_query($conn, $querydeletord) or die("Errore: ".mysqli_error($conn));
  }


   $_COOKIE["ciao"];
  $queryidordine= "INSERT INTO ordini(cliente) VALUES('".$userid."')";
  
   $queryidordine;
  $inscliord = mysqli_query($conn, $queryidordine) or die(mysqli_error($conn));

   $querygetidordine="SELECT MAX(id) as id FROM ordini";
  $getidordine = mysqli_query($conn, $querygetidordine) or die(mysqli_error($conn));
  $idordineo = mysqli_fetch_object($getidordine);
   $idordineo->id;



   $querydettagliordine="INSERT INTO dettaglio_ordini(id_ordine, id_libro, quantita) VALUES('$idordineo->id', '$codlibro','$_POST[quantita]')";
  $dettagliordine=mysqli_query($conn, $querydettagliordine) or die(mysqli_error($conn));

  setcookie("ordinato", "sium");

  setcookie("prezzo" ,$_COOKIE["prez"] * $_POST["quantita"]) ;

  
  header('location: http://localhost/programmazione_web/esame/esame_product.php');

  exit;

}
else if( !empty($_POST["svuoto"]) and $_COOKIE["ordinato"]=="sium" and empty($_POST["placeorder"])/*and $flag==1*/)
{

       $querygetidordine="SELECT MAX(id) as id FROM ordini";
      $getidordine = mysqli_query($conn, $querygetidordine) or die(mysqli_error($conn));
      $idordineo = mysqli_fetch_object($getidordine);
       $idordineo->id;
       $querydeletedett= "DELETE FROM dettaglio_ordini where id_ordine = $idordineo->id";
      $deletedett=mysqli_query($conn, $querydeletedett) or die("Errore: ".mysqli_error($conn));
       $querydeletord= "DELETE FROM ordini where id =$idordineo->id";
      $deletord=mysqli_query($conn, $querydeletord) or die("Errore: ".mysqli_error($conn));
      setcookie("ciao", "no");

  setcookie("ordinato", "nope");

  unset($_COOKIE["ciao"]);



  $message="carrello vuoto";
  echo "<script type='text/javascript'>alert('$message');</script>";
  header('location: http://localhost/programmazione_web/esame/esame_home.php');
  exit;
}
else if(empty($_POST["quantita"]) and !empty($_POST["placeorder"]) and $_COOKIE["ordinato"]=="sium")
{
  setcookie("ordinato", "nope");
  setcookie("ciao", "");
  unset($_COOKIE["ordinato"]);
  unset($_COOKIE["ciao"]);
  header("location: http://localhost/programmazione_web/esame/esame_cart.php");
  sleep(2.5);
  exit;
}
else
{
  $_POST["quantita"]=null;
  exit;
}



}
else
{
echo "carrello vuoto";

exit;
}

$_POST["quantita"]=null;




?>

</html>