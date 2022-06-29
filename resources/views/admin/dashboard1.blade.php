@extends('admin.sidebar')
@extends('layouts.app')


@section('content');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <!--  <li class="breadcrumb-item"><a href="{{ url('contact') }}">Contact Us</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('change-password')}}">Change Password</a></li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!--
    <section class="content">
    <div class="container-fluid">
    <h1 class="mt-4">Contact Form</h1>
    <a href="{{ url('contact-form')}}">View Contact Form</a>

    </div>
    </section>
-->

@endsection
