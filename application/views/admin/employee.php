<main>
    <h1>Employee</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
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
    <div class="modal fade" tabindex="-1" id="addEmployeeModal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Employee - Step 1</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label for="id_product" class="form-label">Produk</label>
                            <select class="form-select" name="id_product" required>
                                <option selected>Pilih Produk</option>
                                <?php foreach($products_show as $product): ?>
                                <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_in" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="date_in" required />
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="number" class="form-control" name="nip" required />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required />
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pob" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="place_of_birth" required />
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="date_of_birth" required />
                        </div>
                    </div>
                <div class="modal-footer">
                        <button type="reset"  class="btn btn-warning">Clear</button>
                    </form>
                
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    
                    <button type="button" class="btn btn-primary" id="nextToAddSalary">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Salary -->
    <div class="modal fade" tabindex="-1" id="addSalary" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Employee - Step 2</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <form id="formAddSalary">
                        <div class="mb-3">
                            <label for="id_division" class="form-label">Divisi</label>
                            <select class="form-select" name="id_division" required>
                                <option value="" selected>Pilih Divisi</option>
                                <?php foreach($division as $divisi): ?>
                                <option value="<?= $divisi['id_division'] ?>"><?= $divisi['name_division'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi</label>
                            <select class="form-select" name="id_position" required>
                                <option value="" selected>Pilih Posisi</option>
                                <?php foreach($position as $posisi): ?>
                                <option value="<?= $posisi['id_position'] ?>"><?= $posisi['name_position'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Gaji</label>
                            <input type="number" class="form-control" name="basic_salary" required />
                        </div>
                        <div class="mb-3">
                            <label for="uang_makan" class="form-label">Uang Makan</label>
                            <input type="number" class="form-control" name="uang_makan" required />
                        </div>
                        <div class="mb-3">
                            <label for="bonus" class="form-label">Bonus</label>
                            <input type="number" value="0" class="form-control" name="bonus" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="backToAddProduct">Back</button>
                    <button type="button" class="btn btn-success" id="submitEmployee">Add Employee</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit Employee-->
    <div class="modal fade" tabindex="-1" id="editProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Employee Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <form id="formEditProduct" enctype="multipart/form-data">
                        <input type="hidden" name="id_employee" id="edit_employee_id">
                        <div class="mb-3">
                            <label for="edit_product" class="form-label">Product</label>
                            <select class="form-select" name="id_product" id="edit_product">
                                <option value="">Select Product</option>
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_date_in" class="form-label">Date In</label>
                            <input type="date" name="date_in" id="edit_date_in" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_nip" class="form-label">NIP</label>
                            <input type="number" name="nip" id="edit_nip" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="gender" id="edit_gender" required>
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_pob" class="form-label">Tempat Lahir</label>
                            <input type="text" name="place_of_birth" id="edit_pob" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_dob" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="date_of_birth" id="edit_dob" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="nextToEditSalary" class="btn btn-primary w-100">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
     <!-- Modal Edit Salary-->
    <div class="modal fade" tabindex="-1" id="editSalary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Employee Salary</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-minus"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <form id="formEditSalary">
                        <input type="hidden" name="tesr" id="edit_employee_id_salary">
                        <div class="mb-3">
                            <label for="edit_divisi" class="form-label">Division</label>
                            <select class="form-select" name="id_division" id="edit_division" required>
                                <option value="" selected>Pilih Divisi</option>
                                <?php foreach($division as $divisi): ?>
                                <option value="<?= $divisi['id_division'] ?>"><?= $divisi['name_division'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_position" class="form-label">Position</label>
                            <select class="form-select" name="id_position" id="edit_position" required>
                                <option value="" selected>Pilih Posisi</option>
                                <?php foreach($position as $posisi): ?>
                                <option value="<?= $posisi['id_position'] ?>"><?= $posisi['name_position'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_salary" class="form-label">Basic Salary</label>
                            <input type="number" name="basic_salary" id="edit_salary" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_salary" class="form-label">Uang Makan</label>
                            <input type="number" name="uang_makan" id="edit_uang_makan" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="edit_salary" class="form-label">Bonus</label>
                            <input type="number" name="bonus" id="edit_bonus" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="backToEditProduct" class="btn btn-secondary">Back</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="submitEditEmployee" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <div class="mb-5">
                                    <label for="form_text1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name_contact" placeholder="Name contact" name="name_contact" required>
                                </div>
                                <div class="mb-5">
                                    <label for="form_text2" class="form-label">No.Hp</label>
                                    <input type="number" class="form-control" id="number_contact" placeholder="08122xxxx" name="number_contact" required>
                                </div>
                                <div class="mb-5">
                                    <label for="form_text2" class="form-label">Hubungan</label>
                                    <div class="fv-row">
                                        <select class="form-select" aria-label="Default select example"  name="as_contact">
                                            <option selected>-Pilih hubungan-</option>
                                            <option value="0">Keluarga</option>
                                            <option value="1">Teman</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-5">
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
                responsive:{
                    details: {
                        type: 'column',
                        target: 'tr',
                    }
                },
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
                    { targets: [1, 2, 3, 4], responsivePriority: 1 }, 
                    { targets: -1, responsivePriority: 2 }, 
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
                title: 'Apakah Anda yakin?',
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
                        
                        bankList.append(`<li class="list-group-item text-danger">Belum mempunyai daftar bank</li>`);
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
        
        //ADD EMPLOYEE 
        $(document).ready(function () 
        {
 
            $('#nextToAddSalary').on('click', function () {
                if ($('#addEmployeeForm')[0].checkValidity()) {
                    $('#addEmployeeModal').modal('hide');
                    $('#addSalary').modal('show');
                } else {
                    $('#addEmployeeForm')[0].reportValidity();
                }
            });

            $('#backToAddProduct').on('click', function () {
                $('#addSalary').modal('hide');
                $('#addEmployeeModal').modal('show');
            });

            $('#submitEmployee').on('click', function () {
                const productData = $('#addEmployeeForm').serializeArray();
                const salaryData = $('#formAddSalary').serializeArray();
                const formData = {};

                productData.concat(salaryData).forEach(field => {
                    formData[field.name] = field.value;
                });

                if ($('#formAddSalary')[0].checkValidity()) {
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Pastikan data yang dimasukan sudah benar",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
   
                            $.ajax({
                                url: '<?= site_url("admin/employee/add_employees") ?>',
                                type: 'POST',
                                data: formData,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status) {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Karyawan berhasil ditambahkan.',
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false,
                                        }).then(() => {
                                            $('#addSalary').modal('hide');
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: response.message || 'Gagal menambah karyawan.',
                                            icon: 'error',
                                        });
                                    }
                                },
                                error: function () {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while adding the employee.',
                                        icon: 'error',
                                    });
                                }
                            });
                        }
                    });
                } else {
                    $('#formAddSalary')[0].reportValidity();
                }
            });
        });


         // ------------EDIT FINANCE
         function editEmployeeBtn(element) 
        {
            const id = $(element).data('edit_id');
            const product = $(element).data('edit_product');
            const dateIn = $(element).data('edit_date_in');
            const nip = $(element).data('edit_nip');
            const name = $(element).data('edit_name');
            const gender = $(element).data('edit_gender');
            const placeOfBirth = $(element).data('edit_pob');
            const dateOfBirth = $(element).data('edit_dob');
            const division = $(element).data('edit_division');
            const basicSalary = $(element).data('edit_basic_salary');
            const uangMakan = $(element).data('edit_uang_makan');
            const bonus = $(element).data('edit_bonus');
            const position = $(element).data('edit_position');

            $('#edit_employee_id').val(id);
            $('#edit_product').val(product);
            $('#edit_date_in').val(dateIn);
            $('#edit_nip').val(nip);
            $('#edit_name').val(name);
            $('#edit_gender').val(gender);
            $('#edit_pob').val(placeOfBirth);
            $('#edit_dob').val(dateOfBirth);
            $('#edit_division').val(division);
            $('#edit_salary').val(basicSalary);
            $('#edit_uang_makan').val(uangMakan);
            $('#edit_bonus').val(bonus);
            $('#edit_position').val(position);

            $('#editProduct').modal('show');
        }

        
        $(document).ready(function () 
        {

            $('#nextToEditSalary').on('click', function () {
                if ($('#formEditProduct')[0].checkValidity()) {
                    $('#editProduct').modal('hide');
                    $('#editSalary').modal('show');
                } else {
                    $('#formEditProduct')[0].reportValidity();
                }
            });

            $('#backToEditProduct').on('click', function () {
                $('#editSalary').modal('hide');
                $('#editProduct').modal('show');
            });

            $('#submitEditEmployee').on('click', function () {
                const productValid = $('#formEditProduct')[0].checkValidity();
                const salaryValid = $('#formEditSalary')[0].checkValidity();

                if (productValid && salaryValid) {
                    const productData = $('#formEditProduct').serializeArray();
                    const salaryData = $('#formEditSalary').serializeArray();
                    const formData = {};

                    productData.concat(salaryData).forEach(field => {
                        formData[field.name] = field.value;
                    });

                    Swal.fire({
                        title: 'Apa kamu yakin?',
                        text: "Pastikan data yang dimasukan sudah benar",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= site_url("admin/employee/update") ?>',
                                type: 'POST',
                                data: formData,
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status) {
                                        Swal.fire('Success', 'Data karyawan berhasil diperbarui.', 'success')
                                            .then(() => location.reload());
                                    } else {
                                        Swal.fire('Error', response.message || 'Gagal memperbarui data karyawan', 'error');
                                    }
                                },
                                error: function (xhr) {
                                    Swal.fire('Error', xhr.responseJSON?.message || 'An error occurred.', 'error');
                                }
                            });
                        }
                    });
                } else {
                    $('#formEditProduct')[0].reportValidity();
                    $('#formEditSalary')[0].reportValidity();
                }
            });

        });

        



	</script>
</main>