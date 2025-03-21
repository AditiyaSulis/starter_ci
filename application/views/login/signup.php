



    <main>

       
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">    
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <div class="w-lg-500px p-10">

                                <form class="form w-100" novalidate="novalidate" id="addproduct" data-action="<?= site_url('auth/regist') ?>" enctype="multipart/form-data">
                                    <div class="text-center mb-11">
                                        <h1 class="text-gray-900 fw-bolder mb-3">
                                            Add User
                                        </h1>
<!--                                        <div class="text-gray-500 fw-semibold fs-6">-->
<!--                                            Your Social Campaigns-->
<!--                                        </div>-->
                                    </div>
                                    <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                        <span>Avatar</span>
                                    </div>
                                    <div class="fv-row mb-8">
                                        <input type="file" placeholder="avatar" name="avatar" autocomplete="off" class="form-control bg-transparent"/> 
                                    </div>
									<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
										<span>Role</span>
									</div>
									<div class="fv-row mb-8">
										<select class="form-select" aria-label="Default select example" name="role" id="role">
											<option selected>-pilih role-</option>
											<option value="1">Super User</option>
											<option value="2">Admin</option>
											<option value="4">HRD</option>
										</select>
									</div>
                                    <div class="fv-row mb-8">
                                        <input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"/> 
                                    </div>
                                    <div class="fv-row mb-8">
                                        <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent"/> 
                                    </div>
                                    <div class="fv-row mb-8" data-kt-password-meter="true">
                                        <div class="mb-1">
                                            <div class="position-relative mb-3">    
                                                <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off"/>

                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                    <i class="ki-duotone ki-eye-slash fs-2"></i>                    <i class="ki-duotone ki-eye fs-2 d-none"></i>                </span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                            </div>
                                        </div>
                                        <div class="text-muted">
                                            Use 8 or more characters with a mix of letters, numbers & symbols.
                                        </div>
                                    </div>
                                    <div class="fv-row mb-8">    
                                        <input type="password" placeholder="Repeat Password" name="confirm-password" type="password" autocomplete="off" class="form-control bg-transparent"/>
                                    </div>

                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                                 <span class="indicator-label">
                                                    Add User
                                                </span>
                                                <span class="indicator-progress">
                                                     Please wait...    
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                        </button>
                                    </div>
                                    <div class="text-gray-500 text-center fw-semibold fs-6">

                                    </div>
                            </form>
                        </div>
                    </div>     
                </div>
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(<?= base_url('asset/media/background/blue-light-bg.jpg')?>)">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
                        <a href="/metronic8/demo1/index.html" class="mb-0 mb-lg-12">
                            <img alt="Logo" src="<?= base_url('asset/media/logos/lorem-ipsum.png')?>"  width="150" height="150"/>
                        </a>     
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="<?= base_url('asset/media/misc/auth-screens.png')?>" alt=""/>                 
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"> 
                        Lorem Ipsum
                        </h1>  
                        <div class="d-none d-lg-block text-white fs-base text-center">
                            It is a long established fact that a reader will be distracted
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1"> by the readable content</a> 
                            of a page when looking at its layout. <br/> The point of using Lorem Ipsum       
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a> 
                                and their <br/>  as opposed to using 'Content here, content herem.  
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</html>
