<!-- Modal Pay -->
<div class="modal fade" id="payPiutangModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Piutang Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="col-md-6">
						<div class="mb-3">
							<span>Sisa: <span id="remaining_amount_display" class="text-success"></span></span>
						</div>
						<div class="mb-3">
							<span>Tenor: <span id="type_piutang_display" class="text-success"></span></span>
						</div>
						<form id="payPiutangForm">
							<input type="hidden" id="edit_id" name="id_piutang">
							<div class="mb-3">
								<label for="form_date" class="form-label">Tanggal</label>
								<input type="datetime-local" value="<?= date('Y-m-d\TH:i') ?>" name="pay_date" class="form-control" id="pay_date" required>
							</div>
							<div class="mb-3">
								<label for="form_text1" class="form-label">Amount</label>
								<input type="number" class="form-control" id="pay_amount" placeholder="Rp.1xxxx" name="pay_amount" required>
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
							<span>Angsuran : <span id="angsuran_display" class="text-success"></span></span>
						</div>
						<div class="mb-3">
							<span>Tanggal Pelunasan    : <span id="tgl_lunas_display" class="text-success"></span></span>
						</div>
						<div class="card p-4 shadow">
							<div class="mb-3">
								<h6>Log:</h6>
								<ul id="log_list" class="list-group">

								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Log -->
<div class="modal fade" id="logPiutangModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Piutang Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm">
						<div class="mb-1">
							<div class="card p-4 shadow">
								<div class="mb-3">
									<h6 class="mb-3">Detail:</h6>
									<div class="row mb-1">
										<div class="col-md-3">
											<span>Nama <span id="final_amount_display" class="text-success"></span></span>
										</div>
										<div class="col-md-9">
											<span>: <span id="name_log_display" class="text-success"> test nama</span></span>
										</div>
									</div>
									<div class="row mb-1">
										<div class="col-md-3">
											<span>Total <span id="final_amount_display" class="text-success"></span></span>
										</div>
										<div class="col-md-9">
											<span>: <span id="total_log_display" class="text-success"> test total</span></span>
										</div>
									</div>
									<div class="row mb-1">
										<div class="col-md-3">
											<span>Tgl Pinjam <span id="final_amount_display" class="text-success"></span></span>
										</div>
										<div class="col-md-9">
											<span>: <span id="paydate_log_display" class="text-success"> test total</span></span>
										</div>
									</div>
									<div class="row mb-1">
										<div class="col-md-3">
											<span>Tgl Lunas <span id="final_amount_display" class="text-success"></span></span>
										</div>
										<div class="col-md-9">
											<span>: <span id="tgl_lunas_log_display" class="text-success"> test total</span></span>
										</div>
									</div>

								</div>
							</div>

						</div>
						<div class="card p-4 shadow">
							<div class="mb-3">
								<h6>Log:</h6>
								<ul id="log_lists" class="list-group">

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
	// PAY MODAL
	const payModal = document.getElementById('payPiutangModal');
	payModal.addEventListener('show.bs.modal', function (event) {
		// console.log("Related Target:", event.relatedTarget);

		const button = event.relatedTarget;
		const id = button.getAttribute('data-id_piutang');
		const remainingAmount = button.getAttribute('data-remaining_piutang');
		const tanggal_pelunasan = button.getAttribute('data-tgl_lunas');
		const tenor = button.getAttribute('data-tenor_piutang');
		const type_tenor = button.getAttribute('data-type_tenor');
		const angsuran = button.getAttribute('data-angsuran');

		console.log("ID:", id);

		function formatToRupiah(number) {
			return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
		}

		// Format tanggal menjadi tanggal-bulan-tahun
		function formatDate(dateString) {
			const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
			return new Date(dateString).toLocaleDateString('id-ID', options);
		}

		type_tenor_formatted = '';
		if(type_tenor == 1) {
			type_tenor_formatted = 'Hari';
		} else if(type_tenor == 2) {
			type_tenor_formatted = 'Minggu';
		}else if(type_tenor == 3) {
			type_tenor_formatted = 'Bulan';
		}else if(type_tenor == 4) {
			type_tenor_formatted = 'Tahun';
		}
		type_formatted = `${tenor} ${type_tenor_formatted}`;


		console.log('sisa : '+remainingAmount);

		$('#remaining_amount_display').text(formatToRupiah(remainingAmount));
		$('#angsuran_display').text(formatToRupiah(angsuran));
		$('#tgl_lunas_display').text(formatDate(tanggal_pelunasan));

		$('#type_piutang_display').text(type_formatted);
		$('#pay_amount').val(angsuran);
		$("#edit_id").val(id);

		$.ajax({
			url: base_url + 'admin/piutang/pay_logs',
			method: 'POST',
			data: { id_piutang: id },
			dataType: 'json',
			success: function (response) {
				const logList = $('#log_list');
				logList.empty();
				if (response.logs && response.logs.length > 0) {
					response.logs.forEach(log => {
						const formattedDate = formatDate(log.pay_date);
						const formattedAmount = formatToRupiah(log.pay_amount);
						logList.append(`<li class="list-group-item text-info"><i class="ti ti-credit-card"></i> - ${formattedDate} sebesar ${formattedAmount}</li>`);
					});
				} else {

					logList.append(`<li class="list-group-item text-danger">Tidak ada riwayat pembayaran untuk transaksi ini.</li>`);
				}
			},
			error: function () {
				$('#log_list').html('<li class="list-group-item text-danger">Gagal memuat riwayat pembayaran.</li>');
			}
		});


		$("#payPiutangForm").on("submit", function (e) {
			e.preventDefault();

			const submitButton = $("#payPiutangForm button[type=submit]");
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
						url: base_url + "admin/piutang/add_pay",
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


	// LOG MODAL
	const logModal = document.getElementById('logPiutangModal');
	logModal.addEventListener('show.bs.modal', function (event) {
		const button = event.relatedTarget;
		const id = button.getAttribute('data-id_piutang');
		const name_log = button.getAttribute('data-name_log');
		const totals_log = button.getAttribute('data-totals_log');
		const paydate_log = button.getAttribute('data-paydate_log');
		const tgl_lunas_log = button.getAttribute('data-tgl_lunas_log');

		console.log('total amount piutang : '+ totals_log  );

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

		$('#name_log_display').text(name_log);
		$('#total_log_display').text(formatToRupiah(totals_log));
		$('#paydate_log_display').text(formatDate(paydate_log));
		$('#tgl_lunas_log_display').text(formatDate(tgl_lunas_log));


		$("#edit_id").val(id);

		$.ajax({
			url: base_url + 'admin/piutang/pay_logs',
			method: 'POST',
			data: { id_piutang: id },
			dataType: 'json',
			success: function (response) {
				const logList = $('#log_lists');
				logList.empty();
				if (response.logs && response.logs.length > 0) {
					response.logs.forEach(log => {
						const formattedDate = formatDate(log.pay_date);
						const formattedAmount = formatToRupiah(log.pay_amount);
						logList.append(`<li class="list-group-item text-info"><i class="ti ti-credit-card"></i> - ${formattedDate} sebesar ${formattedAmount}</li>`);
					});
				} else {

					logList.append(`<li class="list-group-item text-danger">Tidak ada riwayat pembayaran untuk transaksi ini.</li>`);
				}
			},
			error: function () {
				$('#log_list').html('<li class="list-group-item text-danger">Gagal memuat riwayat pembayaran.</li>');
			}
		});


	});

	//DELETE PIUTANG
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
				const base_url = $('meta[name="base_url"]').attr('content');
				$.ajax({
					url: base_url + 'admin/piutang/delete',
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
</script>
