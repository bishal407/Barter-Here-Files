<div class="panel panel-default">
<div class="panel-heading">Comments</div>
  <div class="panel-body">
  <?php 
  	$comsql = "SELECT * FROM comments";
  	$comres = mysqli_query($connection, $comsql);
  	while($comr = mysqli_fetch_assoc($comres)){
  		$hash = md5( strtolower( trim( $comr['email'] ) ) );
		$size = 150;
  		$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
  ?>
  	<div class="row">
  		<div class="col-md-3">
  			<img src="<?php echo $grav_url; ?>">
  		</div>
  		<div class="col-md-9">
  			<p><strong><?php echo $comr['name']; ?></strong> </p>
  			<p><?php echo $comr['submittime'] ?></p>
  			<p><?php echo $comr['subject']; ?></p>
  		</div>
  	</div>
  	<br>
  	<?php } ?>
  </div>
</div>