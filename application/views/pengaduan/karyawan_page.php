<main>
    <h1 class="mb-4">Buat Pengaduan</h1>

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar w-100">
                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                    <a href="#" class="btn btn-sm btn-light btn-flex">
                        <i class="bi bi-arrow-left-short fs-2 me-2"></i>
                        Kembali ke Daftar
                    </a>
                    <div class="badge badge-light-primary fw-bold py-3 px-4">
                        <span class="bullet bullet-primary me-2 w-2 h-2"></span>
                        <span class="fs-8 fw-bold">Portal Karyawan</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-9">
            <!-- Title section -->
            <div class="d-flex flex-wrap align-items-center gap-3 mb-10">
                <h1 class="fw-bold text-gray-900 mb-0">Buat Pengaduan</h1>
                <span class="badge badge-light-primary">
                    <i class="bi bi-pencil-square me-1"></i>
                    Form Pengaduan
                </span>
            </div>

            <!-- Subtitle -->
            <p class="text-gray-600 mb-10 fs-5">
                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                Sampaikan keluhan atau aspirasi Anda dengan jelas. Setiap laporan akan ditangani secara profesional dan terjaga kerahasiaannya.
            </p>

            <!-- Form -->
            <div class="bg-light bg-opacity-25 rounded p-8">
                <form id="formPengaduan" enctype="multipart/form-data">
                    <!-- Upload -->
                    <div class="mb-8">
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

                    <!-- Judul -->
                    <div class="mb-8">
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
                    <div class="mb-8">
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
                    <div class="separator separator-dashed my-8"></div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-flex" id="submitBtn">
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

    /* Responsive */
    @media (max-width: 760px) {
        .upload-zone {
            padding: 40px 20px;
        }
        
        .bg-light.bg-opacity-25.rounded.p-8 {
            padding: 1.5rem !important;
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
    </style>

    <script>
    var base_url = "<?= base_url() ?>";

    $(document).ready(function() {
        // File upload feedback
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

        // Ajax Submit
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            confirmButtonText: 'Oke',
                            confirmButtonColor: 'var(--kt-primary)',
                        }).then(() => {
                            $('#formPengaduan')[0].reset();
                            uploadZone.classList.remove('has-file');
                            filenameText.textContent = '';
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
    });
    </script>
</main>