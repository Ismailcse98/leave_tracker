<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use App\Models\User;
use App\Notifications\SendEmailNotification;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $application_lists = LeaveApplication::with('user','leaveType')->where('status','pending')->get();
        return view('admin.leave-application.pending_list', compact('application_lists'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedList()
    {
        $application_lists = LeaveApplication::with('user','leaveType')->where('status','approve')->get();
        return view('admin.leave-application.approved_list', compact('application_lists'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectedList()
    {
        $application_lists = LeaveApplication::with('user','leaveType')->where('status','reject')->get();
        return view('admin.leave-application.rejected_list', compact('application_lists'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = LeaveApplication::with('user','leaveType')->findOrfail($id);
        return view('admin.leave-application.details', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comments' => 'required',
            'status' => 'required',
        ]);
        
        try {
            $application = LeaveApplication::findOrFail($id);
            $userInfo = User::findOrFail($application->user_id);

            $application->update([
                'comments' => $request->input('comments'),
                'status' => $request->input('status'),
            ]);

            $notifyData = [
                'name' => $userInfo->name,
                'comments' => $request->input('comments'),
                'status' => $request->input('status'),
            ];

            $userInfo->notify(new SendEmailNotification($notifyData));
            
            return response()->json([
                'type' => 'success',
                'message' => 'Leave application updated successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
