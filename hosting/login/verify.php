<?php
$link = mysqli_connect("sql104.epizy.com", "epiz_34138247", "PjAnnVCkxFqLb00", "epiz_34138247_lokcs");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $username = strtolower($username);
    $password = $_POST['password'];
    $deurnaam_cookie = $_COOKIE['deurnaam'];
    $deurnaam_cookie = strtolower($deurnaam_cookie);
    $sanitized_username = mysqli_real_escape_string($link, $username);
    $sanitized_password = mysqli_real_escape_string($link, $password);
   
    $sql = "SELECT `rank` FROM `users` WHERE `username`='$sanitized_username' AND `password`='$sanitized_password'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $user_rank = mysqli_fetch_array($result);
    
    $sql = "SELECT `rank` FROM `doors` WHERE `deur naam` = '$deurnaam_cookie'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $deurrank = mysqli_fetch_array($result);
    
    if($user_rank['rank'] >= $deurran[1]) {
        $sql = "UPDATE `doors` SET `status`='open' WHERE `deur naam`='$deurnaam_cookie'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        sleep(5); // wait for 5 seconds before updating the status to close
        $sql = "UPDATE `doors` SET `status`='close' WHERE `deur naam`='$deurnaam_cookie'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        sleep(3);
        header("Location: scramblepad.php");
        exit();
    } else {
        // Redirect the user to the scramblepad.html page
        header("Location: scramblepad.php");
        exit();
    }

    mysqli_close($link);
}
?>
