<?php
class Core_data extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Piutang');
        $this->load->model('m_Purchase_piutang');
    }

	public function data_piutang()
	{
		$tenor = $this->input->post('tanggal_pelunasan');
		$type = $this->input->post('type');
		$status_piutang = $this->input->post('status_piutang');

		$list = $this->m_Piutang->getPiutangDataCore_get();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {

			$type_ten = '';
			if($item['type_tenor'] == 1) {
				$type_ten = 'Hari';
			} else if($item['type_tenor'] == 2) {
				$type_ten = 'Minggu';
			}else if($item['type_tenor'] == 3) {
				$type_ten = 'Bulan';
			}else if($item['type_tenor'] == 4) {
				$type_ten = 'Tahun';
			}
			$action = $status_piutang == 1 ?
						'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'"
                            data-name_log="'.htmlspecialchars($item['name']).'"
                            data-totals_log="'.htmlspecialchars($item['amount_piutang']).'"
                            data-paydate_log="'.htmlspecialchars($item['piutang_date']).'"
                            data-tgl_lunas_log="'.htmlspecialchars($item['tgl_lunas']).'">
                             LOG
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
						'
						:
						'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'"
                            data-remaining_piutang="'.htmlspecialchars($item['remaining_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-tenor_piutang="'.htmlspecialchars($item['tenor_piutang']).'"
                            data-angsuran="'.htmlspecialchars($item['angsuran']).'"
                            data-type_tenor="'.htmlspecialchars($item['type_tenor']).'">
                             PAY
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
						';



			$status = $item['status_piutang'] == 2 ?
						'
						  <td>
							  <span class="badge gradient-btn-unpaid btn-sm " style="width : 50px">
								  Unpaid
							  </span>
						  </td>
					    '
						:
						'
						  <td>
							  <span class="badge gradient-btn-paid btn-sm " style="width : 50px">
								  Paid
							  </span>
						  </td>
					   ';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['piutang_date']));
			$row[] = $item['name'];
			$row[] = $item['type_piutang'] == '2' ? 'Kasbon' : 'Pinjaman';
			$row[] = $item['tenor_piutang'] . ' ' . $type_ten;
			$row[] = 'Tanggal '.$item['jatuh_tempo'];
			$row[] = date('d M Y', strtotime($item['tgl_lunas']));
			$row[] = 'Rp.'. number_format($item['amount_piutang'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['remaining_piutang'], 0 , ',', '.');
			$row[] = $status;
			$row[] = 'Rp.'. number_format($item['angsuran'], 0 , ',', '.');
			$row[] = $item['description_piutang'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => count($list),
			"recordsFiltered" => count($list),
			"tenor" => $tenor,
			"type" => $type,
			"data" => $data,
		];

		echo json_encode($output);
	}
}
