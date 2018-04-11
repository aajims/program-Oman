<style type="text/css">
.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}
</style>

<div class="container">
      <div class="row">
     <br />
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   		 <?php  foreach($profil as $row)   ?>    
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $row->nama_lengkap; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
                          
                <div class=" col-md-9 col-lg-9 "> 
                  <table id="dynamic-table" class="table table-user-information">
                    <tbody>
                       <tr>
                          <td><strong>Edit Data Pengguna</stong></td>
                        <td><input type="hidden" name="id_admin" value="<?php echo $row->id_admin; ?>"> </td>
                      </tr>
                      <tr>
                        <td>Username  </td>
                        <td><?php echo $row->username; ?></td>
                      </tr>                       
                      <tr>
                        <td>Nama Lengkap</td>
                        <td><?php echo $row->nama_lengkap; ?></td>
                      </tr>
                      <tr>
                        <td>No Telp</td>
                        <td><?php echo $row->no_telp; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $row->email; ?></td>
                      </tr>                       
                    </tbody>
                  </table> 
                  <br />
                  <button onclick="edit_bid(<?php echo $row->id_admin;?>)" class="btn btn-primary">Edit Profil</button>  
                                   
                </div>               
              </div>
            </div>
             <div class="panel-footer">                        
            </div>            
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
 (document).ready( function () {
      $('#dynamic-table').DataTable();
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
        url : "<?php echo site_url('profil/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
             $('[name="id_admin"]').val(data.id_admin);
            $('[name="user"]').val(data.username);
            $('[name="pass"]').val();
            $('[name="nama"]').val(data.nama_lengkap);
            $('[name="telp"]').val(data.no_telp);
			$('[name="email"]').val(data.email);
			//$('[name="gambar"]').val(data.gambar);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Profil'); // Set title to Bootstrap modal title

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
          url = "<?php echo site_url('profil/tambah')?>";
      }
      else
      {
        url = "<?php echo site_url('profil/update')?>";
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
                //alert('Error adding / update data');                
            }
        });       
    }

    function delete_bid(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('profil/delete')?>/"+id,
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
        <h4 id="myModalLabel">Form Profil</h4>
      </div>
      <div class="modal-body">
          <form action="#" id="form" class="form-horizontal" onSubmit="save()">
          <input type="hidden" value="" name="id_admin"/>
              <table class="table table-form">
             	<tr><label for="user"><td style="width: 25%">Username</td></label>
                <td style="width: 35%"><input type="text" id="user" name="user" class="form-control" data-validation="length" data-validation-length="min4"></td></tr>
                <tr><label for="pass"><td style="width: 25%">Password</td></label>
                <td style="width: 35%"><input type="password" id="pass" name="pass" placeholder="kosongkan Jika tidak diganti" class="form-control"></td></tr>
                <tr><label for="nama"><td style="width: 25%">Nama Lengkap</td></label>
                <td style="width: 35%"><input type="text" id="nama" name="nama" class="form-control" ></td></tr>
                <tr><label for="telp"><td style="width: 25%">No Telpon</td></label>
                <td style="width: 35%"><input type="number" id="telp" name="telp" class="form-control" data-validation="length" data-validation-length="max12"></td></tr>
                <tr><label for="email"><td style="width: 25%">Email</td></label>
                <td style="width: 35%"><input type="email" id="email" name="email" class="form-control" data-validation="email" ></td></tr>
      		</table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button id="btnSave"  class="btn btn-primary">Save Changes</button>        
      </div>
        </form>
    </div>
  </div>
</div>	
 
     


 
     