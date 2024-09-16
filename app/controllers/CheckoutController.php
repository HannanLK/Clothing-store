<?php

class CheckoutController extends Controller {
    public function index() {
        // Render a simple checkout view
        $this->renderView('customer/checkout');
    }
}
