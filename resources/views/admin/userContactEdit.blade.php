@extends('layouts.app')


@section('content')


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
  </head>
  <body>
 <div class="container-fluid px-4">
   <div class="card mt-4">
   <h1>Edit Details</h1>
   </div>

    <form class="" action="{{url('update-details/'.$client->id)}}" method="post" enctype="multipart/form-data">
     @csrf
     @method('PUT')

     <div class="mb-3">
     <label for="">Name</label>
  <!--   <p class="form-control"> {{ $client->name }} </p> -->
   <input type="text" name="name" value="{{ $client->name }}" class="form-control">
   </div> <br></br>

     <div class="mb-3">
     <label for="">Email</label>
  <!--   <p class="form-control"> {{ $client->email }} </p> -->
     <input type="email" name="email" value="{{ $client->email }}" class="form-control">
     </div> <br></br>

     <div class="mb-3">
     <label for="">Phone No</label>
     <input type="number" name="phone" value="{{ $client->phone }}" class="form-control">
     </div>  <br></br>

     <div class="mb-3">
     <label for="">Message</label>
     <input type="text" name="msg" value="{{ $client->msg }}" class="form-control">
     </div> <br></br>

     <div class="mb-3">
      <button type="submit" class="btn btn-primary">Update Details</button>
     </div> <br></br>
     </form>
   </div>
 </div>






  </body>
</html>
@endsection
