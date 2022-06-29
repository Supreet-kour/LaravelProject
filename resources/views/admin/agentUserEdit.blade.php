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
   <h4>Edit Users
   <a href="{{url('agent/users')}}" class="btn btn-danger float-end">Back</a> </h4>
   </div>
<br></br>

<form class="" action="{{url('agent/update-user/'.$user->id)}}" method="post" enctype="multipart/form-data">
 @csrf
 @method('PUT')


    <div class="mb-3">
    <label for="">Name</label>
    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    </div> <br></br>

    <div class="mb-3">
    <label for="">Email</label>
    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
    </div> <br></br>

      <div class="mb-3">
        <label for="">Role as</label>
        <select class="form-control" name="role_as">
      <!--    <option value="1" {{ $user->role_as == '1' ? 'selected':'' }}>Admin</option> -->
          <option value="0" {{ $user->role_as == '0' ? 'selected':'' }}>User</option>
          <option value="2" {{ $user->role_as == '2' ? 'selected':'' }}>Agent</option>
        </select>
      </div> <br></br>

    <!--  <div class="mb-3">
        @if($user->role_as == '2')
        <label for="">Permission</label>
        @foreach ($permissions as $permission)
        <br> <input type='checkbox' name='permission_ids[]' value='{{$permission['id']}}' checked="checked"> {{$permission['permission_name']}}
        @endforeach
        @endif

        </select>
      </div> <br></br> -->

     <div class="mb-3">
      <button type="submit" class="btn btn-primary">Update</button>
     </div> <br></br>
     </form>
   </div>
 </div>






  </body>
</html>
