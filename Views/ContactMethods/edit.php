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
		<h4 class="modal-title">Edit Contact Method of: <?=$model['FirstName']?> <?=$model['LastName']?></h4>
	</div>

	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
	
<form action="?action=save" method="post" class="my-horizontal">
	
	
	<input type="hidden" name="id" value="<?=$model['id']?>" />
	
	<div class="form-group <?if(isset($errors['ContactMethodType'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="ContactMethodType">Contact Method Type:</label>
		
		<select size="1" class="required form-control" name="ContactMethodType" id="ContactMethodType">
			<option value="">--Contact Method Type--</option>
			<? foreach (Keywords::SelectListFor(11) as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['ContactMethodType']==$row['id']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['ContactMethodType'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['ContactMethodType']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Value'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Value">Value:</label>
		<input class="required form-control" type="text" name="Value" id="Value" value="<?=$model['Value']?>" placeholder="Value" />
		<? if(isset($errors['Value'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Value']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['User_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="User_id">(What to do here?) User_id:</label>
		<input class="required form-control" type="text" name="User_id" id="User_id" value="<?=$model['User_id']?>" placeholder="User_id" />
		<? if(isset($errors['User_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['User_id']?></span>
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
				$("#ContactMethodType").val(<?=$model['ContactMethodType']?>); //or put select in 
			})
		</script>
			
	<? } ?>