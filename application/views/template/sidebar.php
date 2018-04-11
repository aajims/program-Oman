<div class="nav-side-menu">
    <div class="brand">Brand Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <?php
                $sess_level = $this->session->userdata('level');
                if ($sess_level == "admin") { ?>
				<li>
                  <a href="<?php echo site_url(); ?>/Dashboard">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>
                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-gift fa-lg"></i> Master <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="<?php echo site_url(); ?>/admin"><i class="fa fa-circle-o"></i>Data User</a></li>
			        <li><a href="<?php echo site_url(); ?>/profil"><i class="fa fa-circle-o"></i>Data Profil</a></li>
			        <li><a href="<?php echo site_url(); ?>/guru"><i class="fa fa-circle-o"></i>Data Guru</a></li>
                    <li><a href="<?php echo site_url(); ?>/Bank"><i class="fa fa-circle-o"></i>Data Bank</a></li>
                </ul>	
                 <li><a href="<?php echo site_url(); ?>/kas"><i class="fa fa-desktop"></i> Data Kas </a>
                  </li> 			
				<li><a href="<?php echo site_url(); ?>/masuk"><i class="fa fa-th"></i> Data Kas Masuk </a>
                  </li>
                  <li><a href="<?php echo site_url(); ?>/keluar"><i class="fa fa-archive"></i> Data Kas Keluar</a>
                  </li>
                  <li  data-toggle="collapse" data-target="#laporan" class="collapsed active">
                  	<a><i class="fa fa-bar-chart-o"></i> Data Laporan <span class="arrow"></span></a> </li>
                    <ul class="sub_menu collapse" id="laporan">
                     <li><a href="<?php echo site_url(); ?>/masuk/laporan"><i class="fa fa-circle-o"></i>Laporan Kas Masuk</a></li>
                     <li><a href="<?php echo site_url(); ?>/masuk/lapor"><i class="fa fa-circle-o"></i>Laporan Rek Masuk</a></li>
                     <li><a href="<?php echo site_url(); ?>/keluar/laporan"><i class="fa fa-circle-o"></i>Laporan Kas Keluar</a></li>
                     <li><a href="<?php echo site_url(); ?>/keluar/lapor"><i class="fa fa-circle-o"></i>Laporan Rek Keluar</a></li>
                    </ul>
                <?php } else if ($sess_level == "pemasukan") { ?>
                <li>
                    <a href="<?php echo site_url(); ?>/Dashboard">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a>
                </li>
                <li><a href="<?php echo site_url(); ?>/profil"><i class="fa fa-user"></i>Data Profil</a></li>
                <li><a href="<?php echo site_url(); ?>/guru"><i class="fa fa-user"></i>Data Guru</a></li>
                <li><a href="<?php echo site_url(); ?>/kas/view"><i class="fa fa-desktop"></i> Data Kas </a>
                </li>
                <li><a href="<?php echo site_url(); ?>/masuk"><i class="fa fa-th"></i> Data Kas Masuk </a>
                </li>
                <li  data-toggle="collapse" data-target="#laporan" class="collapsed active">
                    <a><i class="fa fa-bar-chart-o"></i> Data Laporan <span class="arrow"></span></a> </li>
                <ul class="sub_menu collapse" id="laporan">
                    <li><a href="<?php echo site_url(); ?>/masuk/laporan"><i class="fa fa-circle-o"></i>Laporan Kas Masuk</a></li>
                </ul>
                <?php } else if ($sess_level == "pengeluaran") { ?>
                    <li>
                        <a href="<?php echo site_url(); ?>/Dashboard">
                            <i class="fa fa-dashboard fa-lg"></i> Dashboard
                        </a>
                    </li>
                    <li><a href="<?php echo site_url(); ?>/profil"><i class="fa fa-user-circle"></i>Data Profil</a></li>
                    <li><a href="<?php echo site_url(); ?>/kas/view"><i class="fa fa-desktop"></i> Data Kas </a>
                    </li>
                    <li><a href="<?php echo site_url(); ?>/keluar"><i class="fa fa-th"></i> Data Kas Keluar </a>
                    </li>
                    <li  data-toggle="collapse" data-target="#laporan" class="collapsed active">
                        <a><i class="fa fa-bar-chart-o"></i> Data Laporan <span class="arrow"></span></a> </li>
                    <ul class="sub_menu collapse" id="laporan">
                        <li><a href="<?php echo site_url(); ?>/keluar/laporan"><i class="fa fa-circle-o"></i>Laporan Kas Keluar</a></li>
                    </ul>
                    <?php ;} ?>
                <li><a href="<?php echo site_url(); ?>/Auth/logout"><i class="fa fa-sign-out"></i> Logout </a>
            </ul>
     </div>
</div>
