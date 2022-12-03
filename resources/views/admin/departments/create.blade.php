@extends('layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 328.4px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>@lang('panel.departments.departments')</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('panel.departments.home')</a></li>
                    <li class="breadcrumb-item active">@lang('panel.departments.departments')</li>
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
                    <h3 class="card-title">@lang('panel.departments.add_new_department')</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('departments.store') }}" method="post" >
                    @csrf
                    <div class="card-body">  
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label">@lang('panel.departments.name')</label>
                            <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label>@lang('panel.subjects.select_Head')</label>
                            <select name="head_id" class="form-control select2" style="width: 100%;">
                                @foreach($heads as $head)    
                                    <option value="{{$head->id}}">{{$head->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">@lang('panel.departments.submit')</button>
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