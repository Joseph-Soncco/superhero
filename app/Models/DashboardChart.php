<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardChart extends Model
{
    protected $table = "superhero";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $allowedFields = [];

    /**
     * Obtiene datos de editoras para el gráfico desde la vista
     */
    public function getPublishersData()
    {
        return $this->db->table('view_publishers_comparison')->get()->getResultArray();
    }
}
