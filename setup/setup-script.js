const generateQRCodeButton = document.getElementById("generateQRCode");
const printBtn = document.getElementById("print-btn");
const select = document.getElementById("select");

generateQRCode.addEventListener("click", function () {
  var selectedOption = select.options[select.selectedIndex];
  var deurnaamValue = selectedOption.value;

  console.log("data-value1: " + deurnaamValue);

  let ipAddress = location.hostname;
  console.log("ip = ");
  console.log(ipAddress);

  let qrURL = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${ipAddress}%2FGIP%2FGIP%2Fsetup%2Fset_qrCookies.php%3Fdeurnaam%3D${deurnaamValue}`;
  let qrImage = document.createElement("img");
  qrImage.src = qrURL;

  let container = document.getElementById("container");
  container.appendChild(qrImage);

  printBtn.style.display = "block";
});
