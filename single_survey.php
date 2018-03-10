<!-----------------SURVEY-------------->
<!----database---->
<?php include "includes/database.php" ?>
<?php $page['name']  = 'single_survey'; ?>
<?php 
  if(isset($_REQUEST['survey']) && $_REQUEST['survey'] != ''){
	     $req_survey = explode('-', $_REQUEST['survey']);
	     $current_survey = $req_survey[0];          // seperate survey id
         
  }else{
	  header("Location:surveys.php");
	  exit;
  } ?>
 <?php
 			 // $current_user_ip_id - for except voted surveys
				$survey_query = $mysqli->query("SELECT category.category_name as category_name, users.name as username, surveys.* FROM `surveys` 
				LEFT JOIN `users` ON users.id=surveys.user_id
				LEFT JOIN `category` ON category.id=surveys.category
				WHERE surveys.status ='active' AND surveys.id=".$current_survey." ORDER BY surveys.id DESC LIMIT 0,1");
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
									// related tags
						$current_related_tags = array();
						$current_related_tags =  explode(',', $survey_list[0]['tags']);
						
						// page title set
						$page['title'] = $survey_list[0]['title'];
			      }else{   
			   	   $page['title']  = str_replace($req_survey[0].'-', '', $_REQUEST['survey']);
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
				<?php if(isset($search) && $search != ''){ ?>
                <div class="col-sm-12 search_result_div">Search Results For - <?php echo $search; ?></div>
                 <div class="clearfix"></div>
				<?php } ?>
				<!---End Alerts-->
             <!--Survey List-->
<?php 	   
         // show survey result or survey option	
      if($survey_query->num_rows > 0){
	$user_query = $mysqli->query("SELECT * FROM `voting`
				WHERE survey_id='".$survey_list[0]['id']."' AND voter_id ='".$current_user_ip_id."' ORDER BY id ASC");
				if($user_query->num_rows > 0){
					include "includes/survey_result.php";
				}else{
					include "includes/surveylist.php";
				}
	?>
	          <div id=vuukle-emote></div>
                  <div id=vuukle_div></div>
                  <script src=http://vuukle.com/js/vuukle.js type=text/javascript></script>
                  <script type=text/javascript>
                   var VUUKLE_CUSTOM_TEXT = '{ "rating_text": "Give a rating:", "comment_text_0": "Leave a comment", "comment_text_1": "comment", "comment_text_multi": "comments", "stories_title": "Talk of the Town" }';
                    var UNIQUE_ARTICLE_ID = "<?php echo $survey_list[0]['id']; ?>";
                    var SECTION_TAGS = "<?php echo $survey_list[0]['tags']; ?>";
                    var ARTICLE_TITLE = "<?php echo $survey_list[0]['title']; ?>";
                    var GA_CODE = "UA-123456";
                    var VUUKLE_API_KEY = "506fc1a5-7dc7-493f-9b4c-b3578e528c4e";
                    var TRANSLITERATE_LANGUAGE_CODE = "en";
                    var VUUKLE_COL_CODE = "148aa3";
                    var ARTICLE_AUTHORS = btoa(encodeURI('[{"name": "name one", "email":"some_mail@site.com","type": "internal"}, {"name":"name two", "email":"some_other_mail@site.com","type": "external"}]'));
                    create_vuukle_platform(VUUKLE_API_KEY, UNIQUE_ARTICLE_ID, "0", SECTION_TAGS, ARTICLE_TITLE, TRANSLITERATE_LANGUAGE_CODE, "1", "", GA_CODE, VUUKLE_COL_CODE, ARTICLE_AUTHORS);
                  </script>
				
		<?php		}else{  // RESULTS NOT FOUND ?>
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