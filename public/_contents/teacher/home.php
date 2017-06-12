<?php
include("_setup.php");
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
$grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
$quarter = $db_schooldata->get("quarter", "school_id", "1");
if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow'>
			<div class='card-content'>
				<center>School is on Exam Week</center>
			</div>
		</div>
	";} else {$exam_week = "";}

if($grade_encode === "yes"){
	$grade_encode = "
		<div class='card'>
			<div class='card-content'>
				<center class='grey-text text-darken-2'>
				<i class='material-icons medium'>assessments</i><br>
				You may now encode grades for $quarter
				</center>
			</div>
		</div>
	";} else {$grade_encode = "";}

?>
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
startTime();
</script>
<div class="container">
<br>
<h4 class="seagreen-text">
	My Feed
</h4>
<br>

<div class="card">
<div class="card-content">
	<h5>
		Today is <?=date("M d Y")?> <span id="txt"></span>
	</h5>
</div>
</div>
<div id="postFeed">
<?php
	echo $exam_week;
	echo $grade_encode;
	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
