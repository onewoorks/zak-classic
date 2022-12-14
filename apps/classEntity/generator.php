<?php



include("resources/class.database.php");
$database = new Database();







if($_REQUEST["f"]=="")
{
?>

<font face="Arial" size="3"><b>
PHP MYSQL Class Generator
</b>
</font>

<font face="Arial" size="2"><b>

<form action="generator.php" method="POST" name="FORMGEN">

1) Select Table Name: 
<br>

<select name="tablename">

<?php
$database->OpenLink();
$tablelist = mysqli_list_tables($database->database, $database->link);
while ($row = mysqli_fetch_row($tablelist)) {
print "<option value=\"$row[0]\">$row[0]</option>";
}
?>
</select>

<p>
2) Type Class Name (ex. "test"): <br>
<input type="text" name="classname" size="50" value="">
<p>
3) Type Name of Key Field:
<br>
<input type="text" name="keyname" value="" size="50">
<br>
<font size=1>
(Name of key-field with type number with autoincrement!)
</font>
<p>


<input type="submit" name="s1" value="Generate Class">
<input type="hidden" name="f" value="formshowed">

</form>

</b>
</font>
<p>
<font size="1" face="Arial">
<a href="http://www.voegeli.li" target="_blank">
this is a script from www.voegeli.li
</a>
</font>


<?php
} else {

// fill parameters from form
$table = $_REQUEST["tablename"];
$class = $_REQUEST["classname"];
$key = $_REQUEST["keyname"];

$dir = dirname(__FILE__);

$filename = $dir . "/generated_classes/" . "class." . $class . ".php";

// if file exists, then delete it
if(file_exists($filename))
{
unlink($filename);
}

// open file in insert mode
$file = fopen($filename, "w+");
$filedate = date("d.m.Y");

$c = "";

$c = "
<!-- begin of generated class -->
<?php
/*
*
* -------------------------------------------------------
* CLASSNAME:        $class
* GENERATION DATE:  $filedate
* CLASS FILE:       $filename
* FOR MYSQL TABLE:  $table
* FOR MYSQL DB:     $database->database
* -------------------------------------------------------
* CODE GENERATED BY:
* MY PHP-MYSQL-CLASS GENERATOR
* -------------------------------------------------------
*
*/

include_once(\"resources/class.database.php\");

// **********************
// CLASS DECLARATION
// **********************

class $class
{ // class : begin


// **********************
// ATTRIBUTE DECLARATION
// **********************

var $$key;   // KEY ATTR. WITH AUTOINCREMENT
";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;


while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];

if($col!=$key)
{

$c.= "
var $$col;   // (normal Attribute)";


} // endif
//"print "$col";
} // endwhile

$cdb = "$" . "database";
$cdb2 = "database";
$c.="

var $cdb; // Instance of class database

";

$cthis = "$" . "this->";
$thisdb = $cthis . $cdb2 . " = " . "new Database();";

$c.= "
// **********************
// CONSTRUCTOR METHOD
// **********************

function $class(){
    $thisdb
}

";

$c.="
// **********************
// GETTER METHODS
// **********************

";
// GETTER
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];
$mname = "get" . $col . "()";
$mthis = "$" . "this->" . $col;
$c.="
function $mname{
return $mthis;
}
";
}


$c.="
// **********************
// SETTER METHODS
// **********************

";
// SETTER
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];
$val = "$" . "val";
$mname = "set" . $col . "($" . "val)";
$mthis = "$" . "this->" . $col . " = ";
$c.="
function $mname{
$mthis $val;
}
";
}


$sql = "$" . "sql = ";
$id = "$" . "id";
$thisdb = "$" . "this->" . "database";
$thisdbquery = "$" . "this->" . "database->query($" . "sql" . ")";
$result = "$" . "result = ";
$row = "$" . "row";
$result1 = "$" . "result";
$res = "$" . "result = $" . "this->database->result;";

$c.="
// **********************
// SELECT METHOD / LOAD
// **********************

function select($id){

$sql \"SELECT * FROM $table WHERE $key = $id;\";
$result $thisdbquery;
$res
$row = mysqli_fetch_object($result1);
";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];
$cthis = "$" . "this->" . $col . " = $" . "row->" . $col;

$c.="
$cthis;
";
}

$c.="
}
";


$zeile1 = "$" . "sql" . " = \"DELETE FROM $table WHERE $key = $id;\"";
$zeile2 = "$" . "result = $" . "this->database->query($" . "sql);";
$c.="
// **********************
// DELETE
// **********************

function delete($id){
$zeile1;
$zeile2
";
$c.="
}
";

$zeile1 = "$" . "this->$key = \"\"";
$zeile2 = "INSERT INTO $table (";
$zeile5= ")"; 
$zeile3 = "";
$zeile4 = "";
$zeile6 = "VALUES (";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];

if($col!=$key)
{
$zeile3.= "$col" . ",";
$zeile4.= "'$" . "this->$col" . "',";
//$zeile3 = rtrim($zeile3);
//$zeile4 = rtrim($zeile4);
//$zeile3 = str_replace(",", " ", $zeile3);
//$zeile4 = str_replace(",", " ", $zeile4);
}

}

$zeile3 = substr($zeile3, 0, -1);
$zeile4 = substr($zeile4, 0, -1);
$sql = "$" . "sql =";
$zeile7 = "$" . "result = $" . "this->database->query($" . "sql);";
$zeile8 = "$" . "row";
$zeile9 = "$" . "result";
$zeile10 = "$" . "this->$key = " . "mysqli_insert_id($" . "this->database->link);";

$c.="
// **********************
// INSERT
// **********************

function insert(){
$zeile1; // clear key for autoincrement

$sql \"$zeile2 $zeile3 $zeile5 $zeile6 $zeile4 $zeile5\";
$zeile7
$zeile10

}
";


// UPDATE ----------------------------------------

$zeile1 = "$" . "this->$key = \"\"";
$zeile2 = "UPDATE $table SET ";
$zeile5= ")"; 
$zeile3 = "";
$zeile4 = "";
$zeile6 = "VALUES (";

$upd = "";

$sql = "SHOW COLUMNS FROM $table;";
$database->query($sql);
$result = $database->result;
while ($row = mysqli_fetch_row($result)) 
{
$col=$row[0];

if($col!=$key)
{
$zeile3.= "$col" . ",";
$zeile4.= "$" . "this->$col" . ",";
$upd.= "" . "$col = '$" . "this->$col',";
//$zeile3 = rtrim($zeile3);
//$zeile4 = rtrim($zeile4);
//$zeile3 = str_replace(",", " ", $zeile3);
//$zeile4 = str_replace(",", " ", $zeile4);
}

}

$zeile3 = substr($zeile3, 0, -1);
$zeile4 = substr($zeile4, 0, -1);
$upd = substr($upd, 0, -1);
$sql = "$" . "sql = \"";
$zeile7 = "$" . "result = $" . "this->database->query($" . "sql)";
$zeile8 = "$" . "row";
$zeile9 = "$" . "result";
$zeile10 = "$" . "this->$key = $" . "row->$key";
$id = "$" . "id";
$where = "WHERE " . "$key = $" . "id";

$c.="
// **********************
// UPDATE
// **********************

function update($id){
$sql $zeile2 $upd $where \";
$zeile7;
";
$c.="
}
";
$c.= "
} // class : end

?>
<!-- end of generated class -->
";
fwrite($file, $c);

print "
<font face=\"Arial\" size=\"3\"><b>
PHP MYSQL Class Generator
</b>
<p>
<font face=\"Arial\" size=\"2\"><b>
Class '$class' successfully generated as file '$filename'!
<p>
<a href=\"javascript:history.back();\">
back
</a>

</b></font>

";


?>
<p>
<font size="1" face="Arial">
</a>
</font>

<?php
} // endif
?>