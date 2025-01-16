<main>
    <h1>Employee</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="ti ti-plus"></i>
        Add Employee
    </button>

    <div class="row g-3 align-items-center mt-4">
        <div class="col-12 col-md-auto">
            <label class="form-label">Product:</label>
            <select id="filter-product" class="form-select form-select-sm">
                <option value="All" selected>All</option>
                <?php foreach($products as $product):?>
                    <option value="<?= $product['id_product']?>"><?= $product['name_product']?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="mt-6">
        <table id="employees_table" class="table table-bordered table-striped border-primary" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Date In</th>
                    <th>NIP</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Divisi</th>
                    <th>Posisi</th>
                    <th>Gaji</th>
                    <th>Uang Makan</th>
                    <th>Bonus</th>
                    <th>Bank</th>
                    <th>EC</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Employee</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/employee/add_employees') ?>" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <span>Produk</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="id_product">
                                        <option selected>Pilih Produk</option>
                                        <?php foreach($products_show as $product): ?>
                                        <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Tanggal Masuk</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="date" placeholder="Tanggal masuk" name="date_in" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>NIP</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="NIP" name="nip" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Name</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Jenis Kelamin</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="gender">
                                        <option selected>Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Tempat Lahir</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="Tempat Lahir" name="place_of_birth" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Tanggal Lahir</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="date" placeholder="Tanggal Lahir" name="date_of_birth" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                </div>
                             
                                
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Next
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

     <!-- Modal Add Salary -->
    <div class="modal fade" tabindex="-1" id="addSalary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Employee</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/employee/add_employees') ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Divisi</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="Divisi" name="divisi" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Posisi</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="Position" name="position" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Gaji</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Rp.1xxxx" name="basic_salary" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Uang Makan</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Uang makan" name="uang_makan" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Bonus</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Bonus" name="bonus" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Employee
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

                            <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Divisi</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="Divisi" name="divisi" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Posisi</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="Position" name="position" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                         <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Gaji</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Rp.1xxxx" name="basic_salary" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Uang Makan</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Uang makan" name="uang_makan" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                            <span>Bonus</span>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="number" placeholder="Bonus" name="bonus" autocomplete="off" class="form-control bg-transparent"/> 
                                        </div>
                                    </div>
                            </div> -->


    <!-- Modal Edit -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Employee</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>

                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editEmployeeForm" enctype="multipart/form-data">
                                    <input type="hidden" name="id_employee" id="id_employee">
                                    <div class="mb-5">
                                        <label for="id_product" class="form-label">Produk</label>
                                        <select name="id_product" id="product" class="form-select">
                                            <?php foreach ($products as $product): ?>
                                                <option value="<?= $product['id_product']; ?>"><?= $product['name_product']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="date_in" class="form-label">Tanggal Masuk</label>
                                                <input type="date" name="date_in" id="date_in" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="nip" class="form-label">NIP</label>
                                                <input type="number" name="nip" id="nip" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-5">
                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                                <input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="position" class="form-label">Divisi</label>
                                                <input type="text" name="divisi" id="divisi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <label for="position" class="form-label">Posisi</label>
                                                <input type="text" name="position" id="position" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <span>Gaji</span>
                                            </div>
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <input type="number" placeholder="Rp.1xxxx" id="basic_salary" name="basic_salary" autocomplete="off" class="form-control bg-transparent"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <span>Uang Makan</span>
                                            </div>
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <input type="number" placeholder="Uang makan" id="uang_makan" name="uang_makan" autocomplete="off" class="form-control bg-transparent"/> 
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <span>Bonus</span>
                                            </div>
                                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                                <input type="number" placeholder="Bonus" name="bonus" id="bonus" autocomplete="off" class="form-control bg-transparent"/> 
                                            </div>
                                        </div>
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

     <!-- Modal Bank-->
    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bank Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <form id="bankForm">
                                <input type="hidden" id="edit_id" name="id_employee">
                                <div class="mb-3">
                                    <label for="form_text1" class="form-label">Nama Bank</label>
                                    <input type="text" class="form-control" id="bank_name" placeholder="Bank Name" name="bank_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">No.Rek</label>
                                    <input type="number" class="form-control" id="bank_number" placeholder="Bank Number" name="bank_number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">Atas Nama</label>
                                    <input type="text" class="form-control" id="bank_holder_name" placeholder="Holder Name" name="bank_holder_name" required>
                                </div>
                                <div class="d-grid mb-10 mt-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Add Bank
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6 col-sm">
                            <div class="card p-4 shadow">
                                <div class="mb-3">
                                    <h6>Daftar Bank :</h6>
                                    <ul id="bank_list" class="list-group">
     
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Emergency Contact-->
    <div class="modal fade" id="ecModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ecLabel">Emergency Contact Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <form id="ecForm">
                                <input type="hidden" id="edit_id_contact" name="id_employee">
                                <div class="mb-3">
                                    <label for="form_text1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name_contact" placeholder="Name contact" name="name_contact" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">No.Hp</label>
                                    <input type="number" class="form-control" id="number_contact" placeholder="08122xxxx" name="number_contact" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">Hubungan</label>
                                    <div class="fv-row mb-8">
                                        <select class="form-select" aria-label="Default select example"  name="as_contact">
                                            <option selected>-Pilih hubungan-</option>
                                            <option value="0">Keluarga</option>
                                            <option value="1">Teman</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" id="address_contact" name="address_contact" required></textarea>
                                </div>
                                <div class="d-grid mb-10 mt-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Add Emergency Contact
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6 col-sm">
                            <div class="card p-4 shadow">
                                <div class="mb-3">
                                    <h6>Daftar Emergency Contact :</h6>
                                    <ul id="contact_list" class="list-group">
     
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        const base_url = $('meta[name="base_url"]').attr('content');  

        let product = 'All'; 

        function callDT() {
            var table = $('#employees_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: base_url + 'admin/employee/dtSideServer',  
                    type: 'POST',
                    data: function(d) {
                        product = $('#filter-product').val();  
                        d.product = product; 
                    }
                },
                columnDefs: [
                    { targets: "_all", orderable: false },  
                    { targets: 0, className: "text-center" }, 
                ],
            });

            $('#filter-product').change(function() {
                table.ajax.reload();  
            });
        }
        
        callDT();

        //------------DELETE EMPLOYEE
        function handleDeleteButton(id) {
            console.log(id)
            Swal.fire({
                title: 'Apakah Anda sure?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                   
                    $.ajax({
                        url: base_url + 'admin/employee/delete',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status) {
                                swallMssg_s(res.message, false, 1500)
                                    .then(() => {
                                        location.reload();
                                    });
                            } else {
                                swallMssg_e(res.message, true, 0);
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Kesalahan!',
                                'Terjadi kesalahan: Silakan coba lagi.',
                                'error'
                            );
                        },
                    });
                }
            });
        }

        // ------------EDIT FINANCE
        function editEmployeeBtn(element) {
            let $element = $(element);

            $("#id_employee").val($element.data('id'));
            $("#product").val($element.data('product')).trigger("change");
            $("#date_in").val($element.data('date_in'));
            $("#nip").val($element.data('nip'));
            $("#name").val($element.data('name'));
            $("#gender").val($element.data('gender'));
            $("#place_of_birth").val($element.data('place_of_birth'));
            $("#date_of_birth").val($element.data('date_of_birth'));
            $("#position").val($element.data('position'));
            $("#divisi").val($element.data('divisi'));
            $("#basic_salary").val($element.data('basic_salary'));
            $("#uang_makan").val($element.data('uang_makan'));
            $("#bonus").val($element.data('bonus'));
            
            

            $("#editEmployeeModal").modal("show");
        }

        //------ADD BANK 
        const exampleModal = document.getElementById('bankModal');
        exampleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id_employee');
            const bank_number = button.getAttribute('data-bank_number');
            const bank_name = button.getAttribute('data-bank_name');
            const bank_holder_name = button.getAttribute('data-bank_holder_name');

            console.log("Bank Name:", bank_number);
            console.log("Bank Number:", bank_name);
            console.log("Holder Name:", bank_holder_name);
            console.log("id:", id);

            $("#edit_id").val(id);
            $("#bank_name").val(bank_name);
            $("#bank_number").val(bank_number);
            $("#bank_holder_name").val(bank_holder_name);

            $.ajax({
                url: base_url + 'admin/employee/bank_info',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    const bankList = $('#bank_list');
                    bankList.empty();
                    if (response.banks && response.banks.length > 0) {
                        response.banks.forEach(bank => {
                            const list_name = bank.bank_name;
                            const list_number = bank.bank_number;
                            const list_holder = bank.bank_holder_name;
                            const id_bank = bank.id_bank;
                            bankList.append(`   <li class="list-group-item shadow-lg mb-3">
                                                    <div class="d-flex align-items-start justify-content-between">
                                                        <div>
                                                            <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Nama Bank :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${list_name}" disabled readonly>
                                                            </div>
                                                             <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>No.Rek:</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${list_number}" disabled readonly>
                                                            </div>
                                                             <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Atas nama :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${list_holder}" disabled readonly>
                                                            </div>
                                                        </div>
                                                        <button class="btn gradient-btn-delete btn-sm rounded-pill btn-delete-bank" data-id_bank="${id_bank}">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </li>`);
                        });
                    } else {
                        
                        bankList.append(`<li class="list-group-item text-danger">Belu mempunyai daftar account bank.</li>`);
                    }
                },
                error: function () {
                    $('#bank_list').html('<li class="list-group-item text-danger">Gagal memuat riwayat Info Bank.</li>');
                }
            });

            
            $("#bankForm").on("submit", function (e) {
                e.preventDefault();

                const submitButton = $("#bankForm button[type=submit]");
                submitButton.prop("disabled", true).text("Processing...");

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan data sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Tambah',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                

                        $.ajax({
                            url: base_url + "admin/employee/add_bank",
                            type: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (response) {
                                if (response.status) {
                                    swallMssg_s(response.message, false, 1500)
                                    .then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swallMssg_e(response.message, true, 0);
                                    submitButton.prop("disabled", false).text("Submit");
                                }
                            },
                            error: function (xhr, status, error) {
                                swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
                                .then(() => {
                                    location.reload();
                                });
                                submitButton.prop("disabled", false).text("Submit");
                            }
                        });
                    }
                });
            });



            
            
        });


        //------DELETE BANK
        $(document).on("click", ".btn-delete-bank", function () 
        {
                var id_bank = $(this).data("id_bank");
                console.log(id_bank);

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url + "admin/employee/delete_bank",
                            type: "POST",
                            data: { id_bank: id_bank },
                            dataType: "json",
                            success: function (response) {
                                if (response.status) {
                                    swallMssg_s(response.message, false, 1500).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swallMssg_e(response.message, true, 0);
                                }
                            },
                            error: function (xhr, status, error) {
                                swallMssg_e(
                                    "Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product " +
                                        error,
                                    true,
                                    0
                                ).then(() => {
                                    location.reload();
                                });
                            },
                        });
                    }
                });
        });  

        //-------ADD EMERGENCY CONTACT
        const ecModal = document.getElementById('ecModal');
        ecModal.addEventListener('show.bs.modal', function (event) {
            const button1 = event.relatedTarget;
            const id_employees = button1.getAttribute('data-id_employees');
            const name_contact = button1.getAttribute('data-name_contact');
            const number_contact = button1.getAttribute('data-number_contact');
            const as_contact = button1.getAttribute('data-as_contact');
            const address_contact = button1.getAttribute('data-address_contact');

            console.log("address:", address_contact);
            console.log("id:", id_employees);




            $("#edit_id_contact").val(id_employees);
            $("#name_contact").val(name_contact);
            $("#number_contact").val(number_contact);
            $("#as_contact").val(as_contact);
            $("#address_contact").val(address_contact);

            $.ajax({
                url: base_url + 'admin/employee/contact_info',
                method: 'POST',
                data: { id_employees: id_employees },
                dataType: 'json',
                success: function (response) {
                    const contactList = $('#contact_list');
                    contactList.empty();
                    if (response.contacts && response.contacts.length > 0) {
                        response.contacts.forEach(contact => {
                            const list_name_contact = contact.name_contact
                            const list_number_contact = contact.number_contact;
                            const list_as = contact.as_contact;
                            const list_address = contact.address_contact;
                            const id_contact = contact.id_contact;
                            let ass='';
                            if(list_as == 0) {
                                ass = 'Keluarga'
                            } else if(list_as == 1){
                                ass = 'Teman'
                            }
                            contactList.append(`<li class="list-group-item shadow-lg mb-3">
                                                    <div class="d-flex align-items-start justify-content-between">
                                                        <div>
                                                           <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Nama :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${list_name_contact}" disabled readonly>
                                                            </div>
                                                           <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>No.HP :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${list_number_contact}" disabled readonly>
                                                            </div>
                                                           <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Hubungan :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${ass}" disabled readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Alamat :</strong> </p>
                                                                <textarea type="text" class="form-control text-info" disabled readonly>${list_address}</textarea>
                                                            </div>
                                                        </div>
                                                        <button class="btn gradient-btn-delete btn-sm rounded-pill btn-delete-contact" data-id_contact="${id_contact}">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </div>
                                                </li>`);
                        });
                    } else {
                        
                        contactList.append(`<li class="list-group-item text-danger">Belum mempunyai emergency contact.</li>`);
                    }
                },
                error: function () {
                    $('#contact_list').html('<li class="list-group-item text-danger">Gagal memuat.</li>');
                }
            });

            
            $("#ecForm").on("submit", function (e) {
                e.preventDefault();

                const submitbuttom1 = $("#ecForm button[type=submit]");
                submitbuttom1.prop("disabled", true).text("Processing...");

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pastikan data sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Tambah',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                

                        $.ajax({
                            url: base_url + "admin/employee/add_contact",
                            type: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (response) {
                                if (response.status) {
                                    swallMssg_s(response.message, false, 1500)
                                    .then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swallMssg_e(response.message, true, 0);
                                    submitbuttom1.prop("disabled", false).text("Submit");
                                }
                            },
                            error: function (xhr, status, error) {
                                swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
                                .then(() => {
                                    location.reload();
                                });
                                submitbuttom1.prop("disabled", false).text("Submit");
                            }
                        });
                    }
                });
            });



            
            
        });

         //------DELETE BANK
         $(document).on("click", ".btn-delete-contact", function () 
        {
                var id_contact = $(this).data("id_contact");
                console.log(id_contact);

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: base_url + "admin/employee/delete_contact",
                            type: "POST",
                            data: { id_contact: id_contact },
                            dataType: "json",
                            success: function (response) {
                                if (response.status) {
                                    swallMssg_s(response.message, false, 1500).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swallMssg_e(response.message, true, 0);
                                }
                            },
                            error: function (xhr, status, error) {
                                swallMssg_e(
                                    "Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menghapus product " +
                                        error,
                                    true,
                                    0
                                ).then(() => {
                                    location.reload();
                                });
                            },
                        });
                    }
                });
        });  

	</script>
</main>