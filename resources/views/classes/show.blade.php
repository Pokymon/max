@extends('layouts.app')
@section('content')
<div class="card-body">
    <label class="form-label">Class</label>
    <p>{{ $classes->name }}</p>
    <div class="mt-3">
        <label class="form-label">Students</label>
    <div class="card-body">
        <div class="card">
            <div class="table-responsive">
              <table class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Photo</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($classes->students as $student)
                  <tr>
                    <td>{{ $student->name }}</td>
                    <td class="text-muted" >
                      {{ $student->phone_number }}
                    </td>
                    <td class="text-muted" >
                      {{ $student->address }}
                    </td>
                    <td class="text-muted" >
                      {{ $student->studentClass->name }}
                    </td>
                    <td>
                      <img src="{{ asset('storage/'.$student->photo) }}" alt="" width="100px">
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection
