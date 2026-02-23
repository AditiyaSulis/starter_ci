

<main>
    <h1 class="mb-4">Pengaduan Karyawan</h1>

	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		<div class="row g-3 align-items-center mt-4">
			<div class="col-12 col-md-auto">
				<label class="form-label">Date:</label>
				<select id="filterSelect" class="form-select form-select-sm">
					<option value="">All</option>
					<option value="today">Today</option>
					<option value="yesterday">Yesterday</option>
					<option value="this_week">This Week</option>
					<option value="last_week">Last Week</option>
					<option value="this_month" >This Month</option>
					<option value="last_month">Last Month</option>
					<option value="this_year">This Year</option>
					<option value="last_year">Last Year</option>
					<option value="custom">Custom Range</option>
				</select>
			</div>

		</div>

		<div class="table-responsive mt-4">
			<table id="pengaduan_table" class="table table-bordered table-striped w-100">
				<thead class="table-primary">
				<tr>
					<th>Kategori</th>
					<th>Judul</th>
					<th>Pesan Pengaduan</th>
					<th>Tanggal</th>
					<th>status</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal untuk Custom Date -->
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

    <!-- Modal Ubah Status -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">
                        <i class="bi bi-arrow-repeat me-2"></i>
                        Ubah Status Pengaduan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUbahStatus" action="<?= base_url('admin/Pengaduan_karyawan/ubah_status') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_pengaduan" id="modal_id_pengaduan">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Pengaduan</label>
                            <p id="modal_judul" class="text-gray-800 bg-light p-3 rounded"></p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status_pengaduan" class="form-label fw-bold">
                                <i class="bi bi-tag me-1"></i> Pilih Status Baru
                            </label>
                            <select class="form-select form-select-lg" name="status_pengaduan" id="status_pengaduan" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1" class="text-warning">
                                    <i class="bi bi-clock-history me-2"></i> Menunggu Diproses
                                </option>
                                <option value="2" class="text-primary">
                                    <i class="bi bi-arrow-repeat me-2"></i> Sedang Diproses
                                </option>
                                <option value="3" class="text-success">
                                    <i class="bi bi-check2-circle me-2"></i> Selesai
                                </option>
                                <option value="4" class="text-danger">
                                    <i class="bi bi-x-circle me-2"></i> Tidak Selesai
                                </option>
                            </select>
                        </div>
                        
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-warning" id="btnSimpanStatus">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


	<script>
		let base = '<?= base_url()?>';
		const base_url = $('meta[name="base_url"]').attr('content');

		let table;
		let option = '';
		let startDate = '';
		let endDate = '';

		//-----------------------DATATABLE
		//--------TEST FILTER

		function callDT() {
			table = $('#pengaduan_table').DataTable({
				responsive: false,
				autoWidth: false,
				processing: true,
				serverSide: true,
				order: [],
				ajax: {
					url: base + 'admin/Pengaduan_karyawan/dtSideServer',
					type: "POST",
					data: function (d) {
						d.option = option;
						d.startDate = startDate;
						d.endDate = endDate;
					},
				},
				dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
				columnDefs: [
					{ targets: "_all", orderable: false },
					{ targets: 0, className: "text-start" },
				],
			});
		}

		callDT();

		// ---------- FILTER DATE
		$('#filterSelect').on('change', function() {
			option = $(this).val();

			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();

			}


		});


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
			updateCards(option, startDate, endDate);
		});


        $(document).ready(function() {
            // Ketika tombol ubah status diklik
            $('.btn-change-status').on('click', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var judul = $(this).data('judul');
                
                // Set data ke modal
                $('#modal_id_pengaduan').val(id);
                $('#modal_judul').text(judul);
                $('#status_pengaduan').val(status);
            });
            
            // Handle form submit dengan AJAX
            $('#formUbahStatus').on('submit', function(e) {
                e.preventDefault();
                
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();
                var btnSubmit = $('#btnSimpanStatus');
                var originalText = btnSubmit.html();
                
                // Disable button dan tampilkan loading
                btnSubmit.prop('disabled', true);
                btnSubmit.html('<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Tutup modal
                            $('#statusModal').modal('hide');
                            
                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                            // Reload DataTable
                            table.ajax.reload(null, false);
                            
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server. Silakan coba lagi.'
                        });
                    },
                    complete: function() {
                        // Kembalikan button ke kondisi normal
                        btnSubmit.prop('disabled', false);
                        btnSubmit.html(originalText);
                    }
                });
            });
            
            // Reset form ketika modal ditutup
            $('#statusModal').on('hidden.bs.modal', function() {
                $('#formUbahStatus')[0].reset();
                $('#modal_judul').text('');
            });
        });

	</script>

</main>
