<?php
// Read out values from URL using $_GET
$deurnaam = $_GET['deurnaam'];
// Set the cookies separately, with a distant future expiration date
setcookie('deurnaam', $deurnaam, time() + (10 * 365 * 24 * 60 * 60), '/');
header("Location: ..\login\scramblepad.php");
?>

