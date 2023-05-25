<?php 
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $username = $_POST['username'];
    
    $sanitized_voornaam = mysqli_real_escape_string($link, $voornaam);
    $sanitized_achternaam = mysqli_real_escape_string($link, $achternaam);
    $sanitized_username = mysqli_real_escape_string($link, $username);
  
    
    $sql = "DELETE FROM `users` WHERE  `voornaam`='$sanitized_voornaam' and `achternaam`= '$sanitized_achternaam' and `username`='$sanitized_username'";

    $result = mysqli_query($link, $sql) 
    or die(mysqli_error($link));
}
?>

<script>
    window.addEventListener("load", () => {
        let time = 1
        const interval = setInterval(() => {
        time--
            if(time == 0) {
                window.location.replace("index.html")
                clearInterval(interval)
            }
        },1000)
    })
</script>
