@extends('layouts.app')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>professors List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Table</li>
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
                <div class="dropdown" style="float: right;">
                  <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                      Sort by:
                      @if(Request::get('sort')=="Employees")
                        Status: Employees Only
                      @elseif(Request::get('sort')=="Heads")
                        Status: Heads Only 
                      @elseif(Request::get('sort')== null)
                          Employees & Heads
                      @endif
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="{{url()->current()}}" class="dropdown-item" >All Employees & Heads</a>
                      <a href="{{url()->current()."?sort=Employees"}}" class="dropdown-item" >Status: Employees Only</a>
                      <a href="{{url()->current()."?sort=Heads"}}" class="dropdown-item" >Status: Heads Only</a>
                  </div>
                </div>
                <a class="btn btn-success mb-4 text-bold" href="{{route('heads.create')}}">Add New + </a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($heads as $head)  
                  <tr>
                    <td>{{ $head->id}}</td>
                    <td>{{ $head->name}}</td> 
                    <td>
                        <a style="float: left;" class="btn btn-primary" href="{{ route('employees.edit', $head->id ) }}">Edit</a>
                        <form method="post" action="{{ route('heads.destroy',$head->id) }}">
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