<?php

class ProfileController extends Controller {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $customer = $this->userModel->getUserById($userId);
        $orders = $this->orderModel->getOrdersByUser($userId);

        $this->renderView('customer/profile', ['customer' => $customer, 'orders' => $orders]);
    }

    public function edit() {
        // Logic for updating user profile
    }
}
