@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session('info'))
            <div class="alert alert-info" role="alert">
                {{ session('info') }}
            </div>
            @endif
            @if (session('danger'))
            <div class="alert alert-danger" role="alert">
                {{ session('danger') }}
            </div>
            @endif
            <div class="mb-3">
                <a href="{{ route('students.create') }}"><input href="" type="button" value="Create new" class="btn btn-primary"></a>
            </div>
            <div class="card">
              <div class="mb-3">
                <form action="">
                    <div class="row">
                        <input type="text" name="search" class="form-control" value="{{ request('seacrh') }}">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Class</th>
                      <th>Photo</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($students as $student)
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
                      <td>
                        <a href="{{ route('students.edit', $student->id) }}"><input type="button" value="Edit" class="btn btn-primary"></a>
                        <br>
                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                {{ $students->links(
                    'pagination::bootstrap-4'
                ) }}
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
