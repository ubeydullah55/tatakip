<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table      = 'history';


    protected $allowedFields = ['id','p_id','date'];


}