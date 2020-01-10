	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse" id="bs-navbar-collapse"> 
				<ul class="nav navbar-nav navbar-right">
					<li><?php echo anchor('','Home') ?></li>
					<?php if($this->session->userdata('username') == 'admin') { ?>
					<li><?php echo anchor('apoteker/input','Data Apoteker'); } ?></li>
					<li><?php echo anchor('','Data Obat') ?></li>
					<li><?php echo anchor('','Data Transaksi') ?></li>
					<li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('nama'); ?> <b class="caret"></b></a>
	                    <ul class="dropdown-menu">
	                        <li>
	                            <a href="#">Profile</a>
	                        </li>	                        
	                        <li class="divider"></li>
	                        <li>
	                            <?php echo anchor("login/logout","Logout") ?>
	                        </li>
	                    </ul>
	                </li>
				</ul>				
			</div>

		</div>		
	</div>
	