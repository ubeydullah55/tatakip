<?php

namespace App\Models;

use CodeIgniter\Model;

class CarsiModel extends Model
{
    protected $table      = 'izincarsi';


    protected $allowedFields = ['id','ogrenci_no','date','escDate','date2','openDate','sure','aciklama'];


}