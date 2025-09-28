<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardChart;

class DashboardChartController extends BaseController
{
    public function getInforme5(){
        return view('dashboardTarea06/informe5');
    }

    //Retorna JSON que requiere la vista
    public function getDataInforme5() {
        $this->response->setContentType('application/json');
        $dashboardChart = new DashboardChart(); //MODELO
        $data = $dashboardChart->getPublishersData();
        if (!$data){
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No encontramos editoras',
                'resumen' => []
            ]);
        }
        return $this->response->setJSON( [
            'success'=> true,
            'message'=> 'Editoras',
            'resumen' => $data
        ]);
    }

    //Memoria caché = CPU, HDD,SOFTWARE
    public function getDataInforme5Cache() {
        $this->response->setContentType(mime: 'application/json');

        $cachekey = 'resumenPublisherChart';
        $data = cache($cachekey);

        if ($data == null){
            $dashboardChart = new DashboardChart();
            $data = $dashboardChart->getPublishersData();

            //Escribir la nueva memoria caché
            cache()->save($cachekey, $data,3600);
        }
        if (!$data){
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No encontramos editoras',
                'resumen' => []
            ]);
        }
        return $this->response->setJSON( [
            'success'=> true,
            'message'=> 'Editoras',
            'resumen' => $data
        ]);
    }
}
