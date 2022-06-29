@extends('layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact us</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Contact us</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2><strong>We would love to hear from you!!</strong></h2>
            </div>
          </div>
          <div class="col-7">
            <div class="card-body">
              @if(Session::has('message_sent'))
               <div class="alert alert-success" role="alert">
                 {{Session::get('message_sent')}}
               </div>
              @endif
              <form action="{{ url('contact-us')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control"/>
                <span style="color:red">@error('name'){{$message}}@enderror</span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control"/>
                <span style="color:red">@error('email'){{$message}}@enderror</span>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control"/>
                <span style="color:red">@error('phone'){{$message}}@enderror</span>
              </div>
              <div class="form-group">
                <label for="msg">Message</label>
                <textarea name="msg" class="form-control"></textarea>
              </div>

                <div class="form-group">
                <button type="submit" class="btn btn-info">Submit</button>
                </div>

              </form>
            </div>


          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
