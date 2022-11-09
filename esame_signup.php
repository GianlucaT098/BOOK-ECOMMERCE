<?php
    require_once 'esame_auth.php';

    if (checkAuth()) {
        header("Location: esame_home.php");
        exit;
    }   

    // Verifica l'esistenza di dati POST
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) &&  !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));

        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT username FROM 
                ( SELECT username FROM cliente UNION ALL SELECT 'search' UNION ALL SELECT 'create' UNION ALL SELECT 'home' ) 
                AS u WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }



        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {


            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $query = "INSERT INTO cliente( password, username, email ) VALUES( '$password', '$username', '$email')";
            if (mysqli_query($conn, $query)) {
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: esame_home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='esame_signup.css'>
        <script src='esame_signup.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--<link rel="icon" type="image/png" href="favicon.png">-->
        <meta charset="utf-8">

        <title>p - Iscriviti</title>
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
      <a href="#about">Informaioni</a>
      <a href="esame_cart.php">Carrello</a>
      <a href='esame_logout.php'>Esci dalla sessione</a>
      <a href='esame_login.php'>Accedi</a>
      <a href='esame_signup.php' class="active">Iscriviti</a>

      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>

    <body>
        <main>


            <h1>Registrati</h1>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off" id="fo">

                <div class="f">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></div>
                </div>
                <div class="f">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
                </div>
                <div class="f">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                <div class="f">
                    <div><label for='confirm_password'>Conferma Password</label></div>
                    <div><input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
                </div>

                <div class="f"> 
                    <div><input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>></div>
                    <div><label for='allow'>Accetto termini e condizioni</label></div>
                </div>
                <div class="f">
                    <input type='submit' value="Registrati" id="submit" class="buttoN">
                </div>
                <?php

                    if(isset($error))
                    {
                        echo "<p class='errore'>";
                        echo $error[0];
                        echo "</p>";
                    }
                ?>
            </form>
            <div class="signup">Hai un account? <a class="buttoN" href="login.php">Accedi</a> </div>

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