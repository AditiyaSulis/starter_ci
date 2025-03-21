<style>

	#employees_table {
		width: 100% !important;
	}


	#employees_table thead th,
	#employees_table tbody td {
		white-space: nowrap;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}


</style>

<main>
    <h1>Employee</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
        <i class="bi bi-plus-circle"></i>
        Add Employee
    </button>

    <div class="row g-3 align-items-center mt-4">
        <div class="col-6 col-md-3">
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
				<thead class="table-primary">
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Date In</th>
					<th>NIP</th>
					<th>Name</th>
					<th>Gender</th>
					<th class="px-2">Tempat Lahir</th>
					<th class="px-2">Tanggal Lahir</th>
					<th class="px-2">Divisi</th>
					<th class="px-2">Posisi</th>
					<th class="px-2">Type</th>
					<th>Contract</th>
					<th>Gaji</th>
					<th class="px-2">Uang Makan</th>
					<th>Account</th>
					<th>BPJS</th>
					<th>PPH 21</th>
					<th>Address</th>
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
                    <h3 class="modal-title">Add Employee - Step 1/5</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
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
							<label for="name" class="form-label">Nama</label>
							<input type="text" class="form-control" name="name" required />
						</div>
                        <div class="mb-3">
                            <label for="date_in" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="date_in" required />
                        </div>
						<div class="mb-3">
							<label for="email" class="form-label">No.HP</label>
							<input type="number" class="form-control" name="no_hp" required />
						</div>
						<hr  class="mt-6" style="width : 100%;">
						<h5>User Account</h5>
						<div class="mb-3 mt-6">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" name="email" required />
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" name="password" required />
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Ketik Ulang Password</label>
							<input type="password" class="form-control" name="rewrite_password" required />
						</div>
						<hr  class="mb-6" style="width : 100%;">
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="number" class="form-control" name="nip" required />
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
                    <h3 class="modal-title">Add Employee - Step 2/5</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="progress mb-8">
                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
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
						<div class="mb-3" id="type">
							<label for="position" class="form-label">Type Uang Makan</label>
							<select id="type_uang_makan" class="form-select" name="type_uang_makan" required>
								<option value="" selected>-pilih tipe-</option>
								<option value="1">Harian</option>
								<option value="2">Mingguan</option>
								<option value="3">Bulanan</option>
							</select>
						</div>
						<div class="mb-3" id="type">
							<label for="position" class="form-label">Type Karyawan</label>
							<select id="type_employee" class="form-select" name="type_employee" required>
								<option value="" selected>-pilih tipe-</option>
								<option value="1">Kontrak</option>
								<option value="2">Magang</option>
								<option value="3">Permanent</option>
							</select>
						</div>
						<div id="newContract">
							<div class="mb-3">
								<label for="contract_expired" class="form-label">Kontrak Selesai</label>
								<input type="date" class="form-control" name="contract_expired" />
							</div>
						</div>
						<div class="mb-3">
							<label for="npwp" class="form-label">NPWP</label>
							<input type="number"  class="form-control" name="npwp"  />
						</div>
						<div class="mb-3">
							<label for="position" class="form-label">Jenis PPH</label>
							<select class="form-select" name="id_ptkp">
								<option value="" selected>Pilih Jenis PPH</option>
								<?php foreach($pph as $pph_21): ?>
									<option value="<?= $pph_21['id_ptkp'] ?>"><?= $pph_21['code_ptkp'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mb-3">
							<label for="nik" class="form-label">NIK</label>
							<input type="number"  class="form-control" name="nik"  />
						</div>
						<div class="mb-3">
							<label for="no_bpjs" class="form-label">No.BPJS</label>
							<input type="number"  class="form-control" name="no_bpjs"  />
						</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="backToAddProduct">Back</button>
					<button type="button" class="btn btn-primary" id="nextToAddAddress">Next</button>
                </div>
            </div>
        </div>
    </div>

	<!-- Modal Address -->
	<div class="modal fade" tabindex="-1" id="addAddress" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Employee - Step 3/5</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="progress mb-8">
						<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<form id="addAddressForm">
						<h5>Tempat Asal : </h5>
						<hr class="mb-3" style="width: 100%">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Kabupaten/Kota</label>
							<input type="text" class="form-control" id="kabupaten" placeholder="Kabupaten" name="kabupaten" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kecamatan</label>
							<input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" name="kecamatan" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Desa</label>
							<input type="text" class="form-control" id="desa" placeholder="Desa" name="desa" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Blok</label>
							<input type="text" class="form-control" id="blok" placeholder="Blok" name="blok" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kode Pos</label>
							<input type="text" class="form-control" id="kode_pos" placeholder="Kode pos" name="kode_pos" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Spesifik</label>
							<textarea  class="form-control" id="spesifik" placeholder="Spesifik" name="spesifik" required> </textarea>
						</div>
						<h5 class="mt-8">Domisili : </h5>
						<hr class="mb-3" style="width: 100%">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Kabupaten/Kota</label>
							<input type="text" class="form-control" id="kabupaten_domisili" placeholder="Kabupaten" name="kabupaten_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kecamatan</label>
							<input type="text" class="form-control" id="kecamatan_domisili" placeholder="Kecamatan" name="kecamatan_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Desa</label>
							<input type="text" class="form-control" id="desa_domisili" placeholder="Desa" name="desa_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Blok</label>
							<input type="text" class="form-control" id="blok_domisili" placeholder="Blok" name="blok_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kode Pos</label>
							<input type="text" class="form-control" id="kode_pos_domisili" placeholder="Kode pos" name="kode_pos_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Spesifik</label>
							<textarea  class="form-control" id="spesifik_domisili" placeholder="Spesifik" name="spesifik_domisili" required> </textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="backToAddSalary">Back</button>
					<button type="button" class="btn btn-primary" id="nextToAddBankAccount">Next</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Add Bank Account -->
	<div class="modal fade" tabindex="-1" id="addBank" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Employee - Step 4/5</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="progress mb-8">
						<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<form id="addBankForm">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Nama Bank</label>
							<input type="text" class="form-control" id="bank_name1" placeholder="Bank Name" name="bank_name">
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">No.Rek</label>
							<input type="number" class="form-control" id="bank_number1" placeholder="Bank Number" name="bank_number" >
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Atas Nama</label>
							<input type="text" class="form-control" id="bank_holder_name1" placeholder="Holder Name" name="bank_holder_name" >
						</div>
						<div class="d-grid mb-10 mt-10">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="backToAddAddress">Back</button>
					<button type="button" class="btn btn-primary" id="nextToAddEc">Next</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Add Emergency Contact -->
	<div class="modal fade" tabindex="-1" id="addEmergencyContact" data-bs-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Employee - Step 5/5</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="progress mb-8">
						<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<form id="addEcForm">
						<div class="mb-5">
							<label for="form_text1" class="form-label">Name</label>
							<input type="text" class="form-control" id="name_contact1" placeholder="Name contact" name="name_contact">
						</div>
						<div class="mb-5">
							<label for="form_text2" class="form-label">No.Hp</label>
							<input type="number" class="form-control" id="number_contact1" placeholder="08122xxxx" name="number_contact">
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
							<textarea type="text" class="form-control" id="address_contact1" name="address_contact"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="backToAddBankAccount">Back</button>
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
						<div class="mb-3" id="type">
							<label for="position" class="form-label">Type Uang Makan</label>
							<select id="type_uang_makan_edit" class="form-select" name="type_uang_makan" required>
								<option value="" selected>-pilih tipe-</option>
								<option value="1">Harian</option>
								<option value="2">Mingguan</option>
								<option value="3">Bulanan</option>
							</select>
						</div>
						<div class="mb-3" id="type">
							<label for="position" class="form-label">Type Karyawan</label>
							<select id="type_employee_edit" class="form-select" name="type_employee" required>
								<option value="" selected>-pilih tipe-</option>
								<option value="1">Kontrak</option>
								<option value="2">Magang</option>
								<option value="3">Permanent</option>
							</select>
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
                                    <la for="form_text1" class="form-label">Name</la
                                    bel>
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

	<!-- Modal Renew Contract-->
	<div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ecLabel">Renew Contract</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col-md-6">
							<form id="contractForm">
								<input type="hidden" id="edit_id_contract" name="id_employee">
								<input type="hidden" id="edit_old_contract" name="old_contract">
								<div class="mb-5">
									<la for="form_text1" class="form-label">New Contract</la
										bel>
									<input type="date" class="form-control" id="new_contract" placeholder="Name contact" name="new_contract" required>
								</div>
								<div class="mb-5">
									<label for="form_text2" class="form-label">Description</label>
									<textarea type="text" class="form-control" id="description" name="description" required></textarea>
								</div>
								<div class="d-grid mb-10 mt-10">
									<button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Renew Contract
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
									<h6>Log Renew Contract :</h6>
									<ul id="contract_list" class="list-group">

									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Address-->
	<div class="modal fade" id="addressShowModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Address</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<span>Nama: <span id="nama_karyawan" class="text-success"></span></span>
					</div>
					<div class="mb-3">
						<span>Product: <span id="product_employee" class="text-success"></span></span>
					</div>
					<form id="editAddressForrm">
						<input type="hidden" id="edit_id_employee" name="id_employee">
						<h5>Tempat Asal : </h5>
						<hr class="mb-3" style="width: 100%">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Kabupaten/Kota</label>
							<input type="text" class="form-control" id="edit_kabupaten" placeholder="Kabupaten" name="kabupaten" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kecamatan</label>
							<input type="text" class="form-control" id="edit_kecamatan" placeholder="Kecamatan" name="kecamatan" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Desa</label>
							<input type="text" class="form-control" id="edit_desa" placeholder="Desa" name="desa" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Blok</label>
							<input type="text" class="form-control" id="edit_blok" placeholder="Blok" name="blok" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kode Pos</label>
							<input type="text" class="form-control" id="edit_kode_pos" placeholder="Kode pos" name="kode_pos" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Spesifik</label>
							<textarea  class="form-control" id="edit_spesifik" placeholder="Spesifik" name="spesifik" required> </textarea>
						</div>
						<h5 class="mt-8">Domisili : </h5>
						<hr class="mb-3" style="width: 100%">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Kabupaten/Kota</label>
							<input type="text" class="form-control" id="edit_kabupaten_domisili" placeholder="Kabupaten" name="kabupaten_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kecamatan</label>
							<input type="text" class="form-control" id="edit_kecamatan_domisili" placeholder="Kecamatan" name="kecamatan_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Desa</label>
							<input type="text" class="form-control" id="edit_desa_domisili" placeholder="Desa" name="desa_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Blok</label>
							<input type="text" class="form-control" id="edit_blok_domisili" placeholder="Blok" name="blok_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Kode Pos</label>
							<input type="text" class="form-control" id="edit_kode_pos_domisili" placeholder="Kode pos" name="kode_pos_domisili" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Spesifik</label>
							<textarea  class="form-control" id="edit_spesifik_domisili" placeholder="Spesifik" name="spesifik_domisili" required> </textarea>
						</div>
							<button type="submit" class="btn btn-primary">
								<span class="indicator-label">
									Update
								</span>
								<span class="indicator-progress">
									Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
							</button>
						</div>
					</form>
				</div>
			</div>
	</div>

	<!-- Modal User Account-->
	<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">User Account</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="editUserAccountForm">
						<input type="hidden" id="edit_id_employee_user" name="id_employee">
						<input type="hidden" id="old_email" name="old_email">
						<div class="mb-3">
							<label for="form_text1" class="form-label">Email</label>
							<input type="text" class="form-control" id="email_edit" placeholder="Email" name="email" required>
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">Password</label>
							<input type="text" class="form-control" id="password_edit_user" placeholder="Password" name="password" required>
						</div>
						<button type="submit" class="btn btn-primary">
								<span class="indicator-label">
									Update
								</span>
							<span class="indicator-progress">
									Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
						</button>
				</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Modal  PPH-->
	<div class="modal fade" id="pphShowModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">PPH</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="editPphForm">
						<input type="hidden" id="edit_id_employee_pph" name="id_employee">
						<div class="mb-3">
							<label for="position" class="form-label">Jenis PPH</label>
							<select class="form-select" name="id_ptkp" id="edit_id_ptkp">
								<option value="" selected>Pilih Jenis PPH</option>
								<?php foreach($pph as $pph_21): ?>
									<option value="<?= $pph_21['id_ptkp'] ?>"><?= $pph_21['code_ptkp'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mb-3">
							<label for="form_text1" class="form-label">NIK</label>
							<input type="number" class="form-control" id="nik_edit" placeholder="nik" name="nik">
						</div>
						<div class="mb-3">
							<label for="form_text2" class="form-label">NPWP</label>
							<input type="number" class="form-control" id="npwp_edit" placeholder="npwp" name="npwp">
						</div>
						<button type="submit" class="btn btn-primary">
									<span class="indicator-label">
										Update
									</span>
							<span class="indicator-progress">
										Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
									</span>
						</button>
				</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Modal  BPJS-->
	<div class="modal fade" id="bpjsShowModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">BPJS</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="editBpjsForm">
						<input type="hidden" id="edit_id_employee_bpjs" name="id_employee">
						<div class="mb-3">
							<label for="form_text2" class="form-label">NO BPJS</label>
							<input type="number" class="form-control" id="no_bpjs_edit" placeholder="no bpjs" name="no_bpjs">
						</div>
						<button type="submit" class="btn btn-primary">
								<span class="indicator-label">
									Update
								</span>
							<span class="indicator-progress">
									Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
						</button>
				</div>
				</form>
			</div>
		</div>
	</div>



	<script>
        const base_url = $('meta[name="base_url"]').attr('content');  

        let product = 'All';

		function callDT() {
			var table = $('#employees_table').DataTable({
				scrollX: true,
				autoWidth: false,
				processing: true,
				serverSide: true,
				ordering: false,
				fixedColumns: {
					leftColumns: 1,
					rightColumns: 1
				},
				ajax: {
					url: base_url + 'admin/employee/dtSideServer',
					type: 'POST',
					data: function(d) {
						d.product = $('#filter-product').val();
					}
				},
				dom: "<'row'<'col-sm-12 col-md-6 d-flex align-items-center'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>>" +
					"tr" +
					"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				columnDefs: [
					{ targets: 0, className: "text-center" },
					{ targets: [1, 2, 3, 4], responsivePriority: 1 },
					{ targets: -1, responsivePriority: 2 },
				],
				initComplete: function() {
					table.columns.adjust().draw();
				}
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
        exampleModal.addEventListener('show.bs.modal', function (event) 
        {
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
        ecModal.addEventListener('show.bs.modal', function (event)
        {
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
            })

			$('#nextToAddAddress').on('click', function () {
				if ($('#formAddSalary')[0].checkValidity()) {
					$('#addSalary').modal('hide');
					$('#addAddress').modal('show');
				} else {
					$('#formAddSalary')[0].reportValidity();
				}
			});
			$('#backToAddSalary').on('click', function () {
				$('#addAddress').modal('hide');
				$('#addSalary').modal('show');
			});

			$('#nextToAddBankAccount').on('click', function () {
				if ($('#addAddressForm')[0].checkValidity()) {
					$('#addAddress').modal('hide');
					$('#addBank').modal('show');
				} else {
					$('#addAddressForm')[0].reportValidity();
				}
			});
			$('#backToAddAddress').on('click', function () {
				$('#addBank').modal('hide');
				$('#addAddress').modal('show');
			});

			$('#nextToAddEc').on('click', function () {
				if ($('#addBankForm')[0].checkValidity()) {
					$('#addBank').modal('hide');
					$('#addEmergencyContact').modal('show');
				} else {
					$('#addBankForm')[0].reportValidity();
				}
			});
			$('#backToAddBankAccount').on('click', function () {
				$('#addEmergencyContact').modal('hide');
				$('#addBank').modal('show');
			});

			$('#submitEmployee').on('click', function () {
				const employeeData = $('#addEmployeeForm').serializeArray();
				const salaryData = $('#formAddSalary').serializeArray();
				const bankData = $('#addBankForm').serializeArray();
				const ecData = $('#addEcForm').serializeArray();
				const addressData = $('#addAddressForm').serializeArray();

				const formData = {};

				employeeData.concat(salaryData, bankData, ecData, addressData).forEach(field => {
					formData[field.name] = field.value;
				});

				if ($('#addEmployeeForm')[0].checkValidity() && $('#formAddSalary')[0].checkValidity() && $('#addAddressForm')[0].checkValidity() && $('#addBankForm')[0].checkValidity() && $('#addEcForm')[0].checkValidity()) {
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
								url: '<?= site_url("admin/employee/add_all_data_employee") ?>',
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
											$('#addEmergencyContact').modal('hide');
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
					$('#addEmployeeForm')[0].reportValidity();
					$('#formAddSalary')[0].reportValidity();
					$('#addAddressForm')[0].reportValidity();
					$('#addBankForm')[0].reportValidity();
					$('#addEcForm')[0].reportValidity();
				}
			});
		});


         // ------------EDIT EMPLOYEE
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
            const type_uang_makan = $(element).data('edit_type_uang_makan');
            const position = $(element).data('edit_position');
            const type_employee = $(element).data('type_employee');

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
            $('#type_uang_makan_edit').val(type_uang_makan);
            $('#edit_position').val(position);
            $('#type_employee_edit').val(type_employee);

            $('#editProduct').modal('show');
        }

		// ------------EDIT SALARY
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

		//KONTRAK FORM
		document.addEventListener('DOMContentLoaded', function () {
			const type_employee = document.getElementById('type_employee');
			const newContract = document.getElementById('newContract');


			type_employee.addEventListener('change', function () {
				if (this.value === '1' || this.value == 2) {
					newContract.style.display = 'block';
				} else {
					newContract.style.display = 'none';
				}
			});
		});

		//RENEW CONTRACT
		const contractModal = document.getElementById('contractModal');
		contractModal.addEventListener('show.bs.modal', function (event)
		{
			const button1 = event.relatedTarget;
			const id_employees = button1.getAttribute('data-id_employees');
			const old_contract = button1.getAttribute('data-old_contract');

			console.log("id:", id_employees);
			$("#edit_id_contract").val(id_employees);
			$("#edit_old_contract").val(old_contract);

			$.ajax({
				url: base_url + 'admin/employee/contract_info',
				method: 'POST',
				data: { id_employees: id_employees },
				dataType: 'json',
				success: function (response) {
					const contractList = $('#contract_list');
					contractList.empty();
					if (response.contract && response.contract.length > 0) {
						response.contract.forEach(contract => {
							const old_contract = contract.old_contract
							const new_contract = contract.new_contract;
							const description = contract.description;

							contractList.append(`<li class="list-group-item shadow-lg mb-3">

                                                           <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Old Contract :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${old_contract}" disabled readonly>
                                                            </div>
                                                           <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>New Contract :</strong> </p>
                                                                <input type="text" class="form-control smaller-input text-info" value="${new_contract}" disabled readonly>
                                                            </div>
 															 <div class="mb-3">
                                                                <p class="text-dark mb-1"><strong>Description :</strong> </p>
                                                                <textarea type="text" class="form-control smaller-input text-info" disabled readonly>${description}</textarea>
                                                            </div>

                                                </li>`);
						});
					} else {
						contractList.append(`<li class="list-group-item text-danger">Belum ada perpanjangan contract.</li>`);
					}
				},
				error: function () {
					$('#contractList').html('<li class="list-group-item text-danger">Gagal memuat.</li>');
				}
			});

			$("#contractForm").on("submit", function (e) {
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
							url: base_url + "admin/employee/add_contract",
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

		// SHOW AND EDIT address MODAL
		const editAddressModal = document.getElementById('addressShowModal');
		editAddressModal.addEventListener('show.bs.modal', function (event) {
			// console.log("Related Target:", event.relatedTarget);

			const button = event.relatedTarget;
			const id = button.getAttribute('data-id_employee');
			const namaKaryawan = button.getAttribute('data-name');
			const product = button.getAttribute('data-product');

			const kabupaten = button.getAttribute('data-kabupaten');
			const kecamatan = button.getAttribute('data-kecamatan');
			const desa = button.getAttribute('data-desa');
			const blok = button.getAttribute('data-blok');
			const kodePos = button.getAttribute('data-kode_pos');
			const spesifik = button.getAttribute('data-spesifik');


			const kabupatenDomisili = button.getAttribute('data-kabupaten_domisili');
			const kecamatanDomisili = button.getAttribute('data-kecamatan_domisili');
			const desaDomisili = button.getAttribute('data-desa_domisili');
			const blokDomisili = button.getAttribute('data-blok_domisili');
			const kodePosDomisili = button.getAttribute('data-kode_pos_domisili');
			const spesifikDomisili = button.getAttribute('data-spesifik_domisili');

			console.log("ID:", id);


			$('#nama_karyawan').text(namaKaryawan);
			$('#product_employee').text(product);


			$('#edit_kabupaten').val(kabupaten);
			$('#edit_kecamatan').val(kecamatan);
			$('#edit_desa').val(desa);
			$('#edit_blok').val(blok);
			$('#edit_kode_pos').val(kodePos);
			$('#edit_spesifik').val(spesifik);
			$("#edit_id_employee").val(id);

			$('#edit_kabupaten_domisili').val(kabupatenDomisili);
			$('#edit_kecamatan_domisili').val(kecamatanDomisili);
			$('#edit_desa_domisili').val(desaDomisili);
			$('#edit_blok_domisili').val(blokDomisili);
			$('#edit_kode_pos_domisili').val(kodePosDomisili);
			$('#edit_spesifik_domisili').val(spesifikDomisili);

			$("#editAddressForrm").on("submit", function (e) {
				e.preventDefault();

				// const submitButton = $("#editAddressForrm button[type=submit]");
				// submitButton.prop("disabled", true).text("Processing...");

				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: "Pastikan data yang dimasukan sudah benar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Update',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if (result.isConfirmed) {


						$.ajax({
							url: base_url + "admin/employee/edit_address",
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
									// submitButton.prop("disabled", false).text("Submit");
								}
							},
							error: function (xhr, status, error) {
								swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
									.then(() => {
										location.reload();
									});
								// submitButton.prop("disabled", false).text("Submit");
							}
						});
					}
				});
			});

		});


		//-----------------------------------------------------
		const acModal = document.getElementById('userShowModal');
		acModal.addEventListener('show.bs.modal', function (event)
		{
			const button1 = event.relatedTarget;
			const email = button1.getAttribute('data-email');
			const id_employee = button1.getAttribute('data-id_employee');
			$.ajax({
				url: "<?= site_url('admin/employee/find_user') ?>",
				type: "POST",
				data: { email: email,
				id_employee: id_employee},
				dataType: "json",
				success: function(response) {
					if (response.status) {
						$("#edit_id_employee_user").val(id_employee);
						$("#old_email").val(email);
						$("#email_edit").val(response.data.email);
						$("#password_edit_user").val(response.data.password);
					} else {
						alert(response.message);
					}
				},
				error: function() {
					alert("Terjadi kesalahan saat mengambil data.");
				}
			});


			$("#editUserAccountForm").on("submit", function (e) {
				e.preventDefault();

				const submitbuttom1 = $("#editUserAccountForm button[type=submit]");
				submitbuttom1.prop("disabled", true).text("Processing...");

				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: "Pastikan data sudah benar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Update',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: base_url + "admin/employee/edit_user",
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


		//---------------------PPH
		const pphModal = document.getElementById('pphShowModal');
		pphModal.addEventListener('show.bs.modal', function (event) {
			// console.log("Related Target:", event.relatedTarget);

			const button = event.relatedTarget;
			const id = button.getAttribute('data-id_employee');
			const nik = button.getAttribute('data-nik');
			const npwp = button.getAttribute('data-npwp');
			const id_ptkp = button.getAttribute('data-id_ptkp');

			console.log("ID:", id);


			$('#nik_edit').val(nik);
			$('#npwp_edit').val(npwp);
			$('#edit_id_ptkp').val(id_ptkp);
			$('#edit_id_employee_pph').val(id);

			$("#editPphForm").on("submit", function (e) {
				e.preventDefault();

				// const submitButton = $("#editAddressForrm button[type=submit]");
				// submitButton.prop("disabled", true).text("Processing...");

				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: "Pastikan data yang dimasukan sudah benar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Update',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if (result.isConfirmed) {


						$.ajax({
							url: base_url + "admin/employee/edit_pph",
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
									// submitButton.prop("disabled", false).text("Submit");
								}
							},
							error: function (xhr, status, error) {
								swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
									.then(() => {
										location.reload();
									});
								// submitButton.prop("disabled", false).text("Submit");
							}
						});
					}
				});
			});

		});


		//---------------------BPJS
		const bpjsModal = document.getElementById('bpjsShowModal');
		bpjsModal.addEventListener('show.bs.modal', function (event) {
			// console.log("Related Target:", event.relatedTarget);

			const button = event.relatedTarget;
			const id = button.getAttribute('data-id_employee');
			const no_bpjs = button.getAttribute('data-no_bpjs');

			console.log("ID:", id);


			$('#edit_id_employee_bpjs').val(id);
			$('#no_bpjs_edit').val(no_bpjs);

			$("#editBpjsForm").on("submit", function (e) {
				e.preventDefault();

				// const submitButton = $("#editAddressForrm button[type=submit]");
				// submitButton.prop("disabled", true).text("Processing...");

				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: "Pastikan data yang dimasukan sudah benar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Update',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if (result.isConfirmed) {


						$.ajax({
							url: base_url + "admin/employee/edit_bpjs",
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
									// submitButton.prop("disabled", false).text("Submit");
								}
							},
							error: function (xhr, status, error) {
								swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
									.then(() => {
										location.reload();
									});
								// submitButton.prop("disabled", false).text("Submit");
							}
						});
					}
				});
			});

		});

	</script>
</main>
