<main>
	<h1>Absence</h1>

	<div class="row mt-12">
		<div class="col-md-6 col-6 mb-4 col-sm-12">
			<h4>Data Kehadiran Hari Ini</h4>
			<div class="table-responsive">
				<table id="position_table" class="table table-bordered table-striped" style="width:100%">
					<thead>
					<?php $no = 1 ?>
					<tr>
						<th>No</th>
						<th>Product</th>
						<th>Division</th>
						<th>Name</th>
						<th>Date</th>
						<th>Clock In</th>
						<th>Status</th>
					</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6 col-6 mb-4 col-sm-12">
			<div class="card text-center">
				<div class="card-header d-flex justify-content-center pt-4">
					<h5 class="card-title">Attendance</h5>
				</div>
				<div class="card-body">
					<h2 class="card-title"><?= date('d F Y')?></h2>
					<h1 id="realtime-clock"></h1>
					<p class="card-text">Silahkan melakukan absen dengan menekan tombol dibawah.</p>
					<button type="button" class="btn gradient-btn rounded-pill mt-6 mb-6" data-bs-toggle="modal" data-bs-target="#addPosition">
						<i class="bi bi-calendar-check"></i>
						CLOCK IN
					</button>
					<p class="card-text text-danger">*Jam Masuk : 08:00 WIB</p>

				</div>
				<div class="card-footer justify-content-start">
					<button type="button" class="btn bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#izinModal">
						<span class="text-primary">Ajukan Izin</span>
					</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Izin Modal-->
	<div class="modal fade" tabindex="-1" id="izinModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Izin</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/piutang/add_piutang') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Izin Dibuat</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="piutang_date" autocomplete="off" class="form-control bg-transparent" readonly/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Alasan Izin</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="alasan_izin" id="alasan_izin">
								<option selected>-pilih alasan izin-</option>
									<option value="1">Keluarga Melahirkan</option>
									<option value="2">Sakit</option>
									<option value="3">Hayang Meuli Lotek</option>
							</select>
						</div>
						<div id="bukti-form" style="display: none;">
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Bukti</span>
							</div>
							<div class="fv-row mb-8">
								<input type="file" name="amount_piutang" autocomplete="off" class="form-control bg-transparent" />
							</div>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Izin</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tgl_lunas" value="<?= date("Y-m-d") ?>" name="tgl_lunas" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description_piutang"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Buat Izin
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

	<script>
		$('#position_table').DataTable();

		//time
		$(document).ready(function() {
			function updateClock() {
				let now = new Date();
				let formattedTime = now.toLocaleTimeString('id-ID', {
					hour: '2-digit',
					minute: '2-digit',
					second: '2-digit'
				});
				$("#realtime-clock").text(formattedTime);
			}

			setInterval(updateClock, 1000);
			updateClock();
		});

		//BUKTI FORM
		document.addEventListener('DOMContentLoaded', function () {
			const alasanIzinSelect = document.getElementById('alasan_izin');
			const additionalForm = document.getElementById('bukti-form');


			alasanIzinSelect.addEventListener('change', function () {
				if (this.value === '2') {
					additionalForm.style.display = 'block';
				} else {
					additionalForm.style.display = 'none';
				}
			});
		});
	</script>

</main>



