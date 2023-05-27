<?php

namespace App\Models;

use CodeIgniter\Model;

class OgrenciModel extends Model
{
    protected $table      = 'geckalan';


    protected $allowedFields = ['id','ogrenci_no','ad','soyad','tarih','sure','program_adi','tur_id'];


}