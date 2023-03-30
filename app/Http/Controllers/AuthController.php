<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->baseUrl = config("app.api_url_base");
    }
    public function index(Request $request)
    {
        $tickets = Tickets::latest();

        if ($request->reset == 'true') {
            $request->customer_name = null;
            $request->code = null;
            $request->status = null;
            $request->department_id = null;
            $request->from = null;
            $request->to = null;
        }
        if ($request->customer_name) {
            $tickets = $tickets->where('customer_name', 'LIKE', '%' . $request->customer_name . '%');
        }

        if ($request->code) {
            $tickets = $tickets->where('code', $request->code);
        }

        if ($request->status) {
            $tickets = $tickets->where('status', $request->status);
        }

        if ($request->from) {
            if (!$request->to) {
                $request->to = date('Y-m-d');
            }
        }
        if ($request->to) {
            if (!$request->from) {
                $request->from = date('Y-m-d');
            }
        }
        if ($request->from) {
            $tickets = $tickets->whereDate('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $tickets = $tickets->whereDate('created_at', '<=', $request->to);
        }

        $tickets = $tickets->paginate(config('app.pagination'));
        return view('ticket.index', ['tickets' => $tickets, 'customer_name' => $request->customer_name,
            'current_status' => $request->status,
            'code' => $request->code,
            'from' => $request->from,
            'to' => $request->to]);
    }
    public function create()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');

        }
        return redirect()->back()->with('status', 'Log In Unuccessful');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
