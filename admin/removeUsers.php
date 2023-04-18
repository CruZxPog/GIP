<?php 
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $username = $_POST['username'];
    
    echo $voornaam."<br>".$achternaam."<br>".$username."<br>";

    $sql = "DELETE FROM `users` WHERE  `voornaam`='$voornaam' and `achternaam`= '$achternaam' and `username`='$username'";

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
