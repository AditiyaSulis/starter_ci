
<?php 
    switch($pengaduan->status_pengaduan) {
        case 1: 
            $status = '<div class="status-badge pending">
                            <i class="bi bi-clock-history"></i>
                            Menunggu Diproses
                        </div>';
            break;
        case 2: 
            $status = ' <div class="status-badge processing">
                            <i class="bi bi-arrow-repeat"></i>
                            Sedang Diproses
                        </div>';
            break;
        case 3: 
            $status = '<div class="status-badge completed">
                            <i class="bi bi-check2-circle"></i>
                            Selesai
                        </div>';
            break;
        case 4: 
            $status = '<div class="status-badge rejected">
                            <i class="bi bi-x-circle"></i>
                            Tidak Selesai
                        </div>';
            break;
        default: 
          $status = '<div class="status-badge rejected">
                        <i class="bi bi-x-circle"></i>
                        Undefined
                    </div>';
           break;
    }
?>

<style>
    .back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(77,159,255,0.08);
    border: 1px solid rgba(77,159,255,0.18);
    border-radius: 100px;
    padding: 10px 20px;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.25s ease;
  } 

   .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        border-radius: 100px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.02em;
    }

    /* 1. MENUNGGU DIPROSES - Warna Kuning/Orange */
    .status-badge.pending {
        background: rgba(255, 183, 77, 0.12);
        border: 1px solid rgba(255, 183, 77, 0.3);
        color: #ffb74d;
    }

    .status-badge.pending i {
        color: #ffb74d;
        filter: drop-shadow(0 0 8px rgba(255, 183, 77, 0.3));
    }

    /* 2. SEDANG DIPROSES - Warna Biru */
    .status-badge.processing {
        background: rgba(77, 159, 255, 0.12);
        border: 1px solid rgba(77, 159, 255, 0.3);
        color: #4d9fff;
    }

    .status-badge.processing i {
        color: #4d9fff;
        filter: drop-shadow(0 0 8px rgba(77, 159, 255, 0.3));
    }

    /* 3. SELESAI - Warna Hijau */
    .status-badge.completed {
        background: rgba(79, 255, 176, 0.12);
        border: 1px solid rgba(79, 255, 176, 0.3);
        color: #4fffb0;
    }

    .status-badge.completed i {
        color: #4fffb0;
        filter: drop-shadow(0 0 8px rgba(79, 255, 176, 0.3));
    }

    /* 4. TIDAK SELESAI - Warna Merah */
    .status-badge.rejected {
        background: rgba(255, 79, 110, 0.12);
        border: 1px solid rgba(255, 79, 110, 0.3);
        color: #ff4f6e;
    }

    .status-badge.rejected i {
        color: #ff4f6e;
        filter: drop-shadow(0 0 8px rgba(255, 79, 110, 0.3));
    }

    /* Animasi untuk status processing (berputar) */
    .status-badge.processing i {
        animation: spin 2s infinite linear;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Efek hover untuk semua status */
    .status-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    /* Versi ringkas (untuk tampilan yang lebih kecil) */
    .status-badge.compact {
        padding: 4px 12px;
        font-size: 12px;
    }

    .status-badge.compact i {
        font-size: 14px;
    }

</style>

<main>
    <h1 class="mb-4">Detail</h1>

	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		
        <div class="detail-header">
            <a href="#" class="back-button">
            <i class="bi bi-arrow-left-short"></i>
            Kembali ke Daftar
            </a>
            <div class="page-label">
            <div class="label-dot"></div>
            <span class="label-text">Detail Pengaduan</span>
            </div>
        </div>
		
	</div>

</main>
