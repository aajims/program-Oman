<script type="text/javascript">
            function addText(){
                var x = document.getElementById("dana_kas");
                var y = document.getElementById("dana_saldo");
                getSrgm = x.value;               
                res = getSrgm.split("|");
				y.value = res[1];				
			}								
        </script>
  <script>
  	function validasi(form){
  if (form.nom.value > form.saldo.value){
    alert("Transaksi Gagal, Masukan Nominal Lebih kecil lagi.");
    form.nom.focus();
    return (false);
  } 
 
  return (true);
}
  </script>      
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Form Data Kas Keluar</div>
					  <div class="panel-body">
						<div class="col-md-6">
							
							<form method="post" id="form" action="<?php echo site_url() ?>/keluar/tambih"  onSubmit="return validasi(this)">							
								<div class="form-group">
									<label>No Kwitansi</label>
									<input type="text" name="kwi" readonly="" class="form-control" value=<?=$kodeunik;  ?>>  
								</div>																
								<div class="form-group">
									<label>Nama Penerima</label>
									<select class="form-control" name="nm">
			                      <option value="">-- Pilih --</option>
			                      <?php $jenis = $this->db->get('guru');
			                        foreach ($jenis->result()as $row){
			                      ?>
			                      <option class="form-control" value="<?php echo $row->id_guru ?>"><?php echo $row->nm_guru; ?></option>
			                      <?php } ?>
			                 	 </select>
								</div>								
								<div class="form-group">
									<label>Keperluan</label>
									<input type="text" maxlength="30" placeholder="Input Keperluan " name="per" class="form-control" required="" >  
								</div>
								<div class="form-group">
									<label>Sumber Dana</label>
									<select name="kas" class="form-control" id="dana_kas" onchange="javascript: addText();">
			                            <option></option>
			                            <?php foreach($kas as $anggota):?>
			                            <option value="<?php echo $anggota->id_kas; ?>|<?php echo $anggota->saldo; ?>"><?php echo $anggota->dana; ?></option>
			                            <?php endforeach;?>
			                        </select>                              
		                       		</div>
		                        <div class="form-group">
									<label>Saldo</label>
									<input type="text" name="saldo" id="dana_saldo" class="form-control">  
								</div>
								<div class="form-group">
									<label>Tanggal Terima</label>
									<input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>">  
								</div>
								<div class="form-group">
									<label>Nominal</label>
									<input type="number" maxlength="9" id="nominal" placeholder="Rp. " name="nom" class="form-control" required="" >  
								</div>
								<div class="modal-footer">
				                <button name="submit" type="submit" class="btn btn-primary">Save Changes</button>
				                <button type="button" onclick="self.history.back()" class="btn btn-danger" data-dismiss="modal">Back</button>
				            </div>	
							  </form>
							</div>
						</div>
					</div>
				  </div>
				</div>
<script>
	 $(document).ready(function(){
	 	$("#btnSave").click(function(){            
            var saldo=$("#dana_saldo").val();
            var nominal=$("#nominal").val();
		  if (nominal >= saldo) {
                //code
                alert("Transaksi Tidak Ijinkan, Input Jumlah Lebih Besar dari Stok yang ada");
                return false
            }else {
            	return true;
            }
		});
	 });
</script>			 		  	
	