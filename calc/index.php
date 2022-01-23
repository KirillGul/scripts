<?php
error_reporting(E_ALL); //задаёт уровень протоколирования ошибки (E_ALL)
ini_set('display_errors', 'on'); //требуется ли выводить ошибки на экран

include_once __DIR__ . '/VariableChecking.php';
include_once __DIR__ . '/ControllerCalculator.php';
include_once __DIR__ . '/Calculator.php';

class ValidateNumericException extends Exception {};

if (isset($_GET) && !empty($_GET)) {
    try {
        $cheking = (new VariableChecking($_GET['x1'], $_GET['x2'], $_GET['operation']))->cheking();
        
        if ($cheking === 1) {
            $controllerCalculation = new ControllerCalculator($_GET['x1'], $_GET['x2'], $_GET['operation']);
            echo $controllerCalculation->getCalculation();
        }
    } catch (ValidateNumericException $e) {
        echo $e->getMessage();
    }
}
?>

<form action="#">
    <p>
        <input type="number" name="x1">
        <select name="operation" id="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="x2">
    </p>
    <p>
        <input type="submit">
    </p>
</form>
