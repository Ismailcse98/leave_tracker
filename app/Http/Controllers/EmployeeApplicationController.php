<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveApplication;
use App\Models\LeaveType;

class EmployeeApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authId = Auth::id();
        $application_lists = LeaveApplication::with('leaveType')->where('user_id',$authId)->where('status','pending')->get();
        return view('employee.leave-application.index', compact('application_lists'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedList()
    {
        $authId = Auth::id();
        $application_lists = LeaveApplication::with('leaveType')->where('user_id',$authId)->where('status','approve')->get();
        return view('employee.leave-application.approved_list', compact('application_lists'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectedList()
    {
        $authId = Auth::id();
        $application_lists = LeaveApplication::with('leaveType')->where('user_id',$authId)->where('status','reject')->get();
        return view('employee.leave-application.rejected_list', compact('application_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leave_types = LeaveType::where('status', 1)->get();
        return view('employee.leave-application.create', compact('leave_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);

        try {
            LeaveApplication::create([
                'user_id' => Auth::id(),
                'leave_type_id' => $request->input('leave_type_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'reason' => $request->input('reason'),
            ]);

            return response()->json([
                'type' => 'success',
                'message' => 'Leave application created successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Opps somthing went wrong. ' . $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave_types = LeaveType::where('status', 1)->get();
        $leaveApplication = LeaveApplication::findOrfail($id);
        return view('employee.leave-application.edit', compact('leaveApplication','leave_types'));
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
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required',
        ]);
        
        try {
            LeaveApplication::findOrFail($id)->update([
                'leave_type_id' => $request->input('leave_type_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'reason' => $request->input('reason'),
            ]);
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
        $leaveApplication = LeaveApplication::findOrfail($id);
        try {
            $leaveApplication->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Deleted !!',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'error' . $exception->getMessage(),
            ]);
        }
    }
}
