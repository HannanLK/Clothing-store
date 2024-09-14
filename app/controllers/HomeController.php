<?php

class HomeController extends Controller {
    public function index() {
        // Fetch new arrivals, featured products, blog posts, etc.
        $newArrivals = $this->model('ProductModel')->getNewArrivals();
        $featuredProducts = $this->model('ProductModel')->getFeaturedProducts();
        $blogs = $this->model('BlogModel')->getRecentBlogs();
        
        // Pass the data to the home view
        $this->renderView('Customer/home', [
            'newArrivals' => $newArrivals,
            'featuredProducts' => $featuredProducts,
            'blogs' => $blogs,
        ]);
    }
}
