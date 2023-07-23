<!-- form for updating programs in bug bounty platform -->

<?php

// include the database connection file
include_once("config.php");

?>

<!-- html form -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Program</title>
</head>
<body>
    <form action="">
        <input type="text" name="name" placeholder="Name of program">
        <input type="file" name="image">
        <input type="text" name="url" placeholder="URL of program">
        <input type="number" name="minimum" value="0">
        <input type="number" name="maximum" value="0">
        <input type="text" name="description" placeholder="Enter description">
        

    </form>
</body>
</html>