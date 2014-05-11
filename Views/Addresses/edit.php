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
		<h4 class="modal-title">Edit Address of: <?=$model['FirstName']?> <?=$model['LastName']?></h4>
	</div>
	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
	
<form action="?action=save" method="post" class="my-horizontal">
	
	
	<input type="hidden" name="id" value="<?=$model['id']?>" />
	
	<div class="form-group <?if(isset($errors['Addresses'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Addresses">Address:</label>
		<input class="required form-control" type="text" name="Addresses" id="Addresses" value="<?=$model['Addresses']?>" placeholder="Addresses" />
		<? if(isset($errors['Addresses'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Addresses']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['City'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="City">City:</label>
		<input class="required form-control" type="text" name="City" id="City" value="<?=$model['City']?>" placeholder="City" />
		<? if(isset($errors['City'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['City']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['State'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="State">State:</label>
		<input class="required form-control" type="text" name="State" id="State" value="<?=$model['State']?>" placeholder="State" />
		<? if(isset($errors['State'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['State']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Zip'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Zip">Zip Code:</label>
		<input class="required form-control" type="text" name="Zip" id="Zip" value="<?=$model['Zip']?>" placeholder="Zip" />
		<? if(isset($errors['Zip'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Zip']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Country'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Country">Country:</label>
		<input class="required form-control" type="text" name="Country" id="Country" value="<?=$model['Country']?>" placeholder="Country" />
		<? if(isset($errors['Country'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Country']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['AddressType'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="AddressType">Address Type:</label>
		
		<select size="1" class="required form-control" name="AddressType" id="AddressType">
			<option value="">--Address Type--</option>
			<? foreach (Keywords::SelectListFor(12) as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['AddressType']==$row['id']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['AddressType'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['AddressType']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Users_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Users_id">User:</label>
		
		<select size="1" class="required form-control" name="Users_id" id="Users_id">
			<option value="">--User--</option>
			<? foreach (Addresses::GetUsers() as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['Users_id']==$row['id']) echo 'selected=true'?>>
					<?=$row['LastName']?>, <?=$row['FirstName']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['Users_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Users_id']?></span>
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