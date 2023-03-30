<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Note;
use App\Models\Tickets;
use App\Mail\TicketMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $ticket = new Tickets();
            $ticket->code = Tickets::code();
            $ticket->customer_name = $request->name;
            $ticket->mobile = $request->number;
            $ticket->email = $request->email;
            $ticket->status = 'Open';
            $ticket->body = $request->problem;
            $ticket->save();

            $mail = $ticket->email;
            $url = url("/search_ticket?ticket_id=$ticket->code");
            Mail::to($mail)->queue(
                new TicketMail(
                    "New Ticket Is Created By You!",
                    "Your ticket code is $ticket->code. (Use this for get updates)", $url
                )
            );

            DB::commit();
            return redirect('dashboard')->withFlashSuccess("Adding Successful");
        } catch (Exception $ex) {
            DB::rollBack();
            // dd($ex);
            return redirect('dashboard')->withFlashDanger("Adding Unsuccessful");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function show(Tickets $ticket)
    {
        try {
            // $notes = Note::where('ticket_id', $id)->latest()->get();
            $statuses = array();
            switch ($ticket->status) {
                case 'Open':
                    $statuses = ['Open', 'Closed', 'In Progress', 'On Hold', 'Cancelled'];
                    break;
                case 'In Progress':
                    $statuses = ['Closed', 'In Progress', 'On Hold', 'Cancelled'];
                    break;
                case 'On Hold':
                    $statuses = ['Closed', 'On Hold', 'In Progress', 'Cancelled'];
                    break;
            }
            $notes = Note::where('ticket_id', $ticket->id)->latest()->get();
            return view('ticket.show', ['ticket' => $ticket, 'notes' => $notes, 'statuses' => $statuses]);
        } catch (Exception $ex) {
            dd($ex);
            return redirect('dashboard')->withFlashDanger("Can't locate ticket. Please try again.");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function edit(Tickets $tickets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tickets $tickets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tickets  $tickets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tickets $tickets)
    {
        //
    }
    public function saveTicket(Request $request)
    {
        // dd($request);
        DB::beginTransaction();
        try {
            $ticket = new Tickets();
            $ticket->code = Tickets::code();
            $ticket->customer_name = $request->name;
            $ticket->mobile = $request->number;
            $ticket->email = $request->email;
            $ticket->status = 'Open';
            $ticket->body = $request->problem;
            $ticket->save();

            $mail = $ticket->email;
            $url = url("/search_ticket?ticket_id=$ticket->code");
            Mail::to($mail)->queue(
                new TicketMail(
                    "New Ticket Is Created By You!",
                    "Your ticket code is $ticket->code. (Use this for get updates)", $url
                )
            );

            DB::commit();
            return redirect()->back()->with('status', 'Ticket Creation Successful');
        } catch (Exception $ex) {
            DB::rollBack();
            // dd($ex);
            return redirect()->back()->with('status', 'Ticket Creation Unuccessful');
        }
    }
    public function searchTicket(Request $request)
    {
        try {
            $code = $request->ticket_id;
            $ticket = Tickets::where('code', $code)->firstOrFail();
            $notes = Note::where('ticket_id', $ticket->id)->latest()->get();
            return view('ticket.view', ['ticket' => $ticket, 'notes' => $notes]);
        } catch (Exception $ex) {
            // dd($ex);
            return redirect()->back()->with('status', 'Please Recheck The Ticket Code');
        }
    }
}
