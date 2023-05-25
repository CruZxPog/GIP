<?php 
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $voornaam = $_POST['voornaam'];
    $voornaam =strtolower($voornaam);

    $achternaam =$_POST['achternaam'];
    $achternaam =strtolower($achternaam);

    $username = $_POST['username'];
    $username = strtolower($username);
    
    $password = $_POST['password'];
    $rank = $_POST['rank'];
    $sanitized_voornaam = mysqli_real_escape_string($link, $voornaam);
    $sanitized_achternaam = mysqli_real_escape_string($link, $achternaam);
    $sanitized_username = mysqli_real_escape_string($link, $username);
    $sanitized_password = mysqli_real_escape_string($link, $password);
    $sanitized_rank = mysqli_real_escape_string($link, $rank);
    
    $sql = "INSERT INTO `users`(`voornaam`, `achternaam`, `username`, `password`, `rank`) 
            VALUES ('$sanitized_voornaam','$sanitized_achternaam','$sanitized_username','$sanitized_password','$sanitized_rank')";
    
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
