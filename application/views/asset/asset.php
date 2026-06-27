<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .movement-item {
        border-left: 4px solid #0d6efd;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    .movement-item .badge {
        font-size: 0.8rem;
    }
    #movementHistory::-webkit-scrollbar {
        width: 6px;
    }
    #movementHistory::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    } 


    /* Samakan tinggi Select2 dengan form-control Bootstrap */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 13px) !important;
        border: 1px solid #ced4da;
        border-radius: .375rem;
        padding: .375rem .75rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 13px) !important;
        right: 8px;
    }   
</style>

<main>
    <h1 class="mb-4">Asset Management</h1>

    <div class="d-flex justify-content-between flex-wrap mt-5">
        <button type="button" class="btn rounded-pill btn-flex gradient-btn mt-3" data-bs-toggle="modal" data-bs-target="#addAssetModal">
            <i class="bi bi-plus-circle"></i> Tambah Aset
        </button>
    </div>

    <div class="mt-12 shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
        <!-- Filter -->
        <div class="row g-3 align-items-center mt-4">
            <div class="col-12 col-md-auto">
                <label class="form-label">Kategori:</label>
                <select id="filterCategory" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->id_asset_category ?>"><?= $cat->category_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <label class="form-label">Lokasi:</label>
                <select id="filterLocation" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <?php foreach ($locations as $loc): ?>
                        <option value="<?= $loc->id_asset_location ?>"><?= $loc->location_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <label class="form-label">Status:</label>
                <select id="filterStatus" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="diperbaiki">Diperbaiki</option>
                    <option value="dipakai">Dipakai</option>
                    <option value="hilang">Hilang</option>
                    <option value="dijual">Dijual</option>
                </select>
            </div>
            <div class="col-12 col-md-auto">
                <label class="form-label">Kondisi:</label>
                <select id="filterCondition" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="baru">Baru</option>
                    <option value="baik">Baik</option>
                    <option value="lumayan">Lumayan</option>
                    <option value="rusak">Rusak</option>
                </select>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive mt-4">
            <table id="asset_table" class="table table-bordered table-striped w-100">
                <thead class="table-primary">
                    <tr>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>PIC</th>
                        <th>Status</th>
                        <th>Kondisi</th>
                        <th>Tgl Beli</th>
                        <th>Harga Beli</th>
                        <th>Perpindahan asset</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- ========== MODAL TAMBAH ========== -->
    <div class="modal fade" tabindex="-1" id="addAssetModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Aset</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-minus"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form w-100" id="addAssetForm" data-action="<?= site_url('admin/Asset/add_asset') ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kode Aset</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="asset_code" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Nama Aset</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="asset_name" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kategori</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_asset_category" class="form-select">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat->id_asset_category ?>"><?= $cat->category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Lokasi</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_location" class="form-select">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($locations as $loc): ?>
                                            <option value="<?= $loc->id_asset_location ?>"><?= $loc->location_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Penanggung Jawab</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_employee" id="add_id_employee" class="form-select select2-employee" style="width:100%;">
                                        <option value="">- Cari Penanggung Jawab -</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Merek</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="brand" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Model</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="model" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Nomor Seri</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="serial_number" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tanggal Pembelian</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="date" name="purchase_date" value="<?= date('Y-m-d') ?>" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Harga Beli</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="purchase_price" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="status" class="form-select">
                                        <option value="tersedia">Tersedia</option>
                                        <option value="diperbaiki">Diperbaiki</option>
                                        <option value="dipakai">Dipakai</option>
                                        <option value="hilang">Hilang</option>
                                        <option value="dijual">Dijual</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kondisi</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="asset_condition" class="form-select">
                                        <option value="baru">Baru</option>
                                        <option value="baik">Baik</option>
                                        <option value="lumayan">Lumayan</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Catatan</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="noted" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="submit_asset" class="btn btn-primary">
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

    <!-- ========== MODAL EDIT ========== -->
    <div class="modal fade" id="editAssetModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Aset</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-minus"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form w-100" id="editAssetForm" enctype="multipart/form-data">
                        <input type="hidden" name="id_asset" id="edit_id_asset">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kode Aset</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="asset_code" id="edit_asset_code" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Nama Aset</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="asset_name" id="edit_asset_name" class="form-control bg-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kategori</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_asset_category" id="edit_id_asset_category" class="form-select">
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat->id_asset_category ?>"><?= $cat->category_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Lokasi</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_location" id="edit_id_location" class="form-select">
                                        <?php foreach ($locations as $loc): ?>
                                            <option value="<?= $loc->id_asset_location ?>"><?= $loc->location_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Penanggung Jawab</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="id_employee" id="edit_id_employee" class="form-select select2-employee" style="width:100%;" disabled >
                                        <option value="">- Cari Penanggung Jawab -</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Merek</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="brand" id="edit_brand" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Model</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="model" id="edit_model" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Nomor Seri</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="serial_number" id="edit_serial_number" class="form-control bg-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tanggal Pembelian</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="date" name="purchase_date" id="edit_purchase_date" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Harga Beli</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="purchase_price" id="edit_purchase_price" class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Status</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="status" id="edit_status" class="form-select">
                                        <option value="tersedia">Tersedia</option>
                                        <option value="diperbaiki">Diperbaiki</option>
                                        <option value="dipakai">Dipakai</option>
                                        <option value="hilang">Hilang</option>
                                        <option value="dijual">Dijual</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Kondisi</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select name="asset_condition" id="edit_asset_condition" class="form-select">
                                        <option value="baru">Baru</option>
                                        <option value="baik">Baik</option>
                                        <option value="lumayan">Lumayan</option>
                                        <option value="rusak">Rusak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Catatan</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="text" name="noted" id="edit_noted" class="form-control bg-transparent" />
                                </div>
                            </div>
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


    <!-- ========== MODAL MOVEMENT ========== -->
    <div class="modal fade" id="movementModal" tabindex="-1" aria-labelledby="movementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movementModalLabel">Riwayat Pergerakan Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri: Form Tambah Movement -->
                        <div class="col-md-6">
                            <h6 class="mb-3">Tambah Pergerakan</h6>
                            <form id="movementForm">
                                <input type="hidden" name="id_asset" id="movement_asset_id">
                                <input type="hidden" name="from_employee" id="from_employee_hidden">
                                <input type="hidden" name="from_location" id="from_location_hidden">
                                <div class="mb-3">
                                    <label for="to_employee" class="form-label">Ke Karyawan</label>
                                    <select name="to_employee" id="to_employee" class="form-select select2-movement" style="width:100%;">
                                        <option value="">Pilih Karyawan</option>
                                        <?php foreach ($employees as $emp): ?>
                                            <option value="<?= $emp['id_employee'] ?>"><?= $emp['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="to_location" class="form-label">Ke Lokasi</label>
                                    <select name="to_location" id="to_location" class="form-select select2-movement" style="width:100%;">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach ($locations as $loc): ?>
                                            <option value="<?= $loc->id_asset_location ?>"><?= $loc->location_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="movement_date" class="form-label">Tanggal Pindah</label>
                                    <input type="date" name="movement_date" id="movement_date" class="form-control" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Catatan</label>
                                    <input type="text" name="notes" id="notes" class="form-control" placeholder="Catatan (opsional)">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Tambah Pergerakan</button>
                            </form>
                        </div>

                        <!-- Kolom Kanan: Riwayat Movement -->
                        <div class="col-md-6">
                            <h6 class="mb-3">Riwayat Pergerakan</h6>
                            <div id="movementHistory" style="max-height:400px; overflow-y:auto;">
                                <ul class="list-group" id="movementList">
                                    <li class="list-group-item text-muted">Belum ada riwayat.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== SCRIPT ========== -->
    <script>
        let base = '<?= base_url() ?>';
        let table;
        let category = '';
        let assetLocation = '';
        let status = '';
        let condition = '';

        // Data employee untuk Select2 (dikirim dari controller)
        var employees = <?= $employees_json ?>; // array of objects dengan property id_employee dan name

        // Fungsi inisialisasi Select2
        function initSelect2(selector, modalSelector) {
            var data = employees.map(function(emp) {
                return { id: emp.id_employee, text: emp.name };
            });
            // Destroy jika sudah ada
            if ($(selector).data('select2')) {
                $(selector).select2('destroy');
            }
            $(selector).select2({
                data: data,
                placeholder: 'Cari Penanggung Jawab...',
                allowClear: true,
                dropdownParent: $(modalSelector)
            });
        }

        // ---------- DATATABLE ----------
        function callDT() {
            table = $('#asset_table').DataTable({
                responsive: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: base + 'admin/Asset/dtSideserver',
                    type: "POST",
                    data: function(d) {
                        d.category = category;
                        d.location = assetLocation;
                        d.status = status;
                        d.condition = condition;
                    },
                },
                dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
                columnDefs: [
                    { targets: "_all", orderable: false },
                    { targets: 9, className: "text-center" }
                ],
            });
        }
        callDT();

        // ---------- FILTER ----------
        $('#filterCategory').on('change', function() {
            category = $(this).val();
            table.ajax.reload();
        });
        $('#filterLocation').on('change', function() {
            assetLocation = $(this).val();
            table.ajax.reload();
        });
        $('#filterStatus').on('change', function() {
            status = $(this).val();
            table.ajax.reload();
        });
        $('#filterCondition').on('change', function() {
            condition = $(this).val();
            table.ajax.reload();
        });

        // ---------- EDIT ----------
        function editAssetBtn(element) {
            let $el = $(element);
            $('#edit_id_asset').val($el.data('id_asset'));
            $('#edit_asset_code').val($el.data('asset_code'));
            $('#edit_asset_name').val($el.data('asset_name'));
            $('#edit_id_asset_category').val($el.data('id_asset_category'));
            $('#edit_id_location').val($el.data('id_location'));
            // Simpan id employee untuk diisi setelah Select2 siap
            $('#edit_id_employee').data('selected', $el.data('id_employee'));
            $('#edit_brand').val($el.data('brand'));
            $('#edit_model').val($el.data('model'));
            $('#edit_serial_number').val($el.data('serial_number'));
            $('#edit_purchase_date').val($el.data('purchase_date'));
            $('#edit_purchase_price').val($el.data('purchase_price'));
            $('#edit_status').val($el.data('status'));
            $('#edit_asset_condition').val($el.data('asset_condition'));
            $('#edit_noted').val($el.data('noted'));
            $('#editAssetModal').modal('show');
        }

        // ---------- DELETE ----------
        function handleDeleteAssetButton(id) {
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
                        url: base + 'admin/Asset/delete',
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

        // ---------- EVENT MODAL DAN SUBMIT ----------
        $(document).ready(function() {
            // ---- Inisialisasi Select2 saat modal tambah ditampilkan ----
            $('#addAssetModal').on('shown.bs.modal', function() {
                initSelect2('#add_id_employee', '#addAssetModal');
            });

            // ---- Inisialisasi Select2 saat modal edit ditampilkan ----
            $('#editAssetModal').on('shown.bs.modal', function() {
                initSelect2('#edit_id_employee', '#editAssetModal');
                // Set nilai yang sudah disimpan
                var selectedId = $('#edit_id_employee').data('selected');
                if (selectedId) {
                    $('#edit_id_employee').val(selectedId).trigger('change');
                }
            });

            // ---- Destroy Select2 saat modal tambah ditutup ----
            $('#addAssetModal').on('hidden.bs.modal', function() {
                if ($('#add_id_employee').data('select2')) {
                    $('#add_id_employee').select2('destroy');
                }
            });

            // ---- Destroy Select2 saat modal edit ditutup ----
            $('#editAssetModal').on('hidden.bs.modal', function() {
                if ($('#edit_id_employee').data('select2')) {
                    $('#edit_id_employee').select2('destroy');
                }
            });

            // ---- SUBMIT TAMBAH ----
            $("#addAssetForm").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $("#submit_asset").prop("disabled", true).text("Processing...");

                $.ajax({
                    url: $(this).data("action"),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        $("#submit_asset").prop("disabled", false).text("Simpan");
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500).then(() => location.reload());
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function() {
                        $("#submit_asset").prop("disabled", false).text("Simpan");
                        swallMssg_e('Terjadi kesalahan. Silakan coba lagi.', true, 0);
                    }
                });
            });

            // ---- SUBMIT EDIT ----
            $("#editAssetForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: base + 'admin/Asset/update',
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


       // Data employee dan location dari controller
      // Data employee dan location (hanya untuk referensi)
var employees = <?= $employees_json ?>;
var locationsMovement = <?= $locations_json ?>;

// Fungsi inisialisasi Select2 untuk modal movement
function initMovementSelect2() {
    if ($('#to_employee').data('select2')) {
        $('#to_employee').select2('destroy');
    }
    $('#to_employee').select2({
        placeholder: 'Pilih Karyawan',
        allowClear: true,
        dropdownParent: $('#movementModal')
    });

    if ($('#to_location').data('select2')) {
        $('#to_location').select2('destroy');
    }
    $('#to_location').select2({
        placeholder: 'Pilih Lokasi',
        allowClear: true,
        dropdownParent: $('#movementModal')
    });
}

// Fungsi memuat riwayat movement
function loadMovementHistory(id_asset) {
    $.ajax({
        url: base + 'admin/Asset_movement/get_history',
        type: 'POST',
        data: { id_asset: id_asset },
        dataType: 'json',
        success: function(response) {
            var list = $('#movementList');
            list.empty();
            if (response.status && response.data.length > 0) {
                $.each(response.data, function(index, mv) {
                    var date = new Date(mv.movement_date).toLocaleDateString('id-ID');
                    var item = `
                        <li class="list-group-item movement-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>${date}</strong>
                                    <div class="mt-1">
                                        <span class="badge bg-secondary">Dari</span> ${mv.from_employee_name || '-'} 
                                        <span class="badge bg-secondary">Ke</span> ${mv.to_employee_name || '-'}
                                    </div>
                                    <div>
                                        <span class="badge bg-info">Lokasi</span> ${mv.from_location_name || '-'} → ${mv.to_location_name || '-'}
                                    </div>
                                    ${mv.notes ? `<div class="mt-1 text-muted small">Catatan: ${mv.notes}</div>` : ''}
                                </div>
                                <button class="btn btn-sm btn-danger btn-delete-movement" data-id_movement="${mv.id_asset_movement}">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </li>
                    `;
                    list.append(item);
                });
            } else {
                list.append('<li class="list-group-item text-muted">Belum ada riwayat pergerakan.</li>');
            }
        },
        error: function() {
            $('#movementList').html('<li class="list-group-item text-danger">Gagal memuat riwayat.</li>');
        }
    });
}



// Submit form movement
$('#movementForm').on('submit', function(e) {
    e.preventDefault();
    var submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).text('Processing...');

    // Ambil semua nilai secara eksplisit
    var id_asset = $('#movement_asset_id').val();
    var fromEmployee = $('#from_employee_hidden').val();
    var fromLocation = $('#from_location_hidden').val();
    var toEmployee = $('#to_employee').val();
    var toLocation = $('#to_location').val();
    var movementDate = $('#movement_date').val();
    var notes = $('#notes').val();

    // Debug
    console.log('Data akan dikirim:', { id_asset, fromEmployee, fromLocation, toEmployee, toLocation, movementDate, notes });

    // Validasi
    if (!id_asset || !fromEmployee || !fromLocation || !toEmployee || !toLocation || !movementDate) {
        swallMssg_e('Semua field harus diisi!', true, 0);
        submitBtn.prop('disabled', false).text('Tambah Pergerakan');
        return;
    }

    // Kirim data
    $.ajax({
        url: base + 'admin/Asset_movement/add',
        type: 'POST',
        data: {
            id_asset: id_asset,
            from_employee: fromEmployee,
            from_location: fromLocation,
            to_employee: toEmployee,
            to_location: toLocation,
            movement_date: movementDate,
            notes: notes
        },
        dataType: 'json',
        success: function(response) {
            submitBtn.prop('disabled', false).text('Tambah Pergerakan');
            if (response.status) {
                swallMssg_s(response.message, false, 1500);
                var id_asset = $('#movement_asset_id').val();
                loadMovementHistory(id_asset);
                // Reset "Ke" fields
                $('#to_employee').val(null).trigger('change');
                $('#to_location').val(null).trigger('change');
                $('#movement_date').val('<?= date('Y-m-d') ?>');
                $('#notes').val('');
            } else {
                swallMssg_e(response.message, true, 0);
            }
        },
        error: function() {
            submitBtn.prop('disabled', false).text('Tambah Pergerakan');
            swallMssg_e('Terjadi kesalahan, silakan coba lagi.', true, 0);
        }
    });
});

// Hapus movement
$(document).on('click', '.btn-delete-movement', function() {
    var id_movement = $(this).data('id_movement');
    Swal.fire({
        title: 'Hapus riwayat ini?',
        text: 'Data akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base + 'admin/Asset_movement/delete',
                type: 'POST',
                data: { id_movement: id_movement },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        swallMssg_s(response.message, false, 1500);
                        var id_asset = $('#movement_asset_id').val();
                        loadMovementHistory(id_asset);
                    } else {
                        swallMssg_e(response.message, true, 0);
                    }
                },
                error: function() {
                    swallMssg_e('Gagal menghapus.', true, 0);
                }
            });
        }
    });
});

// Fungsi pembuka modal
function openMovementModal(element)
{
    let id_asset = $(element).data('id_asset');
    let id_employee = $(element).data('id_employee');
    let id_location = $(element).data('id_location');

    console.log(id_asset);
    console.log(id_employee);
    console.log(id_location);

    $('#movement_asset_id').val(id_asset);
    $('#from_employee_hidden').val(id_employee);
    $('#from_location_hidden').val(id_location);

    initMovementSelect2();

    loadMovementHistory(id_asset);

    $('#movementModal').modal('show');
}
    </script>
</main>