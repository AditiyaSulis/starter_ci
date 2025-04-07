

<!DOCTYPE html>

<html lang="en" >

    <head>
        <title>Login</title>
        <meta charset="utf-8"/>

		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="https://keenthemes.com/metronic"/>
        <meta property="og:site_name" content="Metronic by Keenthemes" />
        <link rel="canonical" href="https://preview.keenthemes.com/metronic8/demo1/authentication/layouts/corporate/sign-in.html"/>
        <link rel="shortcut icon" href="/metronic8/demo1/assets/media/logos/favicon.ico"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                  
        <link href="<?= base_url('asset/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('asset/css/style.bundle.css')?>" rel="stylesheet" type="text/css"/>
    
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-52YZ3XGZJ6"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-52YZ3XGZJ6');
        </script>        
       
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
        <script>
            if (window.top != window.self) {
                    window.top.location.replace(window.self.location.href);
            }
        </script>
        <script>
            if (window.top != window.self) {
                 window.top.location.replace(window.self.location.href);
                }
        </script>



		<style>
			@media (max-width: 576px) {
				#loginForm {
					padding: 1rem;
				}

				.form-control {
					font-size: 1rem;
				}

				h1 {
					font-size: 1.5rem;
				}
			}
		</style>
    </head>

    <body  id="kt_body"  class="app-blank" >
            <script>
                var defaultThemeMode = "light";
                var themeMode;

                if ( document.documentElement ) {
                    if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                        themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                    } else {
                        if ( localStorage.getItem("data-bs-theme") !== null ) {
                            themeMode = localStorage.getItem("data-bs-theme");
                        } else {
                            themeMode = defaultThemeMode;
                        }			
                    }

                    if (themeMode === "system") {
                        themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                    }

                    document.documentElement.setAttribute("data-bs-theme", themeMode);
                }            
            </script>          
       
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">    
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">
       

                            <!--FORM-->
                            <form class="form w-100" novalidate="novalidate"  id="loginForm" data-action="<?= site_url('auth/login') ?>">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">
                                        Sign In
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Human Resource Information System
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success" role="alert">
                                            <?= $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('forbidden')): ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?= $this->session->flashdata('forbidden'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email" id="email" autocomplete="true" class="form-control bg-transparent"/>
                                </div>
                                <div class="fv-row mb-3">    
                                    <input type="password" placeholder="Password" name="password"  id="password" autocomplete="true" class="form-control bg-transparent"/>
                                </div>

                                <div class="d-grid mb-10 mt-8">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Sign In
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                </button>
                                </div>     
                            </form>
                        </div>
                    </div>     
                </div>
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(<?= base_url('asset/media/background/bg_blue_sea.jpg')?>)">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
                        
                            <img alt="Logo" src="<?= base_url('asset/media/logos/logo_transparent.png')?>"  width="350" height="350"/>
                        
                        <!-- <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="<?= base_url('asset/media/logos/logo_mgr.jpeg')?>" alt=""/>                  -->
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"> 
                        CV Multi Graha Radhika
                        </h1>

                        <div class="d-none d-lg-block text-white fs-base text-center">
							 Jl. Munjul Jaya Cilengkeng Purwakarta, Munjuljaya, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <script src="<?= base_url('asset/plugins/global/plugins.bundle.js')?>"></script>
            <script src="<?= base_url('asset/js/scripts.bundle.js')?>"></script>
            <script src="<?=base_url('asset/js/auth.js')?>"></script>
    </body>

</html>
