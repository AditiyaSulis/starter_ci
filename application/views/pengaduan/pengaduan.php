<main>
    <h1 class="mb-4">Buat Pengaduan</h1>

    <!-- Alert untuk menampilkan kode pengaduan (hanya satu, yang bawah dihapus karena redundan) -->
    <div id="kodePengaduanAlert" class="alert alert-success d-none align-items-center" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span id="alertMessage"></span>
    </div>

    <!-- Grid responsif: kolom ditumpuk di mobile, dua kolom di desktop -->
    <div class="row g-4">
        <!-- Kolom Kiri: Form Pengaduan -->
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <div class="card shadow-sm h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar w-100">
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <div class="badge badge-light-primary fw-bold py-3 px-4">
                                <span class="bullet bullet-primary me-2 w-2 h-2"></span>
                                <span class="fs-8 fw-bold">Portal Karyawan</span>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="card-body pt-9">
                    <!-- Title section -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-6 mb-md-10">
                        <h1 class="fw-bold text-gray-900 mb-0">Buat Pengaduan</h1>
                        <span class="badge badge-light-primary">
                            <i class="bi bi-pencil-square me-1"></i>
                            Form Pengaduan
                        </span>
                    </div>

                    <!-- Subtitle -->
                    <p class="text-gray-600 mb-6 mb-md-10 fs-5">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>
                        Sampaikan keluhan atau aspirasi Anda dengan jelas. Setiap laporan akan ditangani secara profesional dan terjaga kerahasiaannya.
                    </p>

                    <!-- Form -->
                    <div class="bg-light bg-opacity-25 rounded p-4 p-md-6 p-lg-8">
                        <form id="formPengaduan" enctype="multipart/form-data">
                            <!-- Upload -->
                            <div class="mb-6 mb-md-8">
                                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                    <i class="bi bi-image-fill text-primary fs-4"></i>
                                    LAMPIRAN GAMBAR
                                </label>
                                <div class="upload-zone" id="uploadZone">
                                    <input type="file" name="logo" accept="image/*" id="fileInput">
                                    <div class="upload-icon-wrap">
                                        <i class="bi bi-cloud-arrow-up upload-icon"></i>
                                    </div>
                                    <p class="upload-title"><span>Klik untuk memilih file</span> atau seret ke sini</p>
                                    <p class="upload-hint">Format: PNG, JPG, WEBP &mdash; Ukuran maksimal 5 MB</p>
                                    <div class="upload-filename" id="uploadFilename">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span id="filenameText"></span>
                                    </div>
                                </div>
                            </div> 
                            <!-- Kategori -->
                            <div class="mb-6 mb-md-8">
                                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                    <i class="bi bi-grid-fill text-primary fs-4"></i>
                                    KATEGORI
                                </label>
                                <select class="form-select form-select-solid" id="kategoriSelect" name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="fasilitas">Fasilitas Kantor</option>
                                    <option value="keamanan">Keamanan</option>
                                    <option value="lingkungan">Lingkungan Kerja</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <!-- Input manual untuk kategori jika memilih Lainnya -->
                            <div class="mb-6 mb-md-8" id="kategoriLainnyaContainer" style="display: none;">
                                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                    <i class="bi bi-pencil-fill text-primary fs-4"></i>
                                    KATEGORI LAINNYA (ISI MANUAL)
                                </label>
                                <input type="text" 
                                      class="form-control form-control-solid" 
                                      placeholder="Masukkan kategori secara manual"
                                      name="kategori_lainnya" id="kategoriLainnya">
                                <div class="form-text text-gray-500">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Isi dengan kategori yang sesuai dengan pengaduan Anda
                                </div>
                            </div>

                            <!-- Judul -->
                            <div class="mb-6 mb-md-8">
                                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                    <i class="bi bi-tag-fill text-primary fs-4"></i>
                                    JUDUL PENGADUAN
                                </label>
                                <input type="text" 
                                      class="form-control form-control-solid" 
                                      placeholder="Tuliskan judul yang singkat dan jelas..."
                                      name="title_pengaduan">
                            </div>

                            <!-- Isi -->
                            <div class="mb-6 mb-md-8">
                                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                    <i class="bi bi-chat-left-text-fill text-primary fs-4"></i>
                                    ISI PENGADUAN
                                </label>
                                <textarea class="form-control form-control-solid" 
                                          rows="8" 
                                          placeholder="Jelaskan pengaduan Anda secara lengkap dan detail. Sertakan informasi seperti waktu kejadian, lokasi, pihak yang terlibat, dan hal-hal lain yang relevan..."
                                          name="text_pengaduan"></textarea>
                            </div>

                            <!-- Divider -->
                            <div class="separator separator-dashed my-6 my-md-8"></div>

                            <!-- Submit - full width di mobile, auto di desktop -->
                            <div class="d-grid d-sm-flex justify-content-sm-end">
                                <button type="submit" class="btn btn-primary btn-flex" id="submitBtn" style="min-height: 48px;">
                                    <i class="bi bi-send-fill me-2" id="submitIcon"></i>
                                    <span id="submitText">Kirim Pengaduan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

            <!-- Footer -->
            <p class="text-center text-gray-500 mt-6">
                <i class="bi bi-shield-lock-fill text-primary me-2"></i>
                Laporan Anda bersifat rahasia dan terlindungi sepenuhnya
            </p>
        </div>

        <!-- Kolom Kanan: FITUR SEARCH LAPORAN BERDASARKAN KODE -->
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar w-100">
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <div class="badge badge-light-info fw-bold py-3 px-4">
                                <span class="bullet bullet-info me-2 w-2 h-2"></span>
                                <span class="fs-8 fw-bold">Cek Status Pengaduan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-9">
                    <!-- Title section -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-6 mb-md-10">
                        <h2 class="fw-bold text-gray-900 mb-0">Cari Pengaduan</h2>
                        <span class="badge badge-light-info">
                            <i class="bi bi-search me-1"></i>
                            Berdasarkan Kode
                        </span>
                    </div>

                    <!-- Subtitle -->
                    <p class="text-gray-600 mb-6 mb-md-10 fs-5">
                        <i class="bi bi-info-circle-fill text-info me-2"></i>
                        Masukkan kode pengaduan untuk melihat status dan detail laporan yang sudah dibuat.
                    </p>

                    <!-- Search Box -->
                    <div class="bg-light bg-opacity-25 rounded p-4 p-md-6 p-lg-8">
                        <div class="mb-6 mb-md-8">
                            <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                                <i class="bi bi-upc-scan text-info fs-4"></i>
                                KODE PENGADUAN
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control form-control-solid" 
                                       id="kodePengaduan" 
                                       placeholder="Contoh: PGN-2025-02-001"
                                       style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                <button class="btn btn-info" type="button" id="btnCariPengaduan">
                                    <i class="bi bi-search me-2"></i>
                                    Cari
                                </button>
                            </div>
                            <div class="form-text text-gray-500 mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Kode pengaduan dapat dilihat pada email konfirmasi atau bukti pengaduan
                            </div>
                        </div>

                        <!-- Recent Searches / Quick Access -->
                        <div class="mb-6">
                            <label class="fs-7 fw-bold text-gray-700 mb-3">
                                <i class="bi bi-clock-history me-1"></i>
                                Pencarian Terakhir
                            </label>
                            <div class="d-flex flex-wrap gap-2" id="recentSearches">
                                <!-- Akan diisi oleh JavaScript -->
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="separator separator-dashed my-6 my-md-8"></div>

                        <!-- Search Result Card (hidden by default) -->
                        <div id="searchResult" style="display: none;">
                            <div class="d-flex align-items-center gap-3 mb-5">
                                <h4 class="fw-bold text-gray-800 mb-0">Hasil Pencarian</h4>
                                <span class="badge badge-light-success" id="resultStatus"></span>
                            </div>

                            <div class="card card-dashed">
                                <div class="card-body p-6">
                                    <!-- Result content will be populated by JavaScript -->
                                    <div id="resultContent"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Not Found Message (hidden by default) -->
                        <div id="notFoundMessage" class="text-center py-10" style="display: none;">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-3x mb-3"></i>
                            <h5 class="text-gray-700 mb-2">Pengaduan Tidak Ditemukan</h5>
                            <p class="text-gray-500 mb-0">Kode pengaduan yang Anda masukkan tidak valid atau tidak terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Upload Zone Styling - Mengikuti tema Metronic */
    .upload-zone {
        position: relative;
        border: 2px dashed var(--kt-gray-300);
        border-radius: 0.85rem;
        padding: 60px 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        overflow: hidden;
        background: var(--kt-gray-100);
    }

    .upload-zone:hover,
    .upload-zone.has-file {
        border-color: var(--kt-primary) !important;
        background: var(--kt-primary-light) !important;
    }

    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon-wrap {
        width: 72px;
        height: 72px;
        background: var(--kt-primary-light);
        border: 1px solid var(--kt-primary);
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: transform 0.25s;
    }

    .upload-zone:hover .upload-icon-wrap,
    .upload-zone.has-file .upload-icon-wrap {
        background: var(--kt-primary);
        transform: translateY(-5px);
    }

    .upload-zone:hover .upload-icon-wrap i,
    .upload-zone.has-file .upload-icon-wrap i {
        color: white !important;
    }

    .upload-icon {
        font-size: 32px;
        color: var(--kt-primary);
        transition: color 0.25s;
    }

    .upload-title {
        font-size: 16px;
        font-weight: 500;
        color: var(--kt-gray-800);
        margin-bottom: 8px;
    }

    .upload-title span {
        color: var(--kt-primary);
        text-decoration: underline;
        text-underline-offset: 3px;
        font-weight: 600;
    }

    .upload-hint {
        font-size: 14px;
        color: var(--kt-gray-600);
    }

    .upload-filename {
        display: none;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
        font-size: 14px;
        color: var(--kt-primary);
        font-weight: 600;
        background: var(--kt-primary-light);
        border-radius: 10px;
        padding: 12px 20px;
        max-width: 380px;
        margin-left: auto;
        margin-right: auto;
    }

    .upload-zone.has-file .upload-filename {
        display: flex;
    }

    /* Dark mode adjustments */
    .dark-mode .upload-zone {
        background: var(--kt-gray-200);
        border-color: var(--kt-gray-400);
    }

    .dark-mode .upload-title {
        color: var(--kt-gray-900);
    }

    .dark-mode .upload-hint {
        color: var(--kt-gray-700);
    }

    /* Responsive improvements for mobile */
    @media (max-width: 576px) {
        .upload-zone {
            padding: 30px 20px;
        }
        
        .upload-icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 14px;
        }

        .upload-icon {
            font-size: 28px;
        }

        .upload-title {
            font-size: 14px;
        }

        .upload-hint {
            font-size: 12px;
        }

        .upload-filename {
            font-size: 12px;
            padding: 10px 16px;
        }

        .form-control.form-control-solid {
            font-size: 16px; /* Mencegah zoom di iOS */
            padding: 0.7rem 1rem;
        }

        .btn {
            font-size: 1rem;
            padding: 0.6rem 1.2rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.4rem 1rem !important;
        }

        .card-body {
            padding: 1.25rem;
        }

        .fs-5 {
            font-size: 0.95rem !important;
        }
    }

    /* Form control styling */
    .form-control.form-control-solid {
        background-color: var(--kt-gray-100);
        border-color: var(--kt-gray-300);
        color: var(--kt-gray-800);
        padding: 0.8rem 1.2rem;
        font-size: 1rem;
        border-radius: 0.85rem;
    }

    .form-control.form-control-solid:focus {
        background-color: var(--kt-gray-200);
        border-color: var(--kt-primary);
        box-shadow: none;
    }

    .form-control.form-control-solid::placeholder {
        color: var(--kt-gray-500);
    }

    /* Recent search pills */
    .recent-search-pill {
        background: var(--kt-gray-200);
        color: var(--kt-gray-700);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid var(--kt-gray-300);
    }

    .recent-search-pill:hover {
        background: var(--kt-info-light);
        border-color: var(--kt-info);
        color: var(--kt-info);
    }

    .recent-search-pill i {
        font-size: 0.8rem;
    }

    /* Result card styling */
    .result-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px dashed var(--kt-gray-200);
    }

    .result-item:last-child {
        border-bottom: none;
    }

    .result-label {
        width: 120px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--kt-gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .result-value {
        flex: 1;
        font-size: 1rem;
        color: var(--kt-gray-800);
        font-weight: 500;
    }

    /* Status badges */
    .status-badge {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-badge.warning {
        background: var(--kt-warning-light);
        color: var(--kt-warning);
        border: 1px solid var(--kt-warning);
    }

    .status-badge.primary {
        background: var(--kt-primary-light);
        color: var(--kt-primary);
        border: 1px solid var(--kt-primary);
    }

    .status-badge.success {
        background: var(--kt-success-light);
        color: var(--kt-success);
        border: 1px solid var(--kt-success);
    }

    .status-badge.danger {
        background: var(--kt-danger-light);
        color: var(--kt-danger);
        border: 1px solid var(--kt-danger);
    }
    </style>

    <script>
            
        var base_url = "<?= base_url() ?>";

        $(document).ready(function() {
            // Toggle input kategori lainnya
            $('#kategoriSelect').on('change', function() {
                if ($(this).val() === 'lainnya') {
                    $('#kategoriLainnyaContainer').slideDown(300);
                } else {
                    $('#kategoriLainnyaContainer').slideUp(300);
                    $('#kategoriLainnya').val('');
                }
            });

            // ========== FORM PENGADUAN ==========
            const fileInput = document.getElementById('fileInput');
            const uploadZone = document.getElementById('uploadZone');
            const filenameText = document.getElementById('filenameText');

            fileInput.addEventListener('change', function() {
                if (this.files[0]) {
                    uploadZone.classList.add('has-file');
                    filenameText.textContent = this.files[0].name;
                }
            });

            uploadZone.addEventListener('dragover', e => {
                e.preventDefault();
                uploadZone.classList.add('has-file');
            });

            uploadZone.addEventListener('dragleave', () => {
                if (!fileInput.files[0]) uploadZone.classList.remove('has-file');
            });

            uploadZone.addEventListener('drop', e => {
                e.preventDefault();
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            });

            // Ajax Submit Form
            $('#formPengaduan').on('submit', function(e) {
                e.preventDefault();

                const btn = $('#submitBtn');
                const icon = $('#submitIcon');
                const btnText = $('#submitText');

                btn.prop('disabled', true);
                icon.removeClass('bi-send-fill').addClass('bi-hourglass-split');
                btnText.text('Mengirim...');

                $.ajax({
                    url: base_url + 'Pengaduan/add_pengaduan',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(res) {
                        resetBtn();

                        if (res.status === true) {
                            // Reset form terlebih dahulu
                            $('#formPengaduan')[0].reset();
                            uploadZone.classList.remove('has-file');
                            filenameText.textContent = '';

                            // Tampilkan SweetAlert sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pengaduan Anda telah terkirim.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Setelah SweetAlert ditutup, tampilkan alert bootstrap dengan kode
                                $('#kodePengaduanAlert').removeClass('d-none').find('#alertMessage').html(
                                    `Pengaduan berhasil dikirim! Kode pengaduan Anda: <strong>${res.kode_pengaduan}</strong>. Simpan kode ini untuk melacak status.`
                                );

                                // Auto hide setelah 10 detik
                                setTimeout(() => {
                                    $('#kodePengaduanAlert').addClass('d-none');
                                }, 10000);
                            });
                        } else {
                            Swal.fire({
                                icon: res.icon || 'error',
                                title: 'Gagal!',
                                html: res.message,
                                confirmButtonText: 'Coba Lagi',
                                confirmButtonColor: 'var(--kt-primary)',
                            });
                        }
                    },

                    error: function() {
                        resetBtn();
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Koneksi bermasalah atau server tidak merespons. Silakan coba lagi.',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: 'var(--kt-primary)',
                        });
                    }
                });
            });

            function resetBtn() {
                $('#submitBtn').prop('disabled', false);
                $('#submitIcon').removeClass('bi-hourglass-split').addClass('bi-send-fill');
                $('#submitText').text('Kirim Pengaduan');
            }

            // ========== FITUR SEARCH PENGADUAN ==========
            
            // Load recent searches from localStorage
            function loadRecentSearches() {
                let searches = JSON.parse(localStorage.getItem('recentPengaduanSearches') || '[]');
                let html = '';
                
                searches.slice(0, 5).forEach(kode => {
                    html += `<span class="recent-search-pill" onclick="searchByKode('${kode}')">
                                <i class="bi bi-clock-history me-1"></i>
                                ${kode}
                            </span>`;
                });
                
                $('#recentSearches').html(html || '<span class="text-gray-500 fs-7">Belum ada pencarian</span>');
            }

            // Save search to localStorage
            function saveSearch(kode) {
                let searches = JSON.parse(localStorage.getItem('recentPengaduanSearches') || '[]');
                
                searches = searches.filter(item => item !== kode);
                searches.unshift(kode);
                searches = searches.slice(0, 10);
                
                localStorage.setItem('recentPengaduanSearches', JSON.stringify(searches));
                loadRecentSearches();
            }

            // Search function
            window.searchByKode = function(kode) {
                if (!kode) return;
                $('#kodePengaduan').val(kode);
                performSearch();
            };

            function performSearch() {
                const kode = $('#kodePengaduan').val().trim();
                
                if (!kode) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kode Kosong',
                        text: 'Masukkan kode pengaduan terlebih dahulu',
                        confirmButtonColor: 'var(--kt-primary)'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mencari...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'Pengaduan/search_by_kode',
                    type: 'POST',
                    data: { kode: kode },
                    dataType: 'json',
                    success: function(response) {
                        Swal.close();
                        if (response.found) {
                            displaySearchResult(response.data);
                            saveSearch(kode);
                        } else {
                            showNotFound();
                        }
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menghubungi server. Silakan coba lagi.',
                            confirmButtonColor: 'var(--kt-primary)'
                        });
                    }
                });
            }

            function displaySearchResult(data) {
                let statusClass = '';
                let statusText = '';
                
                switch(data.status) {
                    case '1':
                        statusClass = 'warning';
                        statusText = 'Menunggu Diproses';
                        break;
                    case '2':
                        statusClass = 'primary';
                        statusText = 'Sedang Diproses';
                        break;
                    case '3':
                        statusClass = 'success';
                        statusText = 'Selesai';
                        break;
                    case '4':
                        statusClass = 'danger';
                        statusText = 'Tidak Selesai';
                        break;
                    default:
                        statusClass = 'secondary';
                        statusText = 'Unknown';
                }
                
                $('#resultStatus').html(`<i class="bi bi-tag me-1"></i>${statusText}`);
                $('#resultStatus').removeClass().addClass(`badge badge-light-${statusClass}`);
                
                let html = `
                    <div class="result-item">
                        <span class="result-label">Kode</span>
                        <span class="result-value">${data.kode}</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Kategori</span>
                        <span class="result-value">${data.kategori}</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Judul</span>
                        <span class="result-value">${data.judul}</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Tanggal</span>
                        <span class="result-value">${data.tanggal}</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Status</span>
                        <span class="result-value">
                            <span class="status-badge ${statusClass}">${statusText}</span>
                        </span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Info</span>
                        <span class="result-value">${data.pesan}</span>
                    </div>
                `;
                
                $('#resultContent').html(html);
                $('#searchResult').show();
                $('#notFoundMessage').hide();
                
                // Jika ada tombol detail, bisa diaktifkan
                // $('#viewDetailBtn').attr('href', base_url + 'admin/Pengaduan_karyawan/detail/' + data.id);
            }

            function showNotFound() {
                $('#searchResult').hide();
                $('#notFoundMessage').show();
            }

            $('#btnCariPengaduan').on('click', performSearch);
            
            $('#kodePengaduan').on('keypress', function(e) {
                if (e.which === 13) performSearch();
            });

            loadRecentSearches();

            window.searchByKode = function(kode) {
                $('#kodePengaduan').val(kode);
                performSearch();
            };
        });
    </script>
</main>