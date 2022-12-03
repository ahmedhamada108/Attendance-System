@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('panel.departments.departments_list')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('panel.departments.home')</a></li>
              <li class="breadcrumb-item active">@lang('panel.departments.table')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('layouts.errors')
            @include('layouts.sessions_messages')
            <!--Table -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <a class="btn btn-success mb-4 text-bold" href="{{route('departments.create')}}">@lang('panel.departments.add_new') + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th># ID</th>
                    <th>Name</th>
                    <th>Head Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($departments as $department)  
                  <tr>
                    <td>{{ $department->id}}</td>
                    <td>{{ $department->name}}</td> 
                    <td>{{ $department['head']->head_name}}</td> 

                    <td>
                        <a style="float: left;" class="btn btn-primary" href="{{ route('departments.edit', $department->id ) }}">Edit</a>
                        <form method="post" action="{{ route('departments.destroy',$department->id) }}">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                  </tr>
                  </tbody>
                @endforeach
      
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
    <!-- /.content-wrapper -->
@endsection