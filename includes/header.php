<header>
            <div class="headernav">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="col-lg-3 col-xs-12 col-sm-2 col-md-3 logo ">
							<a href="index.php"><img src="img/logo.png" alt="surveyepeople" width='auto' height='69'></a>
						 </div>
                   <!--     <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 hidden-xs hidden-sm selecttopic">
                        </div>--->
                        <div class="col-lg-5 search hidden-xs hidden-sm col-md-3">
                            <div class="wrap">
                                <form action="surveys.php" method="GET" class="form">
                                    <div class="pull-left txt"><input class="form-control" name="s" placeholder="Find Out More Here !!!" type="text" value="<?php if(isset($search)){ echo $search; }  ?>"></div>
                                    <div class="pull-right"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-5 col-md-4 avt">
                            <div class="stnt pull-left">                            
                                    <a class="btn btn-primary" id="createButton" href="createsurvey.php">Create Survey</a>
                            </div>
                        <?php if(!isset($_SESSION['user'])) { ?>
				<div class="stnt pull-right">       
                <a type="button" id="loginButton" class="btn btn-info" data-toggle="modal" data-target="#loginForm">LogIn / Signup</a>
				  </div>
                        <?php } else{ ?>
                            <div class="env pull-left"><a href="my_account.php?s=survey"><i class="fa fa-home"></i></a></div>
                            <div class="avatar pull-left dropdown">
                                <a data-toggle="dropdown" href="#">
                                    <!---User Profile Picture-->
                                    <?php if($_SESSION['user']['login_method'] == 'facebook') { ?>
                                         <img src="<?php echo $_SESSION['user']['avatar']; ?>" alt="<?php echo $_SESSION['user']['name']; ?>" width="37" height="37" >
                                    <?php } else{ ?>
                                        <img src="img/avatar.jpg" alt="<?php echo $_SESSION['user']['name']; ?>">
                                    <?php } ?>
                                </a> <b class="caret"></b>
                                <div class="status green">&nbsp;</div>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my_account.php?s=survey"> My Surveys</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-3" href="logout.php">Log Out</a></li>
                                </ul>
                            </div>
                           <?php } ?>  
                            <div class="clearfix"></div>
                        </div>
                    </div>
					 <div class="col-lg-12 search mob-header-search col-xs-12 col-md-3">
                            <div class="wrap">
                                <form action="surveys.php" method="GET" class="form">
                                    <div class="pull-left txt"><input class="form-control" name="s" placeholder="Find Out More Here !!!" type="text" value="<?php if(isset($search)){ echo $search; }  ?>"></div>
                                    <div class="pull-right"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
</header>