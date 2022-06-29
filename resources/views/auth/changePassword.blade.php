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
   <h1>Change Password</h1>
   </div>

    <form class="" action="{{ url ('update-password') }}" method="post" enctype="multipart/form-data">
      @if(Session::has('success'))
          <div class="alert alert-success">{{Session::get('success')}}</div>
          @endif
          @if(Session::has('fail'))
          <div class="alert alert-danger">{{Session::get('fail')}}</div>
          @endif
     @csrf

     <div class="mb-3">
     <label for="">Old Password</label>
     <input type="password" name="old_password" value="" class="form-control">
     @if($errors->any('old_password'))
     <span class="text-danger">{{$errors->first('old_password')}}</span>
     @endif
     </div> <br></br>

     <div class="mb-3">
     <label for="">New Password</label>
     <input type="password" name="new_password" value="" class="form-control">
     @if($errors->any('new_password'))
     <span class="text-danger">{{$errors->first('new_password')}}</span>
     @endif
     </div> <br></br>


     <div class="mb-3">
     <label for="">Confirm Password</label>
     <input type="password" name="confirm_password" value="" class="form-control">
     @if($errors->any('confirm_password'))
     <span class="text-danger">{{$errors->first('confirm_password')}}</span>
     @endif
     </div> <br></br>



     <div class="mb-3">
      <button type="submit" class="btn btn-primary">Change Password</button>
     </div> <br></br>
     </form>
   </div>
 </div>






  </body>
</html>
