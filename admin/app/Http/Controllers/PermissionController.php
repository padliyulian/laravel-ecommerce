<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['currentAdminSubMenu1'] = 'settings';
        $this->data['currentAdminSubMenu2'] = 'users';
        $this->data['currentAdminMenu'] = 'permission';
    }

    public function index()
    {
    }
}
