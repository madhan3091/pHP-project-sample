			<div class="row main">
				<div class="main_create" align='left'>
				<?php if(!isset($edit_survey)){ ?>
				<h2 align='center'>Create Survey</h2>
				<?php }else{ ?>
				<h2 align='center'>Edit Survey</h2>
				<?php } ?>
					<form action="createsurvey.php" id='create_survey_form' method="post" action="#">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Survey Title <span>*</span></label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"></i></span>
									<textarea type="text" class="form-control" name="title" placeholder="Write Short Title.." required='required'><?php echo $edit_survey['title']; ?></textarea>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Survey Description <span>*</span></label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
									<textarea type="text" class="form-control" name="description"  placeholder="Write Short Summary.." required='required'><?php echo $edit_survey['description']; ?></textarea>
								</div>
							</div>
						</div>
						
				<label for="username" class="cols-sm-2 control-label">Options <span>*</span> (Min - 2, Max - 4 options)</label>
	
	<!----------edit option-------->
	<?php if(isset($edit_survey)){ ?>
	 <p>You Can't Edit Existing Options.. Only can Delete/Add options</p>
<?php 	foreach ($edit_survey['options'] as $option) {  ?>
	
	<div class="form-group survey_option_group extra_option" id="option-<?php echo $option['id']; ?>">
	   <div class="col-sm-11">
		  <div class="input-group">
			<span class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></span>
			<p class="form-control"><?php echo $option['option_name']; ?></p>
		  </div>
	   </div>
	 <div class="col-sm-1">
<a type="button" class="btn btn-danger removeoption" onclick="removeExistOption(<?php echo $option['survey_id']; ?>,<?php echo $option['id']; ?>);">
			<i class="fa fa-remove" aria-hidden="true"></i>
		</a>
	 </div>
	   <br>
	</div>	

	<?php } } ?>

<?php if(!isset($edit_survey)){ ?>
						<div class="form-group survey_option_group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="option[]" required='required'/>
								</div>
							</div>
						</div>
						<div class="form-group survey_option_group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="option[]" required='required'/>
								</div>
							</div>
						</div>
<?php } ?>

			<div class="form-group addOptionDiv" align='center'>
			<button type="button" class="btn btn-default addOptionButton"><i class="fa fa-plus"></i> Add Option </button>
			</div>    
            <div class='clearfix'></div>			
							<div class="form-group">
								<label for="email" class="cols-sm-2 control-label">Category <span>*</span></label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></span>
								<select required='required' name="category" class="form-control">
											<option value="">Select Category</option>
<?php 			
			$cat_query = $mysqli->query("SELECT * FROM `category` WHERE status ='active' ORDER BY id ASC");
				if($cat_query->num_rows > 0){
					while($cat_row = $cat_query->fetch_assoc()){
                       if($edit_survey['category'] == $cat_row['id']){
						   echo "<option value='".$cat_row['id']."' selected>".$cat_row['category_name']."</option>";
					   }else{
						   echo "<option value='".$cat_row['id']."'>".$cat_row['category_name']."</option>";
					   }					
						
					}
            }
?>
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="cols-sm-2 control-label">Tags <span>*</span></label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i></span>
											<select required='required' name="tags[]" multiple class="tags form-control">
											 <option value="">Select Tags</option>
<?php 			
		
		$query_tags = "SELECT GROUP_CONCAT(tags) tags FROM surveys WHERE status='active'";
		$select_tags = $mysqli->query($query_tags);	 
		$row_tags = $select_tags->fetch_assoc();
		// Then explode them
		$tags = $row_tags['tags'];
		$tags_array= explode(',', $tags);
		$tags_array = array_unique($tags_array);
					foreach ($tags_array as $tag) {
                       if(in_array($tag, explode(',',$edit_survey['tags']) ) ){
						   echo "<option value='".$tag."' selected>".$tag."</option>";
					   }else{
						   echo "<option value='".$tag."'>".$tag."</option>";
					   }						
					}
?>
											</select>
									</div>
								</div>
							</div>
						
						<div class="form-group ">
					<?php if(!isset($edit_survey)){ ?>
							<button type="submit" name='create_survey' id="create_survey_submit" class="btn btn-primary btn-lg btn-block login-button">Create Survey</button>
                    <?php }else{ ?>
	<input type="text" name="survey_id" class="sr-only" value="<?php echo $edit_survey['id']; ?>">
	<button type="submit" name='update_survey' id="create_survey_submit" class="btn btn-primary btn-lg btn-block login-button">Update Survey</button>					
					<?php } ?>					
					</div>
						
					</form>
				</div>
			</div>