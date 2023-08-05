<?php

    // Logout

    session_start();
    if(session_destroy()) {
        header("Location: login-root.php");
    }

    

?>