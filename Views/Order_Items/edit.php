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
		width: 35%;
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
			width: 35%;
		}
	}
</style>

	<div class="modal-header">
		<a href="?" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
		<h4 class="modal-title">Edit Items of <?=$model['FirstName']?> <?=$model['LastName']?>'s Order</h4>
	</div>


	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
	
<form action="?action=save" method="post" class="my-horizontal">
	
	
	<input type="hidden" name="id" value="<?=$model['id']?>" />
	
	<div class="form-group <?if(isset($errors['Order_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Order_id">Order Id:</label>
		
		<select size="1" class="required form-control" name="Order_id" id="Order_id">
			<option value="">--Order Id--</option>
			<? foreach (Items::GetOrders() as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['Order_id']==$row['id']) echo 'selected=true'?>>
					<?=$row['id']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['Order_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Order_id']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Product_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Product_id">Product:</label>
		
		<select size="1" class="required form-control" name="Product_id" id="Product_id">
			<option value="">--Product--</option>
			<? foreach (Items::GetProducts() as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['Product_id']==$row['id']) echo 'selected=true'?>>
					<?=$row['Name']?>: $<?=$row['Price']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['Product_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Product_id']?></span>
		<? endif ?>
	</div>
	
	<div class="modal-footer">
		<label class="control-label"></label>
		<input class="btn btn-primary" type="submit" value="Save" />
		<a href="?" data-dismiss="modal">Cancel</a>
	</div>
	
</form>

	<? function JavaScripts(){ global $model; ?>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
		<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
		<script type="text/javascript">
			$(function(){
				
				$("form").validate();
				$("#AddressType").val(<?=$model['AddressType']?>); //or put select in 
			})
		</script>
			
	<? } ?>