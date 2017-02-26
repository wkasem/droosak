<?php

namespace droosak\Http\Controllers;

use Payment;
use Points;

class PaymentController extends Controller
{

    public function index()
    {

      return view('home.payment');
    }

    public function checkout()
    {
      $this->validate(request() ,[
        'amount' => 'required'
      ]);

      return Points::Buy(request('amount'));
    }

    public function success()
    {

      return Payment::success();
    }

    public function fail()
    {


      return Payment::fail();
    }
}
