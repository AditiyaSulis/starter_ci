
<!-- Modal Rincian Gaji -->
<div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Slip Gaji Karyawan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center text-center mb-10">
					<h4 id="name_product"></h4>
					<div class="d-flex">
						<h6>Pada tanggal : &nbsp;</h6>
						<h6 id="tanggal_gajian"></h6>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>NIP </span></div>
					<div class="col-5 col-md-5"><span> : </span><span id="nip_employee" class="ms-4"></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Nama </span></div>
					<div class="col-5 col-md-5"><span> : </span><span id="name_employee" class="ms-4"></span></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Product </span></div>
					<div class="col-5 col-md-5"><span> : </span><span id="product_employee" class="ms-4"></span></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Divisi </span></div>
					<div class="col-5 col-md-5"><span> : </span><span id="division_employee" class="ms-4"></div>
				</div>
				<div class="row mb-1">
					<div class="col-1 col-md-1"><span>Position </span></div>
					<div class="col-5 col-md-5"><span> : </span><span id="position_employee" class="ms-4"></div>
				</div>

				<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
					<div class="row">
						<div class="col-md-6 col-6">
							<h3>Penghasilan</h3>
							<div class="row mb-1">
								<div class="col-3 col-md-3"><span>Gaji Pokok </span></div>
								<div class="col-4 col-md-4"><span> = </span><span id="gaji_pokok" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-3 col-md-3"><span>Uang Makan</span></div>
								<div class="col-4 col-md-4"><span> = </span><span id="uang_makan" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-3 col-md-3"><span>Lembur</span></div>
								<div class="col-4 col-md-4"><span> = </span><span id="lembur" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-3 col-md-3"><span>Bonus</span></div>
								<div class="col-4 col-md-4"><span> = </span><span id="bonus" class="ms-4"></div>
							</div>
							<div class="row mb-1">
								<div class="col-3 col-md-3"><span>Total Gaji</span></div>
								<div class="col-4 col-md-4"><span> = </span><span id="total_gaji" class="ms-4"></div>
							</div>
						</div>
						<div class="col-md-6 col-6">
							<h2>Potongan</h2>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Potongan Izin</span></div>
								<div class="col-5 col-md-5"><span> = </span><span id="total_pot_izin" class="ms-4 fw-bolder"> </span>(<span id="pot_izin"> </span> x <span id="izin_pc"></span>)</div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Potongan Tidak Hadir</span></div>
								<div class="col-5 col-md-5"><span> = </span><span id="total_pot_absen" class="ms-4 fw-bolder"> </span>(<span id="pot_absen"> </span> x <span id="absen_pc"></span>)</div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Potongan Kasbon</span></div>
								<div class="col-5 col-md-5"><span> = </span><span id="pot_kasbon" class="ms-4 fw-bolder"> </span></div>
							</div>
							<div class="row mb-1">
								<div class="col-4 col-md-4"><span>Total Potongan</span></div>
								<div class="col-5 col-md-5"><span> = </span><span id="total_potongan" class="ms-4"></div>
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
										Total Gaji - Total Potongan = Gaji Bersih
									</td>
								</tr>
								<tr>
									<td>
									<span id="rms_total_gaji"></span> - <span id="rms_potongan_gaji"></span> = <span id="gaji_bersih"></span>
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
		</div>
	</div>
</div>


<script>

	// LOG
	const exampleModal = document.getElementById('rincianModal');
	exampleModal.addEventListener('show.bs.modal', function (event) {
		const button = event.relatedTarget;

		const id = button.getAttribute('data-id-payroll-component');
		const izin = parseFloat(button.getAttribute('data-total-izin')) || 0;
		const cuti = parseFloat(button.getAttribute('data-total-cuti')) || 0;
		const absen = parseFloat(button.getAttribute('data-total-absent')) || 0;
		const lembur = parseFloat(button.getAttribute('data-total-overtime')) || 0;
		const dayoff = parseFloat(button.getAttribute('data-total-dayoff')) || 0;
		const gaji = parseFloat(button.getAttribute('data-basic-salary')) || 0;
		const uang_makan = parseFloat(button.getAttribute('data-uang-makan')) || 0;
		const bonus = parseFloat(button.getAttribute('data-bonus')) || 0;
		const potongan_absen = parseFloat(button.getAttribute('data-potongan-absen')) || 0;
		const potongan_izin = parseFloat(button.getAttribute('data-potongan-izin')) || 0;
		const absen_hari = parseFloat(button.getAttribute('data-absen-hari')) || 0;
		const izin_hari = parseFloat(button.getAttribute('data-izin-hari')) || 0;
		const total_potongan = parseFloat(button.getAttribute('data-total-potongan')) || 0;
		const nip = button.getAttribute('data-nip');
		const name = button.getAttribute('data-name');
		const product = button.getAttribute('data-product');
		const divisi = button.getAttribute('data-divisi');
		const position = button.getAttribute('data-position');
		const piutang = button.getAttribute('data-piutang');
		const tanggal_gajian = button.getAttribute('data-tanggal-gajian');
		const total = button.getAttribute('data-gaji-bersih');
		const gaji_kotor = gaji+uang_makan+lembur+bonus;
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
		$('#izin_pc').text(izin);
		$('#absen_pc').text(absen);
		$('#gaji_pokok').text(formatToRupiah(gaji));
		$('#uang_makan').text(formatToRupiah(uang_makan));
		$('#bonus').text(formatToRupiah(bonus));
		$('#lembur').text(formatToRupiah(lembur));
		$('#pot_absen').text(formatToRupiah(absen_hari));
		$('#pot_izin').text(formatToRupiah(izin_hari));
		$('#total_potongan').text(formatToRupiah(total_potongan));

		$('#nip_employee').text(nip);
		$('#name_employee').text(name);
		$('#product_employee').text(product);
		$('#name_product').text(product);
		$('#division_employee').text(divisi);
		$('#position_employee').text(position);
		$('#tanggal_gajian').text(formatDate(tanggal_gajian));
		$('#total_gaji').text(formatToRupiah(gaji_kotor));
		$('#pot_kasbon').text(formatToRupiah(piutang));
		$('#total_pot_izin').text(formatToRupiah(potongan_izin));
		$('#total_pot_absen').text(formatToRupiah(potongan_absen));
		$('#rms_total_gaji').text(formatToRupiah(gaji_kotor));
		$('#rms_potongan_gaji').text(formatToRupiah(total_potongan));
		$('#gaji_bersih').text(formatToRupiah(total));
		$('#gaji_bersih_anda').text(formatToRupiah(total));

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


</script>
