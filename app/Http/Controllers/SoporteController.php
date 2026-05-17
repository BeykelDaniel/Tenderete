<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class SoporteController extends Controller
{
    public function send(Request $request)
    {
        // Validar campos de entrada
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Dirección de correo elegida para recibir el soporte técnico
            $recipient = 'tenderete2026@gmail.com';

            // Ejecuta el envío real usando el Mailable
            Mail::to($recipient)->send(new ContactMessageMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Hemos recibido tu solicitud. Te responderemos pronto a tu correo.'
            ], 200);

        } catch (\Exception $e) {
    // Retorna la traza textual del error directo de PHP/Gmail hacia la alerta de la vista
    return response()->json([
        'success' => false,
        'message' => 'Error Técnico Real: ' . $e->getMessage()
    ], 500);
}

    }
}
