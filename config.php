<?php

$host = "";
$user = "";
$password = "";
$dbname = "";
//$con = pg_connect("host=ec2-44-199-22-207.compute-1.amazonaws.com dbname=d5q8alf1vr45m6 user=jhpbmtnugzwckq password=3d73164f88296ccca9315be4729a42a29c554f294ca8e1206b18e164cfc898df");
 $con = pg_connect("host=localhost dbname=loginform user=postgres password=India@123");

if (!$con) {

	die('Connection failed.');

}

// $con = pg_connect("host=ec2-44-199-22-207.compute-1.amazonaws.com dbname=d5q8alf1vr45m6 user=jhpbmtnugzwckq password=3d73164f88296ccca9315be4729a42a29c554f294ca8e1206b18e164cfc898df");
