<?php

namespace App\Models;

use CodeIgniter\Model;

class WeightChart extends Model
{
    protected $table = "superhero";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [];

    /**
     * Obtiene pesos promedio por editora desde la vista
     */
    public function getWeightDataByPublisher()
    {
        return $this->db->table('view_weight_by_publisher')->get()->getResultArray();
    }
}
