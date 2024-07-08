<?php
    require "vendor/autoload.php";
    include_once 'config/Database.php';
    include_once 'http/request.php';
    include_once 'http/response.php';

    include_once 'endpoints/conductor.php';
    include_once 'endpoints/driver.php';
    include_once 'endpoints/employee.php';
    include_once 'endpoints/route.php';
    include_once 'endpoints/routeType.php';
    include_once 'endpoints/trip.php';
    include_once 'endpoints/tripExpenses.php';
    include_once 'endpoints/user.php';
    include_once 'endpoints/vehicle.php';
       
    include_once 'object_models/Conductor.php';
    include_once 'object_models/Driver.php';
    include_once 'object_models/Employee.php';
    include_once 'object_models/Route.php';
    include_once 'object_models/RouteType.php';
    include_once 'object_models/Trip.php';
    include_once 'object_models/TripExpenses.php';
    include_once 'object_models/User.php';
    include_once 'object_models/Vehicle.php';
?>