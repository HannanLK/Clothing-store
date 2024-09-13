<?php
class HomeController extends Controller {
    
    // Default method (index)
    public function index() {
        // You can load a home page view, for example
        $this->renderView('home/index');
    }
}
