<?php 

require_once 'esame_auth.php';
 
if (!$userid = checkAuth()) {
    header("Location: esame_login.php");
    exit;
}

 $_COOKIE["prezzo"];
$pre=$_COOKIE["prezzo"];
$conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
//create view maordine select max(id_ordine) as id_ordine from dettaglio_ordini
$queryordine= "SELECT dettaglio_ordini.id_ordine , dettaglio_ordini.id_libro , dettaglio_ordini.quantita from dettaglio_ordini inner JOIN maordine on dettaglio_ordini.id_ordine=maordine.id_ordine";
$gordine= mysqli_query($conn, $queryordine) or die(mysqli_error($conn));
$ordineo = mysqli_fetch_object($gordine);
$id_ordine=$ordineo->id_ordine;
$id_libro=$ordineo->id_libro;
$quantita=$ordineo->quantita;
$psingolo=round($pre/$quantita,2);

?>


<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='esame_cart.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='esame_cart.js' defer></script>
    <meta charset="utf-8">
    <script type="text/javascript" src="https://books.google.com/books/previewlib.js"></script>
  </head>


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



    <main>

    <div id="data"></div>


    <?php  echo '<div id="prezzoo">'.'Prezzo Totale: '.$pre.'€'.'</div>' ?>

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

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AfQZm58s83Mf3GD3WrPu0Mre7fE3PNgktEW0b_Uxy7xTMdmWCGF4yCZyWh8J2Hn0fUUDBk9CyNn2F7aS&currency=EUR"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>


function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + "path=/";
}

      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
      return actions.order.create({
         "purchase_units": [{
            "amount": {
              "currency_code": "EUR",
              "value": <?php echo json_encode($pre, JSON_HEX_TAG); ?>,
              "breakdown": {
                "item_total": {  /* Required when including the items array */
                  "currency_code": "EUR",
                  "value": <?php echo json_encode($pre, JSON_HEX_TAG); ?>
                }
              }
            },
            "items": [
              {
                "name": <?php echo json_encode($id_libro, JSON_HEX_TAG); ?>, /* Shows within upper-right dropdown during payment approval */
                "description": "Optional descriptive text..", /* Item details will also be in the completed paypal.com transaction view */
                "unit_amount": {
                  "currency_code": "EUR",
                  "value": <?php echo json_encode($psingolo, JSON_HEX_TAG); ?>
                },
                "quantity": <?php echo json_encode($quantita, JSON_HEX_TAG); ?>
              },
            ]
          }]
      });
    },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            const unit = orderData.purchase_units[0].items[0];
            const tim = orderData.update_time;
            const add = orderData.purchase_units[0].shipping;
            /*alert(`Transaction ${transaction.status}: ${transaction.id} ${transaction.amount.value}
            ${unit.name} ${unit.quantity} ${tim} ${add.address.address_line_1} ${add.address.admin_area_1}
            ${add.address.country_code} ${add.address.postal_code} ${add.address.postal_code}${add.name.full_name}\n\nSee console for all available details`);*/
            // When ready to go live, remove the alert and show a success message within this page. For example:



            setCookie("ordinefattostato",transaction.status,"24");
            setCookie("ordinefattoid",transaction.id,"24");
            setCookie("ordinefattoidlibro", unit.name , "24")
            setCookie("ordinefattoquantita", unit.quantity , "24");
            setCookie("ordinefattoprezzotot", transaction.amount.value, "24");
            setCookie("ordinefattodata", tim , "24");
            setCookie("ordinefattoindirizzo", add.address.address_line_1 , "24");
            setCookie("ordinefattocitta", add.address.admin_area_1 , "24");
            setCookie("ordinefattonazione", add.address.country_code , "24");
            setCookie("ordinefattocodicepostale", add.address.postal_code , "24");
            setCookie("ordinefattofullname", add.name.full_name , "24");
            /* Or go to another URL:*/  actions.redirect('http://localhost/programmazione_web/esame/esame_thankyou.php');
          });
        }
      }).render('#paypal-button-container');
    </script>
        <script>

function showPage()
{
  document.getElementById("loader").style.display = "none";
  document.getElementById("data").style.display = "block";
}

function move() {
  var elem = document.getElementById("myBar");   
  var width = 0;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
      document.getElementById("demo").innerHTML = width * 1  + '%';
    }
  }
}

var myVar;
function listEntries(booksInfo) {
  // Clear any old data to prepare to display the Loading... message.
  var div = document.getElementById("data");
  if (div.firstChild) div.removeChild(div.firstChild);

  myVar= setTimeout(showPage,2000);
  move();

  var mainDiv = document.createElement("div");

  var titoli = <?php echo json_encode($_COOKIE["tit"], JSON_HEX_TAG); ?>;
    var prezzi = <?php echo json_encode($_COOKIE["prez"], JSON_HEX_TAG); ?>;
    var cod=<?php echo json_encode($id_libro, JSON_HEX_TAG); ?>;
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

  var data = <?php echo json_encode($id_libro, JSON_HEX_TAG); ?>;

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
</script>


      </main>
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
</html>


<?php 

if(isset($_COOKIE["ordinefattostato"]) and isset($_COOKIE["ordinefattoid"]) and isset($_COOKIE["ordinefattoidlibro"]) and isset($_COOKIE["ordinefattoquantita"]) and isset($_COOKIE["ordinefattoprezzotot"]) and isset($_COOKIE["ordinefattodata"]))
{

      $ordinestato = $_COOKIE["ordinefattostato"];
      $ordinefattoid = $_COOKIE["ordinefattoid"];
      $ordinefattoidlibro = $_COOKIE["ordinefattoidlibro"];
      $ordinefattoquantita = $_COOKIE["ordinefattoquantita"];
      $ordinefattoprezzotot = $_COOKIE["ordinefattoprezzotot"];
      $ordinefattodata = $_COOKIE["ordinefattodata"];

      $queryinsordricevuto = "INSERT into ordine_ricevuto(id_ordine, ordine_stato, id_libro, quantita, prezzo, data) VALUES('$ordinefattoid','$ordinestato','$ordinefattoidlibro','$ordinefattoquantita','$ordinefattoprezzotot','$ordinefattodata')";
      $insordricevuto = mysqli_query($conn, $queryinsordricevuto) or die(mysqli_error($conn));
      setcookie("ordinefattostato","",null);
      setcookie("ordinefattoid","",null);
      setcookie("ordinefattoidlibro","",null);
      setcookie("ordinefattoquantita","",null);
      setcookie("ordinefattoprezzotot","",null);
      setcookie("ordinefattodata","",null);
      header("Location: esame_cart.php");
      exit;
}



?>