
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

<div class="modal fade" tabindex="-1" id="deleteByCodeModal">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete By Code</h4>


				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
				</div>

			</div>

			<div class="modal-body">
				<form class="form w-100" id="deleteByCodeForm" enctype="multipart/form-data">
					<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
						<span>Kode</span>
					</div>
					<div class="fv-row mb-8">
						<input type="text" id="code_delete" name="code_delete" class="form-control bg-transparent" />
					</div>

					<div class="d-grid mb-10">
						<button type="submit" id="delete_holiday" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Delete
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
	function handleDeleteHolydayButton(id) {
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
					url: base_url + 'absence/holyday/delete',
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


	// ----------- DELETE BY CODE
	$(document).ready(function () {
		var base_url = $('meta[name="base_url"]').attr('content');
		$("#deleteByCodeForm").on("submit", function (e) {
			e.preventDefault();

			var formElement = this;
			var formData = new FormData(formElement);

			$.ajax({
				url: base_url +"absence/holyday/delete_by_code",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (response) {
					if (response.status) {
						swallMssg_s(response.message, false, 1500)
							.then(() =>  {
								location.reload();
							});
					} else {
						swallMssg_e(response.message, true, 0);
					}
				},
				error: function (xhr, status, error) {
					swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
					then(() =>  {
						location.reload();
					});
				}
			});
		});
	});





</script>
