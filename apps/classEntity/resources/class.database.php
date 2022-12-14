<?php
/*
*
* MARCO VOEGELI 31.12.2005
* www.voegeli.li
*
* This class provides one central database-connection for
* al your php applications. Define only once your connection
* settings and use it in all your applications.
*
*
*/

  
 class Database
 { // Class : begin
 
 var $host;  		//Hostname, Server
 var $password; 	//Passwort MySQL
 var $user; 		//User MySQL
 var $database; 	//Datenbankname MySQL
 var $link;
 var $query;
 var $result;
 var $rows;
 
 function Database()
 { // Method : begin
 //Konstruktor
 
 
 
 // ********** DIESE WERTE ANPASSEN **************
 // ********** ADJUST THESE VALUES HERE **********
 
  $this->host = "localhost";                  //          <<---------
  $this->password = "1234";           //          <<---------
  $this->user = "iwang1";                   //          <<---------
  $this->database = "onewscom_zak";           //          <<---------
  $this->rows = 0;
 
 // **********************************************
 // **********************************************
 
 
  
 } // Method : end
 
 function OpenLink()
 { // Method : begin
  $this->link = @mysqli_connect($this->host,$this->user,$this->password) or die (print "Class Database: Error while connecting to DB (link)");
 } // Method : end
 
 function SelectDB()
 { // Method : begin
 
 @mysqli_select_db($this->database,$this->link) or die (print "Class Database: Error while selecting DB");
  
 } // Method : end
 
 function CloseDB()
 { // Method : begin
 mysqli_close();
 } // Method : end
 
 function Query($query)
 { // Method : begin
 $this->OpenLink();
 $this->SelectDB();
 $this->query = $query;
 $this->result = mysqli_query($query,$this->link) or die (print "Class Database: Error while executing Query");
 
// $rows=mysqli_affected_rows();

if(ereg("SELECT",$query))
{
 $this->rows = mysqli_num_rows($this->result);
}
 
 $this->CloseDB();
 } // Method : end	
  
 } // Class : end
 
?>
