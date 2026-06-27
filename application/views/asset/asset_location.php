<main>
    <h1 class="mb-4">Asset Location</h1>

    <div class="d-flex justify-content-between flex-wrap mt-5">
        <button type="button" class="btn rounded-pill btn-flex gradient-btn mt-3" data-bs-toggle="modal" data-bs-target="#addLocationModal">
            <i class="bi bi-plus-circle"></i> Tambah Lokasi
        </button>
    </div>

    <div class="mt-12 shadow-lg" style="border:2px; padding:20px; border-radius:10px; background-color:rgba(229,244,250,0.06);">
        <div class="table-responsive mt-4">
            <table id="location_table" class="table table-bordered table-striped w-100">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Lokasi</th>
                        <th>Gedung</th>
                        <th>Lantai</th>
                        <th>Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" tabindex="-1" id="addLocationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Lokasi</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-minus"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form w-100" id="addLocationForm" data-action="<?= site_url('admin/Asset_location/add') ?>">
                        <div class="fv-row mb-8">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" name="location_name" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Gedung</label>
                            <input type="text" name="building" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Lantai</label>
                            <input type="text" name="floor" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Ruangan</label>
                            <input type="text" name="room" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control bg-transparent" />
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="submit_location" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Loading...</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editLocationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Lokasi</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-minus"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form w-100" id="editLocationForm">
                        <input type="hidden" name="id_asset_location" id="edit_id_asset_location">
                        <div class="fv-row mb-8">
                            <label class="form-label">Nama Lokasi</label>
                            <input type="text" name="location_name" id="edit_location_name" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Gedung</label>
                            <input type="text" name="building" id="edit_building" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Lantai</label>
                            <input type="text" name="floor" id="edit_floor" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Ruangan</label>
                            <input type="text" name="room" id="edit_room" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row mb-8">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" id="edit_description" class="form-control bg-transparent" />
                        </div>
                        <div class="d-grid mb-10 mt-10">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan Perubahan</span>
                                <span class="indicator-progress">Loading...</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let base = '<?= base_url() ?>';
        let table;

        function callDT() {
            table = $('#location_table').DataTable({
                responsive: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: base + 'admin/Asset_location/dtSideserver',
                    type: "POST"
                },
                dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
                columnDefs: [
                    { targets: "_all", orderable: false },
                    { targets: 5, className: "text-center" }
                ],
            });
        }
        callDT();

        function editLocationBtn(element) {
            let $el = $(element);
            $('#edit_id_asset_location').val($el.data('id_asset_location'));
            $('#edit_location_name').val($el.data('location_name'));
            $('#edit_building').val($el.data('building'));
            $('#edit_floor').val($el.data('floor'));
            $('#edit_room').val($el.data('room'));
            $('#edit_description').val($el.data('description'));
            $('#editLocationModal').modal('show');
        }

        function handleDeleteLocationButton(id) {
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
                    $.ajax({
                        url: base + 'admin/Asset_location/delete',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            var res = JSON.parse(response);
                            if (res.status) {
                                swallMssg_s(res.message, false, 1500).then(() => location.reload());
                            } else {
                                swallMssg_e(res.message, true, 0);
                            }
                        },
                        error: function() {
                            Swal.fire('Kesalahan!', 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            // Tambah
            $("#addLocationForm").on("submit", function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $("#submit_location").prop("disabled", true).text("Processing...");

                $.ajax({
                    url: $(this).data("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $("#submit_location").prop("disabled", false).text("Simpan");
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500).then(() => location.reload());
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function() {
                        $("#submit_location").prop("disabled", false).text("Simpan");
                        swallMssg_e('Terjadi kesalahan. Silakan coba lagi.', true, 0);
                    }
                });
            });

            // Edit
            $("#editLocationForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: base + 'admin/Asset_location/update',
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500).then(() => location.reload());
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function() {
                        swallMssg_e('Terjadi kesalahan. Silakan coba lagi.', true, 0);
                    }
                });
            });
        });
    </script>
</main>