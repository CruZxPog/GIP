#include <WiFi.h>
#include <HTTPClient.h>
// #include <Preferences.h>

const char* ssid = "WIFIIICT";
const char* password = "fakatijger";
//Your Domain name with URL path or IP address with path
String serverName = "http://10.3.41.20/gip/gip/login/doorStatus.php";

// the following variables are unsigned longs because the time, measured in
// milliseconds, will quickly become a bigger number than can be stored in an int.
unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
//unsigned long timerDelay = 600000;
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 1000;
const int slot = 12;
const int PIN_BLUE = 27;
const int PIN_RED = 26;
const int PIN_GREEN = 14;


// Preferences preferences;

void setup() {
  pinMode(slot,      OUTPUT);
  pinMode(PIN_RED,   OUTPUT);
  pinMode(PIN_GREEN, OUTPUT);
  pinMode(PIN_BLUE,  OUTPUT);

  Serial.begin(115200); 

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
 
  Serial.println("Timer set to 5 seconds (timerDelay variable), it will take 5 seconds before publishing the first reading.");
}

void loop() {
  digitalWrite(PIN_RED, LOW);
  digitalWrite(PIN_GREEN, LOW);
  digitalWrite(PIN_BLUE, HIGH);
  //Send an HTTP POST request every 10 minutes
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;
      
      uint64_t chipid = ESP.getEfuseMac();
      char chipid_str[17];
      sprintf(chipid_str, "%016llX", chipid);

      String serverPath = serverName + "?naam="+chipid_str;
      Serial.println(serverPath);
      
      // Your Domain name with URL path or IP address with path
      http.begin(serverPath.c_str());
      
      // Send HTTP GET request
      int httpResponseCode = http.GET();
      
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);

        //check payload (door status)
        if (payload == "open" ) {
          //open door
          digitalWrite(PIN_RED, LOW);
          digitalWrite(PIN_GREEN, HIGH);
          digitalWrite(PIN_BLUE, LOW);

          digitalWrite(slot,HIGH);
        } else if (payload == "close") {
          //close door
          digitalWrite(PIN_RED, HIGH);
          digitalWrite(PIN_GREEN, LOW);
          digitalWrite(PIN_BLUE, LOW);

          digitalWrite(slot,LOW);
        } else if (payload == "wrong"){
          digitalWrite(PIN_RED, HIGH);
          digitalWrite(PIN_GREEN, LOW);
          digitalWrite(PIN_BLUE, LOW);

          digitalWrite(slot,LOW);
        }
        
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
      ESP.restart();
    }
    lastTime = millis();
  }
}

