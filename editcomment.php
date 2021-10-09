<div class="panel panel-default">
  <div class="panel-body">
  	<form method="post">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Name</label>
	    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Title">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">EMail</label>
	    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Comment</label>
	    <textarea name="subject" class="form-control" rows="6"></textarea>
	  </div>
	  <div class="form-group">
		  <div class="row">
				<div class="col-md-6">
				<label>Post Status</label>
					<select name="status" multiple class="form-control">
					  <option value="draft">Draft</option>
					  <option value="published">Published</option>
					</select>
				</div>
			  </div>
		  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
  </div>
</div>