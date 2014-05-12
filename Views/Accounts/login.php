<style type="text/css">
	.error {
		color: red;
	}
	.my-horizontal label {
		display: inline-block;
		width: 150px;
		text-align: right;
		margin-right: 10px;
	}
	.my-horizontal .form-control{
		display: inline-block;
	}
	
	.has-feedback .form-control-feedback {
		display: inline-block;
		right: auto;
		top: auto;
		margin-left: -40px;
	}
	.has-error {
		color: red;
	}
	
	@media screen and (min-width: 768px) {
		.my-horizontal .form-control{
			width: 25%;
		}
	}
</style>
	      <div class="modal-header">
	        <a href="?" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
	        <h4 class="modal-title">Login</h4>
	      </div>

	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
            	
    <form method="post" class="my-horizontal col-sm-10" >
		<div class="form-group <?if(isset($errors['email'])) echo 'has-error has-feedback' ?> ">
			<label class="control-label" for="email">Email or Phone Number:</label>
			<input class="required form-control" type="text" name="email" id="email" value="<?=$model['email']?>" placeholder="Email or Phone Number" />
			<? if(isset($errors['email'])): ?>
				<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				<span ><?=$errors['email']?></span>
			<? endif ?>
		</div>

		<div class="form-group <?if(isset($errors['password'])) echo 'has-error has-feedback' ?> ">
			<label class="control-label" for="password">Password:</label>
			<input class="required form-control" type="password" name="password" id="password" value="<?=$model['password']?>" placeholder="Password" />
			<? if(isset($errors['password'])): ?>
				<span class="glyphicon glyphicon-remove form-control-feedback"></span>
				<span ><?=$errors['password']?></span>
			<? endif ?>
		</div>

		  <div class="modal-footer">
			<label class="control-label"></label>
			<input class="btn btn-primary" type="submit" value="Login" />
			<a href="?" data-dismiss="modal">Cancel</a>
	      </div>
    </form>
    <div class="col-sm-2">
    	<button class="btn btn-primary" id="fb-login">Login with Facebook</button>
    	
    	<img id="fb-picture" />
    </div>
    
    <? function JavaScripts(){ ?>
        
	   <script type="text/javascript">
	    	$(function(){
	    		$("#fb-login").click(function(){
	    			FB.login(null,{scope: 'email,user_likes'});
	    		});
	    	})
	    	fbStuff = function(){
	    		
	    		FB.getLoginStatus(function(response) {
				  console.log(response);
				  
				  if (response.status === 'connected') {
				    FB.api("me", function(response){
				    	console.log(response);
				    	$(".navbar-collapse").append("Welcome " + response.first_name)
				    	$("#fb-picture").attr({src: "http://graph.facebook.com/" + response.id + "/picture"})
				    });
				  }
				  else {
				    
				  }
				});
				
	    	}
	    	
	    </script>
    
    
		<script>
		      window.fbAsyncInit = function() {
		        FB.init({
		          appId      : '452014394930220',
		          xfbml      : true,
		          version    : 'v2.0'
		        });
		        fbStuff();
		      };
		
		      (function(d, s, id){
		         var js, fjs = d.getElementsByTagName(s)[0];
		         if (d.getElementById(id)) {return;}
		         js = d.createElement(s); js.id = id;
		         js.src = "//connect.facebook.net/en_US/sdk.js";
		         fjs.parentNode.insertBefore(js, fjs);
		       }(document, 'script', 'facebook-jssdk'));
	    </script>
    <? } ?>
 