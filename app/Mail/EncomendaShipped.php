<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EncomendaShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encomenda)
    {
        $this->encomenda = $encomenda;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mysite.com')
                    ->subject('A tua encomenda foi finalizada')
                    ->view('emails.encomendas.shipped')->with([
                        'id' => $this->encomenda->id,
                        'estado' => $this->encomenda->estado,
                        'cliente_id' => $this->encomenda->cliente_id,
                        'data' => $this->encomenda->data,
                        'preco_total' => $this->encomenda->preco_total,
                        'notas' => $this->encomenda->notas,
                        'nif' => $this->encomenda->nif,
                        'endereco' => $this->encomenda->endereco,
                        'tipo_pagamento' => $this->encomenda->tipo_pagamento,
                        'recibo_url' => $this->encomenda->recibo_url,
                        'tamanho' => $this->encomenda->tshirts->tamanho,
                        'quantidade' => $this->encomenda->tshirts->quantidade,
                        'sub_total' => $this->encomenda->tshirts->sub_total,
                        'preco_un' => $this->encomenda->tshirts->preco_un,
                        ]);
    }
}
