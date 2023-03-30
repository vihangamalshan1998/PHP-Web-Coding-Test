<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Note;
use App\Models\Tickets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NoteController extends Controller
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
        //
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
            $ticket_details = Tickets::where('id', $request->ticket_id)->first();
            $mail = $ticket_details->email;

            $note = new Note();
            $note->body = $request->note;
            $note->ticket_id = $request->ticket_id;
            if ($request->status) {
                $note->current_status = $request->status;
                $ticket_details->status = $request->status;
            } else {
                $note->current_status = $ticket_details->status;
            }
            if ($note->current_status == 'Closed') {
                $url = url("/search_ticket?ticket_id=$ticket_details->code");
                Mail::to($mail)->queue(
                    new TicketMail(
                        "Your Ticket Is Closed (" . $ticket_details->code . ")",
                        "Your ticket is closed (" . $ticket_details->code . ") by " . auth()->user()->name, $url
                    )
                );
            } else {
                $url = url("/search_ticket?ticket_id=$ticket_details->code");
                Mail::to($mail)->queue(
                    new TicketMail(
                        "New Comment Added To Your Ticket (" . $ticket_details->code . ")",
                        "New comment added to your ticket (" . $ticket_details->code . ") by " . auth()->user()->name, $url
                    )
                );
            }
            $note->created_by = auth()->user()->id;
            $note->save();
            $ticket_details->updated_at = Carbon::now();
            $ticket_details->save();
            DB::commit();
            return redirect()->back()->withFlashSuccess("Adding Successful");
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withFlashDanger("Adding Unsuccessful");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
