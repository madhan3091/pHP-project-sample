

<?php if(!isset($_SESSION['user'])) { 

?>
<!--Login Form-->
<div id="loginForm" class="modal fade" role="dialog">
    <br>
       <div class="modal-content col-sm-offset-4 col-sm-4">
        <div class="modal-body">
	<div class="col-sm-offset-2 col-sm-8">
      <a class="btn btn-block btn-social btn-facebook"  href="<?php echo htmlspecialchars($loginURL); ?>">
        <i class="fa fa-facebook"></i> Sign in with Facebook
      </a>  <br>                        
	</div>
        </div>
       </div>
</div>
</div>
<?php } ?>
<?php if(isset($_SESSION['notification']) && $_SESSION['notification'] != "") { 
     echo "<script>alert('".$_SESSION['notification']."');</script>";
	 unset($_SESSION['notification']);
 } ?>