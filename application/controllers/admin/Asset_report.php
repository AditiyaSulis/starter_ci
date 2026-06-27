<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_asset_report');
        $this->load->model('M_asset_category');
    }

    public function index() {
        $this->_ONLYSELECTED([1, 2]);
        $data = $this->_basicData();

        $data['title'] = 'Rincian Asset';
        $data['view_name'] = 'asset/report_category';
        $data['breadcrumb'] = 'Rincian Asset';
        $data['menu'] = 'ASSET';

        // Ambil data laporan
        $report = $this->M_asset_report->get_total_per_category();
        $data['report'] = $report;

        // Hitung total keseluruhan
        $total_all = 0;
        foreach ($report as $row) {
            $total_all += $row->total_price;
        }
        $data['total_all'] = $total_all;

        // Jumlah kategori (yang memiliki aset)
        $data['total_categories'] = count($report);

        // Total aset (count)
        $data['total_assets'] = $this->M_asset_report->count_all_assets();

        // Data untuk chart (labels & values)
        $labels = [];
        $values = [];
        $colors = ['#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#dc3545', '#fd7e14', '#ffc107', '#198754', '#0dcaf0', '#0d6efd'];
        $i = 0;
        foreach ($report as $row) {
            $labels[] = $row->category_name;
            $values[] = (float) $row->total_price;
            $i++;
        }
        $data['chart_labels'] = json_encode($labels);
        $data['chart_values'] = json_encode($values);

        if (isset($data['user']) && $data['user']) {
            $this->load->view('templates/index', $data);
        } else {
            $this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
            redirect('login');
        }
    }

    // Filter berdasarkan rentang tanggal (opsional)
    public function filter() {
        $this->_ONLYSELECTED([1, 2]);
        $this->_isAjax();

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $report = $this->M_asset_report->get_total_per_category($start_date, $end_date);

        $total_all = 0;
        foreach ($report as $row) {
            $total_all += $row->total_price;
        }

        echo json_encode([
            'report' => $report,
            'total_all' => $total_all,
            'total_categories' => count($report),
            'total_assets' => $this->M_asset_report->count_all_assets($start_date, $end_date)
        ]);
    }
}