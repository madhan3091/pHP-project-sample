<?php

session_start();
  if($_SERVER["REMOTE_ADDR"]=="::1"){
		$mysqli = new mysqli("localhost","root","","surveypeople");
  }else{
		$mysqli = new mysqli("localhost","user_letinchat","let!$1in@chat#","letinchat");
 }

 error_reporting(0);
// Check connection
 if($mysqli->connect_error) 
  {
   die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
  }
  
    // site url
    define("siteUrl", "http://survey.letinchat.com/");
  
   if(!isset($_SESSION['user'])) { 

   // LOGIN WITH FACEBOOK //
	require_once 'fbConfig.php';
	$loginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	
   }
  // COMMON FUNCTIONS
  	
	$ip = getenv('HTTP_CLIENT_IP')?:            // IP as well as USER ID
				getenv('HTTP_X_FORWARDED_FOR')?:
				getenv('HTTP_X_FORWARDED')?:
				getenv('HTTP_FORWARDED_FOR')?:
				getenv('HTTP_FORWARDED')?:
				getenv('REMOTE_ADDR'); 
				
	// except voted surveys
	$current_user_ip_id = isset($_SESSION['user'])?$_SESSION['user']['id']:$ip;  // ip - global varibal in database.php
 
 
	 function seoUrl($string, $wordLimit = 0){
	    $separator = '-';
	    
	    if($wordLimit != 0){
	        $wordArr = explode(' ', $string);
	        $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
	    }
	
	    $quoteSeparator = preg_quote($separator, '#');
	
	    $trans = array(
	        '&.+?;'                    => '',
	        '[^\w\d _-]'            => '',
	        '\s+'                    => $separator,
	        '('.$quoteSeparator.')+'=> $separator
	    );
	
	    $string = strip_tags($string);
	    foreach ($trans as $key => $val){
	        $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
	    }
	
	    $string = strtolower($string);
	
	    return trim(trim($string, $separator));
	} 
  
  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
  
 function pagination($page,$total_rows,$limit,$link){ 
			 
			$adjacents = 3;
        	$total_pages = ceil($total_rows / $limit);
			  //Here we generates the range of the page numbers which will display.
			  if($total_pages <= (1+($adjacents * 2))) {
				$start = 1;
				$end   = $total_pages;
			  } else {
				if(($page - $adjacents) > 1) { 
				  if(($page + $adjacents) < $total_pages) { 
					$start = ($page - $adjacents);            
					$end   = ($page + $adjacents);         
				  } else {             
					$start = ($total_pages - (1+($adjacents*2)));  
					$end   = $total_pages;               
				  }
				} else {               
				  $start = 1;                                
				  $end   = (1+($adjacents * 2));             
				}
			  }

		if($total_pages > 1) {
 ?>
          <ul class="pagination pagination-sm justify-content-center">
            <!-- Link of the first page -->
            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
              <a class='page-link' href='<?php echo $link; ?>/?page=1'><<</a>
            </li>
            <!-- Link of the previous page -->
            <li class='page-item <?php ($page <= 1 ? print 'disabled' : '')?>'>
              <a class='page-link' href='<?php echo $link; ?>page=<?php ($page>1 ? print($page-1) : print 1)?>'><</a>
            </li>
            <!-- Links of the pages with page number -->
            <?php for($i=$start; $i<=$end; $i++) { ?>
            <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
              <a class='page-link' href='<?php echo $link; ?>page=<?php echo $i;?>'><?php echo $i;?></a>
            </li>
            <?php } ?>
            <!-- Link of the next page -->
            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
              <a class='page-link' href='<?php echo $link; ?>page=<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>></a>
            </li>
            <!-- Link of the last page -->
            <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
              <a class='page-link' href='<?php echo $link; ?>page=<?php echo $total_pages;?>'>>>                      
              </a>
            </li>
          </ul>
<?php 
				} 
		}
		
		
		
	// Get User //
	function getUser($user_id){
	
	   global $mysqli;
	   $result = array();
	   $query = $mysqli->query("SELECT * FROM users WHERE id=".$user_id);
	
	   if($query->num_rows >0){
	       $result = $query->fetch_assoc();
	   }
	
	  return $result;
	}
		
		
		
?>