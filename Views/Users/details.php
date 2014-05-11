	<?
		$id = $_REQUEST['id'];
		$uInfo = $model[0];
		$aInfo = $model[1];
		$cInfo = $model[2];
		$oInfo = $model[3];
		unset($model);
		$model = $uInfo[0];
	?>
	<link rel="stylesheet" type="test/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" />
	<h2>
		User Account Info
	</h2>
	
	<style type="text/css">
		body table.table .highlighted td{
			background-color: #FFFFAA;
		}
	</style>
	
	<? if(isset($_REQUEST['sub_action'])): ?>
		<div class="alert alert-success alert-dismissable">
			<a class="close">&times;</a>
			The row has been <?=$_REQUEST['sub_action']?> successfully!
		</div>
	<? endif; ?>
	
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>FirstName</th>
				<th>LastName</th>
				<th>Password</th>
				<th>fbid</th>
				<th>UserType</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<? $row = $model[0]?>
				<tr>
					<td><?=$row['FirstName']?></td>
					<td><?=$row['LastName']?></td>
					<td><?=$row['Password']?></td>
					<td><?=$row['fbid']?></td>
					<td><?=$row['UserType']?></td>
					<td>
						<div class="btn-group">
							<a class="btn btn-sm btn-default glyphicon glyphicon-edit" title="Edit" href="?action=edit&id=<?=$row['id']?>"></a>
							<a <?= Accounts::IsAdmin() ? '' : 'disabled' ?>class="btn btn-sm btn-default glyphicon glyphicon-trash glyphicon-trash-info" title="Delete" href="?action=delete&format=json&id=<?=$row['id']?>"></a>
						</div>
					</td>
				</tr>
			<? //endforeach; ?>
			
		</tbody>
	</table>
	</br>
	<h3>Address Information:</h3>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Addresses</th>
				<th>City</th>
				<th>State</th>
				<th>Zip</th>
				<th>AddressType</th>
				<th>Country</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			
			<? foreach ($aInfo as $row): ?>
				<tr>
					<td><?=$row['Addresses']?></td>
					<td><?=$row['City']?></td>
					<td><?=$row['State']?></td>
					<td><?=$row['Zip']?></td>
					<td><?=$row['AddressType']?></td>
					<td><?=$row['Country']?></td>
					<td>
						<div class="btn-grou[]">
							<a class="btn btn-sm btn-default glyphicon glyphicon-edit" title="Edit" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Addresses.php?action=edit&id=<?=$row['Aid']?>"></a>
							<a class="btn btn-sm btn-default glyphicon glyphicon-trash glyphicon-trash-addresses" title="Delete" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Addresses.php?action=delete&format=json&id=<?=$row['Aid']?>"></a>
						</div>
					</td>
				</tr>
			<? endforeach; ?>
			
		</tbody>
	</table>
	</br>
	<h3>Contact Information:</h3>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Contact Method</th>
				<th>Value</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			
			<? foreach ($cInfo as $row): ?>
				<tr>
					<td><?=$row['ContactMethodType']?></td>
					<td><?=$row['Value']?></td>
					<td>
						<div class="btn-grou[]">
							<a class="btn btn-sm btn-default glyphicon glyphicon-edit" title="Edit" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Contacts.php?action=edit&id=<?=$row['Cid']?>"></a>
							<a class="btn btn-sm btn-default glyphicon glyphicon-trash glyphicon-trash-contacts" title="Delete" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Contacts.php?action=delete&format=json&id=<?=$row['Cid']?>"></a>
						</div>
					</td>
				</tr>
			<? endforeach; ?>
			
		</tbody>
	</table>
	</br>
	<h3>Order Information:</h3>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Order Id</th>
				<th>Date Created</th>
				<th>Order Address</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			
			<? foreach ($oInfo as $row): ?>
				<tr>
					<td><?=$row['Order_id']?></td>
					<td><?=$row['OrderDate']?></td>
					<td><?=$row['OrderAddress']?></td>
					<td>
						<div class="btn-grou[]">
							<a class="btn btn-sm btn-default glyphicon glyphicon-edit" title="Edit" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Orders.php?action=edit&id=<?=$row['Cid']?>"></a>
							<a class="btn btn-sm btn-default glyphicon glyphicon-trash glyphicon-trash-orders" title="Delete" href="http://cs.newpaltz.edu/~n02004019/2014Spring/Final/Controllers/Orders.php?action=delete&format=json&id=<?=$row['Cid']?>"></a>
						</div>
					</td>
				</tr>
			<? endforeach; ?>
			
		</tbody>
	</table>
	
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
	
	<? function Javascripts() { ?>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(function(){
				
				$(".table").dataTable();
				$(".highlighted td").delay(2000).animate({backgroundColor: ""}, 2000)
				
				$(".close").click(function(){
					$(this).closest(".alert").slideUp();
				})
				$(".glyphicon-trash-info").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + "?")){
							$.post(that.href, function(data){
								if(data.success){
									//msg user success
									//delete row
									alert('Deleted Successfuly');
									$(that).closest('tr').remove();
								}else{
									//msg user error	
									alert(JSON.stringify(data.errors));
								}
							}, 'json');
						}
						
					}, 'json')
				});
				
				$(".glyphicon-trash-addresses").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + " address?")){
							$.post(that.href, function(data){
								if(data.success){
									//msg user success
									//delete row
									alert('Deleted Successfuly');
									$(that).closest('tr').remove();
								}else{
									//msg user error	
									alert(JSON.stringify(data.errors));
								}
							}, 'json');
						}
						
					}, 'json')
				});
				
				$(".glyphicon-trash-addresses").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + " address?")){
							$.post(that.href, function(data){
								if(data.success){
									//msg user success
									//delete row
									alert('Deleted Successfuly');
									$(that).closest('tr').remove();
								}else{
									//msg user error	
									alert(JSON.stringify(data.errors));
								}
							}, 'json');
						}
						
					}, 'json')
				});
				
				$(".glyphicon-trash-contacts").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + " address?")){
							$.post(that.href, function(data){
								if(data.success){
									//msg user success
									//delete row
									alert('Deleted Successfuly');
									$(that).closest('tr').remove();
								}else{
									//msg user error	
									alert(JSON.stringify(data.errors));
								}
							}, 'json');
						}
						
					}, 'json')
				});
				
				$(".glyphicon-trash-orders").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + " order?")){
							$.post(that.href, function(data){
								if(data.success){
									//msg user success
									//delete row
									alert('Deleted Successfuly');
									$(that).closest('tr').remove();
								}else{
									//msg user error	
									alert(JSON.stringify(data.errors));
								}
							}, 'json');
						}
						
					}, 'json')
				});
				
				$(".glyphicon-edit, .cmd-new").click(function(event){
					var that = this;
					event.preventDefault();
					
					$.get(that.href, { format: 'plain'}, function(data){
						var $myModal = $("#myModal");
						$(".modal-content", $myModal).html(data);
						$myModal.modal('show');
						
					})
				})
				
			})
		</script>
	<? } ?>