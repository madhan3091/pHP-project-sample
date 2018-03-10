<div class="survey-row">
<?php if($page['name'] != 'single_survey'){  ?>
<?php foreach ($survey_list as $survey) { ?>
<div class="survey-list-section" id="survey-<?php echo $survey['id']; ?>">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-user">
                        <span class="panel-timer"><?php echo time_elapsed_string($survey['created_on']); ?></span> 
                        <span class="pull-right vote_count"><?php echo $survey['total_votes']; ?> Votes</span></div>
                   <a href="single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>">
						<h3 class="panel-title"><?php echo $survey['title']; ?></h3>
					</a>
                </div>
				<div class="panel-body two-col survey-result-section" style="display: block;">
				<div class="col-sm-12">
				<?php foreach ($survey['options'] as $option) { ?>
				<?php 
				  if($option['votes'] > 0){ $per = round(($option['votes']/$survey['total_votes'])*100); }
				  else{ $per = 0; }
				?>
					  <div class="col-sm-6 nopadding-left">
		<strong><?php echo $option['option_name']; ?></strong><br>
		<span class=""><?php echo $option['votes']; ?>Votes - <?php echo $per; ?>%</span><br>
						 <div class="progress progress-striped active">
							<div class="progress-bar" style="width: <?php echo $per; ?>%;"></div>
						 </div>
					  </div>
				   <?php } ?>
				</div>				   
				   <!--Survey Result--> 
				   <div class="col-sm-12 nopadding">
					  <div class="col-sm-6 panel-bottom nopadding" align="right">
						 <!--Share Button-->
						 <a class="social-button">Share On</a>
     <a class="social-link btn facebook-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo siteUrl; ?>single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>&t=<?php echo $survey['title']; ?>"
   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Share on Facebook">
   <i class="fa fa-facebook"></i>
</a>
                     <a class="social-link btn whatsapp-btn" href="whatsapp://send?text=<?php echo siteUrl; ?>single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
					  </div>
					  <div class="col-sm-6 panel-bottom nopadding">

					  <a class="btn btn-primary btn-sml" href="createsurvey.php?edit_survey&editId=<?php echo $survey['id']; ?>">Edit</a>
						 <!--Share Button-->
						 <?php if($survey['status'] == 'active'){ ?>
						 <a class="btn btn-default btn-sml activate_button" onclick="activeSurvey(<?php echo $survey['id']; ?>);" style='display:none;'>Activate</a>
						 <a class="btn btn-default btn-sml deactivate_button" onclick="deactiveSurvey(<?php echo $survey['id']; ?>);">Deactivate</a>
						 <?php }elseif($survey['status'] == 'inactive'){ ?>
						 <a class="btn btn-default btn-sml activate_button" onclick="activeSurvey(<?php echo $survey['id']; ?>);">Activate</a>
						 <a class="btn btn-default btn-sml deactivate_button" onclick="deactiveSurvey(<?php echo $survey['id']; ?>);" style='display:none;'>Deactivate</a>
						 <?php } ?>
						 <a class="btn btn-danger btn-sml" onclick="deleteSurvey(<?php echo $survey['id']; ?>);">Delete</a>
				
					 </div>
				   </div>
				</div>
    <!--Survey Result-->
  </div>
  </div>
 <?php } ?>	 
<?php }else{ // single survey result ?>
<?php foreach ($survey_list as $survey) { ?>
<div class="survey-list-section" id="survey-<?php echo $survey['id']; ?>">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-user">
<img src="<?php echo getUser($survey['user_id'])['avatar']; ?>" width='30' class="img-circle"><?php echo $survey['username']; ?>
                        <span class="panel-timer"><?php echo time_elapsed_string($survey['created_on']); ?></span> 
                        <span class="pull-right vote_count"><?php echo $survey['total_votes']; ?> Votes</span></div>
                   <a href="single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>">
						<h3 class="panel-title"><?php echo $survey['title']; ?></h3>
					</a>
		 <!---------Image Section------------>
		 <img src="img/rohitvsgayle.jpg" width="100%">
		 <!---------End Image Section------------> 
					<p><?php echo $survey['description']; ?></p>
                </div>
				<div class="panel-body two-col survey-result-section" style="display: block;">
				<div class="col-sm-12">
				<?php foreach ($survey['options'] as $option) { ?>
				<?php 
				  if($option['votes'] > 0){ $per = round(($option['votes']/$survey['total_votes'])*100); }
				  else{ $per = 0; }
				?>
					  <div class="col-sm-6 nopadding-left">
		<strong><?php echo $option['option_name']; ?></strong>
		<span class="pull-right"><?php echo $per; ?>%</span><br>
						 <div class="progress progress-striped active">
							<div class="progress-bar" style="width: <?php echo $per; ?>%;"></div>
						 </div>
					  </div>
				   <?php } ?>
				</div>				   
				   <!--Survey Result--> 
				   <div class="col-sm-12 nopadding">
					  <div class="col-sm-6 panel-bottom nopadding" align="right">
						 <!--Share Button-->
						 <a class="social-button">Share On</a>
<a class="social-link btn facebook-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo siteUrl; ?>single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>&t=<?php echo $survey['title']; ?>"
   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
   target="_blank" title="Share on Facebook">
   <i class="fa fa-facebook"></i>
</a>
                     <a class="social-link btn whatsapp-btn" href="whatsapp://send?text=<?php echo siteUrl; ?>single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
					  </div>
					  <div class="col-sm-6 panel-bottom nopadding">			
					 </div>
				   </div>
				</div>
    <!--Survey Result-->
  </div>
 </div>
 <?php } ?>	 

 <?php } ?>
</div>


<script>


/* Survey Voting */
$(document).ready(function(){
      
});
 
 function activeSurvey(id){
	 actionSurvey('activate_survey',id);	 
 }
 function deactiveSurvey(id){
	 actionSurvey('deactivate_survey',id);	 
 }
 function deleteSurvey(id){
	 actionSurvey('delete_survey',id);	 
 }

 function actionSurvey(action,id,text){
	 
    if(!confirm("Are you sure to do this Action?")){
       return false;
    }else{

        $.ajax({

            url: 'ajax_functions.php',

            type: 'POST',   

            dataType: 'json',

            data: {
                action: action,
                surveyId:id
            },
            success: function(res) {       
              console.log(res);
            if(res.result == 'failed'){
                alert(res.message);
            }else{
                 alert(res.message);
				if(action == 'activate_survey'){
             $('#survey-'+id+" .deactivate_button").show();
             $('#survey-'+id+" .activate_button").hide();								
				} else if(action == 'deactivate_survey'){
             $('#survey-'+id+" .deactivate_button").hide();
             $('#survey-'+id+" .activate_button").show();						
				}else if(action == 'delete_survey'){
					$('#survey-'+id).slideUp(2000).remove();
				}
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