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
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                          
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                       <tr>
                          <td><strong>Edit Data Pengguna</stong></td>
                        <td><input type="hidden" name="id" value="<?php echo $row->id_admin; ?>"> </td>
                      </tr>
                      <tr>
                        <td>Username  </td>
                        <td><input name="user" type="text" value="<?php echo $row->username; ?>"/></td>
                      </tr>
                      <tr>
                        <td>Nama Lengkap</td>
                        <td><input name="nama" type="text" value="<?php echo $row->nm_lengkap; ?>"/></td>
                      </tr>
                      <tr>
                        <td>No Telp</td>
                        <td><input name="telp" type="number" value="<?php echo $row->no_telp; ?>"/></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><input name="email" type="email" value="<?php echo $row->email; ?>"/></td>
                      </tr>  
                    </tbody>
                  </table> 
                  <br />
                   <a href="<?php echo site_url('master/edit/'.$row->id_admin);?>" class="btn btn-primary">Update</a>                  
                </div>               
              </div>
            </div>
                 <div class="panel-footer">
                        
                        
                    </div>
            
          </div>
        </div>
      </div>
    </div>


 
     