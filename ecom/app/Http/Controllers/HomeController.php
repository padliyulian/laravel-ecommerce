<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SlideService;
use App\Services\ProductService;

class HomeController extends Controller
{
    public function index(SlideService $slideService, ProductService $productService)
    {
		$this->data['slides'] = $slideService->list();
		$this->data['products'] = $productService->popular();

        return $this->load_theme('home', $this->data);
    }
}
