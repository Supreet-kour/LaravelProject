@extends('admin.master')


@section('content')

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
  </head>
  <body>
 <div class="container-fluid px-4 text-center">
   <div class="card mt-4 text-center">
   <h1>Add User</h1>
   </div>

    <form class="" action="{{ url('admin/add-user-details') }}" method="post" enctype="multipart/form-data">
     @csrf

     <div class="mb-3 text-center">
     <label for="">User Name</label>
     <input type="text" name="name" value="" class="form-control text-center">
   </div> <br></br>

     <div class="mb-3 text-center">
     <label for="">User Email</label>
     <input type="email" name="email" value="" class="form-control text-center">
     </div> <br></br>

     <div class="mb-3 text-center">
     <label for="">Password</label>
     <input type="password" name="password" value="" class="form-control text-center">
     </div> <br></br>

     <div class="mb-3 text-center">
      <button type="submit" class="btn btn-primary">Add User</button>
     </div> <br></br>
     </form>
   </div>
 </div>






  </body>
</html>
@endsection
