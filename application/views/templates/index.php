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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <style>
        #exportPDF {
            background-color: #17a2b8; 
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        #exportPDF:hover {
            background-color: #138496; 
            color: white;
        }

        .smaller-input {
            font-size: 14px; 
            color: #000; 
            height: 30px; 
            padding: 5px; 
        }


        .gradient-btn {
            background: linear-gradient(to right,rgb(6, 31, 100), #2575fc);
            border: none;
            color: white;
        }

        .gradient-btn:hover {
            background: linear-gradient(to right,rgb(58, 117, 221),rgb(111, 158, 211));
        }

        .gradient-btn-edit {
            background: linear-gradient(to right,rgb(117, 92, 4), rgb(212, 170, 15));
            border: none;
            color: white;
        }

        .gradient-btn-edit:hover {
            background: linear-gradient(to right,rgb(205, 165, 64),rgb(193, 179, 49));
        }

        .gradient-btn-delete {
            background: linear-gradient(to right,rgb(97, 6, 6),rgb(244, 49, 49));
            border: none;
            color: white;
        }

        .gradient-btn-delete:hover {
            background: linear-gradient(to right,rgb(221, 58, 58),rgb(146, 21, 19));
        }

        .gradient-btn-active {
            background: linear-gradient(to right,rgb(34, 132, 38), rgb(91, 191, 80));
            border: none;
            color: white;
        }

        .gradient-btn-active:hover {
            background: linear-gradient(to right,rgb(106, 217, 114),rgb(39, 210, 99));
        }

        .gradient-btn-inactive {
            background: linear-gradient(to right,rgb(123, 34, 12), rgb(226, 93, 93));
            border: none;
            color: white;
        }

        .gradient-btn-inactive:hover {
            background: linear-gradient(to right,rgb(238, 67, 67),rgb(234, 94, 81));
        }

        .gradient-btn-kredit {
            background: linear-gradient(to right,rgb(211, 171, 26), rgb(193, 184, 61));
            border: none;
            color: white;
        }
        .gradient-btn-debit {
            background: linear-gradient(to right,rgb(21, 156, 75), rgb(60, 188, 128));
            border: none;
            color: white;
        }
        .gradient-btn-paid {
            background: linear-gradient(to right,rgb(21, 68, 156), rgb(69, 120, 192));
            border: none;
            color: white;
        }
        .gradient-btn-unpaid {
            background: linear-gradient(to right,rgb(137, 26, 26), rgb(119, 29, 29));
            border: none;
            color: white;
        }

        .scrollable-card {
            max-height: 200px;
            overflow-y: auto;
        }


        .menu-accordion {
            position: relative;
        }
        .menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        /* .menu-link:hover {
            background-color: #f1f5f9;
        } */
        .menu-sub {
            display: none;
            padding-left: 20px;
        }
        .menu-sub .menu-item {
            margin-top: 5px;
        }
        .menu-sub .menu-link {
            padding: 8px;
            border-radius: 4px;
        }
        /* .menu-sub .menu-link:hover {
            background-color: #e2e8f0;
        } */
        .menu-accordion.active .menu-sub {
            display: block;
        }
        .menu-arrow {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }
        .menu-accordion.active .menu-arrow {
            transform: rotate(90deg);
        }


        /* TEST
        .menu-link {
            display: flex;
            alignt-items: center;
            justify-content: space-between;
            padding: 500px
                } */

        /* PRINT PIUTANG */
        .yang-print {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .kop-surat {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop-surat img {
            height: 100px;
            width: auto;
        }

        .kop-surat h1 {
            font-size: 20px;
            margin: 0;
        }

        .kop-surat h2 {
            font-size: 18px;
            margin: 0;
        }

        .kop-surat p {
            font-size: 14px;
            margin: 0;
        }

        .isi-surat {
           
            line-height: 1.6;
        }

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        @media print {
            main * {
            visibility: hidden;
             } 
            .yang-print {
                margin: 0;
                padding: 0;
            }

            .kop-surat {
                margin-bottom: 30px;
            }
        }

        

    </style>


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
                                <a class="menu-link  <?= $title == 'Admin' ? "active": ""?>" href="<?=base_url('admin/dashboard/dashboard_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="ti ti-layout-dashboard"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </div>
                        </div>

                        <div  class="menu-item pt-5" >
                            <div  class="menu-content" >
                                <span class="menu-heading fw-bold text-uppercase text-gray-500 fs-7 ">EMPLOYMENT</span>
                            </div>
                        </div>
                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link <?= $title == 'Employee' ? "active": ""?>" href="<?=base_url('admin/employee/employee_page')?>">
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
                                <a class="menu-link <?= $title == 'Product' ? "active": ""?>" href="<?=base_url('admin/product/product_page')?>">
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
                                <a class="menu-link <?= $title == 'Division' || $title == 'Position' ? "active": ""?>" href="<?=base_url('admin/division/division_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="bi bi-buildings"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Division & Position</span>
                                </a>
                            </div>
                        </div>

                        <div  class="menu-item pt-5" >
                            <div  class="menu-content" >
                                <span class="menu-heading fw-bold text-uppercase  text-gray-500 fs-7 ">TRANSACTION</span>
                            </div>
                        </div>
                        
                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link <?= $title == 'Finance Record' ? "active": ""?>" 
                                    href="<?=base_url('admin/finance_record/finance_record_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="ti ti-receipt"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Finance Record</span>
                                </a>
                            </div>
                        </div>

                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item menu-accordion menu-title-gray-800" data-kt-menu-trigger="click">
                                <!-- Menu Link -->
                                <span class="menu-link <?= $menu == 'Supplier' ? "active": ""?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="ti ti-truck"></i>
                                        </span>
                                    </span>
                                    
                                    <span class="menu-title">Supplier</span>
                                    <span class="menu-arrow"></span>
                                </span>

                                <!-- Dropdown Submenu -->
                                <div class="menu-sub menu-sub-accordion">
                                    <div class="menu-item">
                                        <a href="<?=base_url('admin/supplier/data_supplier_page')?>" class="menu-link <?= $title == 'Supplier' ? "active": ""?>">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Data</span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a href="<?=base_url('admin/purchases/purchases_unpaid_page')?>" class="menu-link <?= $title == 'Purchases Unpaid' ? "active": ""?>">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Purchases</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link <?= $title == 'Piutang' ? "active": ""?>" href="<?=base_url('admin/piutang/piutang_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="bi bi-currency-exchange"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Piutang</span>
                                </a>
                            </div>
                        </div>     

                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link <?= $title == 'Account Code' ? "active": ""?>" href="<?=base_url('admin/account_code/ac_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="ti ti-filter"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Account Code</span>
                                </a>
                            </div>
                        </div>     

                        <div  class="menu-item pt-5" >
                            <div  class="menu-content" >
                                <span class="menu-heading fw-bold text-uppercase  text-gray-500 fs-7 ">SETTING</span>
                            </div>
                        </div>
                        
                        <div class="menu menu-column menu-rounded menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item">
                                <a class="menu-link <?= $title == 'Setting' ? "active": ""?>" href="<?=base_url('admin/setting/setting_page')?>">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="ti ti-settings"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Setting</span>
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
                                            <a href="<?= base_url('admin/dashboard/dashboard_page')?>"
                                                class="text-muted text-hover-primary">Home</a>
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
                                        <img src="<?= ($user['avatar']) ? base_url('uploads/avatar/'.$user['avatar']) : base_url('asset/media/avatars/150-2.jpg') ?>" />
                                    </div>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo"
                                                        src="<?= ($user['avatar']) ? base_url('uploads/avatar/'.$user['avatar']) : base_url('asset/media/avatars/150-2.jpg') ?>" />
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
                                            <a href="#" class="menu-link d-flex align-items-center  px-2" id="user"
                                            data-id="<?= $user['id']; ?>">
                                                <span class="menu-icon">
                                                    <i class="ti ti-user-circle"></i>
                                                </span>
                                                Profil</a>
                                        </div>
                                        <div class="menu-item  px-5">
                                            <a href="<?= base_url('auth/logout') ?>" 
                                                class="menu-link d-flex align-items-center px-2">
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
        <!-- Modal Edit -->
        <div class="modal fade" id="editUser" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Account</h3>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close" tabindex="-1" aria-labelledby="editUser" aria-hidden="true">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </div>
                    </div>

                    <div class="modal-body">
                        <form class="form w-100" id="editUserForm" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Avatar</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="file" placeholder="avatar" id="avatar" name="avatar" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Name</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Name" id="name" name="name" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Email</span>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" id="email" name="email"
                                    autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="d-grid mb-10 mt-10">
                                <button type="submit" class="btn btn-primary"><span class="indicator-label">
                                        Save Changes
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdowns = document.querySelectorAll('[data-kt-menu-trigger="click"]');

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function () {
                    // Toggle Active Class
                    this.classList.toggle('active');

                    // Close other dropdowns
                    dropdowns.forEach(item => {
                        if (item !== this) {
                            item.classList.remove('active');
                        }
                    });
                });
            });
        });
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="<?=base_url('asset/plugins/global/theme-mode.js')?>"></script>
    <script src="<?=base_url('asset/plugins/global/plugins.bundle.js')?>"></script>
    <!-- <script src="<?=base_url('asset/plugins/global/pluginnew.bundle.js')?>"></script> -->
    <script src="<?=base_url('asset/js/scripts.bundle.js')?>"></script>
    <script src="<?=base_url('asset/js/finance_record.js')?>"></script>
   
    <!-- <div class="yang-print" style="display:none" >
        <div class="kop-surat">
            <img src="logo-instansi.png" alt="Logo Instansi">
            <h1>SURAT PERNYATAAN KASBON</h1>
            <h1>KARYAWAN</h1>
            <p>Jl. Ipik Gandamanah No.303/15, Cisereuh, Kec Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118</p>
        </div>

        <div class="isi-surat">
            <p>Kepada Yth,</p>
            <p>HRD CV.MULTI GRAHA RADHIKA</p>
            <p>Jl. Ipik Gandamanah No.303/15,</p>
            <p> Cisereuh, Kec Purwakarta,</p>
            <p> Kabupaten Purwakarta, Jawa Barat 41118</p>
            <br>
            <p>
                Dengan hormat,<br>
                Saya yang bertandatangan di bawah ini : 
            </p>
            <div class="row">
                <div class="col-md-3">
                    <span>Nama</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="nama_employee_print"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <span>Jabatan</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="position_print"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <span>NIP</span>
                </div>
                <div class="col-md-2">
                    <span>:</span>
                </div>
                <div class="col-md-7">
                    <span id="nip_print"></span>
                </div>
            </div>
            <br>
            <p>
               Dengan ini saya mengajukan permohonan kasbon sebesar Rp.<span id="amount_piutang"></span> untuk keperluan pribadi.
            </p>
            <br>
            <br>
            <p>
                Saya memahami bahwa jumlah kasbon ini akan dipotong dari gaji saya secara bertahap sesuai dengan kesepakatan antara saya dan perusahaan.
            </p>
            <br>
            <p>
                Adapun alasan pengajuan kasbon ini adalah sebagai berikut :
            </p>
            <p>
               "<span id="description_piutang_print"></span>"
            </p>
            <br> 
            <p>
                Akan saya kembalikan pada tanggal : <span id="tgl_lunas"></span>
            </p>
        </div>

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Hormat saya, </p>
                    
                    <br><br><br>
                    <p>(<span id="name_karyawan_ttd_print">)</span></p>
                    <p>Tanggal : <span id="piutang_date"></span></p>
                </div>                              
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Mengetahui, </p>
                    
                    <br><br><br>
                    <p>Amelia Gita Rahayu</span></p>
                    <p>Admin Finance</span></p>
                </div>                              
            </div>
            <div class="col-md-3 text-center">
                <div class="ttd">
                    <p>Mengetahui, </p>
                    
                    <br><br><br>
                    <p>Ara Suhara Sudrajat</span></p>
                    <p>HRD</span></p>
                </div>                              
            </div>
            
        </div>
        
    </div> -->

</body>

    



</html>