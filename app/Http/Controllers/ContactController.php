<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $req)
    {
        // anti-spam honeypot
        if ($req->filled('website')) return back()->with('status', 'Thanks!');

        $data = $req->validate([
            'name' => 'required|max:120',
            'phone' => 'required|max:60',
            'email' => 'required|email',
            'service' => 'nullable|max:80',
            'message' => 'required|max:5000',
        ]);

        // conținut simplu (rapid) – fără view
        $text  = "New contact request\n"
            . "Name: {$data['name']}\n"
            . "Email: {$data['email']}\n"
            . "Phone: {$data['phone']}\n"
            . "Service: " . ($data['service'] ?? '—') . "\n\n"
            . "Message:\n{$data['message']}\n";

        Mail::raw($text, function ($m) use ($data) {
            $m->to(env('MAIL_TO_ADDRESS'))
                ->subject('New Estimate Request - ' . $data['name']);
        });

        return back()->with('status', 'Thanks! We’ve received your request.');
    }
}
