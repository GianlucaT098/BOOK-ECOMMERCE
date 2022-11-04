<?php
    /********************************************************
       Controlla che l'utente sia già autenticato, per non 
       dover chiedere il login ad ogni volta               
    *********************************************************/
    //require_once 'dbconfig.php';
    session_start();

    function checkAuth() {
        // Global per essere letta anche all'esterno di checkAuth()
        //GLOBAL $dbconfig;
        if(!isset($_SESSION['username'])) {
            if (isset($_COOKIE['user_id']) && isset($_COOKIE['cookie_id']) && isset($_COOKIE['token'])) { 
                $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
                //FIXME Necessary to use mysqli_escape_string?
                echo $_COOKIE['cookie_id'] ;
                $cookieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
                $userid = mysqli_real_escape_string($conn, $_COOKIE['user_id']);
                // Prendo il cookie che corrisponde all'ID
                $res = mysqli_query($conn, "SELECT * FROM cookies WHERE id = $cookieid AND cliente = $userid");
                //echo $res;
                if ($cookie = mysqli_fetch_assoc($res)) {
                    // Se scaduto, lo elimino
                    if(/*time() > $cookie['expires']*/FALSE) {
                        mysqli_query($conn, "DELETE FROM cookies WHERE id = ".$cookie['id']) or die(mysqli_error($conn));
                        header('Location: esame_logout.php');
                        exit;
                    // Altrimenti, controllo che il token sia valido
                    } else if (password_verify($_COOKIE['token'], $cookie['hash'])) {
                        $_SESSION['username'] = $_COOKIE['user_id'];
                        mysqli_close($conn);
                        return $_SESSION['username'];
                    }
                }
                mysqli_close($conn);
            }
            return 0;
        } else {
            return $_SESSION['username'];
        }
    }

?>