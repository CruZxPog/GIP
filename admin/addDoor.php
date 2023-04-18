<?php 
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $deurnaam = $_POST['deurnaam'];
    $deurnaam =strtolower($deurnaam);
    
    $rank = $_POST['rank'];

    $sql = "INSERT INTO `doors`(`deur naam`, `status`,`rank`,`chipid`) VALUES ('$deurnaam','close',$rank,'')";
    
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
