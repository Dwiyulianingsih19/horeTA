<header class="topbar" data-navbarbg="skin5">
	<nav class="navbar top-navbar navbar-expand-md navbar-dark">
		<div class="navbar-header" data-logobg="skin6">
			<a class="navbar-brand" href="index.php">
				<b class="logo-icon">
					<img src="images/pos.png" alt="homepage" />
				</b>
				<span class="logo-text">
					<img src="images/sup.png" alt="homepage" />
				</span>
			</a>
			<a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
		</div>
		<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
			<ul class="navbar-nav d-none d-md-block d-lg-none">
				<li class="nav-item">
					<a class="nav-toggler nav-link waves-effect waves-light text-white" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto d-flex align-items-center">
				<li class=" in">
					<form action="proyek.php" method="get" id="form1" role="search" class="app-search d-none d-md-block mr-3">
						<input type="text" name="cari" placeholder="Cari Proyek..." class="form-control mt-0">
						<a href="javascript:;" onclick="parentNode.submit();" class="active">
							<i class="fa fa-search"></i>
						</a>
					</form>
				</li>
				<li>
					<a class="profile-pic" href="user.php">
					<img src="images/acc.png" alt="user-img" width="36" class="img-circle"><span class="text-white font-medium"><?php echo $_SESSION['username']; ?></span></a>
				</li>
			</ul>
		</div>
	</nav>
</header>