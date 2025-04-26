<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{

    public function index() {

        $attendances = Attendance::join('students', 'students.id', '=', 'attendances.stud_num')
        ->get();

        return view('attendance')->with(['attendances' => $attendances]);
    }

    public function attendance($student_id) {
        $studentQR = 'qrcodes/'.$student_id.'.png';
        $student = Student::where('qr_code',$studentQR)->first();

        if(!$student) {
            return response()->json(['error' => 'Invalid QR Code'], 404);
        }

        $attendances = Attendance::join('students', 'students.id', '=', 'attendances.stud_num')
        ->select('students.*', DB::raw('COUNT(attendances.stud_num) as attendance'))
        ->groupBy('students.id')
        ->get();

        Attendance::create(['stud_num' => $student->id]);

        return view('attendance-alert', ['student' => $student]);
    }
}
