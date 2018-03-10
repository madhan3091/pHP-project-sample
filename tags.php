<!-----------------CATEGORY-------------->

<!----database---->
<?php include "includes/database.php" ?>
<?php $page['name']  = 'tags'; ?>
<?php
if(isset($_REQUEST['tag'])){
	
					$tag = $_REQUEST['tag'];
                    $page['title'] = "Survey Tag - ".$tag;					
}else{
	                $tag = '';
                    $page['title'] = "Survey Tag Search";	
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
				<!---Search Results-->
				<?php if(isset($tag) && $tag != ''){ ?>
                <div class="col-sm-12 search_result_div">Tag Results For - <?php echo $tag; ?></div>
                 <div class="clearfix"></div>
				<?php } ?>
				<!---End Alerts-->
             <!--Survey List-->
<?php 	   

if( $tag != '' ){
	
	          // pagination start
				  $limit = 5;
				  if(isset($_GET['page']) && $_GET['page'] != "") {
					$current_page = $_GET['page'];
					$offset = $limit * ($current_page-1);
				  } else {
					$current_page = 1;
					$offset = 0;
				  }	
				$survey_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.id NOT IN (select vs.survey_id from voting vs where vs.voter_id ='".$current_user_ip_id."' )
				AND FIND_IN_SET('".$tag."', tags) AND surveys.status ='active' ORDER BY surveys.id  DESC LIMIT ".$offset.",".$limit);

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
					
				// related tags
				$current_related_tags = array();
                $current_related_tags[] =  $tag;
					
				}				
					$i++;
					}
					include "includes/surveylist.php";              
	
			// pagination //
$pagination_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.id NOT IN (select vs.survey_id from voting vs where vs.voter_id ='".$current_user_ip_id."' )
				AND FIND_IN_SET('".$tag."', tags) AND surveys.status ='active' ORDER BY surveys.id DESC");

			$total_rows = $pagination_query->num_rows;	
                // page link			
				if(isset($search) && $search != ''){ 
						$link = "surveys.php?s=".$search;
				 }else{
					 $link = "surveys.php?";
				 }
	
				pagination($current_page,$total_rows,$limit,$link);
			// End pagination //
	
				}else{  // RESULTS NOT FOUND ?>
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Sorry!
				</h1>
                <h2>
                    No Results Found
				</h2>
                <div class="error-details">
                  
                </div>
            </div>
        </div>										
		<?php		}
}elseif( $category_id == ''){ // CATEGORY NOT FOUND ?>
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!
				</h1>
                <h2>
                    Category Not Found
				</h2>
                <div class="error-details">
                  
                </div>
            </div>
        </div>
<?php } ?> 

            <!--End Survey List-->
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