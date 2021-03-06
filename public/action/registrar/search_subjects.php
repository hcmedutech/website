<?php
/*
Holy Child Montessori
2017

Search Subjects
*/

//Start Session
session_start();

// Declare Permission Level
$perm = 4;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

// Check if empty query
if(empty($query)){

    $r = @$db_subject->select(array());
    
} else {

    $r = $db_subject->like(array(), "$searchBy", "/.*$query/");

}

// Check if empty results
if(!$r){

    echo "
	<div class='card'>
		<div class='card-content'>
		    <center>No results found for $query</center>
		</div>
	</div>";

} else {

    // Loop along
    foreach($r as $subject){

        $subject_id = $subject['subject_id'];
        $subject_title = $subject['subject_title'];
        $subject_description = $subject['subject_description'];
        $grade = $subject['grade'];
        $subject_code = $subject['subject_code'];
        $units = $subject['units'];

        echo "
        <div class='card'>
            <div class='card-content'>
                <b>$subject_title </b> $subject_code<br>
                <p>
                Description: $subject_description<br>
                Grade: $grade<br>
                Subject Code: $subject_code<br>
                Units: $units<br>
                Subject ID: $subject_id
                </p>
            </div>
            <div class='card-action'>
                <a class='green-text' href='../../forms/registrar/create_subject.php?subject_id=$subject_id'>Edit Subject</a>
                <a class='green-text' href='../../forms/registrar/create_class.php?subject_id=$subject_id'>Create Class</a>
            </div>
        </div>
        ";

    }
}

?>