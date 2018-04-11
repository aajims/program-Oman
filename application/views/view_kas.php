<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                <div >
                    <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Dana</button>
                </div>
                </p>
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
						    <tr>
							  <th>No </th>	       
							  <th>Dana </th>                   
	                          <th>Saldo</th>	                                                    
	                          <th>Action</th>
							</tr>
						</thead>						
							<?php $no=1; foreach($kas as $row){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->dana;?></td>															       
							    <td>Rp.<?php echo number_format($row->saldo);?>,-</td>							       
							         <td>
									<button class="btn btn-warning" onclick="edit_bid(<?php echo $row->id_kas;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
									<button class="btn btn-danger" onclick="delete_bid(<?php echo $row->id_kas;?>)"><i class="glyphicon glyphicon-trash"></i></button>
							         </td>
								</tr>
                                  <?php $no++; }?>
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
        url : "<?php echo site_url('kas/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_kas"]').val(data.id_kas);
            $('[name="dn"]').val(data.dana);           
            $('[name="sal"]').val(data.saldo);             
			
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Kas'); // Set title to Bootstrap modal title

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
          url = "<?php echo site_url('kas/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('kas/update')?>";
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
            url : "<?php echo site_url('kas/delete')?>/"+id,
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
                <h3 class="modal-title">Dana Kas</h3>
            </div>            
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_kas"/> 
                    <div class="form-body">                    	
                        <div class="form-group">
                            <label class="control-label col-md-3">Sumber Dana </label>
                            <div class="col-md-9">
                                <input type="text" name="dn" class="form-control" >                                
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Saldo Kas</label>
                            <div class="col-md-9">
                                <input type="number" name="sal" class="form-control" >
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
                
 