<div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SI Apotek</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">                       
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"></i> <?php echo $this->session->userdata('nama') ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"></i> Profile</a>
                        </li>                        
                        <li class="divider"></li>
                        <li>
                            <?php echo anchor("login/logout","Logout") ?>                            
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php if($this->session->userdata('username') == 'admin') { ?>
                    <li><?php echo anchor('apoteker/','Data Apoteker'); } ?></li>                    
                    <li><?php echo anchor('obat/','Data Obat'); ?></li>
                     <li><?php echo anchor('kadaluarsa/','Data Kadaluarsa'); ?></li>
                    <li><?php echo anchor('supplier/','Data Supplier'); ?></li>
                    <li><?php echo anchor('transaksi/','Data Transaksi'); ?></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sistem Informasi Apotek
                            <small>UNIKOM</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <?php echo anchor('kadaluarsa/', $page) ?>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> <?php echo $content ?>
                            </li>
                        </ol>
                    </div>
                </div>