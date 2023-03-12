#include <WiFi.h>
#include <HTTPClient.h>
// #include <Preferences.h>

const char* ssid = "Tuganet-2";
const char* password = "56353044";
String name;
String naam;
//Your Domain name with URL path or IP address with path
String serverName = "http://192.168.0.170/gip/login/doorstatus.php";

// the following variables are unsigned longs because the time, measured in
// milliseconds, will quickly become a bigger number than can be stored in an int.
unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
//unsigned long timerDelay = 600000;
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 1000;
const int redled = 12;
const int greenled = 13;
// Preferences preferences;

void setup() {
  pinMode(redled, OUTPUT);
  pinMode(greenled, OUTPUT);
  digitalWrite(redled,HIGH);

  Serial.begin(115200); 

  // preferences.begin("my-app", false); // Open the preferences with the app name "my-app"
 
  // Read the name from preferences, or set it to "unknown" if it's not found
//  name = preferences.getString("name", "unknown");
 
//  Serial.print(name);
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

char *chipid() {
  uint64_t chipid = ESP.getEfuseMac();
  char chipid_str[17];
  sprintf(chipid_str, "%016llX", chipid);
  return chipid_str;
}


void loop() {
  //Send an HTTP POST request every 10 minutes
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;

      // Serial.print("name ");
      // Serial.println(name);

      String serverPath = serverName + "?naam="+chipid();
      
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
          digitalWrite(redled,LOW);
          digitalWrite(greenled,HIGH);
        } else if (payload == "close") {
          //close door
          digitalWrite(greenled,LOW);
          digitalWrite(redled,HIGH);
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
    }
    lastTime = millis();
  }
}
