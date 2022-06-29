@extends('admin.master');


@section('content');


<h1>Home: {{Auth::User()->name}}</h1>




@endsection
