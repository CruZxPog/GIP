<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Setup Page</title>
   <script src="setup-script.js" defer></script>
    <link rel="stylesheet" href="setup_style.css">
  </head>
  <body>
    <form action="set_qrCookies.php">
      <?php
        // Connect to the database
        $link = mysqli_connect("sql104.epizy.com", "epiz_34138247", "PjAnnVCkxFqLb00", "epiz_34138247_lokcs");

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
        echo '<select id="select" name="deurnaam" aria-label="Select your door" required>';
        echo '<option disabled selected value="">Select your door</option>'; // Add placeholder option
        foreach ($options as $option) {
          ?>
          <option
            value="<?php echo $option["value"] ?>"
            <?php echo $option["class"] ? 'class="' . $option["class"] . '"' : '' ?>
            <?php echo $option["class"] ? 'disabled' : '' ?>
          >
            <?php echo $option["value"] ?>
          </option>
         
          <?php
        }
        echo '</select>';

        // Close the database connection
        $link->close();
      ?>
      <button type="submit" id="submit">Submit</button>

      <button type="button" id="generateQRCode">Generate QR Code</button>
      <div id="qr-container">
      <div id="container"></div>
      </div>
      <button type="button" id="print-btn" onclick="window.print();">Print QR Code</button>
    
    </form>
  </body>
</html>