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

      <button type="submit" id="submit">Submit</button>

      <button type="button" id="generateQRCode" onclick="generateQRCode()">Generate QR Code</button>
      <div id="container"></div>
      <button type="button" id="print-btn">Print QR Code</button>
    
    </form>
   
    <script>
      function setCookies() {
        // Get the values of the input and select fields
        let deurnaamValue = document.getElementById("deurnaam").value.toLowerCase();
        let deurrankValue = document.getElementById("deurrank");

        // Set the cookies with the values
        document.cookie = "deurnaam=" + encodeURIComponent(deurnaamValue);
        document.cookie = "deurrank=" + encodeURIComponent(deurrankValue);
      }

      function generateQRCode() {
        // Get the values of the input and select fields
        let deurnaamValue = document.getElementById("deurnaam").value.toLowerCase();
        let deurrankValue = document.getElementById("deurrank");

        // Get the IP address of the host
        let ipAddress = location.hostname;  

        // Generate the URL with the cookie values
        let qrURL = `http://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http%3A%2F%2F${ipAddress}%2Fset_qrCookies.html%3Fdeurnaam%3D${deurnaamValue}%26deurrank%3D${deurrankValue}`;

        // Create a new image element with the QR code as the source
        let qrImage = document.createElement("img");
        qrImage.src = qrURL;

        // Append the QR code to the container
        let container = document.getElementById("container");
        container.appendChild(qrImage);

        printBtn.style.display = "block";
      }

      const printBtn = document.getElementById("print-btn");
printBtn.addEventListener("click", () => {
  window.print();
});


    </script>
  </body>
</html>
