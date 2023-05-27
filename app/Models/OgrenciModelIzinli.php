<?php

namespace App\Models;

use CodeIgniter\Model;

class OgrenciModelIzinli extends Model
{
    protected $table      = 'izinli';


    protected $allowedFields = ['id','ogrenci_no','tarih','program_adi','tur_id'];


}