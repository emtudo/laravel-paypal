<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DonativoStoreRequest;
use ResultSystems\Paypal\Services\PaypalRequestService as PaypalRequestService;

class DonativoController extends Controller
{
    public function index()
    {
        if (!isset($_GET['token'])) {
            return view('donativo');
        }

        $checkout = new PaypalRequestService();
        $details = $checkout->doExpressCheckoutPayment($_GET['token']);

        if (!isset($details['PAYMENTINFO_0_PAYMENTSTATUS']) || $details['PAYMENTINFO_0_PAYMENTSTATUS'] != 'Completed') {
            return view('donativo')->with('danger', $details['PAYMENTINFO_0_PAYMENTSTATUS']);
        }

        return view('donativo')->with(['success' => $details['PAYMENTINFO_0_AMT'], 'details' => $details]);
    }

    public function cancel()
    {
        if (!isset($_GET['token'])) {
            return view('donativo');
        }

        $paypal = new PaypalRequestService();
        $details = $paypal->getDatails($_GET['token']);
        if (!isset($details['CHECKOUTSTATUS']) || $details['CHECKOUTSTATUS'] != 'PaymentCompleted') {
            return view('donativo')->with('danger', $details['CHECKOUTSTATUS']);
        }

        return view('donativo')->with('success', $details['AMT']);
    }

    /**
     * Store new donative.
     *
     * @param  DonativoStoreRequest $request
     *
     * @return response
     */
    public function store(DonativoStoreRequest $request)
    {
        $input = $request->all();
        $paypal = new PaypalRequestService(uniqid());

        if (count($input['doacoes']) > 1) {
            foreach ($input['doacoes'] as $key => $doacao) {
                $paypal->setItem('1', 'Doação voluntária: '.($key + 1), 'Não há produto para ser entregue, isso é apenas uma doação, esteja ciente disso.', $doacao['value']);
            }
        } else {
            foreach ($input['doacoes'] as $doacao) {
                $paypal->setItem('1', 'Doação voluntária', 'Não há produto para ser entregue, isso é apenas uma doação, esteja ciente disso.', $doacao['value']);
            }
        }

        return $paypal->getCheckoutUrl();
    }
}
