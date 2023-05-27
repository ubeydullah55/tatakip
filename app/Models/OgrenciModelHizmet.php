<?php

namespace App\Models;

use CodeIgniter\Model;

class OgrenciModelHizmet extends Model
{
    protected $table      = 'hizmet';


    protected $allowedFields = ['id','ogrenci_no','tarih','program_adi','tur_id'];


}