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
    	body {
		  padding-top: 50px;
		}
		.navbar-logout {
			margin-top: 8px;
		}
    </style>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
				$links['Users'] = array('class' => 'users-menu', 'link' => 'Users.php', 'name' => 'Users');
				$links['Addresses'] = array('class' => 'addresses-menu', 'link' => 'Addresses.php', 'name' => 'Addresses');
				$links['Contacts'] = array('class' => 'contacts-menu', 'link' => 'Contacts.php', 'name' => 'Contacts');
				$links['Orders'] = array('class' => 'orders-menu', 'link' => 'Orders.php', 'name' => 'Orders');
				$links['Items'] = array('class' => 'items-menu', 'link' => 'Items.php', 'name' => 'Order Items');
				$links['Products'] = array('class' => 'products-menu', 'link' => 'Products.php?action=index', 'name' => 'Products');
				$links['Supliers'] = array('class' => 'supliers-menu', 'link' => 'Supliers.php', 'name' => 'Supliers');
				 
				foreach ($links as $key => $value) {
					$url = $shortcut . $value['link'];
					?>
					<li class="<?=$value['class']?>" ><a href="<?=$url?>"><?=$value['name']?></a></li>
				<?}
          	?>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
	        <li>
	        	<form method='post' action="Products.php?action=logout" class="form-inline">
					<button type="submit" class="btn btn-default navbar-logout">
				  		Log Out <span class="glyphicon glyphicon-log-out"></span></>
					</button>
				</form>
			</li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?= isset($user) ? $user['FirstName'] : ' Guest'?> <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	          	<? foreach($links as $key=> $value) {
	          		$url = $shortcut . $value['link']; ?>
	            <li><a href="<?=$url?>"><?=$value['name']?></a></li>
	            <? } ?>
	            <li class="divider"></li>
	            <li><a href="Products.php">Front End</a></li>
	          </ul>
	        </li>
	      </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>

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
			if (currentPage == "Users.php")
				$(".users-menu").addClass("active");
				
			if (currentPage == "Addresses.php")
				$(".addresses-menu").addClass("active");
				
			if (currentPage == "Contacts.php")
				$(".contacts-menu").addClass("active");
				
			if (currentPage == "Items.php")
				$(".items-menu").addClass("active");
				
			if (currentPage == "Orders.php")
				$(".orders-menu").addClass("active");
				
			if (currentPage == "Products.php")
				$(".products-menu").addClass("active");
				
			if (currentPage == "Supliers.php")
				$(".supliers-menu").addClass("active");
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