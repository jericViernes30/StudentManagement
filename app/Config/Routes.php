<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth\AuthController::login');
$routes->group('student', function ($routes) {
    $routes->get('list', 'Student\StudentController::studentList');
    $routes->post('add', 'Student\StudentController::addStudent');
    $routes->get('grades', 'Student\GradeController::index');
    $routes->post('update-grades', 'Student\GradeController::updateGrades');
    $routes->get('delete-student/(:any)', 'Student\StudentController::deleteStudent/$1');
    $routes->get('export', 'ExportController::exportToExcel');
    $routes->get('grades/(:any)', 'Student\StudentController::getGradesOfStudent/$1');
    $routes->get('fetch-info/(:any)', 'Student\StudentController::fetchStudentData/$1');
    $routes->post('edit', 'Student\StudentController::editStudent');
});

// $routes->group('subject', function($routes){
//     $routes->get('list', 'Subject\SubjectController::list');
// });


$routes->get('/login', 'Auth\AuthController::login');
$routes->post('/auth/login', 'Auth\AuthController::authLogin');
$routes->get('/register', 'Auth\AuthController::register');
$routes->post('/auth/register', 'Auth\AuthController::authRegister');
$routes->get('/logout', 'Auth\AuthController::logout');
