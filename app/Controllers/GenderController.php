<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class GenderController extends BaseController
{

  public function test()
  {
    return "GenderController funciona correctamente";
  }

  public function showGenderLimitUI()
  {
    $db = \Config\Database::connect();
    
    $genders = $db->query("SELECT DISTINCT gender_id, gender FROM view_superhero_gender_report WHERE gender IS NOT NULL ORDER BY gender")->getResultArray();
    
    $genderCounts = $db->query("
        SELECT 
            gender_id,
            gender,
            COUNT(*) as total
        FROM view_superhero_gender_report 
        WHERE gender IS NOT NULL 
        GROUP BY gender_id, gender 
        ORDER BY gender
    ")->getResultArray();
    
    $data = [
      'genders' => $genders,
      'genderCounts' => $genderCounts
    ];
    
    return view('reportesTarea06/filtros', $data);
  }

  public function generateGenderLimitReport()
  {
    $gender_id = $this->request->getVar('gender_id');
    $limit = (int)$this->request->getVar('limit');
    $titulo = $this->request->getVar('titulo') ?: 'Reporte SH 2025';
    
    $limit = max(10, min(200, $limit));
    
    $query = "SELECT * FROM view_superhero_gender_report";
    $params = [];
    
    if ($gender_id && $gender_id !== '') {
      $query .= " WHERE gender_id = ?";
      $params[] = $gender_id;
    }
    
    $query .= " ORDER BY superhero_name LIMIT ?";
    $params[] = $limit;
    
    $db = \Config\Database::connect();
    $superheroes = $db->query($query, $params)->getResultArray();
    
    $genderInfo = null;
    if ($gender_id) {
      $genderResult = $db->query("SELECT gender_id, gender FROM view_superhero_gender_report WHERE gender_id = ? LIMIT 1", [$gender_id])->getRowArray();
      $genderInfo = $genderResult;
    }
    
    $data = [
      'estilos' => view('reportes/estilos'),
      'superheroes' => $superheroes,
      'titulo' => $titulo,
      'genderInfo' => $genderInfo,
      'limit' => $limit,
      'total' => count($superheroes)
    ];
    
    $html = view('reportesTarea06/reporte_pdf', $data);
    
    try {
      $html2PDF = new Html2Pdf('L', 'A4', 'es', true, 'UTF-8', [20, 10, 10, 10]);
      $html2PDF->writeHTML($html);
      
      $this->response->setHeader('Content-Type', 'application/pdf');
      $html2PDF->output('Reporte-SH-2025.pdf');
      exit();
    } catch (Html2PdfException $e) {
      $formatter = new ExceptionFormatter($e);
      echo $formatter->getMessage();
    }
  }
}
