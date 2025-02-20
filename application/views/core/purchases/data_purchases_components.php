<!-- PAY-->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="col-md-6">
						<div class="mb-3">
							<span>Sisa: <span id="remaining_amount_display" class="text-success"></span></span>
						</div>
						<form id="payForm">
							<input type="hidden" id="edit_id" name="id_purchases">
							<div class="mb-3">
								<label for="form_date" class="form-label">Tanggal</label>
								<input type="datetime-local" value="<?= date('Y-m-d\TH:i') ?>" name="payment_date" class="form-control" id="pay_date" required>
							</div>
							<div class="mb-3">
								<label for="form_text1" class="form-label">Amount</label>
								<input type="number" class="form-control" id="pay_amount" placeholder="Rp.1xxxx" name="payment_amount" required>
							</div>
							<div class="mb-3">
								<label for="form_text2" class="form-label">Deskripsi</label>
								<textarea type="text" class="form-control" id="pay_description" placeholder="Enter text" name="description" required> </textarea>
							</div>
							<div class="d-grid mb-10 mt-10">
								<button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Pay
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
						<div class="mb-3">
							<span>Total: <span id="final_amount_display" class="text-success"></span></span>
						</div>
						<div class="card p-4 shadow">
							<div class="mb-3">
								<h6>Log:</h6>
								<ul id="log_list_pay" class="list-group">

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal LOG -->
<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<span>Total : <span id="final_amount_display" class="text-success"></span></span>
				</div>
				<div class="card p-5 shadow mb-5" style="width: auto; max-height: 200px; overflow-y: auto;">
					<div class="mb-3">
						<h6>Log :</h6>
						<ul id="log_list" class="list-group">

						</ul>
					</div>
				</div>
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
		table.ajax.reload();
	});

	// LOG
	const exampleModal = document.getElementById('logModal');
	exampleModal.addEventListener('show.bs.modal', function (event) {
		const button = event.relatedTarget;
		const id = button.getAttribute('data-id-supplier');
		const finalAmount = button.getAttribute('data-final-amount');
		const remainingAmount = button.getAttribute('data-remaining-amount');

		console.log("Final Amount:", finalAmount);
		console.log("Remaining Amount:", remainingAmount);
		console.log("ID:", id);

		// Format angka menjadi Rupiah
		function formatToRupiah(number) {
			return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
		}

		// Format tanggal menjadi DD-MM-YYYY
		function formatDate(dateString) {
			const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
			return new Date(dateString).toLocaleDateString('id-ID', options);
		}

		$('#final_amount_display').text(formatToRupiah(finalAmount));
		$('#remaining_amount_display').text(formatToRupiah(remainingAmount));
		$("#edit_id").val(id);

		$.ajax({
			url: base_urls + 'admin/purchases/pay_logs',
			method: 'POST',
			data: { id: id },
			dataType: 'json',
			success: function (response) {
				const logList = $('#log_list');
				logList.empty();
				if (response.logs && response.logs.length > 0) {
					response.logs.forEach(log => {
						const formattedDate = formatDate(log.payment_date);
						const formattedAmount = formatToRupiah(log.payment_amount);
						logList.append(`<li class="list-group-item">${formattedDate} sebesar ${formattedAmount}</li>`);
					});
				} else {

					logList.append(`<li class="list-group-item text-danger text-primary">Tidak ada riwayat pembayaran untuk transaksi ini.</li>`);
				}
			},
			error: function () {
				$('#log_list').html('<li class="list-group-item text-danger">Gagal memuat riwayat pembayaran.</li>');
			}
		});
	});

	// PAY
	const pay = document.getElementById('payModal');
	pay.addEventListener('show.bs.modal', function (event) {
		const button = event.relatedTarget;
		const id = button.getAttribute('data-id-supplier');
		const finalAmount = button.getAttribute('data-final-amount');
		const remainingAmount = button.getAttribute('data-remaining-amount');

		console.log("Final Amount:", finalAmount);
		console.log("Remaining Amount:", remainingAmount);
		console.log("ID:", id);

		// Format angka menjadi Rupiah
		function formatToRupiah(number) {
			return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
		}

		// Format tanggal menjadi tanggal-bulan-tahun
		function formatDate(dateString) {
			const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
			return new Date(dateString).toLocaleDateString('id-ID', options);
		}

		$('#final_amount_display').text(formatToRupiah(finalAmount));
		$('#remaining_amount_display').text(formatToRupiah(remainingAmount));
		$("#edit_id").val(id);

		$.ajax({
			url: base_urls + 'admin/purchases/pay_logs',
			method: 'POST',
			data: { id: id },
			dataType: 'json',
			success: function (response) {
				const logList = $('#log_list_pay');
				logList.empty();
				if (response.logs && response.logs.length > 0) {
					response.logs.forEach(log => {
						const formattedDate = formatDate(log.payment_date);
						const formattedAmount = formatToRupiah(log.payment_amount);
						logList.append(`<li class="list-group-item text-info"><i class="ti ti-credit-card"></i> - ${formattedDate} sebesar ${formattedAmount}</li>`);
					});
				} else {

					logList.append(`<li class="list-group-item text-danger">Tidak ada riwayat pembayaran untuk transaksi ini.</li>`);
				}
			},
			error: function () {
				$('#log_list_pay').html('<li class="list-group-item text-danger">Gagal memuat riwayat pembayaran.</li>');
			}
		});


		$("#payForm").on("submit", function (e) {
			e.preventDefault();

			const submitButton = $("#payForm button[type=submit]");
			submitButton.prop("disabled", true).text("Processing...");

			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Pembayaran tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Bayar',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {


					$.ajax({
						url: base_urls + "admin/purchases/add_pay",
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


	function handleDeletePurchaseButton(id) {
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
					url: base_url + 'admin/purchases/delete',
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
