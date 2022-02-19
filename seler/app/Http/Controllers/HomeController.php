<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();

		$this->data['currentAdminSubMenu1'] = '';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'dashboard';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', $this->data);
    }
}
