<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentGroupController extends Controller
{
    public function index(){
        return view('pages.payment_group.index');
    }
    public function create(){
        return view('pages.payment_group.create');
    }
}
