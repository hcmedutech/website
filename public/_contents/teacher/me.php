<?php
	include("../_include/setup.php");
	$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
	$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
	$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
	$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
	$name = $first_name . " " . $last_name . " " . $suffix_name;
	if(empty($photo_url)) $photo_url = "assets/imgs/noimg.png";	
?>
<style>
	.collection-title{
		font-size:12pt;
		padding-top:20px;
	}
	i.circle{
		margin-top: 10px;
	}
	.user-name{
		font-size:15pt;
		padding-top:6px;
	}
</style>
<ul class="collection">
	<li class="collection-item avatar">
		<?php echo "<a href='#profilepic'><img src='/$photo_url' class='circle'></a>"; ?>		<p class="user-name"><?=$name?></p>
		<p class="grey-text">
			<a href="settings/account" class="grey-text">
				@<?=$username?> <i class="material-icons tiny">edit</i><br>
			</a>
			<?=$teacher_id?>
		</p>
	</li>
	<li class="collection-item avatar">
		<a href="profile/?teacher_id=<?=$teacher_id?>" class="black-text">
			<i class="material-icons circle red">person</i>
			<p class="collection-title grey-text text-darken-2">My Profile</p>
		</a>
	</li>
	<li class="collection-item avatar">
		<a href="/assets/docs/gradebook_template.xlsx" class="black-text">
			<i class="material-icons circle blue">assessment</i>
			<p class="collection-title grey-text text-darken-2">Gradebook Template <i class="material-icons tiny">launch</i></p>
		</a>
	</li>
	<li class="collection-item avatar">
		<a href="https://drive.google.com/drive/folders/0B3k_JJe8SSgmMTQwTEI2STJTWEk?usp=sharing" class="black-text">
			<i class="material-icons circle pink">folder</i>
			<p class="collection-title grey-text text-darken-2">Resources for Teachers <i class="material-icons tiny">launch</i></p>
		</a>
	</li>
	<?php
		include("../common/me_public.php");
	?>
</ul>
<?php
	include("../common/versioning.php");
?>
  <script type="text/javascript">
	$('.modal').modal();
  </script>
