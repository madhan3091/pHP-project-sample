<?php
  // database
  include "includes/database.php"; 
  $action = $_REQUEST['action'];

  // VOTING SURVEY
  if($action == 'vote_survey' ){
	  
	  if(isset($_SESSION['user'])){
		
		   $voter_id = $_SESSION['user']['id'];
		   $voter_type = 'user';
		   
	  }else{ 
				
		   $voter_id = $ip;
		   $voter_type = 'guest';
		   
	  }
	  	
		  $result = Array();
		  $survey_id = $_REQUEST['surveyId'];
		  $option_id = $_REQUEST['optionId'];  
		
		
	$vote_check = $mysqli->query("SELECT * FROM `voting` WHERE survey_id=".$survey_id." AND voter_id ='".$voter_id."'");
		 if($vote_check->num_rows > 0){
			 $result['result'] = 'failed';
			 $result['message'] = 'You Have Already Voted This Survey';			 	 
		 }else{
			 
			$survey_update = $mysqli->query("UPDATE `surveys` SET total_votes=total_votes+1 WHERE id=".$survey_id);
			// options
			$option_update = $mysqli->query("UPDATE `options` SET votes=votes+1 WHERE id=".$option_id);
		    // voting
			$voting = $mysqli->query("INSERT INTO `voting`(`survey_id`, `option_id`, `voter_id`, `voter_type`) VALUES ('".$survey_id."','".$option_id."','".$voter_id."','".$voter_type."')");	 
		 
		    $survey_query = $mysqli->query("SELECT surveys.* FROM `surveys` WHERE id ='".$survey_id."'");

				if($survey_query->num_rows > 0){
					$survey_list = Array();
					$i=0;
					$survey_list = $survey_query->fetch_assoc();          
					// options add //
	$option_query = $mysqli->query("SELECT * FROM `options` WHERE survey_id='".$survey_id."' AND status ='active' ORDER BY votes DESC");
					if($option_query->num_rows > 0){
						while($option_row = $option_query->fetch_assoc()){	
						   $survey_list['options'][] = $option_row; 
						}
					}
					  $result['result'] = 'success';
					  $result['survey'] = $survey_list;
					  $result['message'] = 'Thanks for Voting..Keep Suggesting :)';	
				}else{
					 $result['result'] = 'failed';
					 $result['message'] = 'Something Went Wrong...';						
				}
		 
		 }
		 
		  echo json_encode($result); 
	      
  }
  //  END VOTING SURVEY


  // ACTIONS ON SURVEY
  if($action == 'activate_survey' ){
	 
		$result = Array();	 
	  	$survey_id = $_REQUEST['surveyId'];
	$survey_update = $mysqli->query("UPDATE `surveys` SET status='active',updated_on=NOW() WHERE user_id=".$_SESSION['user']['id']." AND id=".$survey_id);	  
					 
		if($survey_update){
					  $result['result'] = 'success';
					  $result['message'] = 'Survey has been Activated';	
		}else{
					 $result['result'] = 'failed';
					 $result['message'] = 'Something Went Wrong...';						
		}
		echo json_encode($result); 		
  }
  if($action == 'deactivate_survey' ){
	 
		$result = Array();	 
	  	$survey_id = $_REQUEST['surveyId'];
	$survey_update = $mysqli->query("UPDATE `surveys` SET status='inactive',updated_on=NOW() WHERE user_id=".$_SESSION['user']['id']." AND id=".$survey_id);	  
	//	echo "UPDATE `surveys` SET status='inactive' WHERE user_id=".$_SESSION['user']['id']." AND id=".$survey_id;			 
		if($survey_update){
					  $result['result'] = 'success';
					  $result['message'] = 'Survey has been Deactivated';	
		}else{
					 $result['result'] = 'failed';
					 $result['message'] = 'Something Went Wrong...';						
		}
		echo json_encode($result); 
  }
  if($action == 'delete_survey' ){
	 
		$result = Array();	 
	  	$survey_id = $_REQUEST['surveyId'];
$survey_update = $mysqli->query("UPDATE `surveys` SET is_deleted='yes',updated_on=NOW() WHERE user_id=".$_SESSION['user']['id']." AND id=".$survey_id);	  
					 
		if($survey_update){
					  $result['result'] = 'success';
					  $result['message'] = 'Survey has been deleted';	
		}else{
					 $result['result'] = 'failed';
					 $result['message'] = 'Something Went Wrong...';						
		}	
		echo json_encode($result); 
  }
	// END ACTIONS ON SURVEY

	
	// DELETE OPTIONS
	  if($action == 'delete_option' ){
	 
		$result = Array();	 
	  	$survey_id = $_REQUEST['surveyId'];
	  	$option_id = $_REQUEST['optionId'];
$option_update = $mysqli->query("UPDATE `options` SET status='inactive' WHERE id=".$option_id." AND survey_id=".$survey_id);	  
				 
		if($option_update){
					  $result['result'] = 'success';
					  $result['message'] = 'Option has been deleted';	
		}else{
					 $result['result'] = 'failed';
					 $result['message'] = 'Something Went Wrong...';						
		}	
		echo json_encode($result); 
	}

  // POPUPLAR TAGS
  
   if($action == 'popular_tags' ){
	 
		$result = Array();	
		$query_tags = "SELECT GROUP_CONCAT(tags) tags FROM surveys";
		$select_tags = $mysqli->query($query_tags);	 
		$row_tags = $select_tags->fetch_assoc();
		// Then explode them
		$tags = $row_tags['tags'];
		$tags_array= explode(',', $tags);

		 // remove repeated tags
		$tags_array = array_unique($tags_array);
		
		//Count the values
		$result = array_count_values($tags_array);

		// Sort
		 arsort($result);
		 
		$result = array_slice($result, 0, 15);   // returns "a", "b", and "c"
		echo json_encode($result); 
  } 
  
  // END POPULAR TAGS




  
  ?>