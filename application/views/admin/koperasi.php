<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
	.custom-card {
		background: linear-gradient(135deg, #1cb5e0, #000851);
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}

	.custom-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
	}


	/* === Select2 Metronic Dark/Light Mode === */
	.select2-container--bootstrap-5 .select2-selection {
		height: calc(1.5em + .75rem + 2px);
		padding: .375rem .75rem;
		font-size: 1rem;
		line-height: 1.5;
		border-radius: .475rem;

		background-color: var(--bs-body-bg);
		color: var(--bs-body-color);
		border: 1px solid var(--bs-border-color);

		display: flex;
		align-items: center;
		transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
	}

	/* Text */
	.select2-container--bootstrap-5 .select2-selection__rendered {
		color: var(--bs-body-color);
		padding-left: 0;
	}

	/* Placeholder */
	.select2-container--bootstrap-5 .select2-selection__placeholder {
		color: var(--bs-gray-500);
	}

	/* Arrow */
	.select2-container--bootstrap-5 .select2-selection__arrow {
		height: 100%;
	}

	/* Clear button */
	.select2-container--bootstrap-5 .select2-selection__clear {
		color: var(--bs-gray-500);
	}

	/* Focus (sama dengan Metronic input focus) */
	.select2-container--bootstrap-5.select2-container--focus .select2-selection {
		border-color: var(--bs-primary);
		box-shadow: 0 0 0 .25rem rgba(var(--bs-primary-rgb), .25);
	}

	/* Dropdown */
	.select2-dropdown {
		background-color: var(--bs-body-bg);
		border: 1px solid var(--bs-border-color);
		color: var(--bs-body-color);
	}

	/* Option */
	.select2-results__option {
		color: var(--bs-body-color);
	}

	/* Option hover */
	.select2-results__option--highlighted {
		background-color: var(--bs-primary);
		color: #fff;
	}

	/* Selected option */
	.select2-results__option--selected {
		background-color: var(--bs-gray-200);
		color: var(--bs-body-color);
	}

	/* === Dark Mode Adjustment (Metronic) === */
	[data-bs-theme="dark"] .select2-results__option--selected {
		background-color: var(--bs-gray-800);
	}


</style>

<main>
	<h1>Koperasi</h1>

	<div class="row">
		<div class="col-md-2 mt-10">
			<div class="card position-relative custom-card shadow-lg border-0 rounded-4 overflow-hidden">
				<div class="card-body py-4">
					<div class="text-white fw-bolder fs-3 mb-2">
                    <span class="text-white" data-category-id="jj">
                        Rp.<?= isset($saldo_pinjaman) ? number_format($saldo_pinjaman, 0, ',', '.') : '0' ?>
                    </span>
					</div>
					<div class="fw-semibold text-white opacity-75">Saldo Pinjaman</div>
				</div>

				<!-- Tombol dengan ikon + di pojok kanan bawah -->
				<button type="button" class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 m-3 shadow-sm"
						data-bs-toggle="modal" data-bs-target="#addSaldoKoperasiModal" title="Tambah Saldo">
					<i class="bi bi-plus-lg"></i>
				</button>
			</div>
		</div>
		<!--		<div class="col-md-2 mt-10">-->
		<!--			<div class="card position-relative custom-card shadow-lg border-0 rounded-4 overflow-hidden">-->
		<!--				<div class="card-body py-4">-->
		<!--					<div class="text-white fw-bolder fs-3 mb-2">-->
		<!--                    <span class="text-white" data-category-id="jj">-->
		<!--                        Rp.--><?php //= isset($saldo_kasbon) ? number_format($saldo_kasbon, 0, ',', '.') : '0' ?>
		<!--                    </span>-->
		<!--					</div>-->
		<!--					<div class="fw-semibold text-white opacity-75">Saldo Kasbon</div>-->
		<!--				</div>-->
		<!---->

		<!--				<button type="button" class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 m-3 shadow-sm"-->
		<!--						data-bs-toggle="modal" data-bs-target="#addSaldoKasbonKoperasiModal" title="Tambah Saldo">-->
		<!--					<i class="bi bi-plus-lg"></i>-->
		<!--				</button>-->
		<!--			</div>-->
		<!--		</div>-->
	</div>


	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addKoperasiModal">
		<i class="bi bi-plus-circle"></i>
		Add Koperasi
	</button>

	<ul class="nav nav-tabs mt-8 ms-5">
		<li class="nav-item">
			<a class="nav-link text-dark border border-bottom-0 rounded-top bg-hover-light" aria-current="page" href="<?=base_url('admin/Koperasi/koperasi_paid_page?status=1')?>">Paid</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active text-info " href="<?=base_url('admin/Koperasi/koperasi_page?status=2')?>">Unpaid</a>
		</li>
	</ul>

	<?php $this->load->view($view_data);?>

	<!-- Modal Add Koperasi -->
	<div class="modal fade" tabindex="-1" id="addKoperasiModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Add Koperasi</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/Koperasi/add_koperasi') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Karyawan</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select select-karyawan" aria-label="Default select example" name="id_employee">
								<option value='' selected>-Karyawan-</option>
								<?php foreach($data_karyawan as $emp):?>
									<option value="<?=$emp->id_employee?>"><?=$emp->name.' ('.$emp->name_product.')'?></option>
								<?php endforeach;?>
							</select>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Input</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="koperasi_date" autocomplete="off" class="form-control bg-transparent" />
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Amount</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" name="amount_koperasi" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div id="tenor-form" style="display: block;">
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Jangka Pinjaman</span>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Satuan</span>
								<input type="number" class="form-control" min="1" name="tenor_koperasi" placeholder="" value="1" aria-label="Username">
								<span class="input-group-text">Type</span>
								<select class="form-select" aria-label="Default select example" name="type_tenor" id="type_tenor">
									<option value="1">Hari</option>
									<option value="2">Minggu</option>
									<option value="3" selected>Bulan</option>
									<option value="4">Tahun</option>
								</select>
							</div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Angsuran</span>
							</div>
							<div class="fv-row mb-8">
								<input type="text" name="angsuran" autocomplete="off" class="form-control bg-transparent" />
							</div>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jatuh Tempo (Tanggal)</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Lunas</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tgl_lunas" value="<?= date("Y-m-d") ?>" name="tgl_lunas" autocomplete="off" class="form-control bg-transparent" />
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Add Koperasi
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

	<!-- Modal Add Saldo pinjaman-->
	<div class="modal fade" id="addSaldoKoperasiModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLabel">Saldo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<form id="addSaldoForm">
								<div class="mb-3">
									<label for="form_text1" class="form-label">Saldo</label>
									<input type="text" class="form-control" id="saldo" placeholder="Rp.1xxxx" name="nominal" oninput="rupiahCurrency(this)">
									<input type="hidden"  value="1" name="type_saldo" >
								</div>
								<div class="d-grid mb-10 mt-10">
									<button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">
                                                Tambah Saldo pinjaman
                                            </span>
										<span class="indicator-progress">
                                                Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
									</button>
								</div>
							</form>
						</div>
						<div class="row">
							<div class="col mb-2">
								<a href="<?= base_url('admin/Koperasi/riwayat_saldo/1')?>">Riwayat Saldo <i class="bi bi-box-arrow-up-right ms-1" style="color: #0d6efd"></i></a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Add Saldo Kasbon-->
	<!--	<div class="modal fade" id="addSaldoKasbonKoperasiModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">-->
	<!--		<div class="modal-dialog modal-sm modal-dialog-centered">-->
	<!--			<div class="modal-content">-->
	<!--				<div class="modal-header">-->
	<!---->
	<!--					<h5 class="modal-title" id="exampleModalLabel">Saldo</h5>-->
	<!--					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
	<!--				</div>-->
	<!--				<div class="modal-body">-->
	<!--					<div class="row">-->
	<!--						<div class="col">-->
	<!--							<form id="addSaldoKasbonForm">-->
	<!--								<div class="mb-3">-->
	<!--									<label for="form_text1" class="form-label">Saldo</label>-->
	<!--									<input type="text" class="form-control" id="nominal" placeholder="Rp.1xxxx" name="nominal" oninput="rupiahCurrency(this)">-->
	<!--									<input type="hidden"  value="2" name="type_saldo" >-->
	<!--								</div>-->
	<!--								<div class="d-grid mb-10 mt-10">-->
	<!--									<button type="submit" class="btn btn-primary">-->
	<!--                                            <span class="indicator-label">-->
	<!--                                                Tambah Saldo kasbon-->
	<!--                                            </span>-->
	<!--										<span class="indicator-progress">-->
	<!--                                                Please wait...-->
	<!--                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>-->
	<!--                                            </span>-->
	<!--									</button>-->
	<!--								</div>-->
	<!--							</form>-->
	<!--						</div>-->
	<!--						<div class="row">-->
	<!--							<div class="col mb-2">-->
	<!--								<a href="--><?php //= base_url('admin/Koperasi/riwayat_saldo/2')?><!--">Riwayat Saldo Kasbon <i class="bi bi-box-arrow-up-right ms-1" style="color: #0d6efd"></i></a>-->
	<!--							</div>-->
	<!--						</div>-->
	<!---->
	<!--					</div>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->

	<!-- Modal Pay-->
	<?php $this->load->view($view_components);?>

	<script>
		const base_url = $('meta[name="base_url"]').attr('content');

		//select option karyawan
		$(document).ready(function() {
			$('.select-karyawan').select2({
				theme: 'bootstrap-5',
				placeholder: '-Cari Karyawan-',
				allowClear: true,
				dropdownParent: $('#addKoperasiModal')
			});
		});



	//TENOR FORM
		document.addEventListener('DOMContentLoaded', function () {
			const typePiutangSelect = document.getElementById('type_koperasi');
			const additionalForm = document.getElementById('tenor-form');


			typePiutangSelect.addEventListener('change', function () {
				if (this.value === '1') {
					additionalForm.style.display = 'block';
				} else {
					additionalForm.style.display = 'none';
				}
			});
		});

		document.addEventListener("DOMContentLoaded", function () {
			const amountInput = document.querySelector("input[name='amount_koperasi']");
			const tenorInput = document.querySelector("input[name='tenor_koperasi']");
			const angsuranInput = document.querySelector("input[name='angsuran']");
			const type = document.querySelector("input[name='type_tenor']");
			console.log('tenor_type : ' + type);

			const jatuhTempoInput = document.getElementById("tgl_jatuh_tempo");
			const typeTenorSelect = document.getElementById("type_tenor");
			const tglLunasInput = document.getElementById("tgl_lunas");


			const calculateAngsuran = () => {
				const amount = parseFloat(amountInput.value) || 0;
				const tenor = parseFloat(tenorInput.value) || 0;
				// const tenor_type = parseFloat(type.value) || 0;

				if (tenor > 0 ) {
					angsuranInput.value = (amount / tenor).toFixed(2);
				} else {
					angsuranInput.value = "";
				}
			};

			function calculateTanggalLunas() {
				//const jatuhTempo = parseInt(jatuhTempoInput.value, 10) || 0;
				const tenor = parseInt(tenorInput.value, 10) || 0;
				const typeTenor = parseInt(typeTenorSelect.value, 10);

				let totalDays = 0;

				switch (typeTenor) {
					case 1:
						totalDays += tenor;
						break;
					case 2:
						totalDays += tenor * 7;
						break;
					case 3:
						totalDays += tenor * 30;
						break;
					case 4:
						totalDays += tenor * 365;
						break;
					default:
						break;
				}
				const currentDate = new Date();
				currentDate.setDate(currentDate.getDate() + totalDays);
				const year = currentDate.getFullYear();
				const month = String(currentDate.getMonth() + 1).padStart(2, '0');
				const day = String(currentDate.getDate()).padStart(2, '0');

				tglLunasInput.value = `${year}-${month}-${day}`;
			}

			//jatuhTempoInput.addEventListener("input", calculateTanggalLunas);
			tenorInput.addEventListener("input", calculateTanggalLunas);
			typeTenorSelect.addEventListener("change", calculateTanggalLunas);


			amountInput.addEventListener("input", calculateAngsuran);
			tenorInput.addEventListener("input", calculateAngsuran);
		});

		// $(document).ready(function() {
		// 	const base_url = $('meta[name="base_url"]').attr('content');
		//
		// 	$("#addSaldoForm").on("submit", function (e) {
		// 		e.preventDefault();
		//
		// 		const submitButton = $("#addSaldoForm button[type=submit]");
		// 		submitButton.prop("disabled", true).text("Processing...");
		//
		// 		Swal.fire({
		// 			title: 'Apakah Anda yakin?',
		// 			text: "Agar tidak terjadi kesalahan, cek kembali saldo yang anda input!",
		// 			icon: 'warning',
		// 			showCancelButton: true,
		// 			confirmButtonColor: '#d33',
		// 			cancelButtonColor: '#3085d6',
		// 			confirmButtonText: 'Bayar',
		// 			cancelButtonText: 'Batal',
		// 		}).then((result) => {
		// 			if (result.isConfirmed) {
		// 				$.ajax({
		// 					url: base_urls + "admin/Koperasi/add_saldo",
		// 					type: "POST",
		// 					data: $(this).serialize(),
		// 					dataType: "json",
		// 					success: function (response) {
		// 						if (response.status) {
		// 							swallMssg_s(response.message, false, 1500)
		// 								.then(() => {
		// 									location.reload();
		// 								});
		// 						} else {
		// 							swallMssg_e(response.message, true, 0);
		// 							submitButton.prop("disabled", false).text("Submit");
		// 						}
		// 					},
		// 					error: function (xhr, status, error) {
		// 						swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
		// 							.then(() => {
		// 								location.reload();
		// 							});
		// 						submitButton.prop("disabled", false).text("Submit");
		// 					}
		// 				});
		// 			}
		// 		});
		// 	});
		//
		// 	$("#addSaldoKasbonForm").on("submit", function (e) {
		// 		e.preventDefault();
		//
		// 		const submitButton = $("#addSaldoKasbonForm button[type=submit]");
		// 		submitButton.prop("disabled", true).text("Processing...");
		//
		// 		Swal.fire({
		// 			title: 'Apakah Anda yakin?',
		// 			text: "Agar tidak terjadi kesalahan, cek kembali saldo yang anda input!",
		// 			icon: 'warning',
		// 			showCancelButton: true,
		// 			confirmButtonColor: '#d33',
		// 			cancelButtonColor: '#3085d6',
		// 			confirmButtonText: 'Bayar',
		// 			cancelButtonText: 'Batal',
		// 		}).then((result) => {
		// 			if (result.isConfirmed) {
		// 				$.ajax({
		// 					url: base_urls + "admin/Koperasi/add_saldo",
		// 					type: "POST",
		// 					data: $(this).serialize(),
		// 					dataType: "json",
		// 					success: function (response) {
		// 						if (response.status) {
		// 							swallMssg_s(response.message, false, 1500)
		// 								.then(() => {
		// 									location.reload();
		// 								});
		// 						} else {
		// 							swallMssg_e(response.message, true, 0);
		// 							submitButton.prop("disabled", false).text("Submit");
		// 						}
		// 					},
		// 					error: function (xhr, status, error) {
		// 						swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
		// 							.then(() => {
		// 								location.reload();
		// 							});
		// 						submitButton.prop("disabled", false).text("Submit");
		// 					}
		// 				});
		// 			}
		// 		});
		// 	});
		// });


		//convert currency
		function rupiahCurrency(input) {
			let value = input.value.replace(/[^0-9]/g, ""); // Hanya angka
			if (value === "") {
				input.value = "";
				return;
			}

			let formatted = new Intl.NumberFormat("id-ID").format(value);
			input.value = formatted;
		}

		document.getElementById("addSaldoForm").addEventListener("submit", function() {
			let input = document.querySelector("input[name='nominal']");
			if (input.value !== "") {
				input.value = input.value.replace(/\./g, ""); // Hapus semua titik sebelum submit
			}
		});

		// document.getElementById("addSaldoKasbonForm").addEventListener("submit", function() {
		// 	let input = document.querySelector("input[id='nominal']");
		// 	if (input.value !== "") {
		// 		input.value = input.value.replace(/\./g, ""); // Hapus semua titik sebelum submit
		// 	}
		// });
	</script>
</main>


