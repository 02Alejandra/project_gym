<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Subscription;
use App\Repositories\PaymentRepository;
use App\Repositories\SubscriptionRepository;
use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;
use Flash;
use Response;

class PaymentController extends Controller
{
    /** @var PaymentRepository $paymentRepository*/
    private $paymentRepository;
    /** @var SubscriptionRepository $subscriptionRepository*/
    private $subscriptionRepository;

    public function __construct(PaymentRepository $paymentRepo,SubscriptionRepository $subscriptionRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->subscriptionRepository = $subscriptionRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $payments = $this->paymentRepository->all();

        return view('payments.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();
        $subscriptionId = $request['subscription_id'];
        $totalPrice = Subscription::find($subscriptionId)->total_amount;

        if ($request['amount'] > $totalPrice) {
            return redirect()->back()->withErrors(['amount' => 'El monto no puede ser mayor al precio de la suscripción']);
        }
        if ($request['amount'] = $totalPrice) {
            $this->subscriptionRepository->update(['state' => 'Pagado'], $subscriptionId);
        }
        else {
            $this->subscriptionRepository->update(['state' => 'Abonado'], $subscriptionId);
        }
        $this->subscriptionRepository->update(['total_amount' => $totalPrice - $request['amount']], $subscriptionId);

        $payment = $this->paymentRepository->create($input);
        $subscriptionId = $payment->subscription_id;
        $payments = Payment::where('subscription_id', $subscriptionId)->get();
       
   

        return view('payments.index', ['payments' => $payments, 'subscriptionId' => $subscriptionId]);
    }

    /**
     * Display the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {

            return redirect(route('payments.index'));
        }
        

        return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);
        $subscriptionId = $payment->subscription_id;

        if (empty($payment)) {

            return redirect(route('payments.index'));
        }

        return view('payments.edit')->with('payment', $payment)->with('subscriptionId', $subscriptionId);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param int $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);
        

        if (empty($payment)) {

            return redirect(route('payments.index'));
        }
        $subscriptionId = $request['subscription_id'];
        $totalPrice = Subscription::find($subscriptionId)->subscriptionType()->first()->price;
        if ($request['amount'] > $totalPrice) {
            return redirect()->back()->withErrors(['amount' => 'El monto no puede ser mayor al precio de la suscripción']);
        }
        if ($request['amount'] == $totalPrice) {
            $this->subscriptionRepository->update(['state' => 'Pagado'], $subscriptionId);
        }
        else {
            $this->subscriptionRepository->update(['state' => 'Abonado'], $subscriptionId);
        }
        $this->subscriptionRepository->update(['total_amount' => $totalPrice - $request['amount']], $subscriptionId);

        $payment = $this->paymentRepository->update($request->all(), $id);

        $subscriptionId = $payment->subscription_id;
        $payments = Payment::where('subscription_id', $subscriptionId)->get();
       
        return view('payments.index', ['payments' => $payments, 'subscriptionId' => $subscriptionId]);
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);

        $subscriptionId = $payment->subscription_id;
        $payments = Payment::where('subscription_id', $subscriptionId)->get();
        return view('payments.index', ['payments' => $payments, 'subscriptionId' => $subscriptionId]);
    }

    public function getPaymentsBySubscriptionId($subscriptionId)
    {
        $payments = Payment::where('subscription_id', $subscriptionId)->get();
        return view('payments.index', ['payments' => $payments, 'subscriptionId' => $subscriptionId]);
    }
    public function createPaymentBySubscriptionId($subscriptionId)
    {
        return view('payments.create', ['subscriptionId' => $subscriptionId]);
    }

    public function getInvoiceDetails($id) {
        echo $id;
        $payment = $this->paymentRepository->find($id);
        $payment->load('subscription');
        // var_dump($payment);
        return view('payments.masterDetail', ['payment' => $payment]);
    }
    


    
}
