
 			<div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome.... &nbsp;<?php echo $this->session->userdata("nama_lengkap") ?></strong>&nbsp; Selamat Datang di Aplikasi Keuangan SMP Negeri 1 CIKANDE
                        </div>                       
                    </div>
                  </div>
            <div class="row" style="margin-left: 5px;margin-right: 5px">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-blue panel-widget ">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="glyphicon glyphicon-folder-open fa-3x"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $masuk; ?></div>
                                <div class="text-muted">Transaksi Masuk</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-orange panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="glyphicon glyphicon-folder-close fa-3x"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $keluar; ?></div>
                                <div class="text-muted">Transaksi Keluar</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="glyphicon glyphicon-user fa-3x"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $guru; ?></div>
                                <div class="text-muted">Data Guru</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-red panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="glyphicon glyphicon-user fa-3x"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $admin; ?></div>
                                <div class="text-muted">Data Admin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
            <div class="row">
                    <div class="col-lg-10 col-md-10">
                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Selamat Datang di Halaman Dashboard Administrator
                            </div>
                            <div class="panel-body">
                                <p>Selamat Datang di Aplikasi Pengelolaan Keuangan di SMP Negeri.<br />
                                    Aplikasi ini dibuat untuk memenuhi kebutuhan data keuangan yang ada di sekolah ini, baik itu pemasukannya ataupun pengeluarannya.</p>
                            </div>
                            <div class="panel-footer">
                                <?php echo date('d-m-Y') ?>
                            </div>
                        </div>
                    </div>
                </div>        
                
