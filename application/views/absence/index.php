<?php
$status = '';

if($schedule) {
	if($schedule['status']==1) {
		$status = '<p class="card-text">Silahkan melakukan absen dengan menekan tombol dibawah.</p>
						<form class="form w-100" id="addAttendance" data-action="'.base_url("absence/absence/add_attendance") .'" enctype="multipart/form-data">
								<input type="hidden" value="'. $schedule['id_employee'].'" name="id_employee" autocomplete="off" class="form-control bg-transparent" />
								<input type="hidden" value="'. $schedule['id_schedule'].'" name="id_schedule" autocomplete="off" class="form-control bg-transparent" />
								<input type="hidden" value="'.date("H:i", strtotime($schedule['clock_in'])) .'" name="clock_in" autocomplete="off" class="form-control bg-transparent" />
								<input type="hidden" value="'. date('H:i:s').'" name="jam_masuk" autocomplete="off" class="form-control bg-transparent" />
								<input type="hidden" id="latitude" name="latitude">
    							<input type="hidden" id="longitude" name="longitude">
								<input type="hidden" value="'. date('Y-m-d').'" name="tanggal_masuk" autocomplete="off" class="form-control bg-transparent" />
								<button type="submit" id="submit_attendance" class="btn gradient-btn rounded-pill mt-6 mb-6">
									<i class="bi bi-calendar-check"></i> CLOCK IN
									<span class="indicator-progress">
									Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
								</button>
						</form>
						<span class="card-text text-danger">*Jadwal : '.date("d-m-Y", strtotime($schedule['waktu'])).'</span> 
						<p class="card-text text-danger">Jam Masuk : '.date("H:i", strtotime($schedule['clock_in'])).'</p> 
						<p class="card-text text-danger">Pastikan dalam radius maksimal 250 meter dari lokasi kerja anda. </p>';
	}
	else if($schedule['status']== 2) {
		$status = '<p class="card-text text-warning fw-bolder mt-4">*Hari ini adalah jadwal libur anda.</p>';
	} else if($schedule['status']== 3) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Hari ini adalah tanggal merah</p>';
	} else if($schedule['status']== 4) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Hari ini  adalah jadwal cuti anda.</p>';
	}else if($schedule['status']== 5) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Hari ini anda mengajukan izin.</p>';
	} else if($schedule['status']== 8) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Hari ini adalah libur hari minggu.</p>';
	}else if($schedule['status']== 6) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Anda Sudah melakukan absen hari ini pukul : '. date('H:i',strtotime($schedule['jam_masuk'])).' WIB </p>';
	}
	else if($schedule['status']== 7) {
		$status = '<p class="card-text text-warning  fw-bolder mt-4">*Anda dinyatakan tidak hadir pada tanggal : '.date("d-m-Y", strtotime($schedule['waktu'])).', Absen selanjutnya akan dimulai pukul : '.date("H:i", strtotime($schedule['clock_out'])).' WIB </p>';
	}

} else {
	$status = '<p class="card-text text-warning  fw-bolder mt-4">*Tidak ada jadwal hari ini </p>';
}


?>


<main>



	<h1>Absence</h1>

	<div class="row mt-12">
		<ul class="nav nav-tabs mb-8 order-md-1 order-2 mt-sm-8">
			<li class="nav-item">
				<a class="nav-link active text-info" aria-current="page" href="<?=base_url('absence/absence/absence_page')?>">Kehadiran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link  text-dark" href="<?=base_url('absence/attendance/attendance_page')?>">Rekap Kehadiran</a>
			</li>
		</ul>
		<div class="col-md-8 mb-4 col-sm-12 order-md-1 order-3">
			<h4>Data Kehadiran Hari Ini</h4>
				<?php $this->load->view($view_log_attendance); ?>
		</div>
		<div class="col-md-4 mb-4 col-sm-12 order-md-2 order-1">
			<div class="card text-center">
				<div class="card-header d-flex justify-content-center pt-4">
					<h5 class="card-title">Attendance</h5>
				</div>
				<div class="card-body">
					<h2 class="card-title"><?= date('d F Y')?></h2>
					<h1 id="realtime-clock"></h1>
					<?= $status?>

				</div>
				<div class="card-footer justify-content-start">
					<button type="button" class="btn bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#addProduct">
						<span class="text-primary">Ajukan Izin</span>
					</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Izin Modal-->
	<div class="modal fade" tabindex="-1" id="addProduct">
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
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/data/DataIzin/add_izin') ?>" enctype="multipart/form-data">
							<input type="hidden" value="<?= $user['email'] ?>" name="id_employee" autocomplete="off" class="form-control bg-transparent"/>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Izin Dibuat</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="input_at" autocomplete="off" class="form-control bg-transparent" readonly/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Alasan Izin</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="alasan_izin" id="alasan_izin">
								<option selected>-pilih alasan izin-</option>
								<option value="Izin Keluarga Melahirkan">Izin Keluarga Melahirkan</option>
								<option value="Izin Menghadiri Acara Keagamaan">Izin Menghadiri Acara Keagamaan</option>
								<option value="Izin Sakit">Izin Sakit</option>
								<option value="Izin Mengurus Administrasi">Izin Mengurus Administrasi</option>
								<option value="Izin Menghadiri Pemakaman">Izin Menghadiri Pemakaman</option>
								<option value="Keperluan Mendesak Lainnya">Keperluan Mendesak Lainnya</option>
							</select>
						</div>
						<div id="bukti-form" style="display: block;">
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Bukti</span>
							</div>
							<div class="fv-row mb-8">
								<input type="file" name="bukti_surat_sakit" autocomplete="off" class="form-control bg-transparent" />
							</div>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Izin</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tgl_lunas" value="<?= date("Y-m-d") ?>" name="tanggal_izin" autocomplete="off" class="form-control bg-transparent" />
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
		// document.addEventListener('DOMContentLoaded', function () {
		// 	const alasanIzinSelect = document.getElementById('alasan_izin');
		// 	const additionalForm = document.getElementById('bukti-form');
		//
		//
		// 	alasanIzinSelect.addEventListener('change', function () {
		// 		if (this.value === '2') {
		// 			additionalForm.style.display = 'block';
		// 		} else {
		// 			additionalForm.style.display = 'none';
		// 		}
		// 	});
		// });

		navigator.geolocation.getCurrentPosition(position => {
			document.getElementById('latitude').value = position.coords.latitude;
			document.getElementById('longitude').value = position.coords.longitude;
		}, error => alert('Harap aktifkan GPS untuk melakukan absensi!'));


		$(document).ready(function () {
			$("#addAttendance").on("submit", function (e) {
				e.preventDefault();

				var formElement = this;
				var formData = new FormData(formElement);

				// Menonaktifkan tombol submit
				$("#submit_attendance").prop("disabled", true);
				$("#submit_attendance").text("Processing..."); // Opsional: menambahkan teks loading pada tombol

				$.ajax({
					url: $(formElement).data("action"),
					type: "POST",
					data: formData,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function (response) {
						if (response.status) {
							swallMssg_s(response.message, false, 1500)
								.then(() =>  {
									location.reload();
								});
						} else {
							swallMssg_e(response.message, true, 0).then(()=> {
								$("#submit_attendance").prop("disabled", false);
								$("#submit_attendance").text("Submit Attendance"); // Kembalikan teks tombol
								location.reload();
							});

						}
					},
					error: function (xhr, status, error) {
						// Mengaktifkan tombol submit setelah error terjadi
						$("#submit_attendance").prop("disabled", false);
						$("#submit_attendance").text("Submit Attendance"); // Kembalikan teks tombol

						swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk menambah data ' + xhr.response, true, 0)
							.then(() =>  {
								location.reload();
							});
					},
				});
			});
		});
	</script>


</main>



