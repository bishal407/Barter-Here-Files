<div class="panel panel-default">
	<div class="panel-heading">Comments</div>
	<table class="table table-striped"> 
		<thead> 
		<tr> 
		<th>#</th> 
		<th>Name</th> 
		<th>Comment</th> 
		<th>Time</th> 
		<th>Status</th> 
		<th>Operations</th> 
		</tr> 
		</thead> 
		<tbody> 
		<tr> 
		<th scope="row">Comment ID</th> 
		<td>Name</td> 
		<td>Comment</td> 
		<td>Comment Time</td> 
		<td>Comment Status</td> 
		<td><a href="#">Edit</a> <a href="#">App</a> <a href="#">Dis</a> <a href="#">Del</a></td> 
		</tr> 
		</tbody> 
	</table>
</div>

$sql = "SELECT * FROM comments";
$res = mysqli_query($connection, $sql);


<?php
	while ( $r = mysqli_fetch_assoc($res)) {
?>
	<tr> 
		<th scope="row"><?php echo $r['id']; ?></th> 
		<td><?php echo $r['cid']; ?></td> 
		<td><?php echo $r['name'] ?></td> 
		<td><?php echo $r['subject']; ?></td> 
		<td><?php echo $r['submittime']; ?></td> 
		<td><?php if(isset($r['status']) & !empty($r['status'])){echo $r['status'];}else{echo "NA";} ?></td> 
		<td><a href="editcomment.php?id=<?php echo $r['id']; ?>">Edit</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=publish">App</a> <a href="commentstatus.php?id=<?php echo $r['id']; ?>&status=draft">Dis</a> <a href="delcomment.php?id=<?php echo $r['id']; ?>">Del</a></td> 
	</tr> 
<?php } ?>
