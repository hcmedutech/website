<?php
	session_start();
	include("../../_system/secure.php");
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	
	include("../../_system/config.php");
	$activity_title = "Class Search";
?>
<!Doctype html>
<html>
	<head>
		<title><?=$activity_title?> - <?=$site_title?></title>
		<?php
			include("../../_system/styles.php");
		?>
	</head>
	<body class="grey lighten-3">
		<nav class="<?=$primary_color?>">
			<a class="title"><?=$activity_title?></a>
			<a href="../../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		
		<div class="container">
			<br>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="query">
					<label for="query">Query</label>
				</div>
				<div class="input-field col s6">
					<select id="searchBy" class="browser-default">
						<option value="class_id">Class ID</option>
						<option value="subject_title">Subject Title</option>
						<option value="subject_id">Subject ID</option>
						<option value="grade">Grade</option>
						<option value="school_year">School Year</option>
						<option value="section">Section</option>
						<option value="class_code">Class Code</option>
						<option value="class_room">Class Room</option>
						<option value="access_code">Access Code</option>
						<option value="teacher_id">Teacher ID</option>
						<option value="start_time">Start Time(24h)</option>
						<option value="end_time">End Time (24h)</option>
						<option value="schedule">Schedule</option>
						<option value="max_students">Maximum No of Students</option>
					</select>
				</div>
			</div>
			<button class="btn btn-medium <?=$accent_color?> waves-effect waves-light" id="searchButton">Search</button>
			<br><br>
			<div id="searchresult"></div>
			
		</div>
		<br><br><br><br><br>
	</body>
</html>
<script type="text/javascript">
	
	$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			search();
		}
	});
	
	$("#searchButton").click(function(){
		search();
	});
	
	function search(){
		var q = $("#query").val();
		var s = $("#searchBy").val();
		
		$.ajax({
			type: 'POST',
			url: '../../action/registrar/search_classes.php',
			data: {
				query: q,
				searchBy: s
			},
			cache: false,
			success: function(result){
				$("#searchresult").html(result);
			}
		}).fail(function(){
			var failview = "<div class='card'><div class='card-content'><center><p class='grey-text'>Error connecting to server</p></center></div></div>";
			$("#searchresult").html(failview);
		});
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">