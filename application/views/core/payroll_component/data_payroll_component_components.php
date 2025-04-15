<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style id="pdf-desktop-style" type="text/css" media="print">
	.desktop-pdf-style {
		width: 800px !important;
		font-size: 12px !important;
	}
	.desktop-pdf-style .row {
		display: flex;
		flex-wrap: nowrap;
		flex-direction: row;
	}
	.desktop-pdf-style .col-12,
	.desktop-pdf-style .col-sm-4,
	.desktop-pdf-style .col-sm-8,
	.desktop-pdf-style .col-md-5,
	.desktop-pdf-style .col-md-7 {
		flex: none;
		width: auto !important;
		max-width: none !important;
	}
	}
</style>

<!-- Modal Rincian Gaji -->
<!--MODAL LAMA :-->
<!-- <div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Slip Gaji Karyawan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center text-center mb-4">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="col-auto">
							<img id="logoProduct" src="<?= base_url('uploads/products/compressed/2aa82d30d575861616920a6ad9c99edd.png')?>" width="200px" height="140px" alt="">
						</div>
						<div class="col-auto text-start">
							<h4 id="name_product"></h4>
							<div class="d-flex">
								<h6>Periode : &nbsp;</h6>
								<h6 id="periode_gajian"></h6>
								<h6> - </h6>
								<h6 id="tanggal_gajian"></h6>
							</div>
							<div class="d-flex">
								<span id="kode" class="text-sm"></span>
							</div>
						</div>
						<br>
						<hr>
					</div>
				</div>
				<div class="row mb-1 mt-10">
					<div class="col-1 col-md-1"><span>NIP </span></div>
					<div class="col-6 col-md-6"><span> : </span><span id="nip_employee" class="ms-4"></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Nama </span></div>
					<div class="col-6 col-md-6"><span> : </span><span id="name_employee" class="ms-4"></span></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Product </span></div>
					<div class="col-6 col-md-6"><span> : </span><span id="product_employee" class="ms-4"></span></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-m-1"><span>Divisi </span></div>
					<div class="col-6 col-md-6"><span> : </span><span id="division_employee" class="ms-4"></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Position </span></div>
					<div class="col-6 col-md-6"><span> : </span><span id="position_employee" class="ms-4"></div>
				</div>

				<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
					<div class="row">
						<div class="col-md-5 col-5">
							<h3>Penghasilan</h3>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Gaji Pokok </span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="gaji_pokok" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Uang Makan </span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="uang_makan" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Lembur</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="lembur" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Bonus</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="bonus" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Total Gaji</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="total_gaji" class="ms-4"></div>
							</div>
						</div>
						<div class="col-md-7 col-7">
							<h2>Potongan</h2>
							<div class="row mb-1">
								<div class="col-5 col-md-5"><span>Potongan Tidak Hadir</span></div>
								<div class="col-7 col-md-7"><span> = </span><span id="total_pot_absen" class="ms-4 fw-bolder"> </span>(<span id="pot_absen"> </span> x <span id="absen_pc"></span>)</div>
							</div>
							<div class="row mb-1">
								<div class="col-5 col-md-5"><span>Potongan Kasbon</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="pot_kasbon" class="ms-4 fw-bolder"> </span></div>
							</div>
							<div class="row mb-1">
								<div class="col-5 col-md-5"><span>Keterlambatan</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="pot_telat" class="ms-4 fw-bolder"> </span></div>
							</div>
							<div class="row mb-1">
								<div class="col-5 col-md-5"><span>Potongan Uang makan</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="pot_uang_makan" class="ms-4 fw-bolder"> </span></div>
							</div>
							<div class="row mb-1">
								<div class="col-5 col-md-5"><span>Total Potongan</span></div>
								<div class="col-6 col-md-6"><span> = </span><span id="total_potongan" class="ms-4"></div>
							</div>
						</div>
					</div>

					<div class="table-responsive mt-5">
						<table id="table" class="table table-bordered table-striped text-center align-middle table-success" style="width:100%">
							<thead class="bg-light-primary">
								<tr>
									<th>Gaji Bersih</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										Total Gaji - Total Potongan - PPH = Gaji Bersih
									</td>
								</tr>
								<tr>
									<td>
										<span id="rms_total_gaji"></span> - <span id="rms_potongan_gaji"> </span> -  <span id="pot_pph"> </span> = <span id="gaji_bersih"></span>
									</td>
								</tr>
								<tr>
									<td id="gaji_bersih_anda" class="fw-bolder">

									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button id="downloadPdfBtn" class="btn btn-primary">Download PDF</button>
			</div>
		</div>
	</div>
</div> -->
<!--END MODAL LAMA-->
<!--MODAL BARU-->
<div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Slip Gaji Karyawan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<!-- Header Info -->
				<div class="text-center mb-4">
					<div class="row justify-content-center align-items-center">
						<div class="col-12 col-sm-4 text-center mb-3 mb-sm-0">
							<img id="logoProduct" src="<?= base_url('uploads/products/compressed/2aa82d30d575861616920a6ad9c99edd.png') ?>" class="img-fluid" style="max-height: 120px;" alt="Logo Produk">
						</div>
						<div class="col-12 col-sm-8 text-start">
							<h4 id="name_product" class="mb-1 fw-bold"></h4>
							<div><strong>Periode:</strong> <span id="periode_gajian"></span> - <span id="tanggal_gajian"></span></div>
							<div><small id="kode" class="text-muted"></small></div>
						</div>
					</div>
					<hr class="mt-4">
				</div>

				<!-- Employee Info -->
				<div class="mb-4">
					<h5 class="fw-bold mb-3">Data Karyawan</h5>
					<table style="width: 100%; font-size: 14px;">
						<tr>
							<td style="width: 100px;"><strong>NIP</strong></td>
							<td style="width: 10px;">:</td>
							<td id="nip_employee"></td>
						</tr>
						<tr>
							<td><strong>Nama</strong></td>
							<td>:</td>
							<td id="name_employee"></td>
						</tr>
						<tr>
							<td><strong>Product</strong></td>
							<td>:</td>
							<td id="product_employee"></td>
						</tr>
						<tr>
							<td><strong>Divisi</strong></td>
							<td>:</td>
							<td id="division_employee"></td>
						</tr>
						<tr>
							<td><strong>Position</strong></td>
							<td>:</td>
							<td id="position_employee"></td>
						</tr>
					</table>
				</div>




				<!-- Gaji dan Potongan -->
				<div class="bg-light rounded p-3">
					<div class="row gy-4">
						<!-- Penghasilan -->
						<div class="col-12 col-md-5">
							<h5 class="fw-bold mb-3">Penghasilan</h5>
							<div class="d-flex justify-content-between"><span>Gaji Pokok</span><span id="gaji_pokok"></span></div>
							<div class="d-flex justify-content-between"><span>Uang Makan</span><span id="uang_makan"></span></div>
							<div class="d-flex justify-content-between"><span>Lembur</span><span id="lembur"></span></div>
							<div class="d-flex justify-content-between"><span>Bonus</span><span id="bonus"></span></div>
							<hr>
							<div class="d-flex justify-content-between fw-bold"><span>Total Gaji</span><span id="total_gaji"></span></div>
							<hr>
						</div>


						<!-- Potongan -->
						<div class="col-12 col-md-7 ps-8">
							<h5 class="fw-bold mb-3">Potongan</h5>
							<div class="d-flex justify-content-between"><span>Absen</span> <small>(<span id="pot_absen"></span> x <span id="absen_pc"></span>)</small> <span id="total_pot_absen"></span> </div>
							<div class="d-flex justify-content-between"><span>Kasbon</span><span id="pot_kasbon"></span></div>
							<div class="d-flex justify-content-between"><span>Keterlambatan</span><span id="pot_telat"></span></div>
							<div class="d-flex justify-content-between"><span>Uang Makan</span><span id="pot_uang_makan"></span></div>
							<hr>
							<div class="d-flex justify-content-between fw-bold"><span>Total Potongan</span><span id="total_potongan"></span></div>
							<hr>
						</div>
					</div>

					<!-- Gaji Bersih -->
					<div class="mt-5 bg-primary bg-opacity-25 p-3 rounded">
					<table class="table table-bordered text-center align-middle table-striped">
							<thead class="table-light">
							<tr>
								<th>Perhitungan Gaji Bersih</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Total Gaji - Total Potongan - PPH = Gaji Bersih</td>
							</tr>
							<tr>
								<td>
									<span id="rms_total_gaji"></span> -
									<span id="rms_potongan_gaji"></span> -
									<span id="pot_pph"></span> =
									<span id="gaji_bersih"></span>
								</td>
							</tr>
							<tr>
								<td id="gaji_bersih_anda" class="fw-bold fs-4 text-success"></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<div class="modal-footer d-flex justify-content-center">
				<button id="downloadPdfBtn" class="btn btn-primary w-100 w-sm-auto">Download PDF</button>
			</div>
		</div>
	</div>
</div>
<!--END MODAL BARU-->




<script>

	//Print
	document.getElementById('downloadPdfBtn').addEventListener('click', function () {
		const modalBody = document.querySelector('#rincianModal .modal-body');

		// Clone dan siapkan elemen untuk PDF
		const clone = modalBody.cloneNode(true);
		const container = document.createElement('div');
		container.style.position = 'absolute';
		container.style.top = '-9999px';
		container.style.left = '-9999px';
		container.style.width = '800px';
		container.style.fontSize = '12px';
		container.classList.add('desktop-pdf-style');
		container.style.backgroundColor = 'white';
		container.appendChild(clone);
		document.body.appendChild(container);

		// Tambahkan style desktop ke dalam container
		const style = document.createElement('style');
		style.innerHTML = `
			.desktop-pdf-style * {
				box-sizing: border-box;
			}

			/* Buat row behave seperti desktop */
			.desktop-pdf-style .row {
				display: flex;
				flex-wrap: wrap;
				margin-right: -0.5rem;
				margin-left: -0.5rem;
			}

			/* Bootstrap col fix */
			.desktop-pdf-style .col-12 {
				flex: 0 0 100%;
				max-width: 100%;
				padding-right: 0.5rem;
				padding-left: 0.5rem;
			}

			.desktop-pdf-style .col-sm-4 {
				flex: 0 0 33.3333%;
				max-width: 33.3333%;
			}
			.desktop-pdf-style .col-sm-8 {
				flex: 0 0 66.6666%;
				max-width: 66.6666%;
			}
			.desktop-pdf-style .col-md-5 {
				flex: 0 0 41.666667%;
				max-width: 41.666667%;
			}
			.desktop-pdf-style .col-md-7 {
				flex: 0 0 58.333333%;
				max-width: 58.333333%;
			}

			/* Hindari img pecah & potong */
			.desktop-pdf-style img {
				max-width: 100%;
				height: auto;
				display: block;
			}

			/* Tambahkan space antar kolom kalau perlu */
			.desktop-pdf-style .row > [class^='col-'] {
				padding: 0.5rem;
			}

			/* Tambahkan clear layout potongan gaji */
			.desktop-pdf-style .d-flex {
				display: flex;
				justify-content: space-between;
			}

			/* Background putih & padding stabil */
			.desktop-pdf-style {
				background: #fff;
				color: #000;
				padding: 1rem;
			}
		`;
		container.appendChild(style);


		// Proses html2canvas
		html2canvas(container, {
			scale: 2,
			useCORS: true,
			backgroundColor: '#ffffff'
		}).then(canvas => {
			const imgData = canvas.toDataURL('image/jpeg', 0.9);
			const { jsPDF } = window.jspdf;
			const pdf = new jsPDF('p', 'mm', 'a4');

			const imgWidth = 190;
			const imgHeight = (canvas.height * imgWidth) / canvas.width;

			let posY = 10;
			let pageHeight = pdf.internal.pageSize.getHeight() - 20;

			if (imgHeight > pageHeight) {
				let heightLeft = imgHeight;
				let currentY = posY;

				while (heightLeft > 0) {
					pdf.addImage(imgData, 'JPEG', 10, currentY, imgWidth, imgHeight, '', 'FAST');
					heightLeft -= pageHeight;
					if (heightLeft > 0) {
						pdf.addPage();
						currentY = 10;
					}
				}
			} else {
				pdf.addImage(imgData, 'JPEG', 10, posY, imgWidth, imgHeight, '', 'FAST');
			}

			pdf.save('Slip_Gaji.pdf');

			document.body.removeChild(container);
		});
	});



	// LOG
	const exampleModal = document.getElementById('rincianModal');
	exampleModal.addEventListener('show.bs.modal', function (event) {
		const button = event.relatedTarget;
		const base = "<?= base_url('uploads/products/compressed/')?>"

		const id = button.getAttribute('data-id-payroll-component');
		const absen = parseFloat(button.getAttribute('data-total-absent')) || 0;
		const lembur = parseFloat(button.getAttribute('data-total-lembur')) || 0;
		const dayoff = parseFloat(button.getAttribute('data-total-dayoff')) || 0;
		const gaji = parseFloat(button.getAttribute('data-basic-salary')) || 0;
		const bonus = parseFloat(button.getAttribute('data-bonus')) || 0;
		const potongan_absen = parseFloat(button.getAttribute('data-potongan-absen')) || 0;
		const absen_hari = parseFloat(button.getAttribute('data-absen-hari')) || 0;
		const total_potongan = parseFloat(button.getAttribute('data-total-potongan')) || 0;
		const nip = button.getAttribute('data-nip');
		const name = button.getAttribute('data-name');
		const product = button.getAttribute('data-product');
		const divisi = button.getAttribute('data-divisi');
		const position = button.getAttribute('data-position');
		const piutang = button.getAttribute('data-piutang');
		const tanggal_gajian = button.getAttribute('data-tanggal-gajian');
		const periode_gajian = button.getAttribute('data-periode-gajian');
		const pph = button.getAttribute('data-pph');
		const total = button.getAttribute('data-gaji-bersih');
		const total_gaji_bersih = button.getAttribute('data-total-gaji-bersih');
		const code = button.getAttribute('data-code-payroll');
		const logo = button.getAttribute('data-logo');
		const uang_makan = parseFloat(button.getAttribute('data-uang-makan')) || 0;
		const pot_uang_makan = parseFloat(button.getAttribute('data-pot-uang-makan')) || 0;
		const uang_makan_bersih = parseFloat(button.getAttribute('data-uang-makan-bersih')) || 0;
		const pot_piutang = parseFloat(button.getAttribute('data-piutang')) || 0;

		const total_potongan_telat = button.getAttribute('data-total-potongan-telat');

		document.getElementById('logoProduct').src = base+logo;

		const gaji_kotor = gaji+lembur+bonus+uang_makan;
		console.log("ID:", id);

		// Fungsi format Rupiah
		function formatToRupiah(number) {
			return new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',
				minimumFractionDigits: 0,
				maximumFractionDigits: 0
			}).format(number);
		}

		// Fungsi format tanggal
		function formatDate(dateString) {
			if (!dateString) return '-';
			const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
			return new Date(dateString).toLocaleDateString('id-ID', options);
		}

		// Masukkan data ke dalam modal
		$('#absen_pc').text(absen);
		$('#gaji_pokok').text(formatToRupiah(gaji));

		$('#bonus').text(formatToRupiah(bonus));
		$('#lembur').text(formatToRupiah(lembur));
		$('#pot_absen').text(formatToRupiah(absen_hari));
		$('#total_potongan').text(formatToRupiah(total_potongan));


		$('#pot_telat').text(formatToRupiah(total_potongan_telat));
		$('#uang_makan').text(formatToRupiah(uang_makan));
		$('#pot_uang_makan').text(formatToRupiah(pot_uang_makan));
		$('#uang_makan_bersih').text(formatToRupiah(uang_makan_bersih));
		$('#pot_piutang').text(formatToRupiah(pot_piutang));



		$('#nip_employee').text(nip);
		$('#name_employee').text(name);
		$('#product_employee').text(product);
		$('#name_product').text(product);
		$('#division_employee').text(divisi);
		$('#position_employee').text(position);
		$('#tanggal_gajian').text(formatDate(tanggal_gajian));
		$('#periode_gajian').text(formatDate(periode_gajian));
		$('#total_gaji').text(formatToRupiah(gaji_kotor));
		$('#pot_kasbon').text(formatToRupiah(piutang));
		$('#total_pot_absen').text(formatToRupiah(potongan_absen));
		$('#rms_total_gaji').text(formatToRupiah(gaji_kotor));
		$('#rms_potongan_gaji').text(formatToRupiah(total_potongan));
		$('#gaji_bersih').text(formatToRupiah(total_gaji_bersih));
		$('#pot_pph').text(formatToRupiah(pph));
		$('#gaji_bersih_anda').text(formatToRupiah(total_gaji_bersih));
		$('#kode').text(code);

		$("#edit_id").val(id);
	});

	// Prevent multiple form submissions
	function preventMultipleSubmit(form) {
		const submitButton = form.querySelector('button[type="submit"]');
		if (submitButton) {
			submitButton.disabled = true;
			submitButton.textContent = 'Submitting...';
		}
		return true;
	}

	// Fungsi Hapus
	function handleDeletePayrollComponentButton(id) {
		console.log('ID yang akan dihapus:', id);
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
					url: base_url + 'admin/payroll/delete',
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
