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
                <a href="{{ route('classes.create') }}"><input href="" type="button" value="Create new" class="btn btn-primary"></a>
            </div>
            <div class="card">
              <div class="table-responsive">
                <table class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($classes as $studentClass)
                    <tr>
                      <td>
                        <a href="{{ route('classes.show', $studentClass->id) }}">{{ $studentClass->name }}</a>
                      </td>
                      <td class="text-muted" >
                        {{ $studentClass->slug }}
                      </td>
                      <td>
                        <a href="{{ route('classes.edit', $studentClass->id) }}"><input type="button" value="Edit" class="btn btn-primary"></a>
                        <br>
                        <form action="{{ route('classes.destroy', $studentClass->id) }}" method="post">
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
                {{ $classes->links(
                    'pagination::bootstrap-4'
                ) }}
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
