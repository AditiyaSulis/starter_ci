

<!-- Modal STATUS -->
<div class="modal fade" tabindex="-1" id="setStatusLeaveModal">
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
				<form class="form w-100" id="setStatusLeaveForm" enctype="multipart/form-data">
					<input type="hidden" id="id_cuti" name="id_cuti">
					<input type="hidden" id="id_employee_status" name="id_employee">
					<input type="hidden" id="type_status" name="type">
					<input type="hidden" id="start_day_status" name="start_day">
					<input type="hidden" id="end_day_status" name="end_day">
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
	function handleDeleteLeaveButton(id) {
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
					url: base_url + 'absence/leave/delete',
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
	function setStatusLeave(element) {
		let $element = $(element);

		$("#id_cuti").val($element.data('id_cuti'));
		$("#status").val($element.data('status'));
		$("#id_employee_status").val($element.data('id_employee'));
		$("#start_day_status").val($element.data('start_day'));
		$("#end_day_status").val($element.data('end_day'));
		$("#type_status").val($element.data('type'));

		$("#setStatusLeaveModal").modal("show");
	}
	$(document).ready(function() {
		const base_url = $('meta[name="base_url"]').attr('content');

		$("#setStatusLeaveForm").on("submit", function(e) {
			e.preventDefault();
			$.ajax({
				url: base_url + "absence/leave/set_status",
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






</script>
