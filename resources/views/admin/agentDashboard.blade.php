@extends('admin.agentsidebar')

@section('content');


<div class="card-body">
<form class="" action="{{ url('agent/users') }}" method="post">
  <div class="container text-center">

     @if(Session::has('success'))
      <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
      <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif

  </div>
  </div>

@endsection
