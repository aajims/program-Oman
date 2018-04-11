<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Kas Keluar</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<?php if ($this->session->flashdata('success')): ?>
					    <div class="alert bg-success" role="alert">
					        <span><?php echo $this->session->flashdata('success'); ?></span>
					    </div>
					<?php endif; ?>						
					<div class="panel-body">
						<a href="<?php echo site_url(); ?>/keluar/add" class="btn btn-success" ><i class="glyphicon glyphicon-plus"></i> Add Pengeluaran</a>
						<!--button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Pengeluaran</button-->
						<table data-toggle="table" id="datatable" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
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
							<?php $no=1; foreach($keluar as $row){ ?>
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
								<!---<tr><td >Jumlah Total : Rp.<?php echo number_format($total); ?>,-</td></tr>--->
						</table>					
				</div>
			</div>
		</div><!--/.row-->	
		
 <script type="text/javascript">
  var save_method; //for save method string
    var table;
    
 $(document).ready(function() { 
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
                location.reload();
            }
        });
        location.reload();
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Kas Keluar</h3>
            </div>            
            <div class="modal-body form">
                <form action="#" onsubmit="save()" id="form" class="form-horizontal">
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
                                <input type="text" maxlength="30" placeholder="Input Keperluan " name="per" class="form-control" required="" >                                
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Sumber Dana</label>
                            <div class="col-md-9">
                                <select class="form-control" name="sum" >
						           <option value="">-- Pilih --</option>
			                      <?php $jenis = $this->db->get('kas');
			                        foreach ($jenis->result()as $row){
			                      ?>
			                      <option class="form-control" value="<?php echo $row->id_kas ?>"><?php echo $row->dana; ?></option>
			                      <?php } ?>
						        </select>
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
                                <input type="number" maxlength="9" placeholder="Rp. " name="nom" class="form-control" required="" >                                
                                <span class="help-block"></span>
                            </div>
                        </div>                           
                    </div>                
            	</div>
            <div class="modal-footer">
                <button id="btnSave"  class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->