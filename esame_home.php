<?php



    require_once 'esame_auth.php';
 
    if (!$userid = checkAuth()) {
        header("Location: esame_login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html>
<?php 
        //setcookie("co","");
        $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM cliente WHERE username = '$userid'";
        //echo $query , " |\n";
        $res_1 = mysqli_query($conn, $query) or die("Errore: ".mysqli_error($conn));

        while($row1 = mysqli_fetch_object($res_1))
        {
            //print_r($row1);
        }
        //echo $nome;
        /*$query1 = "SELECT * FROM cidici_l";
        echo $query1;
        $res = mysqli_query($conn, $query1) or die("Errore: ".mysqli_error($conn));
        //print_r ($res);
        while($row = mysqli_fetch_assoc($res))
        {
            //print_r($row);
            print $row['codice'];echo "\n";
        }*/
        
    
        //$userinfo = mysqli_fetch_assoc($res_1);   
        //echo $userinfo[0];
        //FIXME where is the user parameter passed? When you do fetchPost()?
        /*if(isset($_GET['user'])) {
            if ($_GET['user'] != $thisuserinfo['username']) {
                $profileid = mysqli_real_escape_string($conn, $_GET['user']);
                $res_2 = mysqli_query($conn, "SELECT id, nposts, nfollowing, nfollowers, username, name, surname, propic, verified, EXISTS(SELECT followed FROM followers WHERE follower = $userid AND followed = id) AS followed FROM users WHERE username = '$profileid' AND id != '$userid'");
                if (mysqli_num_rows($res_2) == 0) {
                    header("Location: .");
                    exit;
                }
                $userinfo = mysqli_fetch_assoc($res_2);
            } else $userinfo = $thisuserinfo;
        } else $userinfo = $thisuserinfo;*/


        //$conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
        $query1 = "SELECT * FROM libro";
        //echo $query;
        $res = mysqli_query($conn, $query1) or die("Errore: ".mysqli_error($conn));
        //print_r ($res);
        //$row1;
        $i=0;
        $palle=array();
        $titoli = array();
        $prezzi = array(); 
        //print_r($res->num_rows);
        $rows=$res->num_rows;
        //print($rows) ;
        while($row = mysqli_fetch_object($res))
        {
            //print_r($row);
            //$i++;
            //echo "<tr><td>".$row->codice."</td><td>";
            array_push($palle, $row->codice);
            //array_push($titoli, $row->titolo);
            //array_push($prezzi, $row->prezzo);
            //$palle=$row->codice;
            //print_r($row);
            //echo $palle;
            //implode(',',$palle);
            //$i++;
            //print $row['codice']; echo "\n";
            //$row1['i']=$row['codice'];
        }
        //echo"\n"; print $row['codice'];
        //print_r ($row1);
        //echo serialize($res);
        //echo $palle;
       // echo implode(',',$palle);
        //print_r($palle);
        //print_r($titoli);
        //$codici= implode(' ',$palle);
        //echo $codici;
        //search($codici);
        /*foreach($titoli as $k => $v)
        {
          //print($v);
        }*/
        //var_dump($titoli);
        //button.onclick=ins();
        //console.log(button.onclick);
        //$al=document.getElementById("9788842916598");
        //echo $userid;
        //echo $_COOKIE["codlibroadd"];
        //setcookie("co",$codici);
        //$_SESSION["co"]=$codici;

        $results_per_page = 2;
        $que="SELECT * from libro";
        $result=mysqli_query($conn,$que) or die("Errore: ".mysqli_error($conn));
        $number_of_result=mysqli_num_rows($result);

        $number_of_page=ceil($number_of_result / $results_per_page);
        $c=array();

        if(!isset($_GET['page']))
        {
          $page=1;
        }
        else
        {
          $page=$_GET['page'];
        }

        $page_first_result=($page-1) * $results_per_page;
        $que = "SELECT * from libro LIMIT " .$page_first_result.','.$results_per_page;
        //echo $que;
        $resu = mysqli_query($conn,$que) or die("Errore: ".mysqli_error($conn));
        while($row = mysqli_fetch_object($resu))
        {
          //echo "risultato: ",$row->codice;
          array_push($c, $row->codice);
          array_push($titoli, $row->titolo);
          array_push($prezzi, $row->prezzo);

        }
        //print_r($c);
        $codici= implode(' ',$c);
        //setcookie("co",$codici);

        /*for($page=1;$page<=$number_of_page;$page++)
        {
          echo '<a href= "home.php?page='.$page.'">'.$page.'</a>';
        }*/
        
?>
    <head>
    <title>Broken</title>
    <link rel='stylesheet' href='esame_home.css'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='esame_home.js' defer></script>
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
      <a href="esame_home.php" class="active">Home</a>
      <!--<a href="#news">News</a>-->
      <a>Informazioni</a>
      <a href="esame_cart.php">Carrello</a>
      <a href='esame_logout.php'>Esci dalla sessione</a>
      <a href='esame_login.php'>Accedi</a>
      <a href='esame_signup.php'>Iscriviti</a>

      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
    <body onload="search()">


    <main>

        <div class="flex_container">
    <form class="ricerca">
        Inserisci codice libro (ISBN) da cercare:
        <input type="text" id="author" name="ok">
        <input type="submit" value="cerca" id="cerca" class="buttoN" name="cerca">
    </form>

    <form>
        <input type="submit" value="reset pagina" id="reset" class="buttoN">
    </form>

    </div>

    <?php
      if(isset($_GET["cerca"]))
      {
        $mo=$_GET["ok"];
        $queco= "SELECT * from cidici_l where codice = $mo";
        $rqueco = mysqli_query($conn, $queco) or die(mysqli_error($conn));

        $rowqueco = mysqli_fetch_object($rqueco);
        if($rowqueco) 
          $codici=$_GET["ok"];
      }
    ?>



<script>

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
    }
  }
}

var myVar;
function listEntries(booksInfo) {
  // Clear any old data to prepare to display the Loading... message.
  var div = document.getElementById("data");
  console.log(div.firstChild);
  if (div.firstChild) div.removeChild(div.firstChild);

  myVar= setTimeout(showPage,2000);
  move();

  var mainDiv = document.createElement("div");
  //console.log(GBS_setLanguage("It"));
  //console.log(GBS_insertEmbeddedViewer(9788842916598, 100, 100));
  //GBS_insertPreviewButtonLink(9788842916598);
  var titoli = <?php echo json_encode($titoli, JSON_HEX_TAG); ?>;
    console.log(titoli);
    var prezzi = <?php echo json_encode($prezzi, JSON_HEX_TAG); ?>;
    console.log(prezzi);
    var cod=<?php echo json_encode($c, JSON_HEX_TAG); ?>;
    var j=-1;

  for (i in booksInfo) {
    // Create a DIV for each book
    j++;
    var book = booksInfo[i];
    var thumbnailDiv = document.createElement("div");
    thumbnailDiv.className = "thumbnail";

    //Add a link to each book's informtaion page
    var a = document.createElement("p");
    //a.href = book.info_url; //link info
    a.href=book.preview_url; //link info
    //a.href=book.thumbnail_url; /link a immagine
    a.append(book.bib_key) ;
    //var a1 =document.createElement("a");
    //a1.append(preview);
    var a2 = document.createElement("p");
    a2.id="titolo";
    var p1 = document.createElement("p");
    prezzi[j]="prezzo: "+prezzi[j]+"€";
    console.log(titoli[j]);
    console.log(prezzi[j]);
    a2.append(titoli[j]);
    p1.append(prezzi[j]);

    // Display a thumbnail of the book's cover
    var img = document.createElement("img");
    var div1 = document.createElement("div");
    img.src = book.thumbnail_url;
    div1.append(img);
    var buttonadd=document.createElement("a");
    //var buttonsub=document.createElement("button");
    //buttonsub.innerHTML="sottrai dal carrello";
    buttonadd.innerHTML="aggiungi al carrello";
    buttonadd.id=cod[j]+"-ADD";
    //buttonsub.id=cod[j]+="-SUB";
    console.log(buttonadd.id);
    //console.log(buttonsub.id);
    buttonadd.href="http://localhost/programmazione_web/esame/esame_product.php";
    buttonadd.class="button";

    console.log(p1);
    buttonadd.addEventListener("click",on);
    //buttonsub.addEventListener("click",sub);
    

    thumbnailDiv.appendChild(a);
    thumbnailDiv.appendChild(div1);
    thumbnailDiv.appendChild(a2);
    thumbnailDiv.appendChild(p1);
    thumbnailDiv.appendChild(buttonadd);
    //thumbnailDiv.appendChild(buttonsub);
    //button.onclick=function c(){alert("button");};


    //console.log(booksInfo[i]);
    //console.log(book);

    // Alert the user that the book is not previewable
    var p = document.createElement("p");
    p.innerHTML = book.preview;
    //console.log(book.preveiw_url);
    if (p.innerHTML == "noview"){
      p.style.fontWeight = "bold";
      p.style.color = "#f00";
    }
    /*else if(book.preview == "full" || book.preview == "partial")
    {
      document.write('<a href="' + book.preview_url + '">');
            document.write('<img '
              + 'src="/books/images/' + buttonImg + '" '
              + 'style="border:0; margin:3px;" />');
            document.write('<\/a>');
            break;
    }*/

    thumbnailDiv.appendChild(p);
    mainDiv.appendChild(thumbnailDiv);
  }
  div.appendChild(mainDiv);

}

function search(query) {
    console.log(query);
    //$_SESSION["co"]=<?php echo json_encode($codici, JSON_HEX_TAG); ?>//;
  
    var data = <?php echo json_encode(/*$_COOKIE["co"]*/ $codici, JSON_HEX_TAG); ?>;
    //var data =query;
    console.log(data);
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
  
   // if(id è presente nel dbms)
   // {
      scriptElement.setAttribute("id", "jsonScript");
    scriptElement.setAttribute("src",
        "https://books.google.com/books?bibkeys=" +
        data + "&jscmd=viewapi&callback=listEntries");
    scriptElement.setAttribute("type", "text/javascript");
    //}
    
    // make the request to Google booksearch
    document.documentElement.firstChild.appendChild(scriptElement);
   
  }
  //-->
  
  function showPage()
  {
    document.getElementById("loader").style.display = "none";
    document.getElementById("data").style.display = "block";
  }
  
  
  function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + "path=/";
  }
  
  
        function on(event)
        {

          var cod=<?php echo json_encode($c, JSON_HEX_TAG); ?>;
          var rows=<?php echo json_encode($rows, JSON_HEX_TAG); ?>;
          var tit = <?php echo json_encode($titoli, JSON_HEX_TAG); ?>;
          var pre =<?php echo json_encode($prezzi, JSON_HEX_TAG); ?>;
          var lib;
          var titoli;
          var prezzi;
  

  
          for(let i=0; i<rows;i++)
          {
  
  
            lib=cod[i];
            titoli=tit[i];
            prezzi=pre[i];
            cod[i]=cod[i]+"-ADD";
            if(event.currentTarget.id==cod[i])
            {
              setCookie("ciao",lib,"24");
              setCookie("prez",prezzi,"24");
              setCookie("tit",titoli,"24");
              setCookie ("ordinato","");

            }
  
          }
        }
        
        </script>

<p></p>

    <div id="data" style="margin-left: 5em;"></div>
    <div>
    <script src="//books.google.com/books/previewlib.js"></script>
        <script>GBS_setLanguage('it');</script>
        <script>
            var data = <?php echo json_encode(/*$_COOKIE["co"]*/ $codici, JSON_HEX_TAG); ?>;
        GBS_insertPreviewButtonPopup(data);</script>
    </div>

    
    <div id="pag"> <p>Pagina: </p><?php

      if($page>=2)
      {
        echo '<a href= "esame_home.php?page='.($page-1).'">&laquo;</a>';
      }
      for($i=1;$i<=$number_of_page;$i++){
        if($i==$page)
        {
          echo '<a class="active" href= "esame_home.php?page='.$i.'">'.$i.'</a>';
        }
        else
        {
          echo '<a href= "esame_home.php?page='.$i.'">'.$i.'</a>';
        }
      };
      if($page<$number_of_page)
      {
        echo '<a href= "esame_home.php?page='.($page+1).'">&raquo;</a>';
      }
        ?>
    </div>
    




    </main>

<body>

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

    <?php mysqli_close($conn); ?>

</script>


    </head>
</html>