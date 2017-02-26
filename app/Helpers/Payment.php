<?php namespace droosak\Helpers;

use Paypal;
use Points;

class Payment
{

  private $_apiContext;

  public function __construct()
  {
      $this->_apiContext = PayPal::ApiContext(
          env('PAYPAL_CLIENT_ID'),
          env('PAYPAL_CLIENT_SECRET'));

      $this->_apiContext->setConfig(array(
          'mode' => 'sandbox',
          'http.ConnectionTimeOut' => 30
        ));

  }


  public static function Check($points)
  {
      $i = new static;

      $payer = PayPal::Payer();
      $payer->setPaymentMethod('paypal');

      $amount = PayPal::Amount();
      $amount->setCurrency('USD');
      $amount->setTotal($points);

      $transaction = PayPal::Transaction();
      $transaction->setAmount($amount);
      $transaction->setDescription('Droosak Points Charge..');

      $redirectUrls = PayPal:: RedirectUrls();
      $redirectUrls->setReturnUrl(route('home.payment.success'));
      $redirectUrls->setCancelUrl(route('home.payment.fail'));

      $payment = PayPal::Payment();
      $payment->setIntent('sale');
      $payment->setPayer($payer);
      $payment->setRedirectUrls($redirectUrls);
      $payment->setTransactions(array($transaction));
      $response = $payment->create($i->_apiContext);
      $redirectUrl = $response->links[1]->href;

      return redirect()->away( $redirectUrl );
  }


  public static function success()
  {
      $i = new static;

      $id = request()->get('paymentId');
      $token = request()->get('token');
      $payer_id = request()->get('PayerID');

      $payment = PayPal::getById($id, $i->_apiContext);

      $points = (int) $payment->transactions[0]->amount->total;

      Points::add($points);
      $paymentExecution = PayPal::PaymentExecution();

      $paymentExecution->setPayerId($payer_id);
      $executePayment = $payment->execute($paymentExecution, $i->_apiContext);


      return view('home.payment')->with(['payment-status' => Lang::get('auth.points.success')]);
  }

  public static function fail()
  {

      return view('home.payment')->with(['payment-status' => Lang::get('auth.points.fail')]);
  }


}
