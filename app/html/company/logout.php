<?php
    // logout

    session_start();
    if(session_destroy()) {
        header("Location: login-company.php");
    }
    
?>