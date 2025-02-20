

<!-- Modal STATUS -->
<div class="modal fade" tabindex="-1" id="setStatusIzinModal">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Set Status</h4>


				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
				</div>

			</div>

			<div class="modal-body">
				<form class="form w-100" id="setStatusIzinForm" enctype="multipart/form-data">
					<input type="hidden" id="id_izin" name="id_izin">
					<input type="hidden" id="employee" name="id_employee">
					<input type="hidden" id="tanggal" name="tanggal_izin">
					<div class="fv-row mb-8">
						<select class="form-select" aria-label="Default select example" id="status" name="status">
							<option value="1">Dissaprove</option>
							<option value="2">Approve</option>
							<option value="3">Pending</option>
						</select>
					</div>
					<div class="d-grid mb-10">
						<button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Set Status
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
</div>

<!-- MODAL UPDATE PBUKTI-->
<div class="modal fade" tabindex="-1" id="editBuktiModal">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update Bukti</h4>

				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
				</div>
			</div>

			<div class="modal-body">
				<form class="form w-100" id="editBuktiForm" enctype="multipart/form-data">
					<input type="hidden" id="id_izin_update" name="id_izin">
					<div class="mb-10">
						<label for="logo" class="form-label">Bukti</label>
						<input type="file" class="form-control" id="bukti_update" name="bukti_surat_sakit">
					</div>
					<div class="d-grid mb-10">
						<button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Save changes
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
</div>

<!-- Modal untuk gambar -->
<div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8); justify-content: center; align-items: center; z-index: 1000;">
	<span style="position: absolute; top: 20px; right: 30px; color: white; font-size: 30px; cursor: pointer;" onclick="closeImageModal()">×</span>
	<img id="modalImage" src="" alt="Preview" style="max-width: 90%; max-height: 90%;">
</div>



<!-- Modal  Custom Date -->
<div id="customDateModal" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Date Range</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form id="customDateForm">
					<div class="mb-3">
						<label for="startDate" class="form-label">Start Date</label>
						<input type="date" id="startDate" name="start_date" class="form-control">
					</div>
					<div class="mb-3">
						<label for="endDate" class="form-label">End Date</label>
						<input type="date" id="endDate" name="end_date" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="applyCustomDate">Apply</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<script>

	function preventMultipleSubmit(form) {
		const submitButton = form.querySelector('button[type="submit"]');
		if (submitButton) {
			submitButton.disabled = true;
			submitButton.textContent = 'Submitting...';
		}
		return true;
	}
	$('#applyCustomDate').on('click', function() {
		startDate = $('#startDate').val();
		endDate = $('#endDate').val();

		if (!startDate || !endDate) {
			Swal.fire({
				icon: "error",
				title: "Error",
				text: "Masukan tanggal dengan benar"
			});
			return;
		}

		$('#customDateModal').modal('hide');
		option = 'custom';
		table.ajax.reload();
	});

	//------------DELETE
	function handleDeleteIzinButton(id) {
		console.log('id nya : '+id)
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
				const base_url = $('meta[name="base_url"]').attr('content');
				$.ajax({
					url: base_url + 'absence/data/dataizin/delete',
					type: 'POST',
					data: { id: id },
					success: function(response) {
						console.log(response);
						var res = JSON.parse(response);
						if (res.status) {
							swallMssg_s(res.message, true, 0)
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

	//------------SET STATUS
	function setStatusIzin(element) {
		let $element = $(element);

		$("#id_izin").val($element.data('id_izin'));
		$("#status").val($element.data('status'));
		$("#tanggal").val($element.data('tanggal_izin'));
		$("#employee").val($element.data('id_employee'));


		$("#setStatusIzinModal").modal("show");
	}
	$(document).ready(function() {
		const base_url = $('meta[name="base_url"]').attr('content');

		$("#setStatusIzinForm").on("submit", function(e) {
			e.preventDefault();
			$.ajax({
				url: base_url + "absence/data/dataizin/set_status",
				type: "POST",
				data: $(this).serialize(),
				dataType: "json",
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
						text: "Terjadi kesalahan, silahkan coba lagi."
					});
				}
			});
		});
	});

	//------------UPDATE BUKTI
	function updateBukti(element) {
		let $element = $(element);

		$("#id_izin_update").val($element.data('id_izin'));

		$("#editBuktiModal").modal("show");
	}

	$(document).ready(function() {
		const base_url = $('meta[name="base_url"]').attr('content');

		$("#editBuktiForm").on("submit", function(e) {
			e.preventDefault();

			var formElement = this;
			var formData = new FormData(formElement);

			$.ajax({
				url: base_url + "absence/data/dataizin/update_bukti",
				type: "POST",
				data: formData,
				dataType: "json",
				processData: false,
				contentType: false,
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
						text: "Terjadi kesalahan, silahkan coba lagi."
					});
				}
			});
		});
	});


	//IMAGE
	function showImageModal(imageSrc) {
		document.getElementById('modalImage').src = imageSrc;
		document.getElementById('imageModal').style.display = 'flex';
	}

	function closeImageModal() {
		document.getElementById('imageModal').style.display = 'none';
	}



</script>
