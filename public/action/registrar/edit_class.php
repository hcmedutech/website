<?php
/*
Holy Child Montessori
2017

Edit Class
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$class_id = $_POST['class_id'];
$subject_id = $_POST['subject_id'];
$school_year = $_POST['school_year'];
$section = $_POST['section'];
$class_code = $_POST['class_code'];
$class_room = $_POST['class_room'];
$access_code = $_POST['access_code'];
$teacher_id = $_POST['teacher_id'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$schedule = $_POST['schedule'];
$max_students = $_POST['max_students'];

// Check if Class exists
if($db_class->exists("class_id","$class_id")){

	// Check if Subject Exists
	if($db_subject->exists("subject_id", "$subject_id")){

		// Check school year
		if(!$school_year){

			echo "School Year Required";

		} else {

			// Construct Array
			$array = array(
			"class_id" => "$class_id",
			"subject_id" => "$subject_id",
			"school_year" => "$school_year",
			"section" => "$section",
			"class_code" => "$class_code",
			"class_room" => "$class_room",
			"access_code" => "$access_code",
			"teacher_id" => "$teacher_id",
			"start_time" => "$start_time",
			"end_time" => "$end_time",
			"schedule" => "$schedule",
			"max_students" => "$max_students"
			);
			
			// Get Index
			$index = $db_class->index("class_id", "$class_id");

			// Update Data
			$db_class->update($index, $array);
			
			echo "<span class='green-text text-darken-2'>Class $class_id has been edited successfully.</span>";

		}
	
	} else {
	
		echo "Subject $subject_id Doesn't Exist";
	
	}

} else {

	echo "Class Doesn't Exist";

}

?>