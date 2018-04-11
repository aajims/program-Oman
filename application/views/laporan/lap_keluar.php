	<?php echo form_open('keluar/laporan', array('class'=>'form-inline')); ?>
	

	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Laporan Data Kas Keluar</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">					
					<div class="panel-body">
						<strong>Periode :</strong> <input type="date" id="tgl" name="tanggal1" > s/d <input type="date" id="tgl" name="tanggal2">&nbsp;&nbsp;<select class="form-control" name="kas" id="kas" >
                      <option value="ALL">-- Pilih --</option>
                      <?php $jenis = $this->db->get('kas');
                        foreach ($jenis->result()as $row){
                      ?>
                      <option class="form-control" value="<?php echo $row->id_kas ?>"><?php echo $row->dana; ?></option>
                      <?php } ?>
                  </select>&nbsp;<button class="btn btn-primary btn-sm" type="submit" name="submit">Tampilkan</button>
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
							  <th>No </th>	       
							  <th>No Kwitansi </th>                   
	                          <th>Nama Penerima</th>
	                          <th>Keperluan</th>
	                          <th>Tgl Terima</th>	                          
	                          <th>Nominal</th>
	                          <th>Sumber Kas</th>	                          
							</tr>
						</thead>						
							<?php $no=1; foreach($record->result() as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->kwitansi;?></td>
								<td><?php echo $row->nm_guru;?></td>
								<td><?php echo $row->keperluan;?></td>
								<td><?php echo tgl_indo($row->tgl_keluar); ?></td>							       
							    <td>Rp.<?php echo number_format($row->nominal);?>,-</td>
							    <td><?php echo $row->dana;?></td>							         
								</tr>
								<?php $no++; }?>								
						</table>
						<br />
					<div >                    	
		           <a href="<?php echo site_url() ?>/keluar/lap" class="btn btn-info" target="_blank">Print</a>	&nbsp;&nbsp;<a class="btn btn-primary" target="_blank" href="<?php echo site_url(); ?>/keluar/lap_pdf">Print PDF</a>
		           	</div> 
					</div>
			</div>
		</div><!--/.row-->	
		
				