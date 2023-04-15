<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setup Page</title>
    <link rel="stylesheet" href="setup_style.css">
  </head>
  <body>
    <div class="container">
      <form action="../login/scramblepad.html" onsubmit="setCookies()">
        <?php
          // Connect to the database
          $link = mysqli_connect("localhost", "root", "", "locks");

          if ($link->connect_error) {
              die("Connection failed: " . $link->connect_error);
          }

          // Query the database to get the options for the dropdown menu
          $sql = "SELECT * FROM `doors`";
          $result = $link->query($sql);
          $options = array();

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $option_value = $row["deur naam"];
                  $option_class = ($row["chipid"] !== "") ? "in-use" : "";
                  $options[] = array("value" => $option_value, "class" => $option_class);
              }
          }

          // Generate the HTML for the dropdown menu
          echo '<select id="deurnaam" name="deurrank" required>';
          echo '<option disabled selected value="">Select your door</option>'; // Add placeholder option
          foreach ($options as $option) {
              echo '<option value="' . $option["value"] . '" class="' . $option["class"] . '" ' . ($option["class"] ? 'disabled' : '') . '>' . $option["value"] . '</option>';
          }
          echo '</select>';

          // Close the database connection
          $link->close();
        ?>

        <button type="submit">Submit</button>
      </form>
    </div>

    <script>
      function setCookies() {
        // Get the values of the input and select fields
        let deurnaamValue = document.getElementById("deurnaam").value.toLowerCase();
        let deurrankValue = document.getElementById("deurrank").value.toLowerCase();

        // Set the cookies with the values
        document.cookie = "deurnaam=" + encodeURIComponent(deurnaamValue);
        document.cookie = "deurrank=" + encodeURIComponent(deurrankValue);
      }
    </script>
  </body>
</html>
