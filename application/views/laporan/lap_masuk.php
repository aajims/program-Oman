    <div class="clearfix"></div>
     <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo form_open('masuk/lapor', array('id' => 'FormLaporan')); ?>
                            <strong>Periode :</strong> <input type="text" class="input-xlarge datepicker" id="tanggal_dari" name="from" > s/d <input type="text" class="input-xlarge datepicker" value="<?php echo date('Y-m-d'); ?>" id="tanggal_sampai" name="to">
                            &nbsp;&nbsp;<select class="input-xlarge" name="rek" id="rek" >
                                <option value="">-- Pilih --</option>
                                <?php $jenis = $this->db->get('bank');
                                foreach ($jenis->result()as $row){
                                    ?>
                                    <option class="form-control" value="<?php echo $row->id_rek ?>"><?php echo $row->nm_bank; ?>&nbsp;<?php echo $row->rek; ?></option>
                                <?php } ?>
                            </select>&nbsp;&nbsp;<button class="btn btn-primary btn-sm" type="submit" name="submit">Tampilkan</button>
                            <div class="box-body">
                                <?php echo form_close(); ?>
                                <br />
                                <div id='result'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>


<script type="text/javascript">
$(document).ready(function(){
		
	$('#FormLaporan').submit(function(e){
		e.preventDefault();

		var TanggalDari = $('#tanggal_dari').val();
		var TanggalSampai = $('#tanggal_sampai').val();
		var Sumberdana = $('#rek').val();

		if(TanggalDari == '' || TanggalSampai == '')
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html("Tanggal harus diisi !");
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
			$('#ModalGue').modal('show');
		}
		else if (Sumberdana == '')		
		{
			var URL = "<?php echo site_url('masuk/aksi_rek_lapor'); ?>/" + TanggalDari + "/" + TanggalSampai;
			$('#result').load(URL);
		} else
		
		{
			var URL = "<?php echo site_url('masuk/aksi_rek_laporan'); ?>/" + TanggalDari + "/" + TanggalSampai + "/" + Sumberdana;
			$('#result').load(URL);
		}
	});
});
</script>	