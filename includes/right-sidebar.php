                        <div class="col-lg-3 col-md-3">

<?php   // Related Topics
		if(isset($current_related_tags)){ ?>
	                       <div class="sidebarblock">
                                <h3>Related Topics</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
						<div class="tagscloud related_tags">	
<ul>						
<?php		$i = 0;
		$search_rel_tag = '';
		foreach($current_related_tags as $rel_tag){
			if($i == 0){
				$search_rel_tag .= "tags LIKE '%".$rel_tag."%'";
			}else{
				$search_rel_tag .= " AND tags LIKE '%".$rel_tag."%'";	
			}
			
		$i++;
		}
			
	$query_tags = "SELECT GROUP_CONCAT(tags) tags FROM surveys WHERE ".$search_rel_tag." AND status='active'";
		
		$select_tags = $mysqli->query($query_tags);	 
		$row_tags = $select_tags->fetch_assoc();
		// Then explode them
		$tags = $row_tags['tags'];
		$tags_array= explode(',', $tags);
		$tagsList = array_unique($tags_array);
		// Sort
		$tagsList = array_slice($tagsList, 0, 15);   // returns "a", "b", and "c"				
			
			// tags cloud
			foreach($tagsList as $single_tag){ ?>
		<li><a href="tags.php?tag=<?php echo $single_tag; ?>"><?php echo $single_tag; ?><span>-</span></a></li>	  
	<?php  }	 ?>
	  	</ul>
</div>
</div>
</div>
<?php	}  ?>
   
   
						
						
                            <!--trending topics-->
                            <div class="sidebarblock">
                                <h3>Trending Topics</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
<div class="tagscloud trend_tags">
	<ul>
        <!---Tags Cloud-->
	</ul>
</div>
                                </div>
                            </div>



                        </div>




<script>

/* Tags Section Voting */
$(document).ready(function(){
    getPopTags();
});

function getPopTags(){

        $.ajax({

            url: 'ajax_functions.php',

            type: 'POST',   

            dataType: 'json',

            data: {
				action:'popular_tags'
				
			},
            success: function(tags) {  
       //      console.log(tags); // return false;
 // Object { Survey Title *: 3, angular js: 2, current test title: 2, sports: 2, react js: 1, angular versions: 1 }
                     
	    var tagsHtml ="";
		// looping the above array
		Object.keys(tags).map(function(objectKey, index) {
			var value = tags[objectKey];
			tagsHtml = tagsHtml+"<li><a href='tags.php?tag="+objectKey+"'>"+objectKey+"<span>"+value+"</span></a></li>";
			console.log(value);
		});		
                $('.trend_tags ul').html(tagsHtml);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
            }
        });

    }


</script>
