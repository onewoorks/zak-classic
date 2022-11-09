

<?php

// SAMPLE FOR METHOD INSERT()

include_once("../generated_classes/class.User.php");
include_once("../facade/userFacade.php");

$test = new User();

$test->usr_fname = "Irwan B Ibrahim";
$test->usr_name = "iwang";
$test->usr_password = 'kancil21';


//$test->insert();

$result = $test->select(1);
echo $test->getusr_name();

$go = new userFacade();
//$result2 = $go->findAll();
echo $go->findAll();
echo "<br />";
echo $go->getSingleObject('usr_name');


//print "inserted as record $test->id";

?>