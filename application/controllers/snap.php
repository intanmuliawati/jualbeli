
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET, OPTIONS");
class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-hAtdyN4Xa5fDSxbfRokGa0_M', 'production' => false);
		$this->load->model('pengadaan_model', 'pmodel');
        $this->load->library('form_validation');
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
		$data['title'] = 'Snap';
        $data['role_id'] = '2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user']['role_id'] != 2) {
            redirect('auth/blocked');
        }
		$this->load->view('temp/header', $data);
        $this->load->view('temp/sidebar', $data);
        $this->load->view('temp/topbar', $data);
        $this->load->view('checkout_snap');
        $this->load->view('temp/footer');
    	
    }

    public function token()
    {
	
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$pembelian = $this->pmodel->getpembelian($user['id']);
		$total = $this->input->post('tot');
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $total, // no decimal allowed for creditcard
		);
		$i =0;
		// Optional
		foreach ($pembelian as $p){
		$item_detail = array(
		  'id' => $p['id_pembelian'],
		  'price' => $p['harga_satuan'],
		  'quantity' => $p['jumlah'],
		  'name' => $p['subkategori_nama']
		);
		$item_details[$i] = $item_detail;
		$i++;
		}

		// Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 11000,
		//   'quantity' => 10,
		//   'name' => "Orange"
		// );

		// Optional
		// $item_details = array ($item2_details);

		// Optional
		// $billing_address = array(
		//   'first_name'    => "Andri",
		//   'last_name'     => "Litani",
		//   'address'       => "Mangga 20",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16602",
		//   'phone'         => "081122334455",
		//   'country_code'  => 'IDN'
		// );

		// Optional
		// $shipping_address = array(
		//   'first_name'    => "Obet",
		//   'last_name'     => "Supriadi",
		//   'address'       => "Manggis 90",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16601",
		//   'phone'         => "08113366345",
		//   'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
		  'first_name'    => $user['name'],
		  'email'         => $user['email'],
		  'phone'         => $user['no_tlp'],
		  'shipping_address' => $user['alamat']
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 300
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
		// $result = json_decode($this->input->post('result_data'));
    	// echo 'RESULT <br><pre>';
    	// var_dump($result);
		// echo '</pre>' ;
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$result = json_decode($this->input->post('result_data'),true);
		$data = [
		'id_faktur' => $result['order_id'],
		'tgl_pembelian' => date('Y-m-d'),
		'total' => $result['gross_amount'],
		'status_pay' => $result['status_code'],
		'payment_type' => $result['payment_type'],
		'transaction_time' => $result['transaction_time'],
		'bank' => $result['va_numbers'][0]['bank'],
		'va_number' => $result['va_numbers'][0]['va_number'],
		'url_pdf' => $result['pdf_url'],
		'id_user' => $user['id']
		];
		$this->db->insert('riwayat',$data);	
		$pembelian = $this->pmodel->getpembelian($user['id']);
		foreach ($pembelian as $p){
			$this->db->set('status',1);
			$this->db->set('id_faktur',$result['order_id']);
			$this->db->where('id_pembelian',$p['id_pembelian']);
			$this->db->update('pembelian');
		}
		$this->session->set_flashdata('flash', 'diinput!');
		redirect('pembelian');

    }
}