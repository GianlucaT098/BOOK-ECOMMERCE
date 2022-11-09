<?php



    require_once 'esame_auth.php';

    if (checkAuth()) {
        header("Location: esame_home.php");
        exit;
    } 


    // Verifica l'esistenza di dati POST
    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        // Connetti al database
        $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1");
        $username=mysqli_real_escape_string($conn, $_POST['username']);
        $password=mysqli_real_escape_string($conn, $_POST['password']);
        // Cerca utenti con quelle credenziali
        $query = "SELECT * FROM cliente WHERE username = '$username' AND password = '$password'";
		//echo $query;
		$res = mysqli_query($conn, $query) or die(mysqly_error($conn));
        // Verifica la correttezza delle credenziali
        if(mysqli_num_rows($res) > 0)
        {
            if(empty($_POST['remember']))
            {
                // Imposta la variabile di sessione
                while($row1 = mysqli_fetch_assoc($res))
                {
                    $nome=print_r($row1['codice']);
                }
                $_SESSION["username"] = $nome;
                // Vai alla pagina home_db.php
                header("Location: esame_home.php");
            }
            else
            {
                $entry = mysqli_fetch_assoc($res);
                $entry = mysqli_real_escape_string($conn,$entry);
                $token = random_bytes(12);
                // Per motivi di sicurezza, uso un token con hash
                $hash = password_hash($token, PASSWORD_BCRYPT);
                $hash = mysqli_real_escape_string($conn, $hash);
                $expires =  mysqli_real_escape_string($conn, strtotime("+7 day"));
                $query1 = "INSERT INTO cookies(hash, cliente, expires) VALUES('".$hash."','".$entry['cliente']."+1', '".$expires."')";
                //echo $query1;
                $res = mysqli_query($conn, $query1) or die(mysqli_error($conn));
                setcookie("user_id", $entry['cliente']+1, $expires);
                setcookie("cookie_id", mysqli_insert_id($conn), $expires);
                setcookie("token", $token, $expires);
                header("Location: esame_home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                ///exit;
            }

        }
        else
        {
            // Flag di errore
            $errore = true;
        }
    }

?>
<html>
    <head>
        <link rel='stylesheet' href='esame_login.css'>
        <script src='esame_login.js' defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <a href="#about">Informzaioni</a>
      <a href="esame_cart.php">Carrello</a>
      <a href='esame_logout.php'>Esci dalla sessione</a>
      <a href='esame_login.php' class="active">Accedi</a>
      <a href='esame_signup.php'>Iscriviti</a>

      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
    <body>

        <main>
            <div id="fc">
            <form name='nome_form' method='post'>
                <p>
                    <label>Nome utente <input type='text' name='username'></label>
                </p>
                <p>
                    <label>Password <input type='password' name='password'></label>
                </p>
                <p class="remember">
                   <input id="check" type='checkbox' name='remember' value="1" <?php if(isset($_POST["remember"])){echo $_POST["remember"] ? "checked" : "";} ?>>
                    <label for='remember'>Ricorda l'accesso</label>
                </p>
                <p>
                    <input type='submit' class="buttoN" value="Accedi">
                </p>
            </form>
            <div class="signup">Non hai un account? <a href="esame_signup.php" class="button">Iscriviti</a> </div>
            </div>
            <?php
            // Verifica la presenza di errori
            if(isset($errore))
            {
                echo "<p class='errore'>";
                echo "Credenziali non valide.";
                echo "</p>";
            }
        ?>
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
</div>
</html>