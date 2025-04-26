@extends('layouts.header')

@section('content')

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Member Management</h3>
                        <p class="text-subtitle text-muted">Input Member Imformation.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Member Management</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <section class="section">
                <form role="form" method="POST" action="{{ url('create_users') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="">
                            <h4>Enter User Details</h4>
                        </div>
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <strong>{{ \Session::get('success') }}</strong>
                            </div>
                        @endif
                        @if (\Session::has('delete'))
                            <div class="alert alert-danger">
                                <strong>{{ \Session::get('delete') }}</strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-12 col-md-6">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Member Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Member Email">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Member Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Member Name">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Address</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" class="form-control" name="address" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Age</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control" name="age" placeholder="Age">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Gender</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select required name="gender" class="form-select" style="flex: 1;">
                                                <option value="0">Male</option>
                                                <option value="1">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Admition</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select required name="admission_fee" class="form-select" style="flex: 1;">
                                                <option value="0">Full</option>
                                                <option value="1">Half</option>
                                                <option value="2">Not in First Day</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <br>
                        <input value="Add User" type="Submit" class="btn btn-primary"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                    </div>
                </form>
            </section>
        </div>
    </div>
    <div id="main">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Member Details
                </div>
                <div class="card-body">
                    <table id="table1" class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Admition No</th>
                                <th>Member Name</th>
                                <th>Member E-mail</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Admition</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $item)
                                <tr>
                                    <td class="id">{{ ++$key }}</td>
                                    <td class="nic" style="color: red">{{ $item->admission_no }}</td>
                                    <td class="name">{{ $item->name }}</td>
                                    <td class="email">{{ $item->email }}</td>
                                    <td class="nic">{{ $item->age }}</td>
                                    <td class="phone">{{ $item->phone }}</td>
                                    <td class="address">{{ $item->address }}</td>
                                    <td class="gender">
                                        @if ($item->gender == 0)
                                            <span class="">Male</span>
                                        @else
                                            <span class="">Female</span>
                                        @endif
                                    </td>
                                    <td class="admission">
                                        @if ($item->admission_fee == 1)
                                            <span class="">Full</span>
                                        @elseif ($item->admission_fee == 2)
                                            <span class="">Half</span>
                                        @else
                                            <span class="">Not Paid</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($item->role == 1)
                                            <span class="badge bg-danger">Admin</span>
                                        @else
                                            <span class="badge bg-success">Member</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="/deleteUser/{{ $item->id }}"
                                            onclick="return confirm('Are you sure to want to delete it?')"><span
                                                class="badge bg-danger"><i class="bi bi-trash"></i></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection
