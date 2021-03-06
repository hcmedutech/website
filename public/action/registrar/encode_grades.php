<?php
/*
Holy Child Montessori
2017

Encode Grades
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 4;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$enroll_id = $_POST['enroll_id'];
$first_quarter_grade = $_POST['first_quarter_grade'];
$second_quarter_grade = $_POST['second_quarter_grade'];
$third_quarter_grade = $_POST['third_quarter_grade'];
$fourth_quarter_grade = $_POST['fourth_quarter_grade'];
$final_grade = $_POST['final_grade'];

// Update DB
$db_enroll->to("first_quarter_grade", "$first_quarter_grade", "enroll_id", "$enroll_id");
$db_enroll->to("second_quarter_grade", "$second_quarter_grade", "enroll_id", "$enroll_id");
$db_enroll->to("third_quarter_grade", "$third_quarter_grade", "enroll_id", "$enroll_id");
$db_enroll->to("fourth_quarter_grade", "$fourth_quarter_grade", "enroll_id", "$enroll_id");
$db_enroll->to("final_grade", "$final_grade", "enroll_id", "$enroll_id");

// Get Student Data
$student_id = $db_enroll->get("student_id", "enroll_id", "$enroll_id");	
$student_info = $db_student->where(array(),"student_id",$student_id);
foreach($student_info as $student){
    $first_name = $student['first_name'];
    $last_name = $student['last_name'];
    $suffix_name = $student['suffix_name'];
}

$class_id = $db_enroll->get("class_id", "enroll_id", "$enroll_id");
$subject_id = $db_class->get("subject_id","class_id","$class_id");
$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");	
$user_id = $db_account->get("user_id", "student_id", "$student_id");

// Prepare Notif
$notif_title = "$subject_title grade has been encoded";
$notif_content = "Your grade for $subject_title is ready to be viewed.";
$notif_icon = "assessment";
$notif_user_id = "$user_id";
$notif_sender_alternative = "Registrar";

// Send Notification
include("../_require/notif.php");

$parent_array = $db_parentchild->where(array(),"student_id","$student_id");

if(!empty($parent_array)){

    foreach($parent_array as $parent){
        $parent_id = $parent['parent_id'];
        $user_id = $db_account->get("user_id", "parent_id", "$parent_id");
        if(!empty($user_id)){

            // Prepare Notif
            $notif_title = "$first_name's grade for $subject_title has been encoded";
            $notif_content = "$first_name's $subject_title grade is ready to be viewed.";
            $notif_icon = "assessment";
            $notif_user_id = "$user_id";
            $notif_sender_alternative = "Registrar";

            // Send Notification
            include("../_require/notif.php");

        }
    }

}

echo "Grades of $first_name $last_name $suffix_name has been encoded successfully!";

?>