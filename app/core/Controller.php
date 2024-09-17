<?php

class Controller {
    // Load model
    public function model($model) {
        // Require the model file
        require_once '../app/models/' . $model . '.php';
        // Instantiate the model
        return new $model();
    }

    // Load view
    public function renderView($view, $data = []) {
        extract($data);
        
        // Check if the view file exists
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";
        } else {
            die("View does not exist: " . $view . ".php");  // Show the view path
        }
    }
    
}
