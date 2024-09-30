<?php 
class BaseController {
    const VIEW_PATH = "app/views/";
    const MODEL_PATH = "app/models/";
    public function view($pathView, array $input = []) {
        $path = self::VIEW_PATH.$pathView.".php";
        return require_once $path;
    }

    public function initModel($modelName, $conn) {
        $path = self::MODEL_PATH.$modelName.".php";
        if (file_exists($path)) {
            require_once $path;
            if (class_exists($modelName)) {
                return new $modelName($conn);
            }
        }
        return null;
    }
}



?>