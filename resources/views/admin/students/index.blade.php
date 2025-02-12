@extends('admin.master')

@section('title', @trans('admin.label_all_students'))

@section('content')
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Tables <small>Some examples to get you started</small></h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5   form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." >
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row" style="display: block;">
        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Table students</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings"> 
                      <th class="column-title">Id </th>
                      <th class="column-title">Code</th>
                      <th class="column-title">Name</th>
                      <th class="column-title">Faculty</th>
                      <th class="column-title">Class</th>
                      <th class="column-title">#</th>
                      <th class="column-title">#</th>
                    </tr>
                  </thead>

                  <tbody>
                  @foreach ($studentList as $student)
                    <tr class="even pointer">
                      <td>{{$student->id}}</td>
                      <td>{{$student->code}}</td>
                      <td>{{$student->name}}</td>
                      <td>{{$student->faculty->name}}</td>
                      <td>{{$student->klass->name}}</td>
                      <td>
                        <form method="get"
                          action="{{ route('andmin.students.qrCode', $student->id) }}">
                          @method('qrCode')
                          @csrf
                          <button type="submit" class="  btn-outline-danger"><i class="fa fa-pencil-square-o"  aria-hidden="true"></i></button>
                        </form>
                      </td>
                      <td>
                        <form method="get"
                            action="{{ route('admin.students.edit', $student->id) }}"> 
                            <button type="submit" class="  btn-outline-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </form>
                      </td>
                      <td>
                        <form method="post"
                          action="{{ route('admin.students.destroy', $student->id) }}">
                          @method('delete')
                          @csrf
                          <button type="submit" class="  btn-outline-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                        </form>
                      </td>
                    @endforeach
                  </tbody>
                </table>
              </div>


            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 ">
        <div class="x_panel"  >
            <div class="x_title">
                <h2>Form Create Students </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="#">Settings 1</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{route ('admin.students.store') }}">
                @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="code" >Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="code" required="required" class="form-control " name="code" value="{{ old('code') }}">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" id="name" required="required" class="form-control "  name="name" value="{{ old('name') }}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Faculty</label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" name="faculty_id">
                                @foreach($facultyList as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Klass</label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" name="klass_id">
                                @foreach($klassList as $klass)
                                <option value="{{ $klass->id }}">{{ $klass->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button class="btn btn-primary" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
     
  @endsection
