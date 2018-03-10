<div class="survey-row">
<?php foreach ($survey_list as $survey) { ?>
<div class="survey-list-section" id="survey-<?php echo $survey['id']; ?>">
            <div class="panel">
                <div class="panel-heading">
   <div class="panel-user"><img src="<?php echo getUser($survey['user_id'])['avatar']; ?>" width='30' class="img-circle"><?php echo $survey['username']; ?> 
                        <span class="panel-timer"><?php echo time_elapsed_string($survey['created_on']); ?></span> 
                        <span class="pull-right vote_count"><?php echo $survey['total_votes']; ?> Votes</span></div>
                    <a href="single_survey.php?survey=<?php echo seoUrl($survey['id'].'-'.$survey['title']); ?>">
						<h3 class="panel-title"><?php echo $survey['title']; ?></h3>
					</a>
		 <!---------Image Section------------>
		 <img src="img/rohitvsgayle.jpg" width="100%">
		 <!---------End Image Section------------> 
				<?php if($page['name'] == 'single_survey'){  ?>	
					<p><?php echo $survey['description']; ?></p>
				<?php } ?>	
                </div>
                <div class="panel-body two-col survey-option-section">
                    <div class="row">
                    <?php foreach ($survey['options'] as $option) { ?>
                        <div class="col-md-6">
                            <div class="checkbox-div">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="survey-options" value="<?php echo $option['id'];  ?>">
                                        <?php echo $option['option_name']; ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>    
                    </div>
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
                  <div class="col-sm-6 nopadding vote_button_div" style="display:none;">
                 <button type="button" class="btn btn-info btn-sm" id="voteButton" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Voting" onclick="voting('<?php echo $survey['id']; ?>')"> 
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                 <button type="button" class="btn btn-danger btn-sm sr-only" onclick="clearVote('<?php echo $survey['id']; ?>')">
                         <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                 </div>
                </div>
                </div>

    <!--Survey Result-->
  <div class="panel-body two-col survey-result-section">
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
            </div> 
  </div>
 <!--End Survey Result-->
  </div>
  <div class="loader-div"></div>
</div>
<?php } ?>
</div>


<script>


/* Survey Voting */
$(document).ready(function(){

     // Uncheck All Radio Button
     $('input[name="survey-options"]').prop('checked', false);
     // Show Vote Button
     $('.survey-option-section input[name="survey-options"]').on('change',function(e){
           $('.survey-option-section label').removeClass('checked_div');
           $(this).parent('label').addClass('checked_div');
           $(this).parents('.survey-option-section').find('.vote_button_div').slideDown();
           $(this).parents('.survey-option-section').find('.vote_button_div #voteButton').click();
     });         

});


 function clearVote(surveyId){
     $('#survey-'+surveyId+' input[name="survey-options"]').prop('checked',false);
     $('#survey-'+surveyId+' label.checked_div').removeClass('checked_div');
     $('#survey-'+surveyId+' .vote_button_div').slideUp();
 }

 function voting(surveyId){

    var selOption =  $('#survey-'+surveyId+' input[name="survey-options"]:checked').val();
    if(!selOption){
       alert("Please Select One Option");
    }else{
     
     var survey,surveyResult,optionPercent,resultDiv = "";
     $('#survey-'+surveyId+' #voteButton').button('loading');
        $.ajax({

            url: 'ajax_functions.php',

            type: 'POST',   

            dataType: 'json',

            data: {
                surveyId: surveyId,
                optionId:selOption,
				action:'vote_survey'
            },
            success: function(res) {       
              console.log(res);
            if(res.result == 'failed'){
                alert(res.message);
            }else{
              
               //  alert(res.message);
				
                $('#survey-'+surveyId+" .survey-option-section").slideUp(1000);
                $('#survey-'+surveyId+" .survey-result-section").delay(1000).slideDown();

                survey = res.survey;
                surveyResult = survey.options;

                resultDiv = resultDiv + '<div class="col-sm-12">';
 		 console.log(surveyResult);
 		 
 		 var emojiArray = ['em-sunglasses','em-hugging_face','em-grinning','em-sleeping' ];
 		 var emojiStart = 0;
 		 var emoji = '';
 		 
               surveyResult.forEach(function(element,index) {
                    optionPercent = Math.round((element['votes']/survey.total_votes)*100);
                    resultDiv = resultDiv + '<div class="col-sm-6 nopadding-left">';
                    resultDiv = resultDiv + '<strong>'+element['option_name']+'</strong><span class="pull-right">'+optionPercent+'%</span>';
                    resultDiv = resultDiv + '<div class="progress progress-striped active">';
                    resultDiv = resultDiv + '<div class="progress-bar" style="width: '+optionPercent+'%;"></div>';
                    
                    // its already sorted by count in server- so just place emoji from order
                    if(element['votes'] == 0){
                         emoji  = emojiArray [3];
                    }else if(index == 0){
                         emoji  = emojiArray [0];
                         emojiStart++;
                    }else if( element['votes'] == surveyResult[index-1]['votes'] ){
                        emoji  = emojiArray [emojiStart-1];
                    }else{
                        emoji  = emojiArray [emojiStart];
                        emojiStart++;                     
                    }
                    
                    resultDiv = resultDiv + '<i class="em '+emoji+' result-emojis"></i>';      // emojicons
                    resultDiv = resultDiv + '</div>';
                    resultDiv = resultDiv + '</div>';
               });
               resultDiv = resultDiv + '</div>';

               $('#survey-'+surveyId+' .vote_count').html(survey.total_votes+' Votes');
               $('#survey-'+surveyId+" .survey-result-section").prepend(resultDiv); 
            }

            },
            error: function(jqXHR, textStatus, errorThrown) {
            $('#survey-'+surveyId+' #voteButton').button('reset');
				alert("Something Went Wrong..Try Again !!");
                console.log(jqXHR);
            }
        });

    }
 }

</script>