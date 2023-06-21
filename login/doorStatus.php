<?php
$link = mysqli_connect("localhost", "root", "", "locks");

$chipid = mysqli_real_escape_string($link, $_GET["naam"]);
// echo $chipid;
// Controleer of $chipid niet leeg is
if (!empty($chipid)) {

    // Controleer of $chipid al in de tabel bestaat
    $sql = "SELECT COUNT(*) FROM doors WHERE `chipid` = '$chipid'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $count = mysqli_fetch_array($result)[0];
    
    if ($count > 0) { // Als $chipid al in de tabel bestaat

        // Haal de status op van de deur met de gegeven $chipid
        $sql = "SELECT `status` FROM doors WHERE `chipid` = '$chipid'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        $status = mysqli_fetch_array($result);

        // Geef de status terug
        echo $status[0];

    } else { // Als $chipid niet bestaat in de tabel

        // Voeg het nieuwe $chipid toe aan de tabel
        $sql = "UPDATE `doors` SET `chipid`='$chipid' WHERE `chipid` = '' LIMIT 1";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        
    }
} else {
    header('Location: scramblepad.html');
}