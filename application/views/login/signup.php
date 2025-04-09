



    <main>

       

		<div class="row">
			<div class="col-md-12 col-lg-4 col-sm-12 mx-10">
						<form class="form w-100" novalidate="novalidate" id="addproduct" data-action="<?= site_url('auth/regist') ?>" enctype="multipart/form-data">
							<div class="mb-11">
								<h1 class="text-gray-900 fw-bolder mb-3">
									Add User
								</h1>

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

			<div class="col-md-12 col-lg-7 col-sm-12">
				<div class=" mt-12  shadow-sm" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f5feff;">
					<div class="row g-3 align-items-center mt-4">
						<div class="col-6 col-md-3">
							<label class="form-label">Role :</label>
							<select id="filter-role" class="form-select form-select-sm">
								<option value="All" selected>All</option>
								<option value="1">Super user</option>
								<option value="2">Admin</option>
								<option value="3">Employee</option>
								<option value="4">HRD</option>
							</select>
						</div>
						<div class="col-6 col-md-3">
							<label class="form-label">Product :</label>
							<select id="filter-product" class="form-select form-select-sm">
								<option value="All" selected>All</option>
								<?php foreach ($product as $products) : ?>
									<option value="<?=$products['id_product']?>"><?=$products['name_product']?>></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="mt-6">
						<table id="user_table" class="table table-bordered table-striped border-primary" style="width:100%">
							<thead class="table-primary">
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Product</th>
								<th>Role</th>
								<th>Status</th>
								<th class="px-15">Last Update</th>
								<th class="px-15">Last Login</th>
								<th class="px-10">Ip Address</th>
								<th>Avatar</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>


		<!--	EDIT	-->
		<div class="modal fade" id="editUserModal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Edit User Account</h3>

						<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
							 aria-label="Close" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
                        <span class="svg-icon svg-icon-2">
                            <i class="ti ti-minus"></i>
                        </span>
						</div>
					</div>

					<div class="modal-body">
						<form class="form w-100" id="updateUserForm" enctype="multipart/form-data">
							<input type="hidden" name="id" id="edit_id">
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Avatar</span>
							</div>
							<div class="fv-row mb-8">
								<input type="file" placeholder="avatar" id="edit_avatar" name="avatar" autocomplete="off"
									   class="form-control bg-transparent" />
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Role</span>
							</div>
							<div class="fv-row mb-8">
								<select class="form-select" aria-label="Default select example" name="role" id="edit_role">
									<option selected>-pilih role-</option>
									<option value="1">Super User</option>
									<option value="2">Admin</option>
									<option value="3">Employee</option>
									<option value="4">HRD</option>
								</select>
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Name</span>
							</div>
							<div class="fv-row mb-8">
								<input type="text" placeholder="Name" id="edit_name" name="name" autocomplete="off"
									   class="form-control bg-transparent" />
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Email</span>
							</div>
							<div class="fv-row mb-8">
								<input type="email" placeholder="Email" id="edit_email" name="email"
									   autocomplete="off" class="form-control bg-transparent" />
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Password</span>
							</div>
							<div class="fv-row mb-8">
								<input type="text" placeholder="Email" id="edit_password" name="password"
									   autocomplete="off" class="form-control bg-transparent" />
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Status</span>
							</div>
							<div class="fv-row mb-8">
								<select class="form-select" aria-label="Default select example" name="status" id="edit_status">
									<option selected>-pilih status-</option>
									<option value="1">Aktif</option>
									<option value="2">Banned</option>
								</select>
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

			let role = 'All';

			function callDT() {
				var table = $('#user_table').DataTable({
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
						url: base_url + 'admin/userdata/dtSideServer',
						type: 'POST',
						data: function(d) {
							d.role = $('#filter-role').val();
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

				$('#filter-role').change(function() {
					table.ajax.reload();
				});

				$('#filter-product').change(function() {
					table.ajax.reload();
				});
			}

			callDT();



			function editUserBtn(element) {
				let $element = $(element);

				$("#edit_id").val($element.data('edit_id'));
				$("#edit_name").val($element.data('edit_name'));
				$("#edit_role").val($element.data('edit_role'));
				$("#edit_email").val($element.data('edit_email'));
				$("#edit_status").val($element.data('edit_status'));
				$("#edit_password").val($element.data('edit_password'));
				$("#editUserModal").modal("show");
			}
			$(document).ready(function() {
				const base_url = $('meta[name="base_url"]').attr('content');

				$("#updateUserForm").on("submit", function(e) {
					e.preventDefault();

					let formData = new FormData(this); // Gunakan FormData

					$.ajax({
						url: base_url + "admin/userdata/update",
						type: "POST",
						data: formData,
						dataType: "json",
						processData: false, // Tambahkan ini
						contentType: false, // Tambahkan ini
						success: function(response) {
							if (response.status) {
								Swal.fire({
									icon: "success",
									title: "Berhasil",
									text: response.message,
									timer: 1500,
									showConfirmButton: false
								}).then(() => location.reload());
							} else {
								Swal.fire({
									icon: "error",
									title: "Gagal",
									text: response.message
								});
							}
						},
						error: function(xhr, status, error) {
							Swal.fire({
								icon: "error",
								title: "Error",
								text: "Terjadi kesalahan, silakan coba lagi."
							});
						}
					});
				});
			});

		</script>
    </main>

