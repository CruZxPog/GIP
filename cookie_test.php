<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cookie Test</title>
</head>
<body>
  <h1>Cookie Test</h1>

  <?php
    if (isset($_COOKIE["deurnaam"])) {
      echo "<p>Deurnaam: " . $_COOKIE["deurnaam"] . "</p>";
    }

    if (isset($_COOKIE["deurrank"])) {
      echo "<p>Deurrank: " . $_COOKIE["deurrank"] . "</p>";
    }
  ?>
</body>
</html>
