<?

include 'controllerInterface.php';
$controller = new controllerInterface();
echo $controller->callControllerAjax($_POST["show"], $_POST["action"], $_POST["data"]);
?>