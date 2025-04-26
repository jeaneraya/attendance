<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance Report') }}
        </h2>
    </x-slot>
    <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
        <button class="btn btn-primary register-student">Register Student</button>
        <button class="btn btn-primary mx-3">View Report</button>
    </div> -->
    <div class="my-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pt-4">
            <div class="mb-3 d-flex">
                <form action="/select-year" method="POST" class="d-flex justify-content-around w-50">
                    @csrf
                    <input type="text" name="date_range" id="dateRangePicker" class="form-control mx-3" placeholder="Select date range">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped" id="attendance-table">
                        <thead>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Yr Level</th>
                            <th>Attendance</th>
                        </thead>
                        <tbody>
                            @foreach($attendances as $key=>$attendance)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$attendance->student_id}}</td>
                                <td>{{$attendance->first_name}} {{$attendance->middle_name}} {{$attendance->last_name}}</td>
                                <td>{{$attendance->course}}</td>
                                <td>{{$attendance->year_level}}</td>
                                <td>{{$attendance->clock_in}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        new DataTable('#attendance-table');
                        flatpickr("#dateRangePicker", {
                            mode: "range",
                            dateFormat: "Y-m-d",
                        });
                    </script>

                    @if (Request::is('attendance/check/*'))
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
                            <button class="btn btn-primary">➕ Add New Attendance</button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Register Student Modal -->
    <div class="modal fade" id="registerStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Register Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/register-student" method="post">
                    @csrf
                    <div class="row mb-3 wrapper">
                        <div class="col-4">
                            <label for="" class="form-label">Last Name</label>
                            <input type="hidden" name="student_id" id="student_id" class="form-control">
                            <input type="hidden" name="registration" id="registration">
                            <input type="hidden" name="qr_code" id="qr_code">
                            <input class="form-ctrl" type="text" name="last_name" id="last_name">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">First Name</label>
                            <input class="form-ctrl" type="text" name="first_name" id="first_name">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Middle Name</label>
                            <input class="form-ctrl" type="text" name="middle_name" id="middle_name">
                        </div>
                    </div>
                    <div class="row mb-3 wrapper">
                        <div class="col-4">
                            <label for="" class="form-label">Student_id</label>
                            <input class="form-ctrl" type="text" name="student_id" id="student_id">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Course</label>
                            <input class="form-ctrl" type="text" name="course" id="course">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">Year Level</label>
                            <input class="form-ctrl" type="text" name="year_level" id="year_level">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit-button">Submit</button>
            </div>
            </div>
            </form>
        </div>
    </div>

    <script src="{{asset('script.js')}}"></script>
</x-app-layout>
