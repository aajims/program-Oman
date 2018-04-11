    <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

            <div class="x_content">
                <p class="text-muted font-13 m-b-30">
                <div >
                    <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Add Admin</button>
                </div>
                </p>
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No </th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach($admin as $row){ ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $row->username;?></td>
                            <td><?php echo $row->nama_lengkap;?></td>
                            <td><?php echo $row->no_telp;?></td>
                            <td><?php echo $row->email;?></td>
                            <td><?php echo $row->level; ?></td>
                            <td class="center">
                                <a class="btn btn-primary" onclick="edit_bid(<?php echo $row->id_admin;?>)">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a class="btn btn-danger" onclick="delete_bid(<?php echo $row->id_admin;?>)">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
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
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        $('#DataTable').DataTable(); } );

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
            url : "<?php echo site_url('admin/edit/')?>/" + id,
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
                $('[name="level"]').val(data.level);
                //$('[name="bag"]').val(data.id_bagian);

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Admin'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('admin/tambah')?>";
        }
        else
        {
            url = "<?php echo site_url('admin/update')?>";
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
                url : "<?php echo site_url('admin/delete')?>/"+id,
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
                <h3 class="modal-title">Form Admin</h3>
            </div>
            <div class="modal-body form">
                <form id="form" action="#" class="form-horizontal">
                    <input type="hidden" value="" name="id_admin" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input type="text" id="user" name="user" placeholder="Input Username" class="form-control" data-validation="length" data-validation-length="4-12" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" id="pass" name="pass" placeholder="Input Password" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Lengkap</label>
                            <div class="col-md-9">
                                <input type="text" id="nama" name="nama" placeholder="Input Nama Lengkap" class="form-control" data-validation="required" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Telepon</label>
                            <div class="col-md-9">
                                <input type="number" id="telp" name="telp" placeholder="Input dengan angka" class="form-control" data-validation="length" data-validation-length="10-12">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" placeholder="Input Email Valid" class="form-control" data-validation="email"  >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Level</label>
                            <div class="col-md-9">
                                <select name="level" class="form-control" >
                                    <option value="">-- Pilih Level --</option>
                                    <option value="admin">Admin</option>
                                    <option value="pemasukan">Pemasukan</option>
                                    <option value="pengeluaran">Pengeluaran</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

                