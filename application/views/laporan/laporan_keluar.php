<?php if($keluar->num_rows() > 0) { ?>

	<table id="example1" class='table table-bordered'>
		<thead>
			<tr>
			 <th>No </th>	       
			  <th>No Kwitansi </th>                   
              <th>Nama Penerima</th>
              <th>Keperluan</th>
              <th>Tgl Keluar</th>	                          
              <th>Nominal</th>
              <th>Sumber Kas</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;			
			foreach($keluar->result() as $row)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".$row->kwitansi."</td>
						<td>".$row->nm_guru."</td>
						<td>".$row->keperluan."</td>						
						<td>".tgl_indo($row->tgl_keluar)."</td>
						<td>".number_format($row->nominal)."</td>
						<td>".$row->dana."</td>											
					</tr>
				";				
				$no++;			
			}	
			?>
		</tbody>
	</table>
	<br />
	<p>
		<?php
		$from 	= date('Y-m-d', strtotime($from));
		$to		= date('Y-m-d', strtotime($to));
		$sumber = $row->id_kas;
		
		?>
		<a href="<?php echo site_url('keluar/laporan_pdf/'.$from.'/'.$to.'/'.$sumber); ?>" target='blank' class='btn btn-default'><img width="45" height="45" src="<?php echo base_url(); ?>assets/img/pdf.jpg"> Export ke PDF</a>
	</p>
	<br />
<?php } ?>

<?php if($keluar->num_rows() == 0) { ?>
<div class='alert alert-info'>
Data dari tanggal <b><?php echo $from; ?></b> sampai tanggal <b><?php echo $to; ?></b> tidak ditemukan
</div>
<br />
<?php } ?>