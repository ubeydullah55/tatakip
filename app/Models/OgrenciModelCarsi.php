<?php

namespace App\Models;

use CodeIgniter\Model;

class OgrenciModelCarsi extends Model
{
    protected $table      = 'carsi';


    protected $allowedFields = ['id','ogrenci_no','tarih','program_adi','tur_id'];


}