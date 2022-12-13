import serial
import time
import pymysql


# coneccion con la base de datos

miConexion = pymysql.connect(host='localhost', user="root", passwd="12345678" , db="registrador")
cur = miConexion.cursor()


# conexion con el puerto serial

arduino = serial.Serial('COM4',9600)


while True:

    time.sleep(2) #descansa cada 2 segundos la lectura
    data = arduino.readline() #toma la lectura del monitor serial en la linea
    dato = data.split() #crea una lista de data en dato binario
    #print(dato) #imprime en terminal la informacion capturada

    #convierte dato binario en scrip y luego a flotante para la base de datos
        # tomar en cuenta que solo se imprima desde arduino los valores de los datos
   
    temperatura = float(dato[1].decode("utf-8")) 
    
    #print(temperatura)
    humedad = float(dato[0].decode("utf-8"))
    #print(humedad)
    radiacion = float(dato[2].decode("utf-8"))
   
    calidad = float(dato[3].decode("utf-8"))

    # insertando los valores del puerto serial a la base de datos
    # ---------para temperatura --------
    query = "INSERT historial (datos,fecha,id_sensor) VALUES (%s,now(),1)" % temperatura
    print(query)
    cur.execute(query)
    miConexion.commit()
    # ---------para humedad --------
    query = "INSERT historial (datos,fecha,id_sensor) VALUES (%s,now(),71)" % humedad
    print(query)
    cur.execute(query)
    miConexion.commit()
     # ---------para radiacion solar --------
    query = "INSERT historial (datos,fecha,id_sensor) VALUES (%s,now(),81)" % radiacion
    print(query)
    cur.execute(query)
    miConexion.commit()
    # ---------para calidad del aire --------
    query = "INSERT historial (datos,fecha,id_sensor) VALUES (%s,now(),91)" % calidad
    print(query)
    cur.execute(query)
    miConexion.commit()

miConexion.close()
arduino.close()