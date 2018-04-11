<div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        &nbsp;&nbsp;
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>/Dashboard">Aplikasi - Keuangan SMP Negeri 1 CIKANDE </a>
                </div>

              	<div class="logout-spn">
              		<div class="dropdown"><i class="glyphicon glyphicon-user"></i>
              			<a href="#"  data-toggle="dropdown"><?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
              			<ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo site_url(); ?>/profil">Profil</a></li>
              				<li><a href="<?php echo site_url(); ?>/Auth/logout">Log Out</a></li>
              			</ul>
              		</div>
                 
                </div>
            </div>
        </div>

