<?php

namespace App\Controllers;




class Home extends BaseController
{
	public function __construct(){
		$this->guvenlik();
	}
	public function guvenlik(){
		$session =session();
		if(empty($session->get('ad'))){
			echo view('login');
			$session =session();
			session()->setFlashdata('danger','Lütfen telefon numarasını ve şifrenizi girerek giriş yapmayı deneyiniz.....');			
			die();
		}
		
	}

	public function index()
	{
		$yetki = session('yetki');
		if($yetki==5){
			return redirect()->to('/home/carsi_view');
		}
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		$modelprogram= new \App\Models\ProgramModel;
	  	$tarih=SAAT;
	  	$data['title']="anasayfa";
		//ders aktifse çekiyoruz bu şartı sağlıyor	
		  $sart_active=array(
			'is_active'=>'1'
		);	
		$program=$modelprogram->where($sart_active)->findAll();
		$dersler=$modelprogram->where($sart_active)->findColumn('program_ad');
		$data['program']=$program;		
	    $data['toplamgeckalan']=0;
	    $data['toplamgelmeyen']=0;
	    $data['toplamizinli']=0;
		foreach ($program as $row) {
			$sart=array(
				'program_adi'=>$row['program_ad'],
				'tarih'=>$tarih
			);
			$data[$row['p_id'].'data']=$modelgeckalan->where($sart)->findAll();//gec kalanların bilgisi çekildi
			$data['s'.$row['p_id']]=count($data[$row['p_id'].'data']);//her programın 
			$data['toplamgeckalan']+=count($data[$row['p_id'].'data']);
			
		}
		
        
		foreach ($program as $row) {
			$sart=array(
				'program_adi'=>$row['program_ad'],
				'tarih'=>$tarih
			);
			$data[$row['p_id'].'dataGelmeyen']=$modelgelmeyen->where($sart)->findAll();
			$data['sGelmeyen'.$row['p_id']]=count($data[$row['p_id'].'dataGelmeyen']);
			$data['toplamgelmeyen']+=count($data[$row['p_id'].'dataGelmeyen']);
		}

		foreach ($program as $row) {
			$sart=array(
				'program_adi'=>$row['program_ad'],
				'tarih'=>$tarih
			);
			$data[$row['p_id'].'dataizinli']=$modelizinli->where($sart)->findAll();
			$data['sizinli'.$row['p_id']]=count($data[$row['p_id'].'dataizinli']);
			$data['toplamizinli']+=count($data[$row['p_id'].'dataizinli']);
		}	
	
		
		return view("home",$data);
	}
	
	public function ogrenci_ekle_view()
	{
	    error_reporting(E_ALL);
        ini_set("display_errors", 1);
        $data['title']="Öğrenci Ekle";
		return view("ogrenci_ekle",$data);
	}

	public function ogrenci_edit_view()
	{
		$model= new \App\Models\UsersModel;
		$data['viewdata']=$model->findAll();
		return view("talebe_listesi",$data);
	}

	public function update_view_ogrenci($ogrenci_no){
		$model= new \App\Models\UsersModel;
		$data['viewdata']=$model->where('ogrenci_no',$ogrenci_no)->find();
		$data['no']	=$ogrenci_no;
		return view("ogrenci_edit_form",$data);
	}


	public function ogrenci_insert(){
		$model= new \App\Models\UsersModel;
		$ogrenci_no=$this->request->getPost('ogrenci_no');
		$grup=$this->request->getPost('grup');
		$ad=$this->request->getPost('ad');
		$soyad=$this->request->getPost('soyad');
		$tel=$this->request->getPost('tel');
		$v_tel=$this->request->getPost('v_tel');
		$data=[
			'ogrenci_no'=>$ogrenci_no,
			'ad'=>$ad,
			'soyad'=>$soyad,
			'grup'=>$grup,
			'tel'=>$tel,
			'v_tel'=>$v_tel
		];

		$kontrol=$model->where('ogrenci_no', $ogrenci_no)->find();
		

		if(empty($kontrol)){
			$ekleme=$model->insert($data);
			if(isset($ekleme)){
				$session =session();
				session()->setFlashdata('success','Öğrenci başarı ile kaydedildi...');
				return redirect()->to('/home/ogrenci_ekle_view');			
			}
			else{
				$session =session();
				session()->setFlashdata('danger','Öğrenci kayıt edilirken bir hata oluştu...');
				return redirect()->to('/home/ogrenci_ekle_view');
			}

		}if(!empty($kontrol)){
			$session =session();
			session()->setFlashdata('danger','Bu id değerine sahip bir öğrenci zaten bulunmaktadır...');
			return redirect()->to('/home/ogrenci_ekle_view');
		}
		
		


	}

	public function ogrenci_update($no){
		$model= new \App\Models\UsersModel;
		
		$grup=$this->request->getPost('grup');
		$ad=$this->request->getPost('ad');
		$soyad=$this->request->getPost('soyad');
		$tel=$this->request->getPost('tel');
		$v_tel=$this->request->getPost('v_tel');
		$data=[
			'ogrenci_no'=>$no,
			'ad'=>$ad,
			'soyad'=>$soyad,
			'grup'=>$grup,
			'tel'=>$tel,
			'v_tel'=>$v_tel
		];

		$model->where('ogrenci_no', $no)->set($data)->update();
		$guncelleme=$model->update($no,$data);
		if($guncelleme){
			$message =$ad." ".$soyad." isimli  öğrencinin bilgileri güncellenmiştir...";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return redirect()->to('/home');			
		}
		else{
			$message ="GÜNCELLEME İŞLEMİ BAŞARISIZ....";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return redirect()->to('/home');
		}


	}

	public function yoklama_view()
	{
	
		$modelprogram= new \App\Models\ProgramModel;

		$tarih=SAAT;
		//special denen kısım veri tabanında 1 olan müzakere anlamında 0  diğerleri
		$sart=array(
			'is_active'=>'1',
			'special'=>'0'		
		);
		$data['alinmamis']=$modelprogram->where($sart)->where('date !=',$tarih)->findAll();	
		$data['alinmis']=$modelprogram->where($sart)->where('date',$tarih)->findAll();	
		return view("yoklama",$data);
	}

	public function gunluk_yoklama_liste_view($program,$program_ad)
	{
		$model= new \App\Models\UsersModel;
		$data['ogrenciler']=$model->where('info !=','1')->where('h_info !=','1')->findAll();
		$data['title']=$program;
		$data['program_ad']=$program_ad;
		return view("gunluk_yoklama_liste",$data);
				
	}
	public function gunluk_yoklama_liste_view2($program,$program_ad)
	{
		$model= new \App\Models\UsersModel;
		$data['ogrenciler']=$model->where('info !=','1')->where('h_info !=','1')->findAll();
		$data['title']=$program;
		$data['program_ad']=$program_ad;
		return view("gunluk_yoklama_liste2",$data);

	}

	public function gecinsert($ogrenci_no,$program,$ad,$soyad)
	{
		$model= new \App\Models\OgrenciModel;
		$sure=$this->request->getPost('geckalmasuresi');
		$modelprogram= new \App\Models\ProgramModel;
		$tarih=SAAT;		
			$sartders=[
				'p_id'=>$program
			];
		$program_ad=$modelprogram->where($sartders)->findColumn('program_ad');
		$program_adi=$program_ad[0];
		$data = [
			'ogrenci_no' => $ogrenci_no,
			'ad' => $ad,
			'soyad' => $soyad,
			'tarih' => $tarih,
			'sure' => $sure,
			'program_adi' => $program_adi
			
		];
		$sart = ['ogrenci_no' => $ogrenci_no, 'tarih' => $tarih, 'program_adi' => $program_adi];
		$onlem=$model->where($sart)->findAll();
		
	
		if($onlem){
			
			$message =$ad." ".$soyad." isimli  öğrenciye ait veri önceden girilmiştir";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
			
			$gecekleme=$model->insert($data);
			if($gecekleme){
			session()->setFlashdata('info','Geç kalan öğrenci eklendi');
			$message ="Veri Ekleme Başarılı";
			echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else if(!$gecekleme){
			    session()->setFlashdata('danger','Geç kalan öğrenci eklenirken hata oluştu');
			}
		}	
	    	return redirect()->to(site_url('/home/yoklama_view')); 
	}

	

	public function genelyoklama($program){
			$model= new \App\Models\OgrenciModelGelmeyen;
			$model2= new \App\Models\OgrenciModelIzinli;
			$modelprogram= new \App\Models\ProgramModel;
			$modelHistory= new \App\Models\HistoryModel;
			$modelcarsi= new \App\Models\UsersModel;
			$modelcarsiekle= new \App\Models\OgrenciModelCarsi;
			$modelhizmet= new \App\Models\UsersModel;
			$modelhizmetekle= new \App\Models\OgrenciModelHizmet;
			$carsi=$modelcarsi->where('info','1')->findAll();
			$hizmet=$modelhizmet->where('h_info','1')->findAll();
			$tarih=SAAT;
			$sart=[
				'p_id'=>$program
			];
			$historySart=[
				'p_id'=>$program,
				'date'=>$tarih
			];
			$program_ad=$modelprogram->where($sart)->findColumn('program_ad');
			$program_adi=$program_ad[0];
			$historyKontrol=$modelHistory->where($historySart)->findAll();
			//$program_adi diye arrayi değişkene çevirdik			
			//Buraya çekilen id ye göre dersin adı gelecek
			
			$dateGüncellemeSart=array(
				'p_id'=>$program,
				'date'=>$tarih
			);
			
			$gelmeyenler=$this->request->getPost('gelmedi[]');
			$izinliler=$this->request->getPost('izinli[]');

			if(!empty($gelmeyenler) || !empty($izinliler)){
				
				if(!empty($gelmeyenler)){
					//listede gelmeyenler varsa
						for($i=0; $i<count($gelmeyenler); $i++){
							//$gelmeyenno=$gelmeyenler[$i];
							
							$data = [
								'ogrenci_no' => $gelmeyenler[$i],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];
							$model->insert($data);
						}
				}

				if(!empty($izinliler)){
					//listede izinli varsa
						for($i=0; $i<count($izinliler); $i++){
							$data2 = [
								'ogrenci_no' => $izinliler[$i],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];							
							$model2->insert($data2);
						}			
				}
			
				$programdate=$modelprogram->where($sart)->set($dateGüncellemeSart)->update();
				if(!empty($historyKontrol)){
					$historyUpdate=$modelHistory->where($historySart)->set($historySart)->update();					
				}
				if(empty($historyKontrol)){
					$historyinsert=$modelHistory->insert($historySart);
					if(!empty($carsi)){
						for($i=0; $i<count($carsi); $i++){
							$data3 = [
								'ogrenci_no' => $carsi[$i]['ogrenci_no'],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];
						$insertcarsi=$modelcarsiekle->insert($data3);
						}
					}
					if(!empty($hizmet)){
						for($i=0; $i<count($hizmet); $i++){
							$data4 = [
								'ogrenci_no' => $hizmet[$i]['ogrenci_no'],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];
						$inserthizmet=$modelhizmetekle->insert($data4);
						}
					}
				}
				$session =session();
				session()->setFlashdata('info','Yoklama alındı.....');
				return redirect()->to(site_url('/home/yoklama_view')); 

			}
			//Veri girişi yapılmamışsa yani post edilmemişse
			//Önceden veri girilmişse tarihe update ettik müzalere için
			if(empty($gelmeyenler) && empty($izinliler)){				
				$programdate=$modelprogram->where($sart)->set($dateGüncellemeSart)->update();
				
				if(!empty($historyKontrol)){
					$historyUpdate=$modelHistory->where($historySart)->set($historySart)->update();					
				}
				if(empty($historyKontrol)){
					$historyinsert=$modelHistory->insert($historySart);
					if(!empty($carsi)){
						for($i=0; $i<count($carsi); $i++){
							$data3 = [
								'ogrenci_no' => $carsi[$i]['ogrenci_no'],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];
						$insertcarsi=$modelcarsiekle->insert($data3);
						}
					}
					if(!empty($hizmet)){
						for($i=0; $i<count($hizmet); $i++){
							$data4 = [
								'ogrenci_no' => $hizmet[$i]['ogrenci_no'],							
								'tarih' => $tarih,
								'program_adi' => $program_adi
								
							];
						$inserthizmet=$modelhizmetekle->insert($data4);
						}
					}
				}
				session()->setFlashdata('warning','Yoklama kısmına hiçbir veri girmediniz bütün öğrenciler programa katıldı');
				return redirect()->to(site_url('/home/yoklama_view')); 
			}
		
			
	}
	
	
	public function gunlukanaliz($program){
		//Burası anasayfada inceleye bastıktan sonra çıkan listeleme ekranı
		$modelgeckalan= new \App\Models\OgrenciModel;
		$tarih=SAAT;
		$data['title']=$program."-"."Gec Kalanlar";
		$sart=array(
			'program_adi'=>$program,
			'tarih'=>$tarih
			);

		$data['viewdata']=$modelgeckalan->where($sart)->findAll();
		
		return view("gunluk_gecKalan_analiz",$data);
			

	}

	public function gunlukanaliz2($program){
		$modelogrencibilgi= new \App\Models\UsersModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$tarih=SAAT;
		$data['title']=$program."-"."Gelmeyenler";
		$sart=array(
			'program_adi'=>$program,
			'tarih'=>$tarih
			);
			
		$data['viewdata']=$modelgelmeyen->where($sart)->findAll();
		$sayi=count($data['viewdata']);		
		if($sayi>0){
		
			$query = $modelgelmeyen->where($sart)->get();
			$i=0;
			foreach ($query->getResult() as $row) {
			//tek satırda gelmeyenlerin ad soyad bilgileri alınıyor
			//print_r($sonuc[$i]=$modelogrencibilgi->where('ogrenci_no',$row->ogrenci_no)->findAll());
            $gelmeyenno[$i]=['ogrenci_no'=>$row->ogrenci_no];
			$i++;		
				}
			$ogrencidengelen=array();
			$a=0;
			foreach($gelmeyenno as $donen){
			$data['ogrencidengelen'][$a]=$modelogrencibilgi->asObject()->where($gelmeyenno[$a])->findAll();
			$a++;
			}

		}
		else{
			$data['ogrencidengelen']=[];
		}
		

		
		return view("gunluk_gelmeyen_analiz",$data);
			

	}

	public function gunlukanaliz3($program){
		$modelogrencibilgi= new \App\Models\UsersModel;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		$tarih=SAAT;
		$data['title']=$program."-"."izinliler";
		$sart=array(
			'program_adi'=>$program,
			'tarih'=>$tarih
			);
			
		$data['viewdata']=$modelizinli->where($sart)->findAll();
		$sayi=count($data['viewdata']);		
		if($sayi>0){
		
			$query = $modelizinli->where($sart)->get();
			$i=0;
			foreach ($query->getResult() as $row) {
			//tek satırda gelmeyenlerin ad soyad bilgileri alınıyor
			//print_r($sonuc[$i]=$modelogrencibilgi->where('ogrenci_no',$row->ogrenci_no)->findAll());
            $izinlino[$i]=['ogrenci_no'=>$row->ogrenci_no];
			$i++;		
				}
			$ogrencidengelen=array();
			$a=0;
			foreach($izinlino as $donen){
				$data['ogrencidengelen'][$a]=$modelogrencibilgi->asObject()->where($izinlino[$a])->findAll();
			$a++;
			}

		}
		else{
			$data['ogrencidengelen']=[];
		}

		return view("gunluk_izinli_analiz",$data);


			

	}

	public function delete($rapor_no,$kategori,$ogrenci_no){
		
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		if($kategori==0){
		$modelgeckalan->delete(['id' => $rapor_no]);
		}
		if($kategori==1){
			$modelgelmeyen->delete(['id' => $rapor_no]);
		}
		if($kategori==2){
			$modelizinli->delete(['id' => $rapor_no]);
		}
		
		return redirect()->to('/home/kisisel_Analiz'."/".$ogrenci_no);	

	}



	public function kisisel_Analiz($ogrencino){
		$modelogrencibilgi= new \App\Models\UsersModel;
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		$modelcarsi= new \App\Models\OgrenciModelCarsi;
		$modelhizmet= new \App\Models\OgrenciModelHizmet;
		$modelToplamProgram= new \App\Models\HistoryModel;

		$sart=['ogrenci_no'=>$ogrencino];
		$data['bilgi']=$modelogrencibilgi->where($sart)->findAll();
		$data['toplamProgram']=$modelToplamProgram->findAll();
		$data['gec']=$modelgeckalan->where($sart)->findAll();
		$data['gelmeyen']=$modelgelmeyen->where($sart)->findAll();
		$data['izinli']=$modelizinli->where($sart)->findAll();
		$data['carsi']=$modelcarsi->where($sart)->findAll();
		$data['hizmet']=$modelhizmet->where($sart)->findAll();
		//kişisel analizde yuvarlak chard için
		$data['gecsayisi']=count($data['gec']);
		$data['carsisayisi']=count($data['carsi']);
		$data['hizmetsayisi']=count($data['hizmet']);
		$data['gelinmeyensayisi']=count($data['gelmeyen']);
		$data['izinlisayisi']=count($data['izinli']);
		$data['toplamProgramSayisi']=count($data['toplamProgram']);
		$data['katildigiProgramSayisi']=$data['toplamProgramSayisi']-($data['gecsayisi']+$data['gelinmeyensayisi']+$data['izinlisayisi']+$data['carsisayisi']+$data['hizmetsayisi']);
		
		
		foreach($data['bilgi'] as $row){
			$data['title']=$row['ad']." ".$row['soyad'];
		  } 
		$data['birlesikdizi']   = array_merge($data['gec'], $data['gelmeyen'],$data['izinli'],$data['carsi'],$data['hizmet']);
		return view("kisiselAnaliz_view",$data);
	}

	public function toplu_Analiz(){
	    error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$data2['title']="Genel Talebe Takip Tablosu";
		$modelogrencibilgi= new \App\Models\UsersModel;
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		$modelcarsi= new \App\Models\OgrenciModelCarsi;
		$modelhizmet= new \App\Models\OgrenciModelHizmet;
		$modelToplamProgram= new \App\Models\HistoryModel;
		$data['bilgi']=$modelogrencibilgi->findAll();
		$data['geckalmasayisi']=[];
		$data['gelinmeyensayisi']=[];
		$data['izinlisayisi']=[];
		$data['carsisayisi']=[];
		$data['hizmetsayisi']=[];
		$tarih1=$this->request->getPost('tarih1');
		$tarih2=$this->request->getPost('tarih2');
	
		foreach($data['bilgi'] as $row){
			$sart=[
				'ogrenci_no'=>$row['ogrenci_no'],
			];
		
			if($tarih1){
				$sart=[
					'ogrenci_no'=>$row['ogrenci_no'],
					'tarih >='=>$tarih1
				];
				$programSayisiSart=[
					'date >='=>$tarih1					
				];
			
			}	
			if($tarih1 && $tarih2){
				$sart=[
					'ogrenci_no'=>$row['ogrenci_no'],
					'tarih >='=>$tarih1,
					'tarih <='=>$tarih2
				];
				$programSayisiSart=[
					'date >='=>$tarih1,
					'date <='=>$tarih2
				];
			}	
			
			
			
			array_push($data['geckalmasayisi'],count($modelgeckalan->where($sart)->findAll()));	
			array_push($data['gelinmeyensayisi'],count($modelgelmeyen->where($sart)->findAll()));
			array_push($data['izinlisayisi'],count($modelizinli->where($sart)->findAll()));		
			array_push($data['carsisayisi'],count($modelcarsi->where($sart)->findAll()));
			array_push($data['hizmetsayisi'],count($modelhizmet->where($sart)->findAll()));
			
		
		}
		if(!isset($programSayisiSart)){
			$data['toplamProgram']=$modelToplamProgram->findAll();
		}
		if(!empty($programSayisiSart)){
			$data['toplamProgram']=$modelToplamProgram->where($programSayisiSart)->findAll();
		}
		
				
		$data['toplamProgramSayisi']=count($data['toplamProgram']);

		$data2['tumdizi']=[];
		$i=0;
		foreach($data['bilgi'] as $row){
			$katilmasiGereken=$data['toplamProgramSayisi']-($data['hizmetsayisi'][$i]);
			if($katilmasiGereken>0){
				$dusenPuan=($data['gelinmeyensayisi'][$i]*2)+$data['geckalmasayisi'][$i]+$data['izinlisayisi'][$i]+$data['carsisayisi'][$i];
				$kazanilanPuan=(($katilmasiGereken*2)-$dusenPuan);
				$yuzde=($kazanilanPuan/($katilmasiGereken*2))*100;
				$yuzde=round($yuzde,2);
			}
			if($katilmasiGereken<=0){
				$yuzde="-";
			}
			
			$ekle=[
				'ogrenci_no'=>$row['ogrenci_no'],
				'ad'=>$row['ad'],
				'soyad'=>$row['soyad'],
				'gec'=>$data['geckalmasayisi'][$i],
				'gelinmeyen'=>$data['gelinmeyensayisi'][$i],
				'izinli'=>$data['izinlisayisi'][$i],
				'carsi'=>$data['carsisayisi'][$i],
				'hizmet'=>$data['hizmetsayisi'][$i],
				'yuzde'=>$yuzde
				
			];
			array_push($data2['tumdizi'],$ekle);
		
		$i++;
		}	
		$data2['programSayisi']=$data['toplamProgramSayisi'];
		return view('genel_analiz_all',$data2);
		
	}

	public function logout(){
		session_destroy();
		return redirect()->to(site_url('login'));
	}

	public function muzakere_yoklama_view(){
		//muzakere veri tabanından çekilecek
		$modelprogram= new \App\Models\ProgramModel;
		$sart_active=array(
			'is_active'=>'1',
			'special'=>'1'		
		);
		$program=$modelprogram->where($sart_active)->findAll();
		$data['program']=$program;	
		return view('muzakere_yoklama',$data);
	}

	public function muzakere_yoklama_liste_view($program,$program_ad)
	{	
		$model= new \App\Models\UsersModel;
		$session =session();
		$grup=$session->get('mesul_grub');
		$sart=[
			'grup'=>$grup
		];
			
		$data['ogrenciler']=$model->where($sart)->where('info !=','1')->where('h_info !=','1')->findAll();
		$data['title']=$program;
		$data['program_ad']=$program_ad;
		return view("gunluk_yoklama_liste",$data);		
	}
	public function muzakere_yoklama_liste_view2($program,$program_ad)
	{
		$session =session();	
		$grup=$session->get('mesul_grub');
		$sart=[
			'grup'=>$grup
		];
		$model= new \App\Models\UsersModel;
		$data['ogrenciler']=$model->where($sart)->findAll();
		$data['title']=$program;
		$data['program_ad']=$program_ad;
		return view("gunluk_yoklama_liste2",$data);

	}
	


	public function programgoster(){

		$modelprogram= new \App\Models\ProgramModel;
		$sart_active=array(
			'is_active'=>'1'		
		);
		$sart_pasif=array(
			'is_active'=>'0'
		);
		$program=$modelprogram->where($sart_active)->findAll();
		$program2=$modelprogram->where($sart_pasif)->findAll();
		$data['pasif_program']=$program2;
		$data['aktif_program']=$program;	
		$session =session();
		$yetki=$session->get('yetki');
		if($yetki='3' || $yetki='4' ){

			return view('program_goster',$data);
		}
		else
		{
			//yetki olmadığı durum
			session()->setFlashdata('info','Bu işlem için yetkiniz bulunmadığından Anasayfaya yönlendirildiniz....');
			return redirect()->to('/home');	
		}
	}

	public function program_pasif($pid,$pad)
	{
		$modelprogram= new \App\Models\ProgramModel;
		$data=[
			'is_active'=>'0'
		];
		$modelprogram->where('p_id', $pid)->set($data)->update();
		$session =session();
		session()->setFlashdata('info','Program Pasif hale getirildi....');
		return redirect()->to('/home/programgoster');
		
	}


	public function program_active($pid,$pad)
	{
		$modelprogram= new \App\Models\ProgramModel;
		$data=[
			'is_active'=>'1'
		];
		$modelprogram->where('p_id', $pid)->set($data)->update();
		$session =session();
		session()->setFlashdata('info','Program Aktif hale getirildi....');
		return redirect()->to('/home/programgoster');
	}

	public function program_delete($pid,$pad)
	{
		$modelprogram= new \App\Models\ProgramModel;		
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;
		$modelHistory= new \App\Models\HistoryModel;	
		
		$silme1=$modelprogram->where('p_id', $pid)->delete();
		$silme2=$modelgeckalan->where('program_adi', $pad)->delete();
		$silme3=$modelgelmeyen->where('program_adi', $pad)->delete();
		$silme4=$modelizinli->where('program_adi', $pad)->delete();
		$silme5=$modelHistory->where('p_id', $pid)->delete();

		if(isset($silme1,$silme2,$silme3,$silme4,$silme5)){
		$session =session();
		session()->setFlashdata('info','Program başarıyla silindi.....');
		return redirect()->to('/home/programgoster');
		}
		else {
			$session =session();
			session()->setFlashdata('danger','Program silinirken bir hata oluştu.....');
			return redirect()->to('/home/programgoster');
		}		
	
		
	}

	public function program_insert()
	{
		$modelprogram= new \App\Models\ProgramModel;
		$modelHistory= new \App\Models\HistoryModel;
		$pad=$this->request->getPost('program_ad');
		$muzakere=$this->request->getPost('muzakere');
		$data1=[
			'program_ad'=>$pad
		];

		$data2=[
			'program_ad'=>$pad,
			'special'=>'1'
		];
		
		
		if ($muzakere=='1') {
			$ekleme=$modelprogram->insert($data2);
			if (isset($ekleme)) {
				$session =session();
				session()->setFlashdata('info','Grup dersi başayırla eklendi.....');
				return redirect()->to('/home/programgoster');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','Grup dersi eklenirken bir hata oluştu.....');
				return redirect()->to('/home/programgoster');
			}
		}
	
		else{
			$ekleme=$modelprogram->insert($data1);
			if (isset($ekleme)) {
				$session =session();
				session()->setFlashdata('info','Program başayırla eklendi.....');
				return redirect()->to('/home/programgoster');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','Program eklenirken bir hata oluştu.....');
				return redirect()->to('/home/programgoster');
			}
		}
		
	}

	public function ogrenci_delete($id)
	{
		$modelgeckalan= new \App\Models\OgrenciModel;
		$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
		$modelizinli= new \App\Models\OgrenciModelIzinli;	
		$modelogrenci= new \App\Models\UsersModel;
		$modelcarsi1= new \App\Models\OgrenciModelCarsi;
		$modelcarsi2= new \App\Models\CarsiModel;
		$modelhizmet1= new \App\Models\OgrenciModelHizmet;
		$modelhizmet2= new \App\Models\HizmetModel;
		
	
		$silme1=$modelgeckalan->where('ogrenci_no', $id)->delete();
		$silme2=$modelgelmeyen->where('ogrenci_no', $id)->delete();
		$silme3=$modelizinli->where('ogrenci_no', $id)->delete();
		$silme4=$modelogrenci->where('ogrenci_no', $id)->delete();
		$silme5=$modelcarsi1->where('ogrenci_no', $id)->delete();
		$silme6=$modelcarsi2->where('ogrenci_no', $id)->delete();
		$silme7=$modelhizmet1->where('ogrenci_no', $id)->delete();
		$silme8=$modelhizmet2->where('ogrenci_no', $id)->delete();

		
		if(isset($silme1,$silme2,$silme3,$silme4,$silme5,$silme6,$silme7,$silme8)){
		$session =session();
		session()->setFlashdata('success','Ogrenci Başarıyla Silindi.....');
		return redirect()->to('/home/ogrenci_edit_view');
		}
		else {
			$session =session();
			session()->setFlashdata('danger','Ogrenci Silinirken Bir Hata Oluştu.....');
			return redirect()->to('/home/ogrenci_edit_view');
		}		
	
	}


	public function carsi_view()
	{
		$modelogrenci= new \App\Models\UsersModel;
		$modelcarsi= new \App\Models\CarsiModel;
		$tarih=SAAT;
		$tarihkontrol=$modelcarsi->where('date',$tarih)->find();//Bu güne ait yen veri girilmişmi diye bakıyoruz		
		if(empty($tarihkontrol)){
			//yani yeni günde ait veri yoksa içeri giren öğrencilerin infosu 0'a çekiliyor
			$sıfırlama=$modelogrenci->where('info',2)->set('info',0)->update();
		}
		$data['yurtta']=$modelogrenci->where('info',0)->where('h_info',0)->findAll();//burada info ile çarşıda olmayanları h_info ile hizmette olmayanları çekik	
		$data['izinde']=$modelogrenci->where('info',1)->findAll();
		$data['gelmis']=$modelogrenci->where('info',2)->findAll();	
		return view("carsi",$data);
	}

	public function carsi_insert($ogrenci_no,$info,$fonk=null)
	{
		$modelprogram= new \App\Models\UsersModel;
		$modelcarsi= new \App\Models\CarsiModel;
		$tarih=SAAT;
		$datetime = date('Y.m.d H:i:s');
		$data=array(
			'info'=>$info
		);	
		$aciklama=$this->request->getGet('aciklama');
		if($fonk=="escinsert"){
			$cikis=array(
				'ogrenci_no'=>$ogrenci_no,
				'date'=>$tarih,
				'escDate'=>$datetime,
				'aciklama'=>$aciklama
			);
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//öğrenci çarşıya çıktı
			$izinekle=$modelcarsi->insert($cikis);
			if(!empty($ekleme)){
				$session =session();
				session()->setFlashdata('info','Öğrenci çıkışı verildi...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}
		if($fonk=="escupdate"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çrşıya çıkacak öğrenci yanlış işaretlendi
			$izinid=$modelcarsi->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();			
			$izinsilme=$modelcarsi->delete(['id' => $izinid['id']]);
			if(!empty($ekleme) && !empty($izinsilme)){
				$session =session();
				session()->setFlashdata('warning','Öğrenci çıkışı geri alındı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
			
		}	
		if($fonk=="openinsert"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çrşıdaki öğrenci giriş yaptı
			$izinid=$modelcarsi->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();
			$izingelis=$modelcarsi->where('id',$izinid['id'])->set(['openDate'=>$datetime])->set(['date2'=>$tarih])->update();
			$escdate=$modelcarsi->where('id',$izinid['id'])->first();
			$sure=$escdate['escDate'];
			$sure2=$escdate['openDate'];
			
			$ilksaatstr=strtotime($sure);
			$sonsaatstr=strtotime($sure2);//aynı şekilde saatleride strtotime liyoırum	
			$surefark=(abs($sonsaatstr-$ilksaatstr))/60;


			$eklesure=$modelcarsi->where('id',$izinid['id'])->set(['sure'=>$surefark])->update();
			if(!empty($ekleme) && !empty($izingelis)){
				$session =session();
				session()->setFlashdata('success','Öğrenci yurda giriş yaptı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
			
		}	
		if($fonk=="openupdate"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çarşıdan gelen öğrenci yanlış iaretlendi
			$izinid=$modelcarsi->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();
			$izingelis=$modelcarsi->where('id',$izinid['id'])->set(['openDate'=>0])->set(['date2'=>0])->update();
			$sure=$modelcarsi->where('id',$izinid['id'])->set(['sure'=>0])->update();
			if(!empty($ekleme) && !empty($izingelis)){
				$session =session();
				session()->setFlashdata('warning','Öğrenci girişi geri alındı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}
		if($fonk=="openfinish"){
			$sifirla=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();
			if(!empty($sifirla)){
				$session =session();
				session()->setFlashdata('success','Öğrenci giriş kaydı başarıyla tamamlandı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}		
	
		return redirect()->to('/home/carsi_view');	
	}
	
	public function carsi_Analiz(){
				$today=SAAT;
				$data2['title']="Çarşı İzni Analiz Tablosu";
				$modelogrencibilgi= new \App\Models\UsersModel;
				$modelcarsi= new \App\Models\CarsiModel;
				$modelcarsi2= new \App\Models\OgrenciModelCarsi;
				
				$data['bilgi']=$modelogrencibilgi->findAll();
				$data['carsisayisi']=[];
				$tarih1=$this->request->getPost('tarih1');
				$tarih2=$this->request->getPost('tarih2');
				if(!empty($tarih1)){
					$tarihSart=array(
						'date'=>$tarih1
					);

					if(!empty($tarih2)){
						$tarihSart=array(
						'date >='=>$tarih1,
						'date <='=>$tarih2
						);
					}
				}
				if(empty($tarih1) && empty($tarih2)){
					$tarihSart=array(
						'date'=>$today
					);
				}
				if(empty($tarih1) && !empty($tarih2)){
					$tarihSart=array(
						'date'=>$tarih2
					);
				}

				$data['carsiBilgi']=$modelcarsi->where($tarihSart)->orwhere('openDate',0)->orwhere('escDate',$today)->orwhere('date2',$today)->findAll();
				
				$data2['tumdizi']=[];
				$i=0;
				foreach($data['carsiBilgi'] as $row){
					if($row['sure'] % 60 < 10 ){
						$dakika="0".$row['sure']%60;
						
					}
					if($row['sure'] % 60 > 10 ){
						$dakika=$row['sure']%60;
					}
					$baslangic=$row['escDate'];
					$baslangic=date('Y.m.d');
		
					
					$sartAralik=[
						'ogrenci_no'=>$row['ogrenci_no'],
						'tarih >='=>$baslangic,
						'tarih <='=>$today
					];
				
					$ekle=[
						'ogrenci_no'=>$row['ogrenci_no'],
						'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
						'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
						'escDate'=>$row['escDate'],
						'openDate'=>$row['openDate'],
						'kontrolSaat'=>$row['sure'],
						'saat'=>floor($row['sure']/60),
						'dakika'=>$dakika,
						'aciklama'=>$row['aciklama'],
						'izinsayisi'=>count($modelcarsi2->select('id')->where($sartAralik)->findAll())
						
					];
					array_push($data2['tumdizi'],$ekle);
				
				$i++;
				}	


				return view('carsi_analiz',$data2);
		
	}

	
	public function hizmet_view()
	{
		$modelogrenci= new \App\Models\UsersModel;
		$modelhizmet= new \App\Models\HizmetModel;
		$tarih=SAAT;
		$tarihkontrol=$modelhizmet->where('date',$tarih)->find();//Bu güne ait yen veri girilmişmi diye bakıyoruz		
		if(empty($tarihkontrol)){
			//yani yeni günde ait veri yoksa içeri giren öğrencilerin infosu 0'a çekiliyor
			$sıfırlama=$modelogrenci->where('h_info',2)->set('h_info',0)->update();
		}
		$data['yurtta']=$modelogrenci->where('h_info',0)->where('info',0)->findAll();	
		$data['hizmette']=$modelogrenci->where('h_info',1)->findAll();
		$data['gelmis']=$modelogrenci->where('h_info',2)->findAll();	
		return view("hizmet",$data);
	}

	public function hizmet_insert($ogrenci_no,$info,$fonk=null)
	{
		$modelprogram= new \App\Models\UsersModel;
		$modelhizmet= new \App\Models\HizmetModel;
		$tarih=SAAT;
		$datetime = date('Y.m.d H:i:s');
		$data=array(
			'h_info'=>$info
		);	
		$aciklama=$this->request->getGet('aciklama');
		
		if($fonk=="escinsert"){
			$cikis=array(
				'ogrenci_no'=>$ogrenci_no,
				'date'=>$tarih,
				'escDate'=>$datetime,
				'aciklama'=>$aciklama
			);
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//öğrenci hizmete çıktı
			$izinekle=$modelhizmet->insert($cikis);
			if(!empty($ekleme)){
				$session =session();
				session()->setFlashdata('info','Öğrenci çıkışı verildi...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}
		if($fonk=="escupdate"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çrşıya çıkacak öğrenci yanlış işaretlendi
			$izinid=$modelhizmet->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();			
			$izinsilme=$modelhizmet->delete(['id' => $izinid['id']]);
			if(!empty($ekleme) && !empty($izinsilme)){
				$session =session();
				session()->setFlashdata('warning','Öğrenci çıkışı geri alındı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
			
		}	
		if($fonk=="openinsert"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çrşıdaki öğrenci giriş yaptı
			$izinid=$modelhizmet->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();
			$izingelis=$modelhizmet->where('id',$izinid['id'])->set(['openDate'=>$datetime])->set(['date2'=>$tarih])->update();
			$escdate=$modelhizmet->where('id',$izinid['id'])->first();
			$sure=$escdate['escDate'];
			$sure2=$escdate['openDate'];
			
			$ilksaatstr=strtotime($sure);
			$sonsaatstr=strtotime($sure2);//aynı şekilde saatleride strtotime liyoırum	
			$surefark=(abs($sonsaatstr-$ilksaatstr))/60;


			$eklesure=$modelhizmet->where('id',$izinid['id'])->set(['sure'=>$surefark])->update();
			if(!empty($ekleme) && !empty($izingelis)){
				$session =session();
				session()->setFlashdata('success','Öğrenci hizmetten döndü...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
			
		}	
		if($fonk=="openupdate"){
			$ekleme=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();//çarşıdan gelen öğrenci yanlış iaretlendi
			$izinid=$modelhizmet->where('ogrenci_no',$ogrenci_no)->orderBy('id DESC')->first();
			$izingelis=$modelhizmet->where('id',$izinid['id'])->set(['openDate'=>0])->set(['date2'=>0])->update();
			$sure=$modelhizmet->where('id',$izinid['id'])->set(['sure'=>0])->update();
			if(!empty($ekleme) && !empty($izingelis)){
				$session =session();
				session()->setFlashdata('warning','Öğrenci girişi geri alındı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}	
		
		if($fonk=="openfinish"){
			$sifirla=$modelprogram->where('ogrenci_no',$ogrenci_no)->set($data)->update();
			if(!empty($sifirla)){
				$session =session();
				session()->setFlashdata('success','Öğrenci giriş kaydı başarılı...');
			}
			else{
				$session =session();
				session()->setFlashdata('danger','İşlemde bir hata çıktı');
			}
		}
	
		return redirect()->to('/home/hizmet_view');	
	}

	public function hizmet_Analiz(){
		$today=SAAT;
		$data2['title']="Hizmet İzni Analiz Tablosu";
		$modelogrencibilgi= new \App\Models\UsersModel;
		$modelhizmet= new \App\Models\HizmetModel;
		$modelhizmet2= new \App\Models\OgrenciModelHizmet;
		
		$data['bilgi']=$modelogrencibilgi->findAll();
		$data['hizmetsayisi']=[];
		$tarih1=$this->request->getPost('tarih1');
		$tarih2=$this->request->getPost('tarih2');
		if(!empty($tarih1)){
			$tarihSart=array(
				'date'=>$tarih1
			);

			if(!empty($tarih2)){
				$tarihSart=array(
				'date >='=>$tarih1,
				'date <='=>$tarih2
				);
			}
		}
		if(empty($tarih1) && empty($tarih2)){
			$tarihSart=array(
				'date'=>$today
			);
		}
		if(empty($tarih1) && !empty($tarih2)){
			$tarihSart=array(
				'date'=>$tarih2
			);
		}
		
	
		$data['hizmetBilgi']=$modelhizmet->where($tarihSart)->orwhere('openDate',0)->orwhere('escDate',$today)->orwhere('date2',$today)->findAll();
		
		$data2['tumdizi']=[];
		$i=0;
		foreach($data['hizmetBilgi'] as $row){
			if($row['sure'] % 60 < 10 ){
				$dakika="0".$row['sure']%60;
				
			}
			if($row['sure'] % 60 > 10 ){
				$dakika=$row['sure']%60;
			}
			
			$ekle=[
				'ogrenci_no'=>$row['ogrenci_no'],
				'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
				'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
				'escDate'=>$row['escDate'],
				'openDate'=>$row['openDate'],
				'kontrolSaat'=>$row['sure'],
				'saat'=>floor($row['sure']/60),
				'dakika'=>$dakika,
				'aciklama'=>$row['aciklama'],
				'izinsayisi'=>count($modelhizmet2->select('id')->where('ogrenci_no',$row['ogrenci_no'])->findAll())
				
			];
			array_push($data2['tumdizi'],$ekle);
		
		$i++;
		}	

		
		return view('hizmet_analiz',$data2);

}

public function tekDers_Analiz($program=null){
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$data['title']="Tek Ders Talebe Takip Tablosu";
	$today=SAAT;
	$modelogrencibilgi= new \App\Models\UsersModel;
	$modelprogram= new \App\Models\ProgramModel;
	$modelgeckalan= new \App\Models\OgrenciModel;
	$modelgelmeyen= new \App\Models\OgrenciModelGelmeyen;
	$modelizinli= new \App\Models\OgrenciModelIzinli;
	$modelcarsi= new \App\Models\OgrenciModelCarsi;
	$modelcarsidetay= new \App\Models\CarsiModel;
	$modelhizmet= new \App\Models\OgrenciModelHizmet;
	$modelhizmetdetay= new \App\Models\HizmetModel;
	$data['bilgi']=$modelogrencibilgi->findAll();
	$tarih=$this->request->getGet('tarih');
	$program=$this->request->getGet('programlist');
	$data['programlar']=$modelprogram->where('is_active',1)->findAll();
	$data['programad']=$program;
	$data['tarih']=$tarih;
	
	if(!empty($tarih)){
		$today=$tarih;
	}
	
	$data['gecKalann']=$modelgeckalan->where('tarih',$today)->where('program_adi',$program)->findAll();
	$data['gelmeyenn']=$modelgelmeyen->where('tarih',$today)->where('program_adi',$program)->findAll();
	$data['izinlii']=$modelizinli->where('tarih',$today)->where('program_adi',$program)->findAll();
	$data['carsii']=$modelcarsi->where('tarih',$today)->where('program_adi',$program)->findAll();
	$data['hizmett']=$modelhizmet->where('tarih',$today)->where('program_adi',$program)->findAll();
	
	$data['gecKalan']=[];
	$data['gelmeyen']=[];
	$data['izinli']=[];
	$data['carsi']=[];
	$data['hizmet']=[];
	foreach ($data['gecKalann'] as $row) {
		$ekle=[
			'ogrenci_no'=>$row['ogrenci_no'],
			'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'sure'=>$row['sure']
		
		];	
		array_push($data['gecKalan'],$ekle);

	}
	foreach ($data['gelmeyenn'] as $row) {
		$ekle=[
			'ogrenci_no'=>$row['ogrenci_no'],
			'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first()
		];
		array_push($data['gelmeyen'],$ekle);
	}

	foreach ($data['izinlii'] as $row) {
		$ekle=[
			'ogrenci_no'=>$row['ogrenci_no'],
			'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first()
		];	
		array_push($data['izinli'],$ekle);
	}

	foreach ($data['carsii'] as $row) {
		$ekle=[
			'ogrenci_no'=>$row['ogrenci_no'],
			'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'aciklama'=>$modelcarsidetay->select('aciklama')->where('ogrenci_no',$row['ogrenci_no'])->where('date<=',$today)->orderBy('id DESC')->first()
		];
		array_push($data['carsi'],$ekle);
	}

	foreach ($data['hizmett'] as $row) {
		
		$ekle=[
			'ogrenci_no'=>$row['ogrenci_no'],
			'ad'=>$modelogrencibilgi->select('ad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'soyad'=>$modelogrencibilgi->select('soyad')->where('ogrenci_no',$row['ogrenci_no'])->first(),
			'aciklama'=>$modelhizmetdetay->select('aciklama')->where('ogrenci_no',$row['ogrenci_no'])->where('date<=',$today)->orderBy('id DESC')->first()
		];
		array_push($data['hizmet'],$ekle);
	}
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	return view('tekDers',$data);
	
}







}
