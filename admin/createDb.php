<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'locks';
$sql_file = 'C:\wamp64\www\GIP\GIP\admin\locks.sql';

// Create connection
$conn = mysqli_connect($host, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully!<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select the database
mysqli_select_db($conn, $database);

// Read SQL file
$sql = file_get_contents($sql_file);

// Execute multi-query SQL commands
if (mysqli_multi_query($conn, $sql)) {
    echo "SQL script executed successfully!";
} else {
    echo "Error executing SQL script: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>

<script>
    window.addEventListener("load", () => {
                let time = 2
                const interval = setInterval(() => {
                    time--
                    if(time == 0) {
                        window.location.replace("admin.html")
                        clearInterval(interval)
                    }
                },1000)
            })
</script>