<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dana Kas</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">					
					<div class="panel-body">
						
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
							  <th>No </th>	       
							  <th>Dana </th>                   
	                          <th>Saldo</th>                          
							</tr>
						</thead>						
							<?php $no=1; foreach($kas as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->dana;?></td>															       
							    <td>Rp.<?php echo number_format($row->saldo);?>,-</td>						       
								</tr>
								<?php $no++; }?>								
						</table>					
				</div>
			</div>
		</div><!--/.row-->	
		
 