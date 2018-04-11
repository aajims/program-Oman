<script type="text/javascript">
            function addText(){
                var x = document.getElementById("dana_kas");
                var y = document.getElementById("dana_saldo");
                getSrgm = x.value;               
                res = getSrgm.split("|");
				y.value = res[1];				
			}							
        </script>
    <div class="clearfix"></div>
     <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert bg-success" role="alert">
                        <span><?php echo $this->session->flashdata('success'); ?></span>
                    </div>
                <?php endif; ?>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    <div >
                        <a href="<?php echo site_url(); ?>/keluar/tambih" class="btn btn-success" ><i class="glyphicon glyphicon-plus"></i> Add Pengeluaran</a>
                    </div>
                    </p>
                    <table id="example1" class="table table-striped table-bordered">
                        <thead>
						    <tr>
							  <th>No </th>	       
							  <th>No Kwitansi </th>                   
	                          <th>Nama Penerima</th>
	                          <th>Keperluan</th>
	                          <th>Tgl Terima</th>	                          
	                          <th>Nominal</th>
	                          <th>Sumber Kas</th>	                          
	                          <th>Action</th>
							</tr>
						</thead>						
							<?php $no=1; foreach($keluar as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->kwitansi;?></td>
								<td><?php echo $row->nm_guru;?></td>
								<td><?php echo $row->keperluan;?></td>
								<td><?php echo tgl_indo($row->tgl_keluar); ?></td>							       
							    <td>Rp.<?php echo number_format($row->nominal);?>,-</td>
							    <td><?php echo $row->dana;?></td>							       
							         <td>
									<button title="Delete data" class="btn btn-danger"  onclick="delete_bid(<?php echo $row->id_keluar;?>)" ><i class="glyphicon glyphicon-trash"></i></button>
							         </td>                                     
								</tr>								
								<?php $no++; }?>
                            </table>
                        </div>
                    </div>
                </div>
             </div>

 <script type="text/javascript">
 var save_method; //for save method string
    var table;
    
 	(document).ready(function() { 
 	$('#datatable').DataTable(); } ); 
 	
    function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_form').modal('show'); // show bootstrap modal
    
    }

    function edit_bid(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('keluar/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_keluar"]').val(data.id_keluar);
            $('[name="kwi"]').val(data.kwitansi);           
            $('[name="nm"]').val(data.id_guru);
            $('[name="per"]').val(data.keperluan);
            $('[name="kas"]').val(data.id_kas); 
            $('[name="tgl"]').val(data.tgl_keluar);                        
            $('[name="nom"]').val(data.nominal);
			
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kas keluar'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save()
    {	
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('keluar/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('keluar/update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(' update data');                
            }
        });        
    }

    function delete_bid(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('keluar/delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }
        
  </script>
    
     <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Kas Keluar</h3>
                       
            <div class="modal-body form">
                <form action="#" method="post" id="form" onsubmit="save()" class="form-horizontal" onSubmit="return validasi(this)">
                    <input type="hidden" value="" name="id_keluar"/> 
                    <div class="form-body">                    	
                        <div class="form-group">
                            <label class="control-label col-md-3">No Kwitansi</label>
                            <div class="col-md-9">
                                <input type="text" name="kwi" readonly="" class="form-control" value=<?=$kodeunik;  ?>>                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penerima</label>
                            <div class="col-md-9">
                                <select class="form-control" name="nm">
			                      <option value="">-- Pilih --</option>
			                      <?php $jenis = $this->db->get('guru');
			                        foreach ($jenis->result()as $row){
			                      ?>
			                      <option class="form-control" value="<?php echo $row->id_guru ?>"><?php echo $row->nm_guru; ?></option>
			                      <?php } ?>
			                 	 </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keperluan</label>
                            <div class="col-md-9">
                                <input type="text" maxlength="30" placeholder="Input Keperluan " name="per" class="form-control" required="">                                
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Sumber Dana</label>
                            <div class="col-md-9">
                            	<select class="form-control" name="kas" id="dana_kas"  onchange="javascript: addText();">
                              <option value="">-- Pilih --</option>
			                      <?php $jenis = $this->db->get('kas');
			                        foreach ($jenis->result()as $row){
			                      ?>
			                      <option class="form-control" value="<?php echo $row->id_kas ?>|<?php echo $row->saldo ?>"><?php echo $row->dana; ?></option>
			                      <?php } ?>
			                 	 </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="control-label col-md-3">Saldo</label>
                            <div class="col-md-9">
                                <input type="text"  name="saldo" id="dana_saldo" class="form-control" >                                
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Terima </label>
                            <div class="col-md-9">
                                <input type="date" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>">                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nominal</label>
                            <div class="col-md-9">
                                <input type="number" maxlength="9" placeholder="Rp. " id="nominal" name="nom" class="form-control" >                                
                                <span class="help-block"></span>
                            </div>
                        </div>                           
                    </div>                
            	</div>
            <div class="modal-footer">
                <button  class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <script>
  	function validasi(form){
   if (form.per.value == ""){
    alert("Anda belum mengisikan Keperluan.");
    form.per.focus();
    return (false);
  } 
  		
  if (form.nom.value == ""){
    alert("Anda belum mengisikan Nominal.");
    form.nom.focus();
    return (false);
  } 
  
  if (form.saldo.value <= form.nom.value){
    alert("Transaksi Tidak Dapat di Proses, Masukan Nominal yang lebih Kecil dari Saldo.");
    form.nom.focus();
    return (false);
  } 
  return (true);
}
  </script>    