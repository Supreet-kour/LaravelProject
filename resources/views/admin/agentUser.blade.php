@extends('layouts.app')


@section('content')

<!-- Main content -->
<section class="content">
<div class="container-fluid">
<h1 class="mt-4">View User</h1>
</div>
</section>

<div class="container-fluid px-4">
<div class="card mt-4">
@if(in_array(5, $permissions))
<h4> Add User
  <a href="{{url('agent/add-user')}}" class="btn btn-primary"> Add </a> </h4>
  </div>
  @endif
<br></br>

<div class="card-body">
<form class="" action="{{ url('agent/users') }}" method="post">
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
    @if(in_array(4, $permissions))
    <th>ID</th>
    <th>User Name</th>
    <th>User Email</th>
    <th>Role</th>
    @endif
    @if(in_array(6, $permissions))
    <th>Edit</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach($users as $item )
  <tr>
    @if(in_array(4, $permissions))
    <td>{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->role_as == '0' ? 'User':'Agent' }}</td>
    @endif
    @if(in_array(6, $permissions))
    <td> <a href="{{url('agent/edit-user/'.$item->id)}}" class="btn btn-success">Edit</a> </td>
    @endif

  </tr>
  @endforeach
</tbody>
</table>



</form>
</div>

@endsection
