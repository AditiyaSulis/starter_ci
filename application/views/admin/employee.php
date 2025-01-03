<main>
    <h1>Employee</h1>

    <button type="button" class="btn btn-primary rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
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
        <table id="employees_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Date In</th>
                    <th>NIP</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Place of birth</th>
                    <th>Date of birth</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $employee['name_product']; ?></td>
                    <td><?= date("d F Y", strtotime($employee['date_in'])); ?></td>
                    <td><?= $employee['nip']; ?></td>
                    <td><?= $employee['name']; ?></td>
                    <td><?= ($employee['gender']=='L') ? "Laki-laki" : "Perempuan" ?></td>
                    <td><?= $employee['place_of_birth']; ?></td>
                    <td><?= date("d F Y" , strtotime($employee['date_of_birth'])); ?></td>
                    <td><?= $employee['position']; ?></td>
                    <td>
                        <button class="btn btn-warning mb-2 btn-sm rounded-pill btn-edit-emp" 
                                data-id="<?= $employee['id_employee']; ?>"
                                data-product="<?= $employee['id_product']; ?>"
                                data-date-in="<?= date($employee['date_in']); ?>"
                                data-nip="<?= $employee['nip']; ?>"
                                data-name="<?= $employee['name']; ?>"
                                data-gender="<?= $employee['gender']; ?>"
                                data-place-of-birth="<?= $employee['place_of_birth']; ?>"
                                data-date-of-birth="<?= $employee['date_of_birth']; ?>"
                                data-position="<?= $employee['position']; ?>">
                            Edit
                        </button>
                         <button class="btn btn-danger btn-sm mb-2 rounded-pill btn-delete-emp" data-id="<?= $employee['id_employee']; ?>">
                            DELETE
                        </button>
                    </td>
                </tr>
                <?php $no++?>
                <?php endforeach; ?> -->
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
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Product</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="id_product">
                                        <option selected>Pilih Product</option>
                                        <?php foreach($products as $product): ?>
                                        <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tanggal Masuk</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="date" placeholder="Tanggal masuk" name="date_in" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>NIP</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" placeholder="NIP" name="nip" autocomplete="off" class="form-control bg-transparent"/> 
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
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tempat Lahir</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Tempat Lahir" name="place_of_birth" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tanggal Lahir</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="date" placeholder="Tanggal Lahir" name="date_of_birth" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Position</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Position" name="position" autocomplete="off" class="form-control bg-transparent"/> 
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
                                    <div class="mb-3">
                                        <label for="id_product" class="form-label">Product</label>
                                        <select name="id_product" id="product" class="form-select">
                                            <?php foreach ($products as $product): ?>
                                                <option value="<?= $product['id_product']; ?>"><?= $product['name_product']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_in" class="form-label">Date In</label>
                                        <input type="date" name="date_in" id="date_in" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nip" class="form-label">NIP</label>
                                        <input type="number" name="nip" id="nip" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="place_of_birth" class="form-label">Place of Birth</label>
                                        <input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <input type="text" name="position" id="position" class="form-control">
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

          

            $("#editEmployeeModal").modal("show");
        }
	</script>
</main>