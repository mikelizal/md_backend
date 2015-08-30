

import static java.lang.System.in;
import gvjava.org.json.JSONException;
import gvjava.org.json.JSONObject;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;

import javax.net.ssl.HttpsURLConnection;

public class Main {


	static String tipoobservacion ;
	static String iddispositivo ;
	static String datos ;
	static String clave = "ab5639kgaht54kjgahtrlbfgmadgf";
	
	public static void main(String[] args) throws JSONException, IOException {
		
		//
		// TODO Auto-generated method stub
				// BufferedReader br = new BufferedReader(new InputStreamReader(new
				// FileInputStream("lista.txt")));
				String directorio = "./";
				File f = new File(directorio);
				
				String[] directo = f.list();
				if(directo == null){
					
				}
				boolean existe = false;
				if (f.exists()) {
					existe = true;
				} else {
					existe = false;
					
				}

				if (existe == true) {
					File[] file = f.listFiles();
					
					for (int i = 0; i < file.length; i++) {
						datos ="";
						
						if (file[i].getName().contains(".TXT")) {
							String name = file[i].getName();
						
							String[] nam = name.toString().split("\\_");
							String year="";
							if(nam.length>0){
								
							char c1 = nam[1].charAt(2);
							char c2 = nam[1].charAt(3);
							char c3 =nam[1].charAt(4);
							char c4 =nam[1].charAt(5);
							 year = ""+c1 + c2 +c3 +c4;
							 
							
							}

							JSONObject jsonObj = new JSONObject();
							jsonObj.put("clave",clave);
							String mes="";
							String antena ="";
							String observador="";

							BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream(file[i])));
							String linea = br.readLine();
							int cont = 0;
							int aux=0;
							while (linea != null) {
								
								if(linea.contains("[Observer]")){
									aux=1;
									String obs[] = linea.split("\\[Observer]");
									observador = obs[1];
									System.out.println(observador);
								}
								String palabras[] = linea.split("\\|");
								if (cont == 0) {
									 mes = palabras[0];
									System.out.println(mes);
								}else{
									if(aux==0){
									for(int x=1; x< palabras.length;x++){
										datos =datos+palabras[x];
										if(x<palabras.length-1){
											datos = datos+",";
										}					
									}
									datos = datos+",||,";
									}
									
								}
								
								if(linea.contains("[Receiver]")){
									String ant[] = linea.split("\\[Receiver]");
									antena = ant[1];
								}
								
								linea = br.readLine();
								cont++;
							}
							datos = datos.replace(" ", "");
							System.out.println("datooooooss "+datos);
							jsonObj.put("mes", mes);
							jsonObj.put("observador",observador);
							jsonObj.put("antena",antena);
							jsonObj.put("year",year);
							
							jsonObj.put("tipoobservacion", tipoobservacion);
							jsonObj.put("iddispositivo", iddispositivo);
							jsonObj.put("datos", datos);
							
							
							String jsonString = jsonObj.toString();
							
							
							try {
								
								// Generar la URL
								String url = "https://lol-jvisca.rhcloud.com/rest/server.php";						
								// creamos el objeto url para mandar el json
								URL obj = new URL(url);
								// establecemos la conexion
								HttpsURLConnection con = (HttpsURLConnection) obj.openConnection();
								
								// añadimos cabecera
								con.setRequestMethod("POST");			
								// Creamos los parametros para enviar
								String urlParameters = "json=" + jsonString;
								
								// Enviamos los datos por POST
								con.setDoOutput(true); // 		
								DataOutputStream wr = new DataOutputStream(con.getOutputStream());
								wr.writeBytes(urlParameters);
								wr.flush();//obligamos a que mande todo y se quede el buffer vacio.
								wr.close();
								// para comprobar que se manda todo 
								int responseCode = con.getResponseCode();
								
								
								in.close();
							} catch (Exception e) {
								e.printStackTrace();
							}
					
							file[i].delete();
							
						}
						

					}
				}
		
		
		
	}

	

	
	
	

}
