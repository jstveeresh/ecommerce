<style type="text/css">
	.categories {
		margin-bottom: 10px;
	}
	.label-danger{ background-color: maroon; }
	.has-feedback .form-control-feedback {
		top: 0px;
		right: 15px;
	}
</style>
<div ng-app="homepageApp">
	
	<div ng-view></div>
	
	<script type="text/ng-template" id="list">
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4 has-feedback" id="search">
				<input ng-model="query" type="search" class="form-control" placeholder="Search">			
	  			<span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
		</div>
			
		<div class="row" ng-controller="ItemListCtrl" >
			
			<div ng-repeat="item in items | filter:query" class=" col-md-4">
				<div class="panel panel-info">
				  <div class="panel-heading">
					<code class="pull-right">${{item.Price}}</code>
				    <h3 class="panel-title">
				    	<a href="#/item/{{item.id}}">
				    	{{item.Name}}				    		
				    	</a>
				    </h3>
				  </div>
				  <div class="panel-body">
						<img ng-src="{{item.Picture_Url}}" class="img-thumbnail pull-right" alt="140x140" style="width: 140px; height: 140px;" >
						<p>{{item.Description}}</p>
						<a class="btn btn-success">Purchase</a>
				  </div>
				</div>
			</div>
		</div>
	</script>	
	<script type="text/ng-template" id="details">
				<div class="panel panel-info">
				  <div class="panel-heading">
					<code class="pull-right">${{item.Price}}</code>
				    <h3 class="panel-title">{{item.Name}}</h3>
				  </div>
				  <div class="panel-body">
						<img ng-src="{{item.Picture_Url}}" class="img-thumbnail pull-right"  >
						<p>{{item.Description}}</p>
						<a class="btn btn-success">Purchase</a>
				  </div>
				</div>
	</script>
</div>


	<? function JavaScripts(){ ?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.15/angular.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.0-beta.3/angular-route.js"></script>
	<script src="../Content/js/controllers.js"></script>
		<script type="text/javascript">
			$(function(){
				
			});
		</script>
	<? } ?>
