<?php
Class Keluar extends CI_Controller{
       
         
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
		$this->load->helper('fungsidate');
        $this->load->model(array('model_keluar','model_kas'));
        $this->load->library(array('template','pagination','dompdf_gen','form_validation'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Kas Keluar';
		$isi['kodeunik'] = $this->model_keluar->buat_kode();
        $isi['keluar']     = $this->model_keluar->tampilkan();
		$isi['total'] = $this->model_keluar->jumlah();
        $this->template->utama('view_keluar',$isi);        
       }
	
	function view(){
        $isi['judul']    = ' Halaman Kas Keluar';
		$isi['kodeunik'] = $this->model_keluar->buat_kode();
        $isi['keluar']     = $this->model_keluar->tampilkan();
		$isi['total'] = $this->model_keluar->jumlah();
        $this->template->utama('lihat_keluar',$isi);        
       }
	
	function tambih()   {
        if(isset($_POST['submit'])){
    	$saldo = $this->input->post('nom');
		$split = explode('|', $this->input->post('kas'));	
		$kd_kas = $split[0];            
           $data = array( 
        	'kwitansi'=>  $this->input->post('kwi'),           
            'id_guru'=>  $this->input->post('nm'),
            'keperluan'=>  $this->input->post('per'),
            'tgl_keluar' => $this->input->post('tgl'),
            'nominal'=>  $this->input->post('nom'),	
            'id_kas' => $kd_kas,			     
        );		
       	$this->model_keluar->tambah($data);
		$this->model_keluar->updateed($data,$saldo);
		$this->session->set_flashdata('success', 'Transaksi Berhasil di Tambah');
		redirect('keluar');
		}       
        else{
        	$datas['kodeunik'] = $this->model_keluar->buat_kode();
        	$datas['judul'] = 'Halaman Kas Keluar';
			$datas['kas'] = $this->model_keluar->getdana()->result();
            $this->template->utama('tambah_keluar',$datas);            
        }
    }

	function add()   {
        if(isset($_POST['submit'])){
    	$saldo = $this->input->post('nom');
		$split = explode('|', $this->input->post('kas'));	
		$kd_kas = $split[0];            
           $data = array( 
        	'kwitansi'=>  $this->input->post('kwi'),           
            'id_guru'=>  $this->input->post('nm'),
            'keperluan'=>  $this->input->post('per'),
            'tgl_keluar' => $this->input->post('tgl'),
            'nominal'=>  $this->input->post('nom'),	
            'id_kas' => $kd_kas,			     
        );		
       	$this->model_keluar->tambah($data);
		$this->model_keluar->updateed($data,$saldo);
		$this->session->set_flashdata('success', 'Transaksi Berhasil di Tambah');
		redirect('keluar');
		}       
        else{
        	$datas['kodeunik'] = $this->model_keluar->buat_kode();
        	$datas['judul'] = 'Halaman Kas Keluar';
			$datas['kas'] = $this->model_keluar->getdana()->result();
            $this->template->utama('tambah_keluar',$datas);            
        }
    }


	
	public function danakas()
	{
		if($this->input->is_ajax_request())
		{
			$id_pelanggan = $this->input->post('dana_kas');
			
			$data = $this->model_keluar->get_baris($id_pelanggan)->row();
			$json['saldo']			= ( ! empty($data->saldo)) ? $data->saldo : "<small><i>Tidak ada</i></small>";
			
			echo json_encode($json);
		}
	}
	
	function cariDana(){
        $kas= $this->input->post('kas');
        $saldo= $this->model_keluar->cariDana($kas);
        if($saldo->num_rows()>0){
            $saldo=$saldo->row_array();
            echo $saldo['saldo'];
        }
    }
       
      function tambah(){       	
       	$saldo = $this->input->post('nom');	
		/*$kas = $this->input->post('saldo');		
		if ($saldo > $kas) {
			alert('Transaksi Tidak di Ijinkan');		
			return false;
		} else {*/
		$split = explode('|', $this->input->post('kas'));	
		$kd_kas = $split[0];			      		
        $data = array( 
        	'kwitansi'=>  $this->input->post('kwi'),           
            'id_guru'=>  $this->input->post('nm'),
            'keperluan'=>  $this->input->post('per'),
            'tgl_keluar' => $this->input->post('tgl'),
            'nominal'=>  $this->input->post('nom'),	
            'id_kas' => $kd_kas,			     
        );		
       	$this->model_keluar->tambah($data);			
		$this->model_keluar->updateed($data,$saldo);
		echo json_encode(array("status" => TRUE));
		//}		      
    }
    
    function edit($id){
	$data = $this->model_keluar->get_id($id);
	echo json_encode($data);
		}
                
    function update(){
         $data = array(            
            'kwitansi'=>  $this->input->post('kwi'),           
            'id_guru'=>  $this->input->post('nm'),
            'keperluan'=>  $this->input->post('per'),
            'tgl_keluar' => $this->input->post('tgl'),
            'nominal'=>  $this->input->post('nom'),	
            'id_kas' => $this->input->post('kas')	
        );
       $this->model_keluar->update(array('id_keluar' => $this->input->post('id_keluar')), $data);
	echo json_encode(array("status" => TRUE));
    }
    
    function delete($id){
        $data = $this->model_keluar->delete_id($id);
        $this->model_keluar->delete_update($data);
        echo json_encode(array("status" => TRUE));
    }
		
	function laporan(){
		$data['judul']    = 'Laporan Dana Keluar';		
		$this->template->utama('laporan/lapo_keluar',$data);
	}
	
	function aksi_laporan($from, $to, $sumber){				
		$dt['keluar'] 	= $this->model_keluar->laporan($from, $to, $sumber);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$dt['sumber'] = $this->input->post($sumber);
		$this->load->view('laporan/laporan_keluar', $dt);
	}

	function aksi_lapor($from, $to){				
		$dt['keluar'] 	= $this->model_keluar->lapor($from, $to);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$this->load->view('laporan/lapor_keluar', $dt);
	}
	
	function laporan_pdf($from,$to,$sumber){		 
		$this->load->library('cfpdf');
		$tgl = date('d F Y');	
		$nama = $this->session->userdata('nama_lengkap');
				
		$pdf = new FPDF('L','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',17);

        $pdf->Cell(0, 10, "DINAS PENDIDIKAN ", 10, 1, 'C');
        $pdf->Cell(0, 10, "SMP NEGERI 1 CIKANDE ", 10, 1, 'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 7, "Laporan Kas Keluar", 5, 1, 'C');
        $pdf->Cell(0, 5, "Periode ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'C');
		$pdf->Ln(10); 
		$pdf->SetFont('Arial','',10);		

		$pdf->Cell(7, 7, 'No', 1, 0, 'L');
		$pdf->Cell(35, 7, 'No Kwitansi', 1, 0, 'L');		
		$pdf->Cell(35, 7, 'Nama Penerima', 1, 0, 'L'); 
		$pdf->Cell(45, 7, 'Keperluan', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Tgl Keluar', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Nominal', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Sumber Kas', 1, 0, 'L');
				 
		$pdf->Ln();
		
		$transaksi 	= $this->model_keluar->laporan_pdf($from, $to, $sumber);

		$no = 1;
		
		foreach($transaksi->result() as $p)
		{
			$pdf->Cell(7, 7, $no, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->kwitansi, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->nm_guru, 1, 0, 'L');
			$pdf->Cell(45, 7, $p->keperluan, 1, 0, 'L');
			$pdf->Cell(35, 7, date('d F Y', strtotime($p->tgl_keluar)), 1, 0, 'L');			
			$pdf->Cell(35, 7, number_format($p->nominal), 1, 0, 'L');		
			$pdf->Cell(35, 7, $p->dana, 1, 0, 'L');			
			$pdf->Ln();			
			$no++;
		}
		
		$pdf->Ln();
		$pdf->Cell(0, 1, "Mengetahui,  ", 20, 1, 'R');		
		
		$pdf->Cell(0, 2, "Tangerang,  ".date('d/m/Y', strtotime($tgl)), 0, 1, 'L');
		$pdf->Ln(19);
		$pdf->Cell(0, 1, "Kep Sekolah ", 0, 1, 'R');
		$pdf->Cell(0, 1, "$nama ", 0, 1, 'L');			
		
		$pdf->Output();
	}	

	function lapor_pdf($from,$to){		 
		$this->load->library('cfpdf');
		$tgl = date('d F Y');	
		$nama = $this->session->userdata('nama_lengkap');
				
		$pdf = new FPDF('L','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',17);

        $pdf->Cell(0, 10, "DINAS PENDIDIKAN ", 10, 1, 'C');
        $pdf->Cell(0, 10, "SMP NEGERI 1 CIKANDE ", 10, 1, 'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 7, "Laporan Kas Keluar", 5, 1, 'C');
        $pdf->Cell(0, 5, "Periode ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'C');
		$pdf->Ln(10); 
		$pdf->SetFont('Arial','',10);		

		$pdf->Cell(7, 7, 'No', 1, 0, 'L');
		$pdf->Cell(35, 7, 'No Kwitansi', 1, 0, 'L');		
		$pdf->Cell(35, 7, 'Nama Penerima', 1, 0, 'L'); 
		$pdf->Cell(45, 7, 'Keperluan', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Tgl Keluar', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Nominal', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Sumber Kas', 1, 0, 'L');
				 
		$pdf->Ln();
		
		$transaksi 	= $this->model_keluar->lapor_pdf($from, $to);

		$no = 1;
		
		foreach($transaksi->result() as $p)
		{
			$pdf->Cell(7, 7, $no, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->kwitansi, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->nm_guru, 1, 0, 'L');
			$pdf->Cell(45, 7, $p->keperluan, 1, 0, 'L');
			$pdf->Cell(35, 7, date('d F Y', strtotime($p->tgl_keluar)), 1, 0, 'L');			
			$pdf->Cell(35, 7, number_format($p->nominal), 1, 0, 'L');		
			$pdf->Cell(35, 7, $p->dana, 1, 0, 'L');			
			$pdf->Ln();			
			$no++;
		}
		
		$pdf->Ln();
		$pdf->Cell(0, 1, "Mengetahui,  ", 20, 1, 'R');		
		
		$pdf->Cell(0, 2, "Tangerang,  ".date('d/m/Y', strtotime($tgl)), 0, 1, 'L');
		$pdf->Ln(19);
		$pdf->Cell(0, 1, "Kep Sekolah ", 0, 1, 'R');
		$pdf->Cell(0, 1, "$nama ", 0, 1, 'L');			
		
		$pdf->Output();
	}	
}