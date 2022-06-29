@extends('layouts.app')

@section('content');

<!-- Main content -->
<section class="content">
<div class="container-fluid">
<h1 class="mt-4">Contact Details</h1>
</div>
</section>


<div class="card-body">
<form class="" action="{{ url('agent/client') }}" method="post">
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
    @if(in_array(1, $permissions))
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone No</th>
    <th>Message</th>
    @endif
    @if(in_array(2, $permissions))
    <th>Edit</th>
    @endif
    @if(in_array(3, $permissions))
    <th>Delete</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach($client as $item )
  <tr>
    @if(in_array(1, $permissions))
    <td>{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone }}</td>
    <td>{{ $item->msg }}</td>
    @endif
    @if(in_array(2, $permissions))
    <td> <a href="{{url('agent/edit-detail/'.$item->id)}}" class="btn btn-success">Edit</a> </td>
    @endif
    @if(in_array(3, $permissions))
    <td> <a href="{{url('agent/delete-detail/'.$item->id)}}" class="btn btn-success">Delete</a> </td>
    @endif
  </tr>
  @endforeach
</tbody>
</table>



</form>
</div>

@endsection
