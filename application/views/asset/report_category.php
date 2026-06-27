<!-- Chart.js untuk visualisasi -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main>
    <h1 class="mb-4">Laporan Aset per Kategori</h1>

    <!-- Filter (opsional) -->
    <div class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" id="filter_start" class="form-control" value="">
        </div>
        <div class="col-md-3">
            <label class="form-label">Tanggal Akhir</label>
            <input type="date" id="filter_end" class="form-control" value="">
        </div>
        <div class="col-md-1">
            <button id="filter_btn" class="btn btn-primary">Filter</button>
            <button id="reset_filter" class="btn btn-warning">Reset</button>
        </div>
  
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Aset</h6>
                    <h2 class="mb-0" id="total_assets"><?= $total_assets ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Jumlah Kategori</h6>
                    <h2 class="mb-0" id="total_categories"><?= $total_categories ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Nilai Aset</h6>
                    <h2 class="mb-0" id="total_all">Rp <?= number_format($total_all, 0, ',', '.') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart & Table -->
    <div class="row">
        <!-- Chart -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
               <div class="card-header bg-transparent text-center d-flex align-items-center justify-content-center" style="min-height: 60px; padding: 12px 16px;">
                    <h5 class="mb-0">Distribusi Nilai Aset per Kategori</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" style="max-height:300px;"></canvas>
                </div>
            </div>
        </div>
        <!-- Tabel -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center d-flex align-items-center justify-content-center" style="min-height: 60px; padding: 12px 16px;">
                    <h5 class="mb-0">Rincian per Kategori</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-center">Jumlah Aset</th>
                                    <th class="text-end">Total Nilai</th>
                                    <th class="text-end">%</th>
                                </tr>
                            </thead>
                            <tbody id="report_table_body">
                                <?php if ($report): ?>
                                    <?php foreach ($report as $row): ?>
                                        <?php 
                                            $percentage = ($total_all > 0) ? ($row->total_price / $total_all) * 100 : 0;
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row->category_name) ?></td>
                                            <td class="text-center"><?= $row->total_assets ?></td>
                                            <td class="text-end">Rp <?= number_format($row->total_price, 0, ',', '.') ?></td>
                                            <td class="text-end"><?= number_format($percentage, 1) ?>%</td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let base = '<?= base_url() ?>';
        let chartInstance;

        // Data awal dari server
        let initialLabels = <?= $chart_labels ?>;
        let initialValues = <?= $chart_values ?>;
        let initialTotalAll = <?= $total_all ?>;

        // Fungsi render chart
        function renderChart(labels, values) {
            const ctx = document.getElementById('categoryChart').getContext('2d');
            if (chartInstance) {
                chartInstance.destroy();
            }
            chartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            '#0d6efd', '#6610f2', '#6f42c1', '#d63384', 
                            '#dc3545', '#fd7e14', '#ffc107', '#198754', 
                            '#0dcaf0', '#0d6efd'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 11 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? (value / total * 100).toFixed(1) : 0;
                                    return label + ': Rp ' + value.toLocaleString('id-ID') + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Fungsi update tabel
        function updateTable(report, totalAll) {
            const tbody = $('#report_table_body');
            tbody.empty();
            if (report && report.length > 0) {
                $.each(report, function(index, row) {
                    let percentage = totalAll > 0 ? (row.total_price / totalAll) * 100 : 0;
                    let tr = `
                        <tr>
                            <td>${row.category_name}</td>
                            <td class="text-center">${row.total_assets}</td>
                            <td class="text-end">Rp ${Number(row.total_price).toLocaleString('id-ID')}</td>
                            <td class="text-end">${percentage.toFixed(1)}%</td>
                        </tr>
                    `;
                    tbody.append(tr);
                });
            } else {
                tbody.append('<tr><td colspan="4" class="text-center text-muted">Tidak ada data</td></tr>');
            }
        }

        // Inisialisasi chart awal
        renderChart(initialLabels, initialValues);

        // Filter
        $('#filter_btn').on('click', function() {
            let startDate = $('#filter_start').val();
            let endDate = $('#filter_end').val();

            if (startDate && !endDate) {
                Swal.fire('Error', 'Tanggal akhir harus diisi', 'error');
                return;
            }
            if (!startDate && endDate) {
                Swal.fire('Error', 'Tanggal mulai harus diisi', 'error');
                return;
            }

            $.ajax({
                url: base + 'admin/Asset_report/filter',
                type: 'POST',
                data: { start_date: startDate, end_date: endDate },
                dataType: 'json',
                success: function(response) {
                    // Update summary
                    $('#total_assets').text(response.total_assets);
                    $('#total_categories').text(response.total_categories);
                    $('#total_all').text('Rp ' + Number(response.total_all).toLocaleString('id-ID'));

                    // Update chart
                    let labels = response.report.map(row => row.category_name);
                    let values = response.report.map(row => parseFloat(row.total_price));
                    renderChart(labels, values);

                    // Update table
                    updateTable(response.report, response.total_all);
                },
                error: function() {
                    Swal.fire('Error', 'Gagal memuat data', 'error');
                }
            });
        });

        // Reset filter
        $('#reset_filter').on('click', function() {
            $('#filter_start').val('');
            $('#filter_end').val('');
            // Reload halaman
            location.reload();
        });
    </script>
</main>