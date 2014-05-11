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
		<h4 class="modal-title">Edit: <?=$model['Name']?></h4>
	</div>

	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
	
<form action="?action=save" method="post" class="my-horizontal">
	
	
	<input type="hidden" name="id" value="<?=$model['id']?>" />
	
	<div class="form-group <?if(isset($errors['Name'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Name">Name:</label>
		<input class="required form-control" type="text" name="Name" id="Name" value="<?=$model['Name']?>" placeholder="Name" />
		<? if(isset($errors['Name'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Name']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Price'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Price">Price:</label>
		<input class="required form-control" type="text" name="Price" id="Price" value="<?=$model['Price']?>" placeholder="Price" />
		<? if(isset($errors['Price'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Price']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group">
		<label class="control-label" for="Description">Description:</label>
		<input class="form-control" type="Description" name="Description" id="Description" value="<?=$model['Description']?>" placeholder="Description" />
	</div>
	
	<div class="form-group <?if(isset($errors['Picture_Url'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Picture_Url">Picture_Url:</label>
		<input class="required form-control" type="text" name="Picture_Url" id="Picture_Url" value="<?=$model['Picture_Url']?>" placeholder="Picture_Url" />
		<? if(isset($errors['Picture_Url'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Picture_Url']?></span>
		<? endif ?>
	</div>

	<div class="form-group <?if(isset($errors['Catergory_Keyword_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Catergory_Keyword_id">Catergory:</label>
		
		<select size="1" class="required form-control" name="Catergory_Keyword_id" id="Catergory_Keyword_id">
			<option value="">--Catergory--</option>
			<? foreach (Keywords::SelectListFor(13) as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['Catergory_Keyword_id']==$row['id']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['Catergory_Keyword_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Catergory_Keyword_id']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['Suplier_id'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="Suplier_id">Suplier:</label>
		
		<select size="1" class="required form-control" name="Suplier_id" id="Suplier_id">
			<option value="">--Supliers--</option>
			<? foreach (Products::GetSupliers() as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['Suplier_id']==$row['id']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['Suplier_id'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['Suplier_id']?></span>
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
				$("#UserType").val(<?=$model['UserType']?>);
				
			})
		</script>
			
	<? } ?>