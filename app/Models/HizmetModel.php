<?php

namespace App\Models;

use CodeIgniter\Model;

class HizmetModel extends Model
{
    protected $table      = 'izinhizmet';


    protected $allowedFields = ['id','ogrenci_no','date','escDate','date2','openDate','sure','aciklama'];


}