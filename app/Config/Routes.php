<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Reportes
$routes->get('/reportes/r1', 'ReporteController::getReport1');
$routes->get('/reportes/r2', 'ReporteController::getReport2');
$routes->get('/reportes/r3', 'ReporteController::getReport3');

//Excel
$routes->get('/reportes/excel1', 'ReporteController::getExcel1');

//Muestra un interfaz web (Form) para que el usuario seleccine un "tipo de reporte" a generar
$routes->get('/reportes/showui', 'ReporteController::showUIReport');

//El formulario <select>Enviara los datos
$routes->post('/reportes/publisher', 'ReporteController::getReportByPublisher');
$routes->post('/reportes/raceAlignment', 'ReporteController::getReportByRaceAlignment');

//Dashboard
$routes->get('/dashboard/informe1', 'DashboardController::getInforme1'); 
$routes->get('/dashboard/informe2', 'DashboardController::getInforme2');
$routes->get('/dashboard/informe3', 'DashboardController::getInforme3');
$routes->get('/dashboard/informe4', 'DashboardController::getInforme4');

//API
$routes->get('/public/api/getdatainforme2', 'DashboardController::getDataInforme2');
$routes->get('/public/api/getdatainforme3', 'DashboardController::getDataInforme3');
$routes->get('/public/api/getdatainforme4cache', 'DashboardController::getDataInforme4Cache');
$routes->get('/public/api/getdatainforme3cache', 'DashboardController::getDataInforme3Cache');


//Nuevo reporte Tarea 06 - con filtros de género y límite
$routes->get('/gender/test', 'GenderController::test');
$routes->get('/reportes/gender-limit-ui', 'GenderController::showGenderLimitUI');
$routes->post('/reportes/gender-limit', 'GenderController::generateGenderLimitReport');

//Dashboard Tarea 06 - Gráfico de Comparación de Editoras
$routes->get('/dashboard/informe5', 'DashboardChartController::getInforme5');
$routes->get('/public/api/getdatainforme5', 'DashboardChartController::getDataInforme5');
$routes->get('/public/api/getdatainforme5cache', 'DashboardChartController::getDataInforme5Cache');

//Dashboard Tarea 06 - Gráfico de Pesos Promedio por Editora
$routes->get('/dashboard/informe6', 'WeightChartController::getInforme6');
$routes->get('/public/api/getdatainforme6', 'WeightChartController::getDataInforme6');
$routes->get('/public/api/getdatainforme6cache', 'WeightChartController::getDataInforme6Cache');