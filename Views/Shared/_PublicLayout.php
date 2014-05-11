<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Layout Page</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style type="text/css">
	    .navbar-logout {
				margin-top: 8px;
			}
    </style>
  </head>

  <body>

    <header class="jumbotron">
    	<div class="container">
    		<h1 class="glyphicon glyphicon-tower"> Random Store</h1>
    	</div>
    	</div>
    </header>
    
      <div class="container">
      <div class="navbar navbar-default" role="navigation">
      		<div class="container">
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="#">Final</a>
		        </div>
        		<div class="collapse navbar-collapse">
		          <ul class="nav navbar-nav">
		          	<?php
		          		$shortcut = "../../Final/Controllers/";
		          	
		          		$links = array();
						/*$links['Users'] = array('class' => 'users-menu', 'link' => 'Users.php', 'name' => 'Users');
						$links['Addresses'] = array('class' => 'addresses-menu', 'link' => 'Addresses.php', 'name' => 'Addresses');
						$links['Contacts'] = array('class' => 'contacts-menu', 'link' => 'Contacts.php', 'name' => 'Contacts');
						$links['Orders'] = array('class' => 'orders-menu', 'link' => 'Orders.php', 'name' => 'Orders');
						$links['Items'] = array('class' => 'items-menu', 'link' => 'Items.php', 'name' => 'Order Items');*/
						$links['Products'] = array('class' => 'products-menu', 'link' => 'Products.php', 'name' => 'Products');
						//$links['Supliers'] = array('class' => 'supliers-menu', 'link' => 'Supliers.php', 'name' => 'Supliers');
						 
						foreach ($links as $key => $value) {
							$url = $shortcut . $value['link'];
							?>
							<li class="<?=$value['class']?>" ><a href="<?=$url?>"><?=$value['name']?></a></li>
						<?}
		          	?>
		          </ul>
		          
		          <ul class="nav navbar-nav navbar-right">
		          	<? if(!Accounts::IsLoggedIn()):?>	
			        <li>
			        	<form method='post' action="Products.php?action=login" class="form-inline">
							<button type="submit" class="btn btn-default navbar-logout">
								<span class="glyphicon glyphicon-log-in"></span>
						  		Log In 
							</button>
						</form>
					</li>
					<?else:?>
					<li>
						<form method='post' action="Products.php?action=logout" class="form-inline">
							<button type="submit" class="btn btn-default navbar-logout">
						  		Log Out <span class="glyphicon glyphicon-log-out"></span></>
							</button>
						</form>
					</li>
					<? endif;?>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?= isset($user) ? $user['FirstName'] : ' Guest'?> <b class="caret"></b></a>
			          <ul class="dropdown-menu">
			          	<?if(Accounts::IsLoggedIn()):?>
				            <li><a class="edit-info" href="<?= isset($user) ? "Products.php?action=accountInfo&id=" . $user['id'] : '#'?>">My Account</a></li>
				            <li><a class="edit-order" href="<?= isset($user) ? "Products.php?action=orderInfo&id=" . $user['id'] : '#'?>">My Orders</a></li>
				            <?if(isset($userAdmin)):?>
					            <li class="divider"></li>
					            <li><a href="Users.php">Back End</a></li>
					        <?endif;?>
			            <?else:?>
			            	<li><a href="Products.php?action=login">Please log in to see account details</a></li>
			            <?endif;?>
			          </ul>
			        </li>
			      </ul>
		          <ul class="nav navbar-nav navbar-right"></ul> <!--fixes navbar spacing -->
        		</div><!--/.nav-collapse -->
      		</div>
      </div>
      
	<div class="modal fade" id="myModal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        <p>One fine body&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <div class="container">
    	
    	<? include $view; ?>
    	
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <?
    	if(function_exists("JavaScripts")) {
    		JavaScripts();
    	}
    ?>
    <script type="text/javascript">
		$(function(){
			var currentPage = getFileName();
				
			if (currentPage == "Products.php")
				$(".products-menu").addClass("active");
				
			//if (currentPage == "Supliers.php")
				//$(".supliers-menu").addClass("active");
				
			$(".edit-info").click(function(event){
					var that = this;
					event.preventDefault();
					
					$.get(that.href, { format: 'plain'}, function(data){
						var $myModal = $("#myModal");
						$(".modal-content", $myModal).html(data);
						$myModal.modal('show');
						
					})
				})
				
		})
		function getFileName() {
			//this gets the full url
			var url = document.location.href;
			//this removes the anchor at the end, if there is one
			url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
			//this removes the query after the file name, if there is one
			url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
			//this removes everything before the last slash in the path
			url = url.substring(url.lastIndexOf("/") + 1, url.length);
			//return
			return url;
		}
	</script>
  </body>
</html>