<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pengaduan</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
  :root {
    --bg:       #060b17;
    --surface:  #0c1528;
    --surface2: #101d35;
    --border:   #18293f;
    --accent:   #4d9fff;
    --muted:    #3d5a7a;
    --danger:   #ff4f6e;
    --success:  #4fffb0;
    --warning:  #ffb74d;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background: var(--bg);
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 64px 24px 80px;
  }

  /* Background effects */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 50% -10%, rgba(77,159,255,0.10) 0%, transparent 70%),
      radial-gradient(ellipse 40% 40% at 85% 80%, rgba(77,159,255,0.05) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
  }

  body::after {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
  }

  /* Main container */
  .detail-card {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 980px;
    animation: rise 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
  }

  @keyframes rise {
    from { opacity: 0; transform: translateY(32px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Header with back button */
  .detail-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    animation: rise 0.6s 0.08s cubic-bezier(0.22, 1, 0.36, 1) both;
  }

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

  .back-button:hover {
    background: rgba(77,159,255,0.15);
    border-color: var(--accent);
    transform: translateX(-3px);
  }

  .back-button i {
    font-size: 18px;
    color: var(--accent);
  }

  .page-label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(77,159,255,0.08);
    border: 1px solid rgba(77,159,255,0.18);
    border-radius: 100px;
    padding: 7px 18px 7px 12px;
  }

  .label-dot {
    width: 8px; height: 8px;
    background: var(--accent);
    border-radius: 50%;
    box-shadow: 0 0 8px var(--accent), 0 0 20px rgba(77,159,255,0.5);
    flex-shrink: 0;
  }

  .label-text {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: #ffffff;
  }

  /* Title section */
  .title-section {
    margin-bottom: 40px;
    animation: rise 0.6s 0.12s cubic-bezier(0.22, 1, 0.36, 1) both;
  }

  .form-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(2.2rem, 4.5vw, 3.2rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: #ffffff;
    margin-bottom: 16px;
  }

  .form-title em {
    font-style: normal;
    color: var(--accent);
  }

  .complaint-id {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(77,159,255,0.1);
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 14px;
    color: var(--accent);
    border: 1px solid rgba(77,159,255,0.2);
  }

  .complaint-id i {
    font-size: 16px;
  }

  /* Main content */
  .detail-body {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 24px;
    padding: 48px 56px;
    animation: rise 0.6s 0.16s cubic-bezier(0.22, 1, 0.36, 1) both;
    box-shadow: 0 40px 100px rgba(0,0,0,0.5), 0 0 0 1px rgba(77,159,255,0.04);
  }

  /* Status badge */
  .status-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 40px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
  }

  .status-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    border-radius: 100px;
    font-size: 14px;
    font-weight: 600;
  }

  .status-badge.pending {
    background: rgba(255, 183, 77, 0.1);
    border: 1px solid rgba(255, 183, 77, 0.3);
    color: #ffb74d;
  }

  .status-badge.processed {
    background: rgba(77, 159, 255, 0.1);
    border: 1px solid rgba(77, 159, 255, 0.3);
    color: var(--accent);
  }

  .status-badge.completed {
    background: rgba(79, 255, 176, 0.1);
    border: 1px solid rgba(79, 255, 176, 0.3);
    color: var(--success);
  }

  .status-badge.rejected {
    background: rgba(255, 79, 110, 0.1);
    border: 1px solid rgba(255, 79, 110, 0.3);
    color: var(--danger);
  }

  .date-info {
    display: flex;
    align-items: center;
    gap: 24px;
  }

  .date-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #ffffff;
    opacity: 0.9;
  }

  .date-item i {
    color: var(--accent);
    font-size: 16px;
  }

  /* Meta information grid */
  .meta-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
    margin-bottom: 40px;
    padding: 24px;
    background: var(--surface2);
    border-radius: 16px;
    border: 1px solid var(--border);
  }

  .meta-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .meta-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #8a9fb0;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .meta-label i {
    color: var(--accent);
    font-size: 14px;
  }

  .meta-value {
    font-size: 16px;
    font-weight: 500;
    color: #ffffff;
    line-height: 1.5;
  }

  .meta-value.small {
    font-size: 14px;
    color: #8a9fb0;
  }

  /* Complaint content */
  .complaint-content {
    margin-bottom: 40px;
  }

  .content-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #ffffff;
  }

  .content-label i {
    color: var(--accent);
    font-size: 16px;
  }

  .content-body {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 28px;
    font-size: 17px;
    line-height: 1.8;
    color: #ffffff;
    white-space: pre-wrap;
  }

  /* Attachment section */
  .attachment-section {
    margin-bottom: 40px;
  }

  .attachment-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #ffffff;
  }

  .attachment-label i {
    color: var(--accent);
    font-size: 16px;
  }

  .attachment-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
  }

  .attachment-item {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.25s ease;
    cursor: pointer;
  }

  .attachment-item:hover {
    border-color: var(--accent);
    background: rgba(77,159,255,0.05);
    transform: translateY(-2px);
  }

  .attachment-icon {
    width: 40px;
    height: 40px;
    background: rgba(77,159,255,0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .attachment-icon i {
    font-size: 20px;
    color: var(--accent);
  }

  .attachment-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .attachment-name {
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .attachment-size {
    font-size: 11px;
    color: #8a9fb0;
  }

  /* Response section */
  .response-section {
    background: linear-gradient(135deg, rgba(77,159,255,0.05) 0%, rgba(77,159,255,0.02) 100%);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 40px;
  }

  .response-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
  }

  .response-avatar {
    width: 48px;
    height: 48px;
    background: var(--accent);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 700;
    color: #060b17;
  }

  .response-meta {
    flex: 1;
  }

  .response-name {
    font-size: 16px;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 4px;
  }

  .response-role {
    font-size: 12px;
    color: #8a9fb0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .response-role i {
    font-size: 14px;
    color: var(--accent);
  }

  .response-date {
    font-size: 12px;
    color: #8a9fb0;
  }

  .response-content {
    font-size: 16px;
    line-height: 1.7;
    color: #ffffff;
    margin-left: 60px;
  }

  /* Action buttons */
  .action-buttons {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 40px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    border: none;
    cursor: pointer;
  }

  .btn-primary {
    background: var(--accent);
    color: #ffffff;
  }

  .btn-primary:hover {
    background: #6db3ff;
    box-shadow: 0 10px 20px rgba(77,159,255,0.3);
    transform: translateY(-2px);
  }

  .btn-outline {
    background: transparent;
    border: 1.5px solid var(--border);
    color: #ffffff;
  }

  .btn-outline:hover {
    border-color: var(--accent);
    background: rgba(77,159,255,0.05);
  }

  .btn i {
    font-size: 18px;
  }

  /* Divider */
  .divider {
    height: 1px;
    background: linear-gradient(to right, transparent, var(--border) 20%, var(--border) 80%, transparent);
    margin: 32px 0;
  }

  /* Responsive */
  @media (max-width: 760px) {
    body { padding: 40px 16px 60px; }
    .detail-body { padding: 32px 24px; }
    .meta-grid { grid-template-columns: 1fr; }
    .status-bar { flex-direction: column; align-items: flex-start; gap: 16px; }
    .date-info { flex-wrap: wrap; }
    .action-buttons { flex-direction: column; }
    .btn { justify-content: center; }
    .attachment-grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<div class="detail-card">

  <!-- Header with back button -->
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

  <!-- Title section -->
  <div class="title-section">
    <h1 class="form-title">
      Detail <em>Pengaduan</em>
    </h1>
    <div class="complaint-id">
      <i class="bi bi-hash"></i>
      <span>ID: PGN-2025-02-001</span>
    </div>
  </div>

  <!-- Main content -->
  <div class="detail-body">

    <!-- Status bar -->
    <div class="status-bar">
      <div class="status-badge pending">
        <i class="bi bi-clock-history"></i>
        Menunggu Diproses
      </div>
      <div class="date-info">
        <span class="date-item">
          <i class="bi bi-calendar3"></i>
          Dibuat: 20 Februari 2025, 14:30 WIB
        </span>
        <span class="date-item">
          <i class="bi bi-calendar-check"></i>
          Diperbarui: 21 Februari 2025, 09:15 WIB
        </span>
      </div>
    </div>

    <!-- Meta information -->
    <div class="meta-grid">
      <div class="meta-item">
        <span class="meta-label">
          <i class="bi bi-person-fill"></i>
          Nama Pengadu
        </span>
        <span class="meta-value">Budi Santoso</span>
        <span class="meta-value small">NIK: 1987654321</span>
      </div>
      <div class="meta-item">
        <span class="meta-label">
          <i class="bi bi-building"></i>
          Departemen
        </span>
        <span class="meta-value">Divisi Operasional</span>
        <span class="meta-value small">Cabang Jakarta Pusat</span>
      </div>
      <div class="meta-item">
        <span class="meta-label">
          <i class="bi bi-envelope-fill"></i>
          Kontak
        </span>
        <span class="meta-value">budi.santoso@company.com</span>
        <span class="meta-value small">+62 812-3456-7890</span>
      </div>
      <div class="meta-item">
        <span class="meta-label">
          <i class="bi bi-tag-fill"></i>
          Kategori
        </span>
        <span class="meta-value">Fasilitas Kantor</span>
        <span class="meta-value small">Prioritas: Normal</span>
      </div>
    </div>

    <!-- Complaint title -->
    <div style="margin-bottom: 32px;">
      <span class="content-label" style="margin-bottom: 12px;">
        <i class="bi bi-tag-fill"></i>
        JUDUL PENGADUAN
      </span>
      <h2 style="font-family: 'Syne', sans-serif; font-size: 24px; font-weight: 700; color: #ffffff; margin-bottom: 8px;">
        AC Lantai 3 Tidak Berfungsi dengan Baik
      </h2>
    </div>

    <!-- Complaint content -->
    <div class="complaint-content">
      <span class="content-label">
        <i class="bi bi-chat-left-text-fill"></i>
        ISI PENGADUAN
      </span>
      <div class="content-body">
        Saya ingin melaporkan bahwa AC di ruangan kerja lantai 3, khususnya di area timur (ruang 305-308), tidak berfungsi dengan baik sejak Senin, 19 Februari 2025. 
        
        Kondisi AC hanya mengeluarkan angin biasa tanpa pendinginan yang memadai, sehingga suhu ruangan menjadi panas dan mengganggu kenyamanan bekerja. Beberapa rekan kerja juga mengeluhkan hal yang sama.

        Teknisi sudah dipanggil namun belum ada tindak lanjut. Mohon segera ditindaklanjuti karena kondisi ini sangat mengganggu produktivitas kerja.

        Terima kasih atas perhatiannya.
      </div>
    </div>

    <!-- Attachment section -->
    <div class="attachment-section">
      <span class="attachment-label">
        <i class="bi bi-paperclip"></i>
        LAMPIRAN (3 FILE)
      </span>
      <div class="attachment-grid">
        <div class="attachment-item">
          <div class="attachment-icon">
            <i class="bi bi-filetype-jpg"></i>
          </div>
          <div class="attachment-info">
            <span class="attachment-name">foto_ac_1.jpg</span>
            <span class="attachment-size">2.4 MB</span>
          </div>
          <i class="bi bi-download" style="color: var(--accent);"></i>
        </div>
        <div class="attachment-item">
          <div class="attachment-icon">
            <i class="bi bi-filetype-png"></i>
          </div>
          <div class="attachment-info">
            <span class="attachment-name">foto_ac_2.png</span>
            <span class="attachment-size">1.8 MB</span>
          </div>
          <i class="bi bi-download" style="color: var(--accent);"></i>
        </div>
        <div class="attachment-item">
          <div class="attachment-icon">
            <i class="bi bi-filetype-pdf"></i>
          </div>
          <div class="attachment-info">
            <span class="attachment-name">laporan_teknisi.pdf</span>
            <span class="attachment-size">524 KB</span>
          </div>
          <i class="bi bi-download" style="color: var(--accent);"></i>
        </div>
      </div>
    </div>

    <!-- Response section (Admin/HRD response) -->
    <div class="response-section">
      <div class="response-header">
        <div class="response-avatar">
          <span>HR</span>
        </div>
        <div class="response-meta">
          <div class="response-name">Siti Rahayu</div>
          <div class="response-role">
            <i class="bi bi-shield-fill-check"></i>
            HRD Manager
          </div>
        </div>
        <div class="response-date">
          21 Februari 2025, 10:30 WIB
        </div>
      </div>
      <div class="response-content">
        Terima kasih atas laporannya. Kami sudah meneruskan keluhan ini ke tim teknisi dan akan segera ditindaklanjuti. Teknisi akan datang besok pagi pukul 09.00 untuk melakukan perbaikan. Mohon maaf atas ketidaknyamanannya.
      </div>
    </div>

    <!-- Additional response if any -->
    <div class="response-section" style="margin-top: 16px;">
      <div class="response-header">
        <div class="response-avatar" style="background: var(--success); color: #060b17;">
          <span>TK</span>
        </div>
        <div class="response-meta">
          <div class="response-name">Ahmad Hidayat</div>
          <div class="response-role">
            <i class="bi bi-tools"></i>
            Kepala Teknisi
          </div>
        </div>
        <div class="response-date">
          22 Februari 2025, 09:45 WIB
        </div>
      </div>
      <div class="response-content">
        Laporan tindak lanjut: Perbaikan AC sudah dilakukan. Unit AC di ruang 305-308 sudah berfungsi normal kembali. Kami akan melakukan pengecekan berkala untuk memastikan tidak ada masalah serupa. Terima kasih.
      </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Action buttons -->
    <div class="action-buttons">
      <button class="btn btn-outline">
        <i class="bi bi-printer-fill"></i>
        Cetak
      </button>
      <button class="btn btn-outline">
        <i class="bi bi-share-fill"></i>
        Bagikan
      </button>
      <button class="btn btn-primary">
        <i class="bi bi-check2-circle"></i>
        Tindak Lanjuti
      </button>
    </div>

  </div>

  <!-- Footer note -->
  <p class="form-footer" style="margin-top: 28px; text-align: center; color: #ffffff; opacity: 0.8;">
    <i class="bi bi-shield-lock-fill" style="color: var(--accent);"></i>
    Dokumen ini bersifat rahasia dan hanya dapat diakses oleh pihak yang berwenang
  </p>

</div>

<!-- Script for interactive elements (optional) -->
<script>
  // Optional: Add interactive functionality
  document.querySelectorAll('.attachment-item').forEach(item => {
    item.addEventListener('click', () => {
      // Simulate download or preview
      alert('Fitur download akan diimplementasikan dengan backend');
    });
  });

  document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      if (!btn.classList.contains('btn-outline') && !btn.classList.contains('btn-primary')) {
        e.preventDefault();
        alert('Fitur ini akan diintegrasikan dengan backend');
      }
    });
  });
</script>

</body>
</html>