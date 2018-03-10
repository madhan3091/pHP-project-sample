<!-----------------SURVEY-------------->
<!----database---->
<?php include "includes/database.php" ?>
<?php if(!isset($_REQUEST['edit_survey'])){ 
		$page['name']  = 'create_survey';
		$page['title']  = 'Create Survey';
	  }else{ 
		$page['name']  = 'edit_survey';
		$page['title']  = 'Edit Survey';								
	  } 
?>
<?php
   // create survey
  if(isset($_REQUEST['create_survey'])){
	
	$title = addslashes($_POST['title']);
	$description = addslashes($_POST['description']);
	$category = $_POST['category'];
	$tags = implode(',', $_POST['tags']);
	$option = $_POST['option'];
	$slug = seoUrl($title);	
	
	$check_survey = $mysqli->query("SELECT * FROM `surveys` WHERE url_slug='".$slug."'");
	$check_survey = $check_survey->num_rows;
	
	if($check_survey > 0){
		$slug = $slug.'-'.$check_survey;
	}
	
	$query = "INSERT INTO `surveys`(`title`, `description`, `category`, `tags`, `user_id`, `url_slug`) VALUES ('".$title."','".$description."','".$category."','".$tags."','".$_SESSION['user']['id']."','".$slug."')";
//	echo $query;
	$insert = $mysqli->query($query);
	$survey_id = $mysqli->insert_id;
	 if($insert){
		 
		foreach($option as $opt){	
			if($opt != ''){
				$mysqli->query("INSERT INTO `options`(`option_name`, `survey_id`) VALUES ('".addslashes($opt)."','".$survey_id."')");
			}	
		}		

		$_SESSION['notification'] = "Survey is Created Successfully !!";
		header('Location:my_account.php?s=survey#survey-'.$survey_id);
	 }else{
		 $_SESSION['notification'] = "Sorry..Something went wrong.. Try Again !!";	 
	 }
   
  }
  
   // edit survey
    if(isset($_REQUEST['edit_survey'])){
	 
	  if( $_GET['editId'] == ''){
		  header('Location:surveys.php');
	  }else{
		  $edit_id = $_GET['editId'];
	  }	    
	  
		$check_survey = $mysqli->query("SELECT * FROM `surveys` WHERE is_deleted = 'no' AND user_id=".$_SESSION['user']['id']." AND id=".$edit_id);
		$count_survey = $check_survey->num_rows;
		
		if($count_survey == 0){
			 header('Location:surveys.php');
		}else{
			$edit_survey = $check_survey->fetch_assoc();
			// option add
  $option_query = $mysqli->query("SELECT * FROM `options` WHERE survey_id='".$edit_id."' AND status ='active' ORDER BY id ASC");
				if($option_query->num_rows > 0){
					while($option_row = $option_query->fetch_assoc()){	
					   $edit_survey['options'][] = $option_row; 
					}
				}	
		}
	  
    }
	
	   // update survey
  if(isset($_POST['update_survey'])){
	
	$survey_id = $_POST['survey_id'];
	$title = addslashes($_POST['title']);
	$description = addslashes($_POST['description']);
	$category = $_POST['category'];
	$tags = implode(',', $_POST['tags']);
	$option = $_POST['option'];
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($title));	
	
	$check_survey = $mysqli->query("SELECT * FROM `surveys` WHERE url_slug='".$slug."' AND id !=".$survey_id);
	$check_survey = $check_survey->num_rows;
	
	if($check_survey > 0){
		$slug = $slug.'-'.$check_survey;
	}
	
	$query = "UPDATE `surveys` SET title='".$title."',description='".$description."',category=".$category.",tags='".$tags."',url_slug='".$slug."' WHERE id =".$survey_id;
	// echo $query; exit;
	$update = $mysqli->query($query);
	 if($update){
		 
		foreach($option as $opt){	
			if($opt != ''){
				$mysqli->query("INSERT INTO `options`(`option_name`, `survey_id`) VALUES ('".addslashes($opt)."','".$survey_id."')");
			}	
		}		
		$_SESSION['notification'] = "Survey is Updated Successfully !!";
		header('Location:my_account.php?s=survey#survey-'.$survey_id);
	 }else{
		$_SESSION['notification'] = "Sorry..Something went wrong.. Try Again !!";
	 }
   
  }

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<!--Head-->
		<?php include "includes/head.php" ?>
    </head>
    <body>  

<div class="container-fluid">
<!--Header-->
<?php include "includes/header.php" ?>
<!--End Header-->
<div class="clearfix"></div>
 <section class="content">
  <div class="container">
         <div class="row">

             <?php include "includes/left-sidebar.php" ?>
             <div class="col-lg-6 col-md-6">
               <!---Alerts-->
                <?php  include "includes/alerts.php" ?>
                <!---End Alerts-->
				<div class="clearfix"></div>
			             <!---Create Survey Form-->
                 <?php if(isset($_SESSION['user'])){  ?>
                         <!---survey form-->
                <?php  include "includes/survey_form.php" ?>
                <!---survey form-->      	 
	
				 <?php }else{ ?> 
		<div class="col-md-12">
            <div class="error-template">
                <h3>
                    You have to Sign Up to Create Your Survey 
				</h3>
     <div class="error-details col-sm-6 col-sm-offset-3">
      <a class="btn btn-block btn-social btn-facebook"  href="<?php echo htmlspecialchars($loginURL); ?>">
        <i class="fa fa-facebook"></i> Sign in with Facebook
      </a>  
	</div>
            </div>
        </div>			 
				 
				 <?php } ?>
						 <!--End Survey Form-->
             </div><br>
                <?php  include "includes/right-sidebar.php" ?>
         </div>
  </div>
 </section>

<!--Footer-->
<?php include "includes/footer.php" ?>
<!--End Footer-->
</div><!--Container-->
<script>
$(document).ready(function() {
	
    $('.tags').select2({ tags:true,theme: "classic" });
	
	$('.addOptionButton').on('click', function(){
	 
	 if($('.survey_option_group').length == 4){
		 alert("Maximum 4 Options Only Allowed");
		 return false;
	 }
	 
		var html = '';
		html = html+'<div class="form-group survey_option_group extra_option">';
		html = html+'<div class="col-sm-11">';
		html = html+'<div class="input-group">';
		html = html+'<span class="input-group-addon"><i class="fa fa-gg-circle" aria-hidden="true"></i></span>';
		html = html+'<input type="text" class="form-control" name="option[]" />';
		html = html+'</div>';
		html = html+'</div>';
		html = html+'<div class="col-sm-1">';
		html = html+'<a type="button" class="btn btn-danger removeoption" onclick="removeOption(this);"><i class="fa fa-remove" aria-hidden="true"></i></a>';
		html = html+'</div><br>';
		html = html+'</div>';
		
		$('.survey_option_group').last().after(html);
		
	});
	
});	

 function removeOption(event){

	   $(event).closest('.survey_option_group').remove(); 
 }
 
  function removeExistOption(surveyId,optionId){
	 
    if(!confirm("Are you sure to remove this Option?")){
       return false;
    }else{

        $.ajax({

            url: 'ajax_functions.php',

            type: 'POST',   

            dataType: 'json',

            data: {
                action: 'delete_option',
                surveyId:surveyId,
                optionId:optionId
            },
            success: function(res) {       
				console.log(res);
				if(res.result == 'failed'){
					alert(res.message);
				}else if(res.result == 'success'){
					 alert(res.message);
					 $('#option-'+optionId).remove();
				}else{
					 alert(res.message);
				}
			},
            error: function(jqXHR, textStatus, errorThrown) {
				alert("Something Went Wrong..Try Again !!");
                console.log(jqXHR);
            }
        });

    }
 }

</script>

 </body>

</html>