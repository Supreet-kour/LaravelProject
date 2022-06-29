@extends('admin.master')


@section('content')

<!-- Main content -->
<section class="content">
<div class="container-fluid">
<h1 class="mt-4">View User</h1>
</div>
</section>

<div class="container-fluid px-4">
<div class="card mt-4 text-center">
<h4> Add User
  <a href="{{url('admin/add-user')}}" class="btn btn-primary"> Add </a> </h4>
  </div>
<br></br>
    <div class="container-fluid px-4">
        <div class="row m-2">
            <form class="col-9" action="">
                <div class="form-group">
                    <input type="search" name="search" id="" class="form-control" placeholder="search by name or email" value="{{$search}}">
                </div>
                <button class="btn btn-primary">Search</button>
            </form>

        </div>

<div class="card-body">
<form class="" action="{{ url('admin/users') }}" method="post">
  @if(Session::has('success'))
      <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
      <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif
      @csrf
<table class="table table-bordered">
<thead>
  <tr>
    <th>ID</th>
    <th>User Name</th>
    <th>User Email</th>
    <th>Role</th>
    <th>Edit</th>
  </tr>
</thead>
<tbody>
  @foreach($users as $item )
  <tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->role_as == '0' ? 'User':'Agent' }}</td>

    <td> <a href="{{url('admin/edit-user/'.$item->id)}}" class="btn btn-success">Edit</a> </td>
  </tr>
  @endforeach
</tbody>
</table>



</form>
</div>

@endsection
