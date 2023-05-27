<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table      = 'kullanici';


    protected $allowedFields = ['id','k_adi','k_sifre','ad','soyad','unvan','yetki','mesul_grub'];


}