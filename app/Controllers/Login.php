<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
      
        return view('login');
    }

    public function kontrol()
    {
      $model= new \App\Models\KullaniciModel;
      $session= session();

      $data=[];
      if($this->request->getMethod() =='post'){
        $k_adi=$this->request->getPost('k_adi');
        $k_sifre=$this->request->getPost('k_sifre');
        $user=$model->where('k_adi',$k_adi)->first();
        if(empty($user)){
          $session =session();
			    session()->setFlashdata('danger','Telefon no bulunamadı.....');
          return redirect()->to('/login');
        }else{
           if($k_sifre==$user['k_sifre']){           
             $session->set($user);          
            return redirect()->to(base_url('home'));
           }else{
            $session =session();
			      session()->setFlashdata('danger','Şifreniz yanlış.....');
            return redirect()->to('/login');
           }
        }
      }

    }
   
}