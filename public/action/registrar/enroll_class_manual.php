<?php
session_start();
	include("../../_system/secure.php");
	include("../../_system/database/db.php");
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
				header("Location: $from");
		}
	}
	
	$db_account = new DBase("account", "../../_store");
	$db_notification = new DBase("notification", "../../_store");
	$db_class = new DBase("class","../../_store");
	$db_student = new DBase("student", "../../_store");
	$db_enroll = new DBase("student_class", "../../_store");
	$db_hold = new DBase("student_hold","../../_store");
	
					$notif_id = rand(1000000000,9999999999);
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");

	
	$enroll_id = rand(1000000000,9999999999);
	$student_id = $_POST['student_id'];
	$class_id = $_POST['class_id'];
	$enroll_month = date("M");
	$enroll_day = date("d");
	$enroll_year = date("Y");
	$enroll_hour = date("H");
	$enroll_minute = date("i");
	
	$check_student = $db_student->get("student_id", "student_id", "$student_id");
	$check_hold = $db_hold->get("student_id","student_id","$student_id");
	$check_id = $db_class->get("class_id", "class_id", "$class_id");
	
	if(empty($check_student)){
		echo  "Student does not exist";
	} else {
		if(empty($check_hold)){
			if(empty($check_id)){
				echo "Class Not Found";
			} else {
				
				$first_name = $db_student->get("first_name", "student_id", "$student_id");
				$last_name = $db_student->get("last_name",  "student_id", "$student_id");
				$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
				$class_title = $db_class->get("class_title", "class_id", "$class_id");
				$school_year = $db_class->get("school_year", "class_id", "$class_id");
				
				$array = array(
				"enroll_id" => "$enroll_id",
				"school_year" => "$school_year",
				"student_id" => "$student_id",
				"class_id" => "$class_id",
				"enroll_month" => "$enroll_month",
				"enroll_day" => "$enroll_day",
				"enroll_year" => "$enroll_year",
				"enroll_hour" => "$enroll_hour",
				"enroll_minute" => "$enroll_minute",
				"first_quarter_grade" => "",
				"second_quarter_grade" => "",
				"third_quarter_grade" => "",
				"fourth_quarter_grade" => "",
				"final_grade" => "",
				"enroll_notes" => ""
				);
				
				$db_enroll->add($array);
				
				$user_id = $db_account->get("user_id", "student_id", "$student_id");
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "You are now enrolled in $class_title ",
					"notification_content" => "Congratulations! You are now enrolled in your class $class_title for SY $school_year.",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "assignment_turned_in",
					"user_id" => "$user_id",
					"sender_alternative" => "Registrar",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);

				echo "<span class='green-text'> $first_name $last_name $suffix_name enrolled in $class_title </span>";
				
			}
		} else {
			echo "Student on hold";
		}
	}
		
?>