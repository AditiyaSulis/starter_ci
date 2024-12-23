<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller JsonTypicode
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class JsonTypicode extends CI_Controller
{
    
  public function __construct()
  {
    $this->load->helper('call_api');
    parent::__construct();
  }

  public function fetch_data_from_api() {
        $url = 'https://jsonplaceholder.typicode.com/posts'; // URL API
        $response = $this->call_api($url, 'GET'); // Panggil API dengan metode GET

        if ($response['status']) {
            $data['posts'] = $response['data'];
            $this->load->view('posts_view', $data); // Kirim data ke view
        } else {
            echo "Gagal memuat data: " . $response['message'];
        }

        $this->load->view('api_view');
    } 


}


/* End of file JsonTypicode.php */
/* Location: ./application/controllers/JsonTypicode.php */