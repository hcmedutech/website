<?php
session_start();
include("../../_system/config.php");
include("../../_system/database/db.php");

$db_studentclass = new DBase("student_class", "../../_store");
$db_student = new DBase("student", "../../_store");
$db_class = new DBase("class", "../../_store");

$activity_title = "View All Grades";
if(empty($_SESSION['account_type'])){
    header("Location: ../../");
} else {
    $account_type = $_SESSION['account_type'];
    if($account_type === "admin"){
    } else {
        header("Location: ../../");
    }
}

if(empty($_REQUEST['student_id'])){
    header("Location: ../../");
} else {
    $student_id = $_REQUEST['student_id'];
    $check = $db_student->get("student_id", "student_id", "$student_id");
    if(empty($check)){
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $enroll_array = $db_studentclass->where(array(), "student_id", "$student_id");        
        $first_name = $db_student->get("first_name", "student_id", "$student_id");
        $last_name = $db_student->get("last_name", "student_id", "$student_id");
        $suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
    }
}

if(empty($_SERVER['HTTP_REFERER'])){
    $from = "../../";
} else {
    $from = $_SERVER['HTTP_REFERER'];
}
?>
<!Doctype html>
<html>
    <head>
        <title><?=$activity_title . " - " . $site_title?></title>
        <?php
            include("../../_system/styles.php");
        ?>
    </head>
    <body>
        <nav class="nav-extended <?=$primary_color?>">
			<div class="nav-wrapper">
			<a class="title"><?=$activity_title?></a>
			<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
			</div>
            <div class="nav-content">
				<span class="nav-title"><?=$first_name." " .$last_name." ".$suffix_name." (".$student_id.")"?></span>
			</div>
		</nav>
        <br><br>
        <div class="container">
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>School Year</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>1st</th>
                        <th>2nd</th>
                        <th>3rd</th>
                        <th>4th</th>
                        <th>Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($enroll_array)){

                        } else {
                            foreach($enroll_array as $enroll){
                                $school_year = $enroll['school_year'];
                                $class_id = $enroll['class_id'];
                                $first_quarter = $enroll['first_quarter_grade'];
                                $second_quarter = $enroll['second_quarter_grade'];
                                $third_quarter = $enroll['third_quarter_grade'];
                                $fourth_quarter = $enroll['fourth_quarter_grade'];
                                $final_grade = $enroll['final_grade'];
                                $class_title = $db_class->get("class_title", "class_id", "$class_id");
                                $grade = $db_class->get("grade", "class_id", "$class_id");
                                
                                echo "                                
                                <tr>
                                    <td>$school_year</td>
                                    <td>$grade</td>
                                    <td>$class_title</td>
                                    <td>$first_quarter</td>
                                    <td>$second_quarter</td>
                                    <td>$third_quarter</td>
                                    <td>$fourth_quarter</td>
                                    <td>$final_grade</td>
                                </tr>                                
                                ";

                            }
                        }
                    ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">