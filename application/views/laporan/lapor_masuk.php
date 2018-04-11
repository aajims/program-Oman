<?php if($masuk->num_rows() > 0) { ?>

	<table id="example1" class='table table-bordered'>
		<thead>
			<tr>
			 <th>No </th>	       
			  <th>No Kwitansi </th>                   
              <th>Sumber Dana</th>              
              <th>Tgl Masuk</th>	                          
              <th>Nominal</th>              
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;			
			foreach($masuk->result() as $row)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".$row->kwitansi."</td>
						<td>".$row->dana."</td>												
						<td>".tgl_indo($row->tgl_masuk)."</td>
						<td>".number_format($row->nominal)."</td>																	
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
		<a href="<?php echo site_url('masuk/lapor_pdf/'.$from.'/'.$to); ?>" target='blank' class='btn btn-default'><img width="45" height="45" src="<?php echo base_url(); ?>assets/img/pdf.jpg"> Export ke PDF</a>
	</p>
	<br />
<?php } ?>

<?php if($masuk->num_rows() == 0) { ?>
<div class='alert alert-info'>
Data dari tanggal <b><?php echo $from; ?></b> sampai tanggal <b><?php echo $to; ?></b> tidak ditemukan
</div>
<br />
<?php } ?>