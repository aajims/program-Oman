<?php
Class Masuk extends CI_Controller{
       
     public $data;    
    function __construct() {
        parent::__construct();
        $this->model_squrity->getsqurity();
        $this->load->database();
		$this->load->helper('fungsidate');
        $this->load->model(array('model_masuk','model_kas'));
        $this->load->library(array('template','pagination','form_validation'));
    }
        
    function index(){
        $isi['judul']    = ' Halaman Kas Masuk';
		$isi['kodeunik'] = $this->model_masuk->buat_kode();
        $isi['masuk']     = $this->model_masuk->tampilkan();
		$isi['message']=    "<div class='alert alert-success'>Data Berhasil diupdate</div>";
		$isi['total'] = $this->model_masuk->jumlah();
        $this->template->utama('view_masuk',$isi);        
       }
	
	function view(){
        $isi['judul']    = ' Halaman Kas Masuk';
		$isi['kodeunik'] = $this->model_masuk->buat_kode();
        $isi['masuk']     = $this->model_masuk->tampilkan();
		$isi['total'] = $this->model_masuk->jumlah();
        $this->template->utama('lihat_masuk',$isi);        
       }
       
     function tambah(){
	    $this->_validate();
       	$saldo =strip_tags($this->input->post('nom'));
		$data = array(
            'kwitansi'=>  $this->input->post('kwi'), 
            'id_kas'=>  $this->input->post('sum'),
            'id_rek'=>  $this->input->post('rek'),
            'tgl_masuk' => $this->input->post('tgl'),		
			'nominal'=>  $this->input->post('nom')		    
        );
		$this->session->set_flashdata('success', 'Data Berhasil di Tambah');
       	$this->model_masuk->tambah($data);		
		$this->model_masuk->updatee($data,$saldo);
		echo json_encode(array("status" => TRUE));				 		         
    }
    
    function edit($id){
	$data = $this->model_masuk->get_id($id);
	echo json_encode($data);
		}
                
    function update(){
        $this->_validate();
         $data = array(
             'kwitansi'=>  $this->input->post('kwi'),
             'id_kas'=>  $this->input->post('sum'),
             'id_rek'=>  $this->input->post('rek'),
             'tgl_masuk' => $this->input->post('tgl'),
             'nominal'=>  $this->input->post('nom')
         );
       $this->model_masuk->update(array('id_masuk' => $this->input->post('id_masuk')), $data);
	echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('sum') == '' )
        {
            $data['inputerror'][] = 'sum';
            $data['error_string'][] = 'Sumber Dana Harus di Isi ';
            $data['status'] = FALSE;
        }

        if($this->input->post('tgl') == '')
        {
            $data['inputerror'][] = 'tgl';
            $data['error_string'][] = 'Data Tanggal Harus di Isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('nom') == '')
        {
            $data['inputerror'][] = 'nom';
            $data['error_string'][] = 'Data Nominal Harus di Isi';
            $data['status'] = FALSE;
        }

        if($this->input->post('kwi') == '')
        {
            $data['inputerror'][] = 'kwi';
            $data['error_string'][] = 'Data Kwitansi Harus di Isi';
            $data['status'] = FALSE;
        }


        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function delete($id){
        $data = $this->model_masuk->delete($id);
        $this->model_masuk->delete_update($data);
        echo json_encode(array("status" => TRUE));
    }


	function laporan(){
		$data['judul']    = 'Laporan Kas Masuk';
		$this->template->utama('laporan/lapo_masuk',$data);
	}

    function lapor(){
        $data['judul']    = 'Laporan Rekening Masuk';
        $this->template->utama('laporan/lap_masuk',$data);
    }
	
	function aksi_laporan($from, $to, $sumber){				
		$dt['masuk'] 	= $this->model_masuk->laporan($from, $to, $sumber);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$dt['sumber'] = $this->input->post($sumber);
		$this->load->view('laporan/laporan_masuk', $dt);
	}

    function aksi_rek_laporan($from, $to, $sumber){
        $dt['masuk'] 	= $this->model_masuk->laporanrek($from, $to, $sumber);
        $dt['from']			= date('d F Y', strtotime($from));
        $dt['to']			= date('d F Y', strtotime($to));
        $dt['sumber'] = $this->input->post($sumber);
        $this->load->view('laporan/laporan_rek_masuk', $dt);
    }

	function aksi_lapor($from, $to){				
		$dt['masuk'] 	= $this->model_masuk->lapor($from, $to);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$this->load->view('laporan/lapor_masuk', $dt);
	}

    function aksi_rek_lapor($from, $to){
        $dt['masuk'] 	= $this->model_masuk->laporrek($from, $to);
        $dt['from']			= date('d F Y', strtotime($from));
        $dt['to']			= date('d F Y', strtotime($to));
        $this->load->view('laporan/lapor_rek_masuk', $dt);
    }
	
	function laporan_pdf($from,$to,$sumber){		 
		$this->load->library('cfpdf');
		$tgl = date('d F Y');	
		$nama = $this->session->userdata('nama_lengkap');
				
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',17);

        $pdf->Cell(0, 10, "DINAS PENDIDIKAN ", 10, 1, 'C');
        $pdf->Cell(0, 10, "SMP NEGERI 1 CIKANDE ", 10, 1, 'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 7, "Laporan Kas Masuk ", 5, 1, 'C');
        $pdf->Cell(0, 5, "Periode ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'C');
		$pdf->Ln(10); 
		$pdf->SetFont('Arial','',10);		

		$pdf->Cell(7, 7, 'No', 1, 0, 'L');
		$pdf->Cell(35, 7, 'No Kwitansi', 1, 0, 'L');		
		$pdf->Cell(45, 7, 'Sumber Dana', 1, 0, 'L');
		$pdf->Cell(45, 7, 'Tgl Masuk', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Nominal', 1, 0, 'L');
				 
		$pdf->Ln();
		
		$transaksi 	= $this->model_masuk->laporan($from, $to, $sumber);

		$no = 1;
		
		foreach($transaksi->result() as $p)
		{
			$pdf->Cell(7, 7, $no, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->kwitansi, 1, 0, 'L');
			$pdf->Cell(45, 7, $p->dana, 1, 0, 'L');
			$pdf->Cell(45, 7, date('d F Y', strtotime($p->tgl_masuk)), 1, 0, 'L');
			$pdf->Cell(35, 7, number_format($p->nominal), 1, 0, 'L');
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

    function laporan_rek_pdf($from,$to,$sumber){
        $this->load->library('cfpdf');
        $tgl = date('d F Y');
        $nama = $this->session->userdata('nama_lengkap');

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',17);

        $pdf->Cell(0, 10, "DINAS PENDIDIKAN ", 10, 1, 'C');
        $pdf->Cell(0, 10, "SMP NEGERI 1 CIKANDE ", 10, 1, 'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 7, "Laporan Kas Masuk ", 5, 1, 'C');
        $pdf->Cell(0, 5, "Periode ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'C');
        $pdf->Cell(0, 7, "Nama Bank : $sumber ", 5, 1, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','',10);

        $pdf->Cell(7, 7, 'No', 1, 0, 'L');
        $pdf->Cell(35, 7, 'No Kwitansi', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Sumber Dana', 1, 0, 'L');
        $pdf->Cell(45, 7, 'No Rekening', 1, 0, 'L');
        $pdf->Cell(45, 7, 'Tgl Masuk', 1, 0, 'L');
        $pdf->Cell(35, 7, 'Nominal', 1, 0, 'L');

        $pdf->Ln();

        $transaksi 	= $this->model_masuk->laporanrek($from, $to, $sumber);

        $no = 1;

        foreach($transaksi->result() as $p)
        {
            $pdf->Cell(7, 7, $no, 1, 0, 'L');
            $pdf->Cell(35, 7, $p->kwitansi, 1, 0, 'L');
            $pdf->Cell(45, 7, $p->dana, 1, 0, 'L');
            $pdf->Cell(45, 7, $p->rek, 1, 0, 'L');
            $pdf->Cell(45, 7, date('d F Y', strtotime($p->tgl_masuk)), 1, 0, 'L');
            $pdf->Cell(35, 7, number_format($p->nominal), 1, 0, 'L');
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
				
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',17);

        $pdf->Cell(0, 10, "DINAS PENDIDIKAN ", 10, 1, 'C');
        $pdf->Cell(0, 10, "SMP NEGERI 1 CIKANDE ", 10, 1, 'C');
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(0, 7, "Laporan Kas Masuk ", 5, 1, 'C');
		$pdf->Cell(0, 5, "Periode ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'C');
		$pdf->Ln(10); 
		$pdf->SetFont('Arial','',10);		

		$pdf->Cell(7, 7, 'No', 1, 0, 'L');
		$pdf->Cell(35, 7, 'No Kwitansi', 1, 0, 'L');		
		$pdf->Cell(35, 7, 'Sumber Dana', 1, 0, 'L');		
		$pdf->Cell(35, 7, 'Tgl Masuk', 1, 0, 'L');
		$pdf->Cell(35, 7, 'Nominal', 1, 0, 'L');
						 
		$pdf->Ln();
		
		$transaksi 	= $this->model_masuk->lapor_pdf($from, $to);

		$no = 1;
		
		foreach($transaksi->result() as $p)
		{
			$pdf->Cell(7, 7, $no, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->kwitansi, 1, 0, 'L');
			$pdf->Cell(35, 7, $p->dana, 1, 0, 'L');			
			$pdf->Cell(35, 7, date('d F Y', strtotime($p->tgl_masuk)), 1, 0, 'L');			
			$pdf->Cell(35, 7, number_format($p->nominal), 1, 0, 'L');		
						
			$pdf->Ln();			
			$no++;
		}
		
		$pdf->Ln();
		$pdf->Cell(0, 1, "Mengetahui,  ", 20, 1, 'C');
		
		$pdf->Cell(0, 2, "Tangerang,  ".date('d/m/Y', strtotime($tgl)), 0, 1, 'L');
		$pdf->Ln(19);
		$pdf->Cell(0, 1, "Kep Sekolah ", 0, 1, 'C');
		$pdf->Cell(0, 1, "$nama ", 0, 1, 'L');			
		
		$pdf->Output();
	}	
}