<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    //

    public function send_email_encomenda_fechada(Request $request, Encomenda $encomenda)
    {
        // SEND EMAIL WITH MAILABLE CLASS
        // Send to user:
        $user = User::findOrFail($encomenda->cliente_id);
        Mail::to($user)
            ->send(new OrderShipped($encomenda));

        return redirect()->route('encomendas.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', 'E-Mail sent with success (using Mailable)');
    }
}
