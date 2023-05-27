<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Form extends Controller
{
    public function index()
    {
      
        return view('blank');
        
     
    }

    public function save()
    {
      $btntakip=$this->request->getPost('btn');
      $verikontrol1=$this->request->getPost('testDate');
      if($btntakip){
        if($verikontrol1){
          $date=$_POST['testDate'];
          $date=strtotime($date);
          $date=date('d-m-Y',$date);                 
          $newDate=$date;
          $newDate=strtotime('-6 day',strtotime($newDate));
          
          $newDate=date("d-m-Y",$newDate);
          echo "Bir Hafta Önceki Tarih=".$newDate;
          echo"</br>";
          echo "Seçilen Tarih=".$date;
        }
        else
        echo "Başlangıç veya bitiş tarihi boş bırakılamaz";
      }
      else
        echo "Butona basılmadı";

      
      


      

      
      
      
      
      
    }
   
}