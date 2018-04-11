<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Data Kas Masuk</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">					
					<div class="panel-body">
						<button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Pemasukan</button>
						<table data-toggle="table" id="datatable" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
							  <th>No </th>	       
							  <th>No Kwitansi </th>                   
	                          <th>Sumber Dana</th>
	                          <th>Tgl Masuk</th>	                          
	                          <th>Nominal</th>                          
							</tr>
						</thead>						
							<?php $no=1; foreach($masuk as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->kwitansi;?></td>
								<td><?php echo $row->dana;?></td>
								<td><?php echo tgl_indo($row->tgl_masuk); ?></td>							       
							    <td>Rp.<?php echo number_format($row->nominal);?>,-</td>			       
								</tr>
								<?php $no++; }?>								
						</table>					
				</div>
			</div>
		</div><!--/.row-->	
		
 <script type="text/javascript">
 (document).ready( function () {
      $('#datatable').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    
    }

    function edit_bid(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('masuk/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_masuk"]').val(data.id_masuk);
            $('[name="kwi"]').val(data.kwitansi);           
            $('[name="sum"]').val(data.id_kas); 
            $('[name="tgl"]').val(data.tgl_masuk);                        
            $('[name="nom"]').val(data.nominal);
			
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kas Masuk'); // Set title to Bootstrap modal title

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
          url = "<?php echo site_url('masuk/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('masuk/update')?>";
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
            url : "<?php echo site_url('masuk/delete')?>/"+id,
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
  
  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel">Form Kas Masuk</h4>
      </div>
      <div class="modal-body">
          <form action="#" id="form" class="form-horizontal" onSubmit="save()">
          <input type="hidden" value="" name="id_masuk"/>
              <table class="table table-form">  
              	<tr><label for="nip"><td style="width: 25%">No Kwitansi</td></label>
                <td style="width: 35%"><input type="text" id="kwi" name="kwi" readonly="" class="form-control" value=<?=$kodeunik;  ?>></td></tr>            	
             	<tr><label for="nama"><td style="width: 25%">Sumber Dana</td></label>
                <td style="width: 35%"><select class="form-control" name="sum" >
			           <option value="">-- Pilih --</option>
                      <?php $jenis = $this->db->get('kas');
                        foreach ($jenis->result()as $row){
                      ?>
                      <option class="form-control" value="<?php echo $row->id_kas ?>"><?php echo $row->dana; ?></option>
                      <?php } ?>
			        </select></td></tr>
                <tr><label for="tgl"><td style="width: 25%">Tanggal Masuk </td></label>
                <td style="width: 35%"><input type="date" id="tgl" name="tgl" class="form-control" ></td></tr>
                <tr><label for="telp"><td style="width: 25%">Nominal </td></label>
                <td style="width: 35%"><input type="number" placeholder="Rp. " maxlength="12" id="nom" name="nom" class="form-control" required="required" ></td></tr>
                
      		</table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnSave"  class="btn btn-primary">Save Changes</button>        
      </div>
        </form>
    </div>
  </div>
</div>