#include <DHT.h>
#include <DHT_U.h>

//--------- DECLARACION DE SENSORES---------------//
//----------Humedad y temperatura (DHT22)--------
int SENSOR = 2; // pin DATA de DHT22 un pin digital 2
float TEMPERATURA;
float HUMEDAD;
//----------Radiacion solar (LDR)----------------
float RADIACION;
float LDRpin = A0;
//----------Calidad del aire (MQ-135)------------
//float MQ135pin = A1;
//int adc_MQ135; 
//float voltaje;
//int RL = 19741; //ohms
//float RsPRO = 43228060.822695;
//float Rs;
//float Ro;
//double CO2;

DHT dht (SENSOR, DHT22); // creación del objeto, cambiar segundo parámetro
        // por DHT11 si se utiliza en lugar del DHT22
void setup(){
  Serial.begin (9600); // inicializacion de monitor serial
  dht.begin (); // inicializacion de sensor

}

void loop () {

  delay (2000);
  //for (int i=0;i<10; i++) {
  TEMPERATURA = dht.readTemperature (); // obtencion de valor de temperatura
  HUMEDAD = dht.readHumidity (); // obtencion de valor de humedad
  RADIACION = analogRead(LDRpin);
  int adc_MQ135 = analogRead(A1); //Lemos la salida analógica  del MQ135
  float voltaje = adc_MQ135 * (5.0 / 1024.0); //Convertimos la lectura en un valor de voltaje
  int RL = 19741; //ohms
  float RsPRO = 43228060.822695;
  float Rs = 1024*(RL/voltaje)- RL;  //Calculamos Rs con un RL de 10kOhm medido con el ohmmimetro
  float Ro = RsPRO/(5.5973021420 * pow(415.90,-0.365425824)); //resistencia a 100 ppm de CO en aire limpio,estimado segun graficos.
  float CO2 = pow((Rs/Ro)/5.5973021420, 1/-0.365425824); // calculamos la concentración  de alcohol con la ecuación obtenida.
  //Serial.print ("Temperatura:"); // escritura en monitor serial de los valores
  Serial.print (TEMPERATURA);
  Serial.print (" ");
  //Serial.print ("Humedad:");
  Serial.print (HUMEDAD);
  Serial.print (" ");
  Serial.print (RADIACION);
  Serial.print (" ");
  Serial.println (CO2);

  //----LDR ----------------------
  
  //}
}

