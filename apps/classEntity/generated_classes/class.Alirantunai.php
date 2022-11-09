
<!-- begin of generated class -->
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        Alirantunai
* GENERATION DATE:  02.02.2012
* CLASS FILE:       D:\xampplite\htdocs\zak\apps\classEntity/generated_classes/class.Alirantunai.php
* FOR MYSQL TABLE:  tbl_alirantunai
* FOR MYSQL DB:     onewscom_zak
* -------------------------------------------------------
* CODE GENERATED BY:
* MY PHP-MYSQL-CLASS GENERATOR
* -------------------------------------------------------
*
*/

include_once("resources/class.database.php");

// **********************
// CLASS DECLARATION
// **********************

class Alirantunai
{ // class : begin


// **********************
// ATTRIBUTE DECLARATION
// **********************

var $at_id;   // KEY ATTR. WITH AUTOINCREMENT

var $at_timeDate;   // (normal Attribute)
var $at_perkara;   // (normal Attribute)
var $at_kategori;   // (normal Attribute)
var $at_jumlah;   // (normal Attribute)
var $at_guna;   // (normal Attribute)
var $at_beratEmas;   // (normal Attribute)
var $stf_id;   // (normal Attribute)
var $caw_id;   // (normal Attribute)
var $usr_id;   // (normal Attribute)
var $at_zak;   // (normal Attribute)

var $database; // Instance of class database


// **********************
// CONSTRUCTOR METHOD
// **********************

function Alirantunai(){
$this->database = new Database();
}


// **********************
// GETTER METHODS
// **********************


function getat_id(){
return $this->at_id;
}

function getat_timeDate(){
return $this->at_timeDate;
}

function getat_perkara(){
return $this->at_perkara;
}

function getat_kategori(){
return $this->at_kategori;
}

function getat_jumlah(){
return $this->at_jumlah;
}

function getat_guna(){
return $this->at_guna;
}

function getat_beratEmas(){
return $this->at_beratEmas;
}

function getstf_id(){
return $this->stf_id;
}

function getcaw_id(){
return $this->caw_id;
}

function getusr_id(){
return $this->usr_id;
}

function getat_zak(){
return $this->at_zak;
}

// **********************
// SETTER METHODS
// **********************


function setat_id($val){
$this->at_id =  $val;
}

function setat_timeDate($val){
$this->at_timeDate =  $val;
}

function setat_perkara($val){
$this->at_perkara =  $val;
}

function setat_kategori($val){
$this->at_kategori =  $val;
}

function setat_jumlah($val){
$this->at_jumlah =  $val;
}

function setat_guna($val){
$this->at_guna =  $val;
}

function setat_beratEmas($val){
$this->at_beratEmas =  $val;
}

function setstf_id($val){
$this->stf_id =  $val;
}

function setcaw_id($val){
$this->caw_id =  $val;
}

function setusr_id($val){
$this->usr_id =  $val;
}

function setat_zak($val){
$this->at_zak =  $val;
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select($id){

$sql =  "SELECT * FROM tbl_alirantunai WHERE at_id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysqli_fetch_object($result);


$this->at_id = $row->at_id;

$this->at_timeDate = $row->at_timeDate;

$this->at_perkara = $row->at_perkara;

$this->at_kategori = $row->at_kategori;

$this->at_jumlah = $row->at_jumlah;

$this->at_guna = $row->at_guna;

$this->at_beratEmas = $row->at_beratEmas;

$this->stf_id = $row->stf_id;

$this->caw_id = $row->caw_id;

$this->usr_id = $row->usr_id;

$this->at_zak = $row->at_zak;

}

// **********************
// DELETE
// **********************

function delete($id){
$sql = "DELETE FROM tbl_alirantunai WHERE at_id = $id;";
$result = $this->database->query($sql);

}

// **********************
// INSERT
// **********************

function insert()
{
$this->at_id = ""; // clear key for autoincrement

$sql = "INSERT INTO tbl_alirantunai ( at_timeDate,at_perkara,at_kategori,at_jumlah,at_guna,at_beratEmas,stf_id,caw_id,usr_id,at_zak ) VALUES ( '$this->at_timeDate','$this->at_perkara','$this->at_kategori','$this->at_jumlah','$this->at_guna','$this->at_beratEmas','$this->stf_id','$this->caw_id','$this->usr_id','$this->at_zak' )";
$result = $this->database->query($sql);
$this->at_id = mysqli_insert_id($this->database->link);

}

// **********************
// UPDATE
// **********************

function update($id)
{



$sql = " UPDATE tbl_alirantunai SET  at_timeDate = '$this->at_timeDate',at_perkara = '$this->at_perkara',at_kategori = '$this->at_kategori',at_jumlah = '$this->at_jumlah',at_guna = '$this->at_guna',at_beratEmas = '$this->at_beratEmas',stf_id = '$this->stf_id',caw_id = '$this->caw_id',usr_id = '$this->usr_id',at_zak = '$this->at_zak' WHERE at_id = $id ";

$result = $this->database->query($sql);



}


} // class : end

?>
<!-- end of generated class -->