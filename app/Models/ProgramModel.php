<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table      = 'programlar';


    protected $allowedFields = ['p_id','program_ad','is_active','special','date'];


}