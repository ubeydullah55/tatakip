<?php

namespace App\Models;

use CodeIgniter\Model;

class OgrenciModelGelmeyen extends Model
{
    protected $table      = 'gelmeyen';


    protected $allowedFields = ['id','ogrenci_no','tarih','program_adi','tur_id'];


}