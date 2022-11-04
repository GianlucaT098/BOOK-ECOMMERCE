<?php



?>

<?php

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    // Se dei cookie sono stati settati, devo occuparmi anche di questi
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['token']) && isset($_COOKIE['cookie_id'])) { 
        $conn = mysqli_connect("localhost", "root", "1965196919931998", "esercitazione1") or die(mysqli_error($conn));
        // Leggo i dati dei cookie settati
        $cookieid = mysqli_real_escape_string($conn, $_COOKIE['cookie_id']);
        $userid = mysqli_real_escape_string($conn, $_COOKIE['user_id']);
        // Ricerco i cookie dell'utente nel database
        $res = mysqli_query($conn, "SELECT id, hash FROM cookies WHERE id = $cookieid AND cliente = $userid");
        if ($cookie = mysqli_fetch_assoc($res)) { 
            // Se trovo un match, verifico che il toekn del client sia ancora valido
            // (altrimenti sarà già stato eliminato nella checkAuth)
            if (password_verify($_COOKIE['token'], $cookie['hash'])) {
                // Elimino sia dal DB che dal cookie
                mysqli_query($conn, "DELETE FROM cookies WHERE id = $cookieid");
                mysqli_close($conn);
                setcookie('user_id', '');
                setcookie('cookie_id', '');
                setcookie('token', '');
            }
        }
        mysqli_close($conn);
    }

    header('Location: esame_login.php');
?>