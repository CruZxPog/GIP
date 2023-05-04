<?php
// Read out values from URL using $_GET
$deurnaam = $_GET['deurnaam'];
$deurrank = $_GET['deurrank'];

// Set the cookies separately, with a distant future expiration date
setcookie('deurnaam', $deurnaam, time() + (10 * 365 * 24 * 60 * 60), '/');
setcookie('deurrank', $deurrank, time() + (10 * 365 * 24 * 60 * 60), '/');

header("Location: ..\login\scramblepad.html");
?>

<body style="background-color: blueviolet;"></body>