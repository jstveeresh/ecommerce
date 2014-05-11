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
		<h4 class="modal-title">Edit <?=$model['FirstName']?> <?=$model['LastName']?>'s Account Info</h4>
	</div>

	<ul class="error">
		<? foreach ($errors as $key => $value): ?>
			<li><b><?=$key?>:</b> <?=$value?></li>
		<? endforeach; ?>
	</ul>
<form action="?action=saveInfo" method="post" class="my-horizontal">
	
	<input type="hidden" name="id" value="<?=$model['id']?>" />
	<input type="hidden" name="AddressId" value="<?=$model['AddressId']?>" />
	
	<div class="form-group <?if(isset($errors['FirstName'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="FirstName">First Name:</label>
		<input class="required form-control" type="text" name="FirstName" id="FirstName" value="<?=$model['FirstName']?>" placeholder="First Name" />
		<? if(isset($errors['FirstName'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['FirstName']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group <?if(isset($errors['LastName'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="LastName">Last Name:</label>
		<input class="required form-control" type="text" name="LastName" id="LastName" value="<?=$model['LastName']?>" placeholder="Last Name" />
		<? if(isset($errors['LastName'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['LastName']?></span>
		<? endif ?>
	</div>
	
	<div class="form-group">
		<label class="control-label" for="Password">Password:</label>
		<input class="form-control" type="password" name="Password" id="Password" value="<?=$model['Password']?>" placeholder="Password" />
	</div>
	
	<div class="form-group">
		<label class="control-label" for="fbid">fbid:</label>
		<input class="form-control" type="text" name="fbid" id="fbid" value="<?=$model['fbid']?>" placeholder="fbid" />
	</div>


	<div class="form-group <?if(isset($errors['UserType'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="UserType">User Type:</label>
		
		<select size="1" class="required form-control" name="UserType" id="UserType">
			<?if(!Accounts::IsAdmin()):?>
				<? foreach (Keywords::SelectListFor(10) as $row) {
					if($model['UserType']==$row['Name'])
						$userTypeId = $row['id']; } ?>
			<?endif;?>
			<option value="">--User Type--</option>
			<? foreach (Keywords::SelectListFor(10) as $row): ?>
				<option value="<?if(isset($userTypeId)) {echo $userTypeId;} else {echo $row['id'];}?>" <?if($model['UserType']==$row['Name']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['UserType'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['UserType']?></span>
		<? endif ?>
	</div>
	
	
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
				<option value="<?=$row['id']?>" <?if($model['AddressType']==$row['Name']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['AddressType'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['AddressType']?></span>
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
	
	<div class="form-group <?if(isset($errors['ContactMethodType'])) echo 'has-error has-feedback' ?> ">
		<label class="control-label" for="ContactMethodType">Contact Method Type:</label>
		
		<select size="1" class="required form-control" name="ContactMethodType" id="ContactMethodType">
			<option value="">--Contact Method Type--</option>
			<? foreach (Keywords::SelectListFor(11) as $row): ?>
				<option value="<?=$row['id']?>" <?if($model['ContactMethodType']==$row['Name']) echo 'selected=true'?>>
					<?=$row['Name']?>
				</option>
			<? endforeach; ?>
		</select>
		
		<? if(isset($errors['ContactMethodType'])): ?>
			<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			<span ><?=$errors['ContactMethodType']?></span>
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