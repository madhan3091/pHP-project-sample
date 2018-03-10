<!-----------------SURVEY-------------->
<!----database---->
<?php include "includes/database.php" ?>
<?php $page['name']  = 'surveys'; ?>
<?php 
  if(isset($_REQUEST['s']) && $_REQUEST['s'] != ''){
	     $search = $_REQUEST['s'];
         $page['title']  = 'Search - '.$search;
  }else{
	  $page['title']  = 'Surveys List';
  } ?>

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
				<?php if(isset($search) && $search != ''){ ?>
                <div class="col-sm-12 search_result_div">Search Results For - <?php echo $search; ?></div>
                 <div class="clearfix"></div>
				<?php } ?>
				<!---End Alerts-->
             <!--Survey List-->
<?php 	   
      $limit = 5;
      if(isset($_GET['page']) && $_GET['page'] != "") {
        $current_page = $_GET['page'];
        $offset = $limit * ($current_page-1);
      } else {
        $current_page = 1;
        $offset = 0;
      }

              // SEARCH RESULTS
			if(isset($search) && $search != ''){
			  $search_query = "AND ( surveys.title LIKE '%".$search."%' OR surveys.description LIKE '%".$search."%' )";
			}else{ $search_query=''; }
			 // $current_user_ip_id - for except voted surveys
$survey_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.id NOT IN (select vs.survey_id from voting vs where vs.voter_id ='".$current_user_ip_id."' )
				AND surveys.status ='active' ".$search_query." ORDER BY surveys.id DESC LIMIT ".$offset.",".$limit);

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
					include "includes/surveylist.php";
					
			// pagination //
$pagination_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.id NOT IN (select vs.survey_id from voting vs where vs.voter_id ='".$current_user_ip_id."' )
				AND surveys.status ='active' ".$search_query." ORDER BY surveys.id DESC");

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
                    No Results Not Found
				</h2>
                <div class="error-details">
                  
                </div>
            </div>
        </div>										
		<?php  }  ?>
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