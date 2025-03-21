
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


	function handleDeleteBatchUangMakanButton(id) {
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
					url: base_url + 'admin/uang_makan/delete_batch',
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

</script>

