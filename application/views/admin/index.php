
<main>
    <?php if ($this->session->flashdata('authorize')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('authorize'); ?>
    </div>
    <?php endif; ?>
    <h1>Dashboard</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?= $allSuperUsers ?>">
												<?= $allSuperUsers ?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Super Users</div>
									</div>

									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-fill-gear" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?= $allAdmins ?>">
												<?=$allAdmins?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Admins</div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-lines-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
										<span class="text-success" data-category-id="<?= $allUsers ?>">
											<?= $allUsers?>
										</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Users </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-people-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col">
						<div class="card bg-body">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
									<div class="text-gray-900 fw-bolder fs-2">
										<span class="text-success" data-category-id="<?= $allProducts ?>">
											<?= $allProducts?>
										</span>
									</div>
									<div class="fw-bold text-gray-800">
										 Products </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-buildings-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?= $allEmployees ?>">
												<?= $allEmployees?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Employees </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-badge-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?= $allRecords ?>">
												<?= $allRecords?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											Finance Records </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-currency-exchange"` style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>
		</div>
	</div>


	<!-- Card Piutang -->
	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
		<h3>Piutang</h3>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body bg-light-warning bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalJatuhTempo ?>">
										<?= $totalJatuhTempo ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Tanggal <span class="text-danger" style="font-weight: bold"><?= date("d")?> - <?=date('d', strtotime('+3 days'))?> </span></div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-bell-fill" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>

					<div class="bg-light-danger bg-gradient progress-bar-striped py-3 px-6 rounded-bottom-2">
						<div class="row align-items-center" >
							<div class="col-md-10">
									<span class="text-dark" style="font-weight: bold ">
										Cek piutang yang jatuh tempo
									</span>
							</div>
							<div class="col-md-2">
								<i class="bi bi-arrow-right-circle icon-check-piutang" onclick="showJatuhTempo()" style="font-size:2rem;" ></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">
			<div class="col">
				<div class="card bg-body bg-light bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalUnpaid ?>">
										<?= $totalUnpaid ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Unpaid </div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-box-arrow-left" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col">
				<div class="card bg-body bg-light bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalPaid ?>">
										<?= $totalPaid ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Paid </div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-box-arrow-in-right" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>


	<!-- Modal datatables -->
	<div class="modal" id="jatuhTempoModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Jatuh tempo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php $this->load->view($view_data);?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<a href="<?= base_url('admin/piutang/piutang_page')?>" class="btn btn-primary" >See All</a>
				</div>
			</div>
		</div>
	</div>

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



	<script>
		const base_url = $('meta[name="base_url"]').attr('content');

		// $(document).ready(function() {
		//
		// }
		// $('#jatuhtempo_table').DataTable({
		// 	responsive: true,
		// 	scrollX: true,
		// 	autoWidth: false,
		// 	columnDefs: [
		// 		{ width: '150px', targets: [2, 3, 4, 5] },
		// 		{ className: "text-nowrap", targets: "_all" }
		// 	]
		// });

		function showJatuhTempo(){

			$("#jatuhTempoModal").modal("show");
		}


		const exampleModal = document.getElementById('payPiutangModal');
		exampleModal.addEventListener('show.bs.modal', function (event) {
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



	</script>

</main>
