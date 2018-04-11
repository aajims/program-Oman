<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                        <div >
                            <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add No Rek</button>
                        </div>
                        </p>
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
						    <tr>
							  <th>No </th>
	                          <th>Nama Bank</th>
	                          <th>No rekening</th>
                              <th>Atas nama</th>
	                          <th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($bank as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->nm_bank;?></td>
								<td><?php echo $row->rek; ?></td>
                                <td><?php echo $row->atasnama; ?></td>
								<td class="center">
									<button class="btn btn-info" onclick="edit_bid(<?php echo $row->id_rek; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_bid(<?php echo $row->id_rek; ?>)"><i class="glyphicon glyphicon-remove"></i></button>
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
        url : "<?php echo site_url('bank/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_rek"]').val(data.id_rek);
            $('[name="nama"]').val(data.nm_bank);
            $('[name="rek"]').val(data.rek);
            $('[name="nm"]').val(data.atasnama);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


    function save()
    {

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable


      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('bank/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('bank/update')?>";
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

    }

    function delete_bid(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('bank/delete')?>/"+id,
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
                <h3 class="modal-title">Form Data Bank</h3>
            </div>
            <div class="modal-body form">
                <form id="form"  action="#" class="form-horizontal">
                    <input type="hidden" value="" name="id_rek"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Bank</label>
                            <div class="col-md-9">
                                <select name="nama" class="form-control">
                                    <option value=""> ---- Pilih Bank ----  </option>
                                    <option value="Bank BCA"> Bank BCA</option>
                                    <option value="Bank Mandiri"> Bank Mandiri</option>
                                    <option value="Bank BRI"> Bank BRI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Rekening</label>
                            <div class="col-md-9">
                                <input type="number" name="rek" placeholder="Input dengan angka" class="form-control" data-validation="length" data-validation-length="10-15"  >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Atas nama</label>
                            <div class="col-md-9">
                                <input type="text" name="nm" placeholder="Input pemilik rek" class="form-control" data-validation="required"  >
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

 
        