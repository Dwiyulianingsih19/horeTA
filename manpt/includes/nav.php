<aside class="left-sidebar" data-sidebarbg="skin6">
	<div class="scroll-sidebar">
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
						<i class="fas fa-clock fa-fw" aria-hidden="true"></i>
						<span class="hide-menu">Dashboard</span>
					</a>
				</li>
				<?php if($_SESSION['level'] == "1"){ ?>
				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link <?php if((basename($_SERVER['PHP_SELF']) == "edituser.php") OR (basename($_SERVER['PHP_SELF']) == "tambahuser.php")) echo "active" ?>" href="manageuser.php" aria-expanded="false">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span class="hide-menu">Manage User</span>
					</a>
				</li>
				<?php } ?>
				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link <?php if(basename($_SERVER['PHP_SELF']) == "ubahpassword.php") echo "active" ?>" href="user.php" aria-expanded="false">
						<i class="fa fa-user" aria-hidden="true"></i>
						<span class="hide-menu">Profil</span>
					</a>
				</li>
				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="proyek.php" aria-expanded="false">
						<i class="fas fa-database" aria-hidden="true"></i>
						<span class="hide-menu">Proyek</span>
					</a>
				</li>
				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false">
						<i class="fas fa-user-times" aria-hidden="true"></i>
						<span class="hide-menu">Logout</span>
					</a>
				</li>

				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="vendor.php" aria-expanded="false">
						<i class="fas fa-users" aria-hidden="true"></i>
						<span class="hide-menu">Vendor</span>
					</a>
				</li>

				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="pemilik_proyek.php" aria-expanded="false">
						<i class="fas fa-users" aria-hidden="true"></i>
						<span class="hide-menu">Pemilik Proyek</span>
					</a>
				</li>

				<li class="sidebar-item"> 
					<a class="sidebar-link waves-effect waves-dark sidebar-link" href="data_proyek.php" aria-expanded="false">
						<i class="fas fa-users" aria-hidden="true"></i>
						<span class="hide-menu">Critical Path</span>
					</a>
				</li>

			</ul>
		</nav>
	</div>
</aside>