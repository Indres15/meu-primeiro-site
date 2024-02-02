<?php

namespace App\Payment\PagSeguro;

use Illuminate\Support\Env;
use PhpParser\Node\Stmt\Foreach_;

class Boleto
{
    private $items;
    private $user;
    private $reference;
    private $senderHash;

    public function __construct($items, $user,$reference, $senderHash)
    {
        $this->items = $items;
        $this->user = $user;
        $this->reference = $reference;
        $this->senderHash = $senderHash;
    }

    public function doPayment()
    {
        $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();

        $boleto->setMode('DEFAULT');

        $boleto->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        $boleto->setCurrency("BRL");

        foreach($this->items as $items) {
            $boleto->addItems()->wihParameters(
                $items['id'],
                $items['name'],
                $items['amount'],
                $items['price']

            );
        }

        $boleto->setReference(base64_decode($this->reference));

        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sadbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $boleto->setSender()->setName($user->name);
        $boleto->setSender()->setEmail($email);

        $boleto->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $boleto->setSender()->setDocument()->withParameters(
            'CPF',
            '61355585368'
        );

        $boleto->setSender()->setHash($this->senderHash);

        $boleto->setSender()->SetIp('172.0.0.0');

        $boleto->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $result = $boleto->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;

    }
}