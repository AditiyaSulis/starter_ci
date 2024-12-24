<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
	<base href="">
	<meta charset="utf-8" />
	<meta name="base_url" content="<?= base_url(); ?>">
	<title><?= $title?> - LPKS Borneo Flasher</title>
	<meta name="description" content="LPKS Borneo Flasher" />
	<meta name="keywords" content="LPKS Borneo Flasher" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
	<link rel="shortcut icon" href="<?= base_url('/asset/media/logos/Logo.png')?>" />
	<link href="<?=base_url('asset/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('asset/css/style.bundle.css')?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('asset/css/style-custom.css')?>" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap4.css" />
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
	<script src=" https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap4.js"></script>



</head>

<body id="kt_body"
	class=" d-flex flex-column min-vh-100 header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed"
	style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	
	<script>
		var defaultThemeMode = "light";
		var themeMode;

		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}

			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
				data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
				data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
				data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<div class="aside-logo flex-column-auto" id="kt_aside_logo">
					<a href="<?= base_url('admin/dashboard/dashboard_page')?>">
						<img alt="Logo" src="<?= base_url('asset/media/logos/Logo.png')?>" class="h-15px logo" />
					</a>
					<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
						data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
						data-kt-toggle-name="aside-minimize">
						<span class="svg-icon svg-icon-1 rotate-180">
							<i class="ti ti-chevrons-right"></i>
						</span>
					</div>
				</div>
				<div class="aside-menu flex-column-fluid">
					<div class=" scroll-y my-5  mx-3" id="kt_aside_menu_wrapper" data-kt-scroll="true"
						data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
						data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
						data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
						<div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item">
								<a class="menu-link active" href="<?=base_url('admin/dashboard/dashboard_page')?>">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
											<i class="ti ti-layout-dashboard"></i>
										</span>
									</span>
									<span class="menu-title">Dashboard</span>
								</a>
							</div>
						</div>
						<div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item">
								<a class="menu-link active" href="<?=base_url('admin/product/product_page')?>">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
											<i class="ti ti-package"></i>
										</span>
									</span>
									<span class="menu-title">Product</span>
								</a>
							</div>
						</div>
						<div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item">
								<a class="menu-link active" href="<?=base_url('admin/account_code/ac_page')?>">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
											<i class="ti ti-filter"></i>
										</span>
									</span>
									<span class="menu-title">Account Code & Category</span>
								</a>
							</div>
						</div>
						<div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item">
								<a class="menu-link active" href="<?=base_url('admin/employee/employee_page')?>">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
											<i class="ti ti-id-badge"></i>
										</span>
									</span>
									<span class="menu-title">Employee</span>
								</a>
							</div>
						</div>
						<div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item">
								<a class="menu-link active" href="<?=base_url('admin/finance_record/finance_record_page')?>">
									<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
											<i class="ti ti-receipt"></i>
										</span>
									</span>
									<span class="menu-title">Finance Record</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid">
				<div class="header align-items-stretch">
					<div class="container-fluid d-flex align-items-stretch justify-content-between">
						<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
							<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
								id="kt_aside_mobile_toggle">
								<span class="svg-icon svg-icon-2x mt-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none">
										<path
											d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
											fill="black" />
										<path opacity="0.3"
											d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
											fill="black" />
									</svg>
								</span>
							</div>
						</div>
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
							<a href="index.html" class="d-lg-none">
								<img alt="Logo" src="<?= base_url('asset/media/logos/Logo.png') ?>" class="h-15px" />
							</a>
						</div>
						<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
							<div class="d-flex align-items-center" id="kt_header_nav">
								<div data-kt-swapper="true" data-kt-swapper-mode="prepend"
									data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}"
									class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
										<li class="breadcrumb-item text-muted">
											<a href="dashboard.html" class="text-muted text-hover-primary">Home</a>
										</li>
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-200 w-5px h-2px"></span>
										</li>
										<li class="breadcrumb-item text-muted"><?=$breadcrumb?></li>
									</ul>
								</div>
							</div>
							<div class="d-flex align-items-stretch flex-shrink-0">
								<div class="d-flex align-items-center ms-1 ms-lg-3">
									<a href="#"
										class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px"
										data-kt-menu-trigger="{default:'click', lg: 'hover'}"
										data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
										<span class="svg-icon svg-icon-1">
											<i class="ti ti-moon-stars theme-light-show"></i>
											<i class="ti ti-moon-filled theme-dark-show"></i>
										</span>
									</a>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
										data-kt-menu="true" data-kt-element="theme-mode-menu">
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode"
												data-kt-value="light">
												<span class="menu-icon" data-kt-element="icon">
													<span class="svg-icon svg-icon-1">
														<i class="ti ti-moon-stars "></i>
													</span>
												</span>
												<span class="menu-title">
													Light
												</span>
											</a>
										</div>
										<div class="menu-item px-3 my-0">
											<a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
												data-kt-value="dark">
												<span class="menu-icon" data-kt-element="icon">
													<span class="svg-icon svg-icon-1">
														<i class="ti ti-moon-filled"></i>
													</span>
												</span>
												<span class="menu-title">
													Dark
												</span>
											</a>
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center ms-1 ms-lg-3">
									<div class="cursor-pointer symbol symbol-30px symbol-md-40px"
										data-kt-menu-trigger="click" data-kt-menu-attach="parent"
										data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
										<img src="<?= base_url('asset/media/avatars/150-2.jpg')?>" />
									</div>
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
										data-kt-menu="true">
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="<?= base_url('asset/media/avatars/150-2.jpg')?>" />
												</div>
												<div class="d-flex flex-column">
													<div class="fw-bolder d-flex align-items-center fs-5 text-muted">
														<?= $user['name'] ?>
													</div>
													<span
														class="fw-bold text-muted text-hover-primary fs-7"><?= $user['email'] ?></span>
												</div>
											</div>
										</div>
										<div class="separator my-2"></div>
										<div class="menu-item px-5">
											<a href="#" class="menu-link d-flex align-items-center  px-2">
												<span class="menu-icon">
													<i class="ti ti-user-circle"></i>
												</span>
												Profil</a>
										</div>
										<div class="menu-item  px-5">
											<a href="<?= base_url('auth/logout') ?>" class="menu-link d-flex align-items-center  px-2">
												<span class="menu-icon">
													<i class="ti ti-outbound"></i>
												</span>
												Keluar</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class=" d-flex flex-column-fluid">
						<div class="container-fluid" id="kt_content_container">

                        	<?php $this->load->view($view_name); ?>

						</div>
				</div>
			</div>
			<footer class=" mt-auto ">
							<div class="footer py-4 d-flex flex-lg-column">
								<div
									class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-end">
									<div class="text-dark order-2 order-md-1">
										<span class="text-muted fw-bold me-1">2024 ©</span>
										<a href="" target="_blank" class="text-gray-800 text-hover-primary">test</a>
									</div>
								</div>
							</div>
			</footer>
		</div>
	</div>


   


	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?=base_url('asset/plugins/global/theme-mode.js')?>"></script>
	<script src="<?=base_url('asset/plugins/global/plugins.bundle.js')?>"></script>
	<script src="<?=base_url('asset/js/scripts.bundle.js')?>"></script>
	<script src="<?=base_url('asset/js/product.js')?>"></script>
	
</body>


</html>