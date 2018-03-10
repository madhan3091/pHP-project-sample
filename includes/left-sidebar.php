                        <div class="col-lg-3 col-md-3">

                            <!-- -->
                            <div class="sidebarblock lg-width-category">
                                <h3>Categories</h3>
                                <div class="divline"></div>
                                <div class="blocktxt">
                                    <!--Main Categrpoies-->
<ul id="sidebar" class="nav nav-pills nav-stacked" style="max-width: 200px;">
    <li class="<?php  if(strcasecmp($category_name,"sports") == 0){ ?>active<?php } ?>"><a href="category.php?category=sports"><i class="fa fa-futbol-o fa-lg" aria-hidden="true"></i>  Sports </a></li>
    <li class="<?php  if(strcasecmp($category_name,"movies") == 0){ ?>active<?php } ?>"><a href="category.php?category=movies"><i class="fa fa-film fa-lg" aria-hidden="true"></i>  Movies </a></li>
    <li class="<?php  if(strcasecmp($category_name,"gaming") == 0){ ?>active<?php } ?>"><a href="category.php?category=gaming"><i class="fa fa-gamepad fa-lg" aria-hidden="true"></i>  Gaming </a></li>
    <li class="<?php  if(strcasecmp($category_name,"gadgets") == 0){ ?>active<?php } ?>"><a href="category.php?category=gadgets"><i class="fa fa-mobile fa-lg" aria-hidden="true"></i>  Gadgets </a></li>
    <li class="<?php  if(strcasecmp($category_name,"programming") == 0){ ?>active<?php } ?>"><a href="category.php?category=programming"><i class="fa fa-code fa-lg" aria-hidden="true"></i> Programming </a></li>
    <li class="<?php  if(strcasecmp($category_name,"other") == 0){ ?>active<?php } ?>"><a href="category.php?category=other"><i class="fa fa-globe fa-lg" aria-hidden="true"></i>  Other </a></li>
</ul>
                                </div>
                            </div>

                            <!-- -->
                            <div class="sidebarblock mob-category">
                                <div class="blocktxt">
                                    <!--Main Categories-->
<select class="categorypicker">
  <option value="">Choose category</option>
<?php 
   $total_category = ['sports','movies','gaming','gadgets','programming','other'];
   foreach($total_category as $cate){
        if(strcasecmp($category_name,$cate) == 0){
			echo "<option value=".$cate." selected>".ucfirst($cate)."</option>";
		}else{
			echo "<option value=".$cate.">".ucfirst($cate)."</option>";
		}	   
   }
?>
</select>

                                </div>
                            </div>
<script>
	$(document).ready(function() {
		
		// select picker
		$('.categorypicker').select2({ theme: 'classic'});
	
    // select category function	
		$('.categorypicker').on('change', function(){
			
		  var category = $(this).val();
		  
			if( category != ''){
				location.href = "category.php?category="+category;
			}
			
		});
		
	});
</script>						
							
                        </div>