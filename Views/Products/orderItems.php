	<?
		$id = $_REQUEST['id'];
	?>
	<link rel="stylesheet" type="test/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" />
	<h2>
		List of Order Items
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
				<th>Order Id</th>
				<th>Product Id</th>
				<th>Product Name</th>
				<th>Customer's Name</th>
				<th>Address</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			
			<? foreach ($model as $row): ?>
				<tr class="<?=isset($_REQUEST['sub_action']) && $id==$row['id'] ? "highlighted" : "" ?>">
					<td><?=$row['Order_id']?></td>
					<td><?=$row['Product_id']?></td>
					<td><?=$row['ProductName']?></td>
					<td><?=$row['LastName']?>, <?=$row['FirstName']?></td>
					<td><?=$row['Addresses']?></td>
					<td>
						<div class="btn-grou[]">
							<a class="btn btn-sm btn-default glyphicon glyphicon-trash" title="Delete" href="?action=deleteItem&format=json&id=<?=$row['id']?>"></a>
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
				$(".glyphicon-trash").click(function(event){
					var that = this;
					event.preventDefault();
					$.get(this.href, function(data){
						
						if(confirm("Are you sure that you want to delete " + data.data.FirstName + " " + data.data.LastName + "'s Address?")){
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
	