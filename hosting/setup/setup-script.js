const generateQRCodeButton = document.getElementById("generateQRCode");
const printBtn = document.getElementById("print-btn");
const select = document.getElementById("select");

generateQRCode.addEventListener("click", function () {
  // Get the values of the input and select fields
  var selectedOption = select.options[select.selectedIndex];
  var deurnaamValue = selectedOption.value;

  console.log("data-value1: " + deurnaamValue);

  // Get the IP address of the host
  let ipAddress = location.hostname;
  console.log("ip = ");
  console.log(ipAddress);

  // Generate the URL with the cookie values
  //let qrURL = `http://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http%3A%2F%2F${ipAddress}%2Fset_qrCookies.html%3Fdeurnaam%3D${deurnaamValue}%26deurrank%3D${deurrankValue}`;
  ///GIP/GIP/setup/set_qrCookies.html
  let qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${ipAddress}%2Flogin%2Fset_qrCookies.php%3Fdeurnaam%3D${deurnaamValue}`;
  // Create a new image element with the QR code as the source
  let qrImage = document.createElement("img");
  qrImage.src = qrURL;

  // Append the QR code to the container
  let container = document.getElementById("container");
  container.appendChild(qrImage);

  printBtn.style.display = "block";
});
