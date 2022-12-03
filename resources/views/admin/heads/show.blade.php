@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>professors</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('heads.index') }}" >professors</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header bg-success">
                    <h3 class="card-title">Edit the professor</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('heads.update',$heads->id) }}" method="POST" >
                    @csrf
                    <input type="hidden" name="_method" value="put" />
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">name</label>
                            <input value="{{ $professors->name }}" type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input value="{{ $professors->email }}" type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input  type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                                <input  type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group" data-select2-id="11">
                                <label>Select Professors Status</label>
                                <select name="activation" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0" {{0 ==$professors->activation ? 'selected' : ''}} data-select2-id="3">Pending</option>
                                    <option value="1" {{1 ==$professors->activation ? 'selected' : ''}} data-select2-id="14">Accept</option>
                                    <option value="2" {{2 ==$professors->activation ? 'selected' : ''}} data-select2-id="15">Rejected</option>
                                </select>
                            </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>    
                  </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
  <!-- /.content -->

</div>
@endsection