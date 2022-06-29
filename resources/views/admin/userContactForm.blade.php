@extends('layouts.app')


@section('content')



<!-- Main content -->
<section class="content">
<div class="container-fluid">
<h1 class="mt-4">Contact Details</h1>
</div>
</section>


<div class="card-body">
<form class="" action="{{ url('contact-form') }}" method="post">
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
    <th>Name</th>
    <th>Email</th>
    <th>Phone No</th>
    <th>Message</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
</thead>
<tbody>
  @foreach($clients as $item )
  <tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone }}</td>
    <td>{{ $item->msg }}</td>
    <td> <a href="{{url('edit-detail/'.$item->id)}}" class="btn btn-success">Edit</a> </td>
    <td> <a href="{{url('delete-detail/'.$item->id)}}" class="btn btn-success">Delete</a> </td>
  </tr>
  @endforeach
</tbody>
</table>



</form>
</div>

@endsection
