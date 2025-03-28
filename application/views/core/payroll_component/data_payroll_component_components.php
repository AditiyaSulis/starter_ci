<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>



<!-- Modal Rincian Gaji -->
<div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
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
</div>


<script>

	//Print
	document.getElementById('downloadPdfBtn').addEventListener('click', function () {
		const modalBody = document.querySelector('.modal-body');

		html2canvas(modalBody, {
			scale: 1.5,
			useCORS: true,
			backgroundColor: '#ffffff'
		}).then(canvas => {
			const imgData = canvas.toDataURL('image/jpeg', 0.7);
			const { jsPDF } = window.jspdf;
			const pdf = new jsPDF('p', 'mm', 'a4');

			const imgWidth = 190; // Sesuaikan agar hampir penuh lebar A4
			const imgHeight = (canvas.height * imgWidth) / canvas.width;

			const marginX = 10; // Margin kiri agar tidak menempel ke tepi
			let posY = 10; // Mulai dari bagian atas halaman

			// Jika gambar lebih tinggi dari satu halaman, tambahkan fitur multi-halaman
			if (imgHeight > pdf.internal.pageSize.getHeight() - 20) {
				let remainingHeight = imgHeight;
				let currentY = posY;

				while (remainingHeight > 0) {
					const sliceHeight = Math.min(remainingHeight, pdf.internal.pageSize.getHeight() - 20);
					pdf.addImage(imgData, 'JPEG', marginX, currentY, imgWidth, sliceHeight, '', 'FAST');

					remainingHeight -= sliceHeight;
					if (remainingHeight > 0) {
						pdf.addPage();
						currentY = 10;
					}
				}
			} else {
				pdf.addImage(imgData, 'JPEG', marginX, posY, imgWidth, imgHeight, '', 'FAST');
			}

			pdf.save('Slip_Gaji.pdf');
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

		const total_potongan_telat = button.getAttribute('data-total-potongan-telat');

		document.getElementById('logoProduct').src = base+logo;

		const gaji_kotor = gaji+lembur+bonus+uang_makan;
		console.log("ID:", id);

		// Fungsi format Rupiah
		function formatToRupiah(number) {
			return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
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
