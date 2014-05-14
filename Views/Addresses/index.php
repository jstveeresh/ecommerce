
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.min.css" />
    <style>
    	.main{
    		margin-top: 20px;
    	}
    </style>
    
    <p class="main">This is the Addresses Section of my eCommerce project. </p>
	<h2>
		List of Addresses
	</h2>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>Zip</th>
			</tr>
		</thead>
		<tbody>
			
			<? foreach ($model as $row): ?>
				<tr>
					<td><?=$row['City']?></td>
					<td><?=$row['State']?></td>
					<td><?=$row['Country']?></td>
					<td><?=$row['Zip']?></td>
				</tr>
			<? endforeach; ?>
			
		</tbody>
	</table>
	
	<? function JavaScripts(){ ?>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
		    $(function(){
		    	
		    ${".table").dataTable();
		    
		    })
		</script>
	<? } ?>
	


