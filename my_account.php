
<!-----------------SURVEY-------------->
<!----database---->
<?php include "includes/database.php" ?>
<?php $page['name']  = 'my_account'; ?>
<?php $page['title']  = 'My Account'; ?>
<?php  // active tab
  if(isset($_GET['s'])){
	$show = $_GET['s'];
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
		    <div class="row">
        <div class="col-md-12">
            <div class="tab" id='accountTab' role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php if($show == 'survey') echo 'active'; ?>"><a href="#my_surveys" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-globe"></i>  My Surveys</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in <?php if($show == 'survey') echo 'active'; ?>" id="my_surveys">
<?php  		
		$survey_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.user_id ='".$_SESSION['user']['id']."' AND surveys.is_deleted = 'no' ORDER BY surveys.status ASC,surveys.id DESC");

				if($survey_query->num_rows > 0){
					$survey_list = Array();
					$i=0;
					while($survey_row = $survey_query->fetch_assoc()){						
						$survey_list[] = $survey_row;              
					// options add //
					$option_query = $mysqli->query("SELECT * FROM `options`
				WHERE survey_id='".$survey_row['id']."' AND status ='active' ORDER BY id ASC");
				if($option_query->num_rows > 0){
					while($option_row = $option_query->fetch_assoc()){	
					   $survey_list[$i]['options'][] = $option_row; 
					}
				}				
					$i++;
					}
					include "includes/survey_result.php";
				}else{  // RESULTS NOT FOUND ?>
        <div class="col-md-12">
            <div class="error-template">
                <h2> You haven't created any survey yet	</h2>
                <a class="btn btn-primary" id="createButton" href="createsurvey.php">Create Survey</a>
            </div>
        </div>			
		<?php  } ?>				
                    </div>
                </div>
            </div>
        </div>
    </div>		 
	
				 <?php } ?>
						 <!--End Survey Form-->
             </div>
                <?php  include "includes/right-sidebar.php" ?>
         </div>
  </div>
 </section>

<!--Footer-->
<?php include "includes/footer.php" ?>
<!--End Footer-->
</div><!--Container-->

 </body>

</html>