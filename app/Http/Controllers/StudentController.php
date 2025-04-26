<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{

    public function index() {
        $students = Student::where('status',1)->get();
        return view('dashboard', compact('students'));
    }

    public function registerStudent(Request $request) {
        $data = $request->all();
        unset($data['stud_id']);

        $baseUrl = request()->getSchemeAndHttpHost();

        if($request->stud_id == NULL) {
 
            $student_id = uniqid('STU-');

            $qrCodePath = 'qrcodes/'.$student_id.'.png';
            QrCode::format('png')->size(200)->generate(url($baseUrl.'/attendance/check/' . $student_id), public_path('qrcodes/' . $student_id . '.png'));

            $data['qr_code'] = $qrCodePath;
        } 
       
        Student::updateOrCreate([
            'id' => $request->stud_id],
            $data);
        
        return redirect()->back();
    }

    public function getStudent($stud_id) {
        $student = Student::find($stud_id);
        return response()->json($student);
    }

    public function archive($stud_id) {
        Student::where('id',$stud_id)->update(['status' => 0]);
        return response()->json(['success' => true, 'message' => 'Student archived successfully']);
    }

    public function selectYear(Request $request) {
        $range = $request->input('date_range');

        if ($range && str_contains($range, ' to ')) {
            [$startDate, $endDate] = explode(' to ', $range);
    
            $attendances = Attendance::join('students', 'students.id', '=', 'attendances.stud_num')
                                ->whereDate('clock_in', '>=', $startDate)
                                ->whereDate('clock_in', '<=', $endDate)
                                ->get();
    
            return view('attendance', compact('attendances'));
        }
    
        return back()->with('error', 'Please select a valid date range.');
    }
}
