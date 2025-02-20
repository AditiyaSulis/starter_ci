
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
				<h6 class="mt-10">Potongan : </h6>
				<div class="table-responsive">
					<table id="table" class="table table-bordered" style="width:100%">
						<thead class="bg-light-primary">
						<tr>
							<th>Izin</th>
							<th>Potongan Izin</th>
							<th>Absen</th>
							<th>Potongan Absen</th>
							<th>Potongan Kasbon</th>
							<th>Total Pot</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td id="izin_pc">
							</td>
							<td id="pot_izin">
							</td>
							<td id="absen_pc">
							</td>
							<td id="pot_absen">
							</td>
							<td id="pot_kasbon">
							</td>
							<td id="total_potongan">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="mt-12">
					<h6>Gaji selama 1 bulan : </h6>
					<table id="table2" class="table table-bordered" style="width:100%">
						<thead class="bg-light-primary">
						<tr>
							<th>Gaji Pokok</th>
							<th>Uang Makan</th>
							<th>Lembur</th>
							<th>Bonus</th>
							<th>Total</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td id="gaji_pokok">
							</td>
							<td id="uang_makan">
							</td>
							<td id="lembur">
							</td>
							<td id="bonus">
							</td>
							<td id="total">
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-6">
						<span id="total_gaji"></span> - <span id="total_potongan_gaji"></span> = - <span id="gaji_bersih"></span>
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
		const izin = button.getAttribute('data-total-izin');
		const cuti = button.getAttribute('data-total-cuti');
		const absen = button.getAttribute('data-total-absen');
		const lembur = button.getAttribute('data-total-overtime');
		const dayoff = button.getAttribute('data-total-dayoff');
		const gaji = button.getAttribute('data-basic-salary');
		const uang_makan = button.getAttribute('data-uang-makan');
		const bonus = button.getAttribute('data-bonus');
		const nip = button.getAttribute('data-nip');
		const name = button.getAttribute('data-name');
		const product = button.getAttribute('data-product');
		const divisi = button.getAttribute('data-divisi');
		const position = button.getAttribute('data-position');
		const tanggal_gajian = button.getAttribute('data-tanggal-gajian');


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

		$('#izin_pc').text(izin);
		$('#absen_pc').text(absen);
		$('#gaji_pokok').text(formatToRupiah(gaji));
		$('#uang_makan').text(formatToRupiah(uang_makan));
		$('#bonus').text(formatToRupiah(bonus));
		$('#lembur').text(formatToRupiah(lembur));
		$('#pot_absen').text(formatToRupiah(pot_absen));
		$('#pot_izin').text(formatToRupiah(pot_izin));

		$('#nip_employee').text(nip);
		$('#name_employee').text(name);
		$('#product_employee').text(product);
		$('#name_product').text(product);
		$('#division_employee').text(divisi);
		$('#position_employee').text(position);
		$('#tanggal_gajian').text(formatDate(tanggal_gajian));

		$("#edit_id").val(id);

	});


	function preventMultipleSubmit(form) {
		const submitButton = form.querySelector('button[type="submit"]');
		if (submitButton) {
			submitButton.disabled = true;
			submitButton.textContent = 'Submitting...';
		}
		return true;
	}


	//------------DELETE
	function handleDeletePayrollComponentButton(id) {
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







</script>
