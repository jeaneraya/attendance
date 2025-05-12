<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
        <button class="btn btn-primary register-student">Register Student</button>
        <a href="/attendance" class="btn btn-primary mx-3">View Report</a>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped" id="student-table">
                        <thead>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Yr Level</th>
                            <th>QR Code</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($students as $key=>$student)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$student->student_id}}</td>
                                <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                                <td>{{$student->course}}</td>
                                <td>{{$student->year_level}}</td>
                                <td><img src="{{ asset($student->qr_code) }}" alt="QR Code" width="70"></td>
                                <td>
                                    <div class="buttons-wrapper d-flex">
                                        <button class="btn btn-success btn-sm view-student" data-id="{{$student->id}}">View</button>
                                        <button class="btn btn-warning btn-sm mx-2 edit-student" data-id="{{$student->id}}">Edit</button>
                                        <button class="btn btn-secondary btn-sm" data-id="{{$student->id}}" onclick="archiveStudent(this)">Archive</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        new DataTable('#student-table');
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Student Modal -->
    <div class="modal fade" id="registerStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 student_modal" id="exampleModalLabel">Register Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/register-student" method="post">
                    @csrf
                    <div class="row mb-3 wrapper">
                        <div class="col-4">
                            <label for="" class="form-label">Last Name</label>
                            <input type="hidden" class="form-ctrl" name="stud_id" id="stud_id">
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
                    <div class="row mb-5 wrapper">
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
                    <div class="row wrapper qr-wrapper">
                        <div class="col-4">
                            <img src="" alt="" width="150" id="qr_code">
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
