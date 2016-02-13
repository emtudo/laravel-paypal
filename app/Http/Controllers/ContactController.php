<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use Exception;
use Mail;

class ContactController extends Controller
{
    /**
     * Envia email.
     *
     * @return Response
     */
    public function store(ContactStoreRequest $request)
    {
        $keys = array_keys($request->all());

        foreach ($keys as $value) {
            if (!in_array($value, ['email', 'phone', 'comments', 'name'])) {
                return response()->json('Houve algum problema e não foi possível enviar sua mensagem', 403);
            }
        }

        try {
            $r = Mail::send('emails.contacts', $request->all(), function ($message) use ($request) {
                $message
                    ->replyTo($request->email)
                    ->to(env('MAIL_TO'))
                    ->subject('Conctact: emtudo.xyz - paypal!');
            });
        } catch (Exception $e) {
            $r = false;
        }

        //Verifica se o email foi enviado com sucesso.
        if ($r) {
            return response()->json('Mensagem enviada com sucesso!', 200);
        }

        return response()->json('Houve algum problema e não foi possível enviar sua mensagem', 422);
    }
}
