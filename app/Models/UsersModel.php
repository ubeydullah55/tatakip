<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'ogrenci';


    protected $allowedFields = ['ogrenci_no','ad','soyad','grup','tel','v_tel','info','h_info'];


}