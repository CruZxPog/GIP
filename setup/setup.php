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
                $option_data1 = $row["deur naam"];
                $option_data2 = $row["rank"];
                $option_class = ($row["chipid"] !== "") ? "in-use" : "";
                $options[] = array("value" => $option_value, "data_value1" => $option_data1,"data_value2" => $option_data2, "class" => $option_class);
            }
        }

        // Generate the HTML for the dropdown menu
        echo '<select id="select" required>';
        echo '<option disabled selected value="">Select your door</option>'; // Add placeholder option
        foreach ($options as $option) {
          echo '<option value="' . $option["value"] . '" class="' . $option["class"] . '" ' 
          . 'data-value1="' . $option["data_value1"] . '" data-value2="' . $option["data_value2"] . '" '
          . ($option["class"] ? 'disabled' : '') . '>' . $option["value"] . '</option>';
       
        }
        echo '</select>';

        // Close the database connection
        $link->close();
      ?>

      <button type="button" id="submit" onclick="setCookies();">Submit</button>

      <button type="button" id="generateQRCode">Generate QR Code</button>
      <div id="qr-container">
      <div id="container"></div>
      </div>
      <button type="button" id="print-btn" onclick="window.print();">Print QR Code</button>
    
    </form>
  </body>
</html>