<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        //  session()->forget('pagseguro_session_code');
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (!session()->has('cart')) return redirect()->route('home');
        $this->makePagSeguroSession();

        $cartItems = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        //var_dump(session()->get('pagseguro_session_code'));

        return view('checkout', compact('cartItems'));
    }

    public function proccess(Request $request)
    {
        try {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $reference = 'XPTO';

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = (object) $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'store_id' => 40
            ];

            $user->orders()->create($userOrder);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');


            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso',
                    'order'   => $reference
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido';

            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message

                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}