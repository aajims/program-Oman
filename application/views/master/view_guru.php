<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                        <div >
                            <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Guru</button>
                        </div>
                        </p>
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
						    <tr>
							  <th>No </th>	       
							  <th>NIP </th>                   
	                          <th>Nama Lengkap</th>
	                          <th>Bidang Studi</th>	                          
	                          <th>No Telepon</th>
	                          <th>Email</th>
	                          <th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($guru as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->nip;?></td>
								<td><?php echo $row->nm_guru;?></td>
								<td><?php echo $row->bid_studi; ?></td>							       
							    <td><?php echo $row->no_telp;?></td>
							    <td><?php echo $row->email;?></td>
								<td class="center">
									<button class="btn btn-info" onclick="edit_bid(<?php echo $row->id_guru; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>									
									<button class="btn btn-danger" onclick="delete_bid(<?php echo $row->id_guru; ?>)"><i class="glyphicon glyphicon-remove"></i></button>									
								</td>
                        </tr>   
                        <?php $no++; }?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
            
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
        url : "<?php echo site_url('guru/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_guru"]').val(data.id_guru);
            $('[name="nip"]').val(data.nip);           
            $('[name="nama"]').val(data.nm_guru); 
            $('[name="studi"]').val(data.bid_studi);                        
            $('[name="telp"]').val(data.no_telp);
			$('[name="email"]').val(data.email);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Guru'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


    function save()
    {
       var validasi = /^[a-zA-Z ]+$/;
        if (nama.value.match(validasi)) {

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable


      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('guru/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('guru/update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    location.reload();
                }
                else
                {
                    for (var i = 0; i < data.inputerror.length; i++)
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


            },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error adding / update data');
                  $('#btnSave').text('save'); //change button text
                  $('#btnSave').attr('disabled',false); //set button enable

              }
        });
        } else {
            alert("Nama Lengkap Wajib Huruf!");
            return false;
        }
    }

    function delete_bid(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('guru/delete')?>/"+id,
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
                <h3 class="modal-title">Form Guru</h3>
            </div>
            <div class="modal-body form">
                <form id="form"  action="#" class="form-horizontal">
                    <input type="hidden" value="" name="id_guru"/> 
                    <div class="form-body">                    	
                        <div class="form-group">
                            <label class="control-label col-md-3">NIP</label>
                            <div class="col-md-9">
                                <input type="text"  placeholder="Input Nomor Induk Pegawai" name="nip" class="form-control" data-validation="length" data-validation-length="8-12" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Input Nama Lengkap" id="nama" name="nama" class="form-control"
                                       data-validation-regexp="^([a-z]+)$">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Bidang Studi</label>
                            <div class="col-md-9">
                            	<select class="form-control" name="studi" >
                                <option value="">-- Pilih --</option>
						          <?php
								  $pilihan	= array("Agama","IPA","IPS","MATEMATIKA","KEWARGANEGARAAN","B.INDONESIA","B.INGGRIS");
						          foreach ($pilihan as $nilai) {
						            if ($dataLevel==$nilai) {
						                $cek=" selected";
						            } else { $cek = ""; }
						            echo "<option value='$nilai' $cek>$nilai</option>";
						          }
						          ?>
						        </select>                                
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Telepon</label>
                            <div class="col-md-9">
                                <input type="number" name="telp" placeholder="Input dengan angka" class="form-control" data-validation="length" data-validation-length="10-12"  >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" placeholder="Input Email Valid" class="form-control" data-validation="email" >
                                <span class="help-block"></span>
                            </div>
                        </div>                                          
                    </div>                
            	</div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" onclick="save()"  class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 
        