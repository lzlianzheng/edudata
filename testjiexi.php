<?php
$json_string='{"id":1,"name":"foo","email":"foo@foobar.com","interest":["wordpress","php"]} ';
$obj=json_decode($json_string);
echo $obj->id."<br>";
echo $obj->name."<br>"; //prints foo
echo $obj->email."<br>";
echo $obj->interest[1]."<br>"; //prints php
echo $obj->interest[0]."<br>";
?>