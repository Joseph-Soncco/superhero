<?php

namespace App\Models;

use CodeIgniter\Model;

class ReporteGenderLimit extends Model
{
    protected $table = "view_superhero_gender_report";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [];
}

