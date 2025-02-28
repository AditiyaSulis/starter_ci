<main>
	<h1>Setting</h1>

	<div class="card shadow">
		<div class="card-header">
			<div class="card-title fs-3 fw-bold">Company Settings</div>
		</div>

		<form id="kt_project_settings_form" class="form" enctype="multipart/form-data">
			<div class="card-body p-9">
				<div class="row mb-5">
					<div class="col-xl-3">
						<div class="fs-6 fw-semibold mt-2 mb-3">Logo</div>
					</div>
					<div class="col-lg-8">
						<input type="hidden" class="form-control form-control-solid" id="id" name="id" value="<?= $employee['id_employee']?>"/>
						<div class="image-input image-input-outline shadow" data-kt-image-input="true">
							<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('<?=base_url('uploads/avatar/'.$employee['logo'])?>')"></div>
							<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
								<i class="bi bi-pencil-square fs-4"></i>
								<input type="file" name="logo" id="logo" accept=".png, .jpg, .jpeg"/>
								<input type="hidden" name="logo_remove"/>
							</label>
							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-trash3 fs-4"></i>
                            </span>

							<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="bi bi-trash3 fs-4"></i>
                            </span>
						</div>
						<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
					</div>
				</div>
				<div class="row mb-8">
					<div class="col-xl-3">
						<div class="fs-6 fw-semibold mt-2 mb-3">Company Name</div>
					</div>
					<div class="col-xl-9 fv-row">
						<input type="text" class="form-control form-control-solid shadow-lg" id="name" name="name" value="<?= $employee['name']?>"/>
					</div>
				</div>
				<div class="row mb-8">
					<div class="col-xl-3">
						<div class="fs-6 fw-semibold mt-2 mb-3">Email</div>
					</div>
					<div class="col-xl-9 fv-row">
						<input type="email" class="form-control form-control-solid shadow-lg" id="email" value="<?= $employee['email']?>" name="email"/>
					</div>
				</div>
				<div class="row mb-8">
					<div class="col-xl-3">
						<div class="fs-6 fw-semibold mt-2 mb-3">Contact</div>
					</div>
					<div class="col-xl-9 fv-row">
						<input type="number" class="form-control form-control-solid shadow-lg" id="contact" value="<?= $employee['contact']?>" name="contact"/>
					</div>
				</div>
				<div class="row mb-8">
					<div class="col-xl-3">
						<div class="fs-6 fw-semibold mt-2 mb-3">Address</div>
					</div>
					<div class="col-xl-9 fv-row">
						<textarea name="address" id="address" class="form-control form-control-solid shadow-lg h-100px"><?= $employee['address']?></textarea>
					</div>
				</div>
			</div>

			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
				<button type="submit" class="btn btn-primary" id="btn-save">Save Changes</button>
			</div>
		</form>

	</div>

	<script>

		//EDIT COMPANY PROFILE
		$(document).ready(function() {
			const base_url = $('meta[name="base_url"]').attr('content');

			$("#kt_project_settings_form").on("submit", function(e) {
				e.preventDefault();
				var formElement = this;
				var formData = new FormData(formElement);
				$.ajax({
					url: base_url + "admin/setting/update",
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(response) {
						if (response.status) {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message,
								timer: 1500,
								showConfirmButton: false,
							}).then(() => {
								location.reload();
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								html: response.message,
								showConfirmButton: true,
							});
						}
					},
					error: function(xhr, status, error) {
						Swal.fire({
							icon: 'error',
							title: 'Server Error',
							text: `Terjadi kesalahan: ${xhr.responseText || error}`,
							showConfirmButton: true,
						});
					}
				});
			});
		});

	</script>



</main>
