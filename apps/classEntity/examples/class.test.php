
<!-- begin of generated class -->
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        test
* GENERATION DATE:  02.01.2006
* CLASS FILE:       generated_classes/class.test.php
* FOR MYSQL TABLE:  test
* FOR MYSQL DB:     test
* -------------------------------------------------------
* CODE GENERATED BY:
* MY PHP-MYSQL-CLASS GENERATOR
* from: >> www.voegeli.li >> (download for free!)
* -------------------------------------------------------
*
*/

include_once("resources/class.database.php");

// **********************
// CLASS DECLARATION
// **********************

class test
{ // class : begin


// **********************
// ATTRIBUTE DECLARATION
// **********************

var $id;   // KEY ATTR. WITH AUTOINCREMENT

var $name;   // (normal Attribute)
var $vorname;   // (normal Attribute)
var $adresse;   // (normal Attribute)
var $telefon;   // (normal Attribute)
var $jahr;   // (normal Attribute)

var $database; // Instance of class database


// **********************
// CONSTRUCTOR METHOD
// **********************

function test()
{

$this->database = new Database();

}


// **********************
// GETTER METHODS
// **********************


function getid()
{
return $this->id;
}

function getname()
{
return $this->name;
}

function getvorname()
{
return $this->vorname;
}

function getadresse()
{
return $this->adresse;
}

function gettelefon()
{
return $this->telefon;
}

function getjahr()
{
return $this->jahr;
}

// **********************
// SETTER METHODS
// **********************


function setid($val)
{
$this->id =  $val;
}

function setname($val)
{
$this->name =  $val;
}

function setvorname($val)
{
$this->vorname =  $val;
}

function setadresse($val)
{
$this->adresse =  $val;
}

function settelefon($val)
{
$this->telefon =  $val;
}

function setjahr($val)
{
$this->jahr =  $val;
}

// **********************
// SELECT METHOD / LOAD
// **********************

function select($id)
{

$sql =  "SELECT * FROM test WHERE id = $id;";
$result =  $this->database->query($sql);
$result = $this->database->result;
$row = mysqli_fetch_object($result);


$this->id = $row->id;

$this->name = $row->name;

$this->vorname = $row->vorname;

$this->adresse = $row->adresse;

$this->telefon = $row->telefon;

$this->jahr = $row->jahr;

}

// **********************
// DELETE
// **********************

function delete($id)
{
$sql = "DELETE FROM test WHERE id = $id;";
$result = $this->database->query($sql);

}

// **********************
// INSERT
// **********************

function insert()
{
$this->id = ""; // clear key for autoincrement

$sql = "INSERT INTO test ( name,vorname,adresse,telefon,jahr ) VALUES ( '$this->name','$this->vorname','$this->adresse','$this->telefon','$this->jahr' )";
$result = $this->database->query($sql);
$this->id = mysqli_insert_id($this->database->link);

}

// **********************
// UPDATE
// **********************

function update($id)
{



$sql = " UPDATE test SET  name = '$this->name',vorname = '$this->vorname',adresse = '$this->adresse',telefon = '$this->telefon',jahr = '$this->jahr' WHERE id = $id ";

$result = $this->database->query($sql);



}


} // class : end

?>
<!-- end of generated class -->
