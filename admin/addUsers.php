<?php 
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $voornaam = $_POST['voornaam'];
    $achternaam =$_POST['achternaam'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rank = $_POST['rank'];

    $sql = "INSERT INTO `users`(`voornaam`, `achternaam`, `username`, `password`, `rank`) 
            VALUES ('$voornaam','$achternaam','$username','$password','$rank')";
    
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
                        window.location.replace("admin.html")
                        clearInterval(interval)
                    }
                },1000)
            })
</script>