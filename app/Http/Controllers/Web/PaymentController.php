<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\BecomeInstructor;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentChannel;
use App\Models\ReserveMeeting;
use App\Models\Reward;
use App\Models\RewardAccounting;
use App\Models\Sale;
use App\Models\TicketUser;
use App\Models\MultiAffilate;
use App\PaymentChannels\ChannelManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    protected $order_session_key = 'payment.order_id';

    public function paymentRequest(Request $request)
    {
        $this->validate($request, [
            'gateway' => 'required'
        ]);

        $user = auth()->user();
        $gateway = $request->input('gateway');
        $orderId = $request->input('order_id');

        $order = Order::where('id', $orderId)
            ->where('user_id', $user->id)
            ->first();

        if ($order->type === Order::$meeting) {
            $orderItem = OrderItem::where('order_id', $order->id)->first();
            $reserveMeeting = ReserveMeeting::where('id', $orderItem->reserve_meeting_id)->first();
            $reserveMeeting->update(['locked_at' => time()]);
        }

        if ($gateway === 'credit') {

            if ($user->getAccountingCharge() < $order->amount) {
                $order->update(['status' => Order::$fail]);

                session()->put($this->order_session_key, $order->id);

                return redirect('/payments/status');
            }

            $order->update([
                'payment_method' => Order::$credit
            ]);

            $this->setPaymentAccounting($order, 'credit');

            $order->update([
                'status' => Order::$paid
            ]);

            session()->put($this->order_session_key, $order->id);

            return redirect('/payments/status');
        }

        $paymentChannel = PaymentChannel::where('id', $gateway)
            ->where('status', 'active')
            ->first();

        if (!$paymentChannel) {
            $toastData = [
                'title' => trans('cart.fail_purchase'),
                'msg' => trans('public.channel_payment_disabled'),
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        $order->payment_method = Order::$paymentChannel;
        $order->save();

        // multi affiliate money adding
        // $order = Order::where('id', $orderId)
        // ->where('user_id', $user->id)
        // ->first();
                 
        // $affiliateDirect = affiliates::where('referred_user_id', $order->user_id )->first();
        // $affiliatePartner = affiliates::where('referred_user_id', $affiliateUserID->referred_user_id )->first();

        // $direct_user = User::where('id', $affiliateUserID->affiliate_user_id)->first();
        // $partner_user = User::where('id', $affiliatePartner->affiliate_user_id)->first();
        // $direct_comission=0;
        // $partner_comission=0;
        // if($direct_user){
        //     $plan=$AffliatePlans::where('rank', $partner_user->rank)->first();
        //     if($plan){
        //         $direct_comission= ($direct_user->direct_commi / 100) * $order->amount;
        //         Accounting::create([
        //             'user_id' => $user->id,
        //             'system' => false,
        //             'referred_user_id' => $affiliateUserID->affiliate_user_id,
        //             'is_affiliate_commission' => true,
        //             'amount' => $direct_comission,
        //             'webinar_id' => null,
        //             'meeting_time_id' => $order->id ? $order->id : null,
        //             'subscribe_id' => null,
        //             'promotion_id' => null,
        //             'type_account' =>"income",
        //             'type' => "addiction",
        //             'description' =>"indirect_commission_from_referral",
        //             'created_at' => time()
        //         ]);


        //         // Accounting::
        //     }
        // }else if($partner_user){
        //     $partner_comission= ($direct_user->partner_commi / 100) * $order->amount;
        //         Accounting::create([
        //             'user_id' => $user->id,
        //             'system' => false,
        //             'referred_user_id' => $affiliatePartner->affiliate_user_id,
        //             'is_affiliate_commission' => true,
        //             'amount' => $partner_comission,
        //             'webinar_id' => null,
        //             'meeting_time_id' => $order->id ? $order->id : null,
        //             'subscribe_id' => null,
        //             'promotion_id' => null,
        //             'type_account' =>"income",
        //             'type' => "addiction",
        //             'description' =>"indirect_commission_from_referral",
        //             'created_at' => time()
        //         ]);

        // }

        
        // end Affiliate money adding
        
        try {
            $channelManager = ChannelManager::makeChannel($paymentChannel);
            $redirect_url = $channelManager->paymentRequest($order);

            if (in_array($paymentChannel->class_name, ['Paytm', 'Payu', 'Zarinpal', 'Stripe', 'Paysera', 'Cashu', 'Iyzipay', 'MercadoPago'])) {
                return $redirect_url;
            }

            return Redirect::away($redirect_url);

        } catch (\Exception $exception) {

            $toastData = [
                'title' => trans('cart.fail_purchase'),
                'msg' => trans('cart.gateway_error'),
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }
    }

    public function paymentVerify(Request $request, $gateway)
    {
        $paymentChannel = PaymentChannel::where('class_name', $gateway)
            ->where('status', 'active')
            ->first();

        try {
            $channelManager = ChannelManager::makeChannel($paymentChannel);
            $order = $channelManager->verify($request);

            if (!empty($order)) {

                if ($order->status == Order::$paying) {
                    $this->setPaymentAccounting($order);

                    $order->update(['status' => Order::$paid]);
                } else {
                    if ($order->type === Order::$meeting) {
                        $orderItem = OrderItem::where('order_id', $order->id)->first();

                        if ($orderItem && $orderItem->reserve_meeting_id) {
                            $reserveMeeting = ReserveMeeting::where('id', $orderItem->reserve_meeting_id)->first();

                            if ($reserveMeeting) {
                                $reserveMeeting->update(['locked_at' => null]);
                            }
                        }
                    }
                }

                session()->put($this->order_session_key, $order->id);

                return redirect('/payments/status');
            } else {
                $toastData = [
                    'title' => trans('cart.fail_purchase'),
                    'msg' => trans('cart.gateway_error'),
                    'status' => 'error'
                ];
                return redirect('cart')->with($toastData);
            }

        } catch (\Exception $exception) {
            $toastData = [
                'title' => trans('cart.fail_purchase'),
                'msg' => trans('cart.gateway_error'),
                'status' => 'error'
            ];
            return redirect('cart')->with(['toast' => $toastData]);
        }
    }

    public function setPaymentAccounting($order, $type = null)
    {
        if ($order->is_charge_account) {
            Accounting::charge($order);
        } else {
            foreach ($order->orderItems as $orderItem) {
                $sale = Sale::createSales($orderItem, $order->payment_method);

                if (!empty($orderItem->reserve_meeting_id)) {
                    $reserveMeeting = ReserveMeeting::where('id', $orderItem->reserve_meeting_id)->first();
                    $reserveMeeting->update([
                        'sale_id' => $sale->id,
                        'reserved_at' => time()
                    ]);

                    $reserver = $reserveMeeting->user;

                    if ($reserver) {
                        $this->handleMeetingReserveReward($reserver);
                    }
                }

                if (!empty($orderItem->subscribe_id)) {
                    Accounting::createAccountingForSubscribe($orderItem, $type);
                } elseif (!empty($orderItem->promotion_id)) {
                    Accounting::createAccountingForPromotion($orderItem, $type);
                } elseif (!empty($orderItem->registration_package_id)) {
                    Accounting::createAccountingForRegistrationPackage($orderItem, $type);

                    if (!empty($orderItem->become_instructor_id)) {
                        BecomeInstructor::where('id', $orderItem->become_instructor_id)
                            ->update([
                                'package_id' => $orderItem->registration_package_id
                            ]);
                    }
                } else {
                    // webinar and meeting

                    Accounting::createAccounting($orderItem, $type);
                    TicketUser::useTicket($orderItem);
                }
            }
        }

        Cart::emptyCart($order->user_id);
    }

    public function payStatus(Request $request)
    {
        $orderId = $request->get('order_id', null);

        if (!empty(session()->get($this->order_session_key, null))) {
            $orderId = session()->get($this->order_session_key, null);
            session()->forget($this->order_session_key);
        }

        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->first();

        if (!empty($order)) {
            $data = [
                'pageTitle' => trans('public.cart_page_title'),
                'order' => $order,
            ];

            return view('web.default.cart.status_pay', $data);
        }

        return redirect('/panel');
    }

    private function handleMeetingReserveReward($user)
    {
        if ($user->isUser()) {
            $type = Reward::STUDENT_MEETING_RESERVE;
        } else {
            $type = Reward::INSTRUCTOR_MEETING_RESERVE;
        }

        $meetingReserveReward = RewardAccounting::calculateScore($type);

        RewardAccounting::makeRewardAccounting($user->id, $meetingReserveReward, $type);
    }
}