@extends('layouts.admin')

@section('content')
<!-- Imported start -->

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="container">
                @if(Session::has('success'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                @endif
            </div>
            <h5 class="card-title mb-4 d-inline">Admins</h5>
           <a  href="{{ route('admins-create') }}" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">username</th>
                  <th scope="col">email</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin)
                  <tr>
                    <th scope="row">{{ $admin->id }}</th>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table> 
          </div>
        </div>
      </div>
    </div>
<!-- Imported end -->
@endsection