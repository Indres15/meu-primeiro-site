<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Store;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Payment\PagSeguro\Notification;
use App\UserOrder;
use PhpParser\Node\Stmt\TryCatch;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function index()
    {
        try {
             //session()->forget('pagseguro_session_code');
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (!session()->has('cart')) return redirect()->route('home');
        $this->makePagSeguroSession();

        $cartItems = array_map(function ($line) {
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);

        // var_dump(session()->get('pagseguro_session_code'));

        return view('checkout', compact('cartItems'));

        } catch (\Exception $e) {
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');

        }

    }

    public function proccess(Request $request)
    {
        try {
            $dataPost = $request->all();
            $user = User::findOrfail(auth()->id());
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4()->toString();

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = (object) $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                  
            ];

            $userOrder = $user->orders()->create($userOrder);

            $userOrder->stores()->sync($stores);

            //notificar loja de novo pedido
            $store = (new Store())->notifyStoreOwners($stores);

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
            $message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar pedido';

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

    public function notification()
    {
       try{
        $notification = new notification();
        $notification = $notification->getTransaction();

        $reference = base64_decode($notification->getRefence());
        
        $userOrder = UserOrder::whereReference($reference);
        $userOrder->update([
            'pagseguro status' => $notification->getStatus()

        ]);

        if($notification->getStatus() == 3) {
            // Liberar o pedido do Usuario... atualizar o status do pedido para em separação
            //NOtificar o usuário que o pedido foi pago..
            //Notificar a loja da confirmação do pedido...
        }

        return response()->json([], 204);
        // var_dump($notification->getTransaction());

       } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : '';

            return response()->json(['error' => $message], 500);
       }
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