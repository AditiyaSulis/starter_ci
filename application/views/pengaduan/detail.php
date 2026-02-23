<main>
    <h1 class="mb-4">Pengaduan Karyawan</h1>

    <?php 
        switch($pengaduan->status_pengaduan) {
            case 1: 
                $status = '<span class="badge badge-warning badge-lg py-3 px-4">
                                <i class="bi bi-clock-history me-2"></i>
                                Menunggu Diproses
                            </span>';
                break;
            case 2: 
                $status = '<span class="badge badge-primary badge-lg py-3 px-4">
                                <i class="bi bi-arrow-repeat me-2"></i>
                                Sedang Diproses
                            </span>';
                break;
            case 3: 
                $status = '<span class="badge badge-success badge-lg py-3 px-4">
                                <i class="bi bi-check2-circle me-2"></i>
                                Selesai
                            </span>';
                break;
            case 4: 
                $status = '<span class="badge badge-danger badge-lg py-3 px-4">
                                <i class="bi bi-x-circle me-2"></i>
                                Tidak Selesai
                            </span>';
                break;
            default: 
              $status = '<span class="badge badge-danger badge-lg py-3 px-4">
                            <i class="bi bi-x-circle me-2"></i>
                            Undefined
                        </span>';
               break;
        }
    ?>

    <div class="card shadow-sm">
        <div class="card-header border-0 pt-6">
            <div class="card-toolbar w-100">
                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                    <a href="<?= base_url('admin/Pengaduan_karyawan') ?>" class="btn btn-sm btn-primary btn-flex">
                        <i class="bi bi-arrow-left-short fs-2 me-2"></i>
                        Kembali ke Daftar
                    </a>
                    <div class="badge badge-light-primary fw-bold py-3 px-4">
                        <span class="bullet bullet-primary me-2 w-2 h-2"></span>
                        Detail Pengaduan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-9">
            <!-- Title -->
            <div class="d-flex flex-wrap align-items-center gap-3 mb-10">
                <h1 class="fw-bold text-gray-900 mb-0">Detail Pengaduan</h1>
                <span class="badge badge-light-primary">
                    <i class="bi bi-hash me-1"></i>
                    KODE <?= $pengaduan->kode_pengaduan ?>
                </span>
            </div>

            <!-- Status Bar -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-8 pb-4 border-bottom border-gray-300">
                <?= $status ?>
                <div class="d-flex flex-wrap gap-5">
                    <span class="d-flex align-items-center gap-2 text-gray-700">
                        <i class="bi bi-calendar3 text-primary fs-3"></i>
                        Dibuat: <?= date('d-m-Y', strtotime($pengaduan->created_at)) ?>
                    </span>
                </div>
            </div>

            <!-- Judul -->
            <div class="mb-8">
                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                    <i class="bi bi-tag-fill text-primary fs-4"></i>
                    JUDUL PENGADUAN
                </label>
                <h2 class="fw-bold fs-2x text-gray-900 mb-3">
                    <?= $pengaduan->title_pengaduan ?>
                </h2>
            </div>

            <!-- Isi -->
            <div class="mb-8">
                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                    <i class="bi bi-chat-left-text-fill text-primary fs-4"></i>
                    ISI PENGADUAN
                </label>
                <div class="bg-light p-8 rounded text-gray-800 fs-5" style="line-height: 1.8;">
                    <?= $pengaduan->text_pengaduan ?>
                </div>
            </div>

            <!-- Lampiran -->
            <div class="mb-8">
                <label class="d-flex align-items-center gap-2 mb-3 fs-6 fw-bold text-uppercase text-gray-600">
                    <i class="bi bi-paperclip text-primary fs-4"></i>
                    LAMPIRAN
                </label>
                <div class="row g-5">
                    <?php if(!empty($pengaduan->image_pengaduan)): ?>
                        <div class="col-md-4 col-sm-6">
                            <a href="<?=base_url('uploads/pengaduan/'.$pengaduan->image_pengaduan)?>" target="_blank">
                                <div class="card card-dashed hoverable">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="symbol symbol-40px bg-light-primary">
                                            <i class="bi bi-file-earmark-image fs-2x text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="text-gray-800 fw-bold d-block text-truncate"><?= $pengaduan->image_pengaduan ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-gray-500 fst-italic mb-0">Tidak ada lampiran</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap gap-3 justify-content-end pt-6 border-top border-gray-300">
                <button class="btn btn-light btn-sm">
                    <i class="bi bi-printer-fill fs-3 me-2"></i>
                    Cetak
                </button>
                <button class="btn btn-light btn-sm">
                    <i class="bi bi-share-fill fs-3 me-2"></i>
                    Bagikan
                </button>
            </div>
        </div>
    </div>

    <style>
    /* Animasi untuk processing */
    .badge-primary i.bi-arrow-repeat {
        animation: spin 2s infinite linear;
        display: inline-block;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Hover effects */
    .card-dashed:hover {
        border-color: var(--kt-primary) !important;
        background: var(--kt-primary-light) !important;
        transition: all 0.3s ease;
    }

    .card-dashed:hover .symbol {
        background: var(--kt-primary) !important;
    }

    .card-dashed:hover .symbol i {
        color: white !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .fs-2x {
            font-size: 1.5rem !important;
        }
        
        .card-body.pt-9 {
            padding-top: 1.5rem !important;
        }
        
        .gap-5 {
            gap: 1rem !important;
        }
    }
    </style>

    <script>
        // document.querySelectorAll('.card-dashed').forEach(item => {
        //     item.addEventListener('click', () => {
        //         Swal.fire({
        //             text: 'Fitur download akan diimplementasikan dengan backend',
        //             icon: 'info',
        //             confirmButtonText: 'Oke',
        //             confirmButtonColor: 'var(--kt-primary)'
        //         });
        //     });
        // });

        document.querySelectorAll('.btn-light').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    text: 'Fitur ini akan diintegrasikan dengan backend',
                    icon: 'info',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: 'var(--kt-primary)'
                });
            });
        });
    </script>
</main>