<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WeightChart;

class WeightChartController extends BaseController
{
    public function getInforme6(){
        return view('dashboardTarea06/informe6');
    }

    public function getDataInforme6() {
        $this->response->setContentType('application/json');
        $weightChart = new WeightChart();
        $data = $weightChart->getWeightDataByPublisher();

        if (!$data){
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No encontramos datos de peso',
                'resumen' => []
            ]);
        }

        return $this->response->setJSON( [
            'success'=> true,
            'message'=> 'Pesos Promedio',
            'resumen' => $data
        ]);
    }

    public function getDataInforme6Cache() {
        $this->response->setContentType(mime: 'application/json');

        $cachekey = 'resumenWeightChart';
        $data = cache($cachekey);

        if ($data == null){
            $weightChart = new WeightChart();
            $data = $weightChart->getWeightDataByPublisher();

            cache()->save($cachekey, $data,3600);
        }

        if (!$data){
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No encontramos datos de peso',
                'resumen' => []
            ]);
        }

        return $this->response->setJSON( [
            'success'=> true,
            'message'=> 'Pesos Promedio',
            'resumen' => $data
        ]);
    }
}
