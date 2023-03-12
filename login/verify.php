<?php
$link = mysqli_connect("localhost","root","","locks");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // print_r($_POST);

    $username = $_POST['username'];
    $password = $_POST['pass'];
    $deurnaam_cookie = $_COOKIE['deurnaam'];
    $deurrank_cookie = $_COOKIE['deurrank'];
    
    $sanitized_username = 
        mysqli_real_escape_string($link, $username);
        //mysqli_real_escape_string functie neemt de speciale tekens als text en beschouwt ze niet als querygebruik.
    $sanitized_password = 
        mysqli_real_escape_string($link, $password);
        
    $sql = "SELECT `rank` FROM `users` WHERE `username`= '$sanitized_username' and `password`= '$sanitized_password'";
        
    $result = mysqli_query($link, $sql) 
        or die(mysqli_error($link));
        
    $user_rank = mysqli_fetch_array($result);
    
    if($user_rank['rank'] >= $deurrank_cookie) {
        ?>
        <body id="background" style="background-color: rgb(19, 136, 8) ">
        <?php
           $sql = "UPDATE `doors` SET `status`='open' WHERE  `deur naam`='$deurnaam_cookie'";
           $result = mysqli_query($link, $sql) 
           or die(mysqli_error($link));
        ?>
        </body>
        <script>
            window.addEventListener("load", () => {
                const background = document.getElementById("background")
                let time = 7
                const interval = setInterval(() => {
                    time--
                    if (time == 2) {
                        <?php
                          $sql = "UPDATE `doors` SET `status`='close' WHERE `deur naam`='$deurnaam_cookie'";
                          $result = mysqli_query($link, $sql) 
                          or die(mysqli_error($link));
                        ?>
                        background.style.backgroundColor = "rgb( 219, 0, 7)"
                    } 
                    if (time == 0) {
                        window.location.replace("scramblepad.html")
                        clearInterval(interval)
                    }
                }, 1000)
            })
        </script>
        <?php
    } else {
        ?>
        <body id="background" style="background-color:rgb( 219, 0, 7)">
        </body>
        <script>
            window.addEventListener("load", () => {
                let time = 6
                const interval = setInterval(() => {
                    time--
                    if(time == 0) {
                        window.location.replace("scramblepad.html")
                        clearInterval(interval)
                    }
                },1000)
            })
        </script>
        <?php
    }

    //als dit niet werkt kijk naar https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
    //use bcrypt to hash password check chat gpt


}

?>