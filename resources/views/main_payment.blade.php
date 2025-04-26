@extends('layouts.header')

@section('content')

    <style>
        <style>.filter-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-select {
            margin-right: 10px;
        }

        .filter-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
        }

        .dataTable-input {
            display: none;
        }

        .filter-select {
            margin-right: 10px;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 5px;
        }
    </style>

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
                        <h3>Payment Management</h3>
                        <p class="text-subtitle text-muted">Input Payment Imformation.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ 'dashboard' }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payment Management</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

        <section class="section">
            <form role="form" method="POST" action="{{ route('add_paymentdetails') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="">
                        <h4>Enter Payment Details</h4>
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
                                        <label>Member Ad_no</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <div class="col-md-8 form-group">
                                            <select id="admissionIdInput" name="admition_no"
                                                placeholder="Select Admission Number..." style="width: 100%; height: 31px">
                                                <option value="" selected></option>
                                                @foreach ($customers as $key => $customerData)
                                                    <option value="{{ $customerData->admission_no }}"
                                                        data-customer-name="{{ $customerData->name }}">
                                                        {{ $customerData->admission_no }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Payment Period</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <select required name="period" class="form-select" style="flex: 1; width:100%">
                                            <option value="1">1 Month</option>
                                            <option value="2">3 Months</option>
                                            <option value="3">1 Year</option>
                                        </select>
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
                                        <label>Member Name</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="memberNameInput" name="name" class="form-control"
                                            placeholder="Member name will appear here..." readonly>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Payment Ammount</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="number" class="form-control" name="ammount" placeholder="Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <input value="Add Payment" type="Submit" class="btn btn-primary"
                        class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                </div>
            </form>
        </section>
    </div>

    <div id="main">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Payment Details
                </div>

                <div class="card-body">
                    <table id="table1" class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Member Admition</th>
                                <th scope="col">Member Name</th>
                                <th scope="col" class="text-center">Period</th>
                                <th scope="col" class="text-center">Ammount</th>
                                <th scope="col" class="text-center">Payment Date</th>
                                <th scope="col" class="text-center">Edit</th>
                                <th scope="col" class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment as $key => $item)
                                <tr data-category="{{ $item->book_category_id }}" data-name="{{ $item->title }}">
                                    <th>{{ ++$key }}</th>
                                    <td>{{ $item->admition_no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        @if ($item->period == 1)
                                            <span class="badge bg-primary">1 Month</span>
                                        @elseif($item->period == 2)
                                            <span class="badge bg-primary">3 Months</span>
                                        @elseif($item->period == 3)
                                            <span class="badge bg-primary">1 Year</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->ammount }}</td>
                                    <td class="text-center">{{ $item->payment_date }}</td>
                                    <td class="text-center" style="text-align: center !important">
                                        <a href="#" id="editButton"><span class="badge bg-primary"><i
                                                    class="bi bi-pencil"></i></span></a>
                                    </td>
                                    <td class="text-center" style="text-align: center">
                                        <a href="/deleteBook/{{ $item->id }}"
                                            onclick="return confirm('Are you sure to want to delete it?')">
                                            <span class="badge bg-danger"><i class="bi bi-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @foreach ($payment as $payment)
            <div id="myModal" class="modal">
                <div class="modal-content" style="max-width: fit-content">
                    <h4 class="card-title">Payment Update Form</h4>
                    <span class="close" style="text-align: right; color:black">&times;</span>
                    <form id="editForm" class="form form-horizontal" role="form" method="POST"
                        action="{{ url('update_book/' . $payment->id) }}">

                        <div class="form-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Book Name</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" value="{{ $payment->name }}" class="form-control"
                                        name="name" readonly placeholder="payment Name">
                                </div>
                                <div class="col-md-4">
                                    <label>payment Author</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" value="{{ $payment->admition_no }}" class="form-control"
                                        name="admition_no" placeholder=" " readonly>

                                </div>
                                <div class="col-md-4">
                                    <label>Price</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="ammount" value="" class="form-control" name="ammount"
                                        placeholder="ammount">
                                </div>
                                <div class="col-md-4">
                                    <label>Period</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <select required name="period" class="form-select" style="flex: 1;">
                                        <option value="1">1 Month</option>
                                        <option value="2">3 Months</option>
                                        <option value="3">1 Year</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            .close {
                color: #000000;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: rgb(255, 0, 0);
                text-decoration: none;
                cursor: pointer;
            }
        </style>

    </div>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#admissionIdInput').change(function() {
                var selectedId = $(this).val();
                var selectedName = $(this).find('option:selected')
                    .text();
                var customerName = $('#admissionIdInput option:selected').data('customer-name');
                $('#memberNameInput').val(customerName);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // When the edit button is clicked
            $("#editButton").click(function() {
                // Show the modal
                $("#myModal").css("display", "block");

                // You may need to fetch the form data using an AJAX call here

                // For simplicity, I'm just assigning a sample form action
                $("#editForm");

                // Prevent default link behavior
                return false;
            });

            // When the user clicks on the close button, close the modal
            $(".close").click(function() {
                $("#myModal").css("display", "none");
            });

            // When the user clicks anywhere outside of the modal, close it
            $(window).click(function(event) {
                if (event.target == $("#myModal")[0]) {
                    $("#myModal").css("display", "none");
                }
            });
        });
    </script>
    <script>
        new TomSelect("#nameInput", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <script>
        new TomSelect("#nicInput", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <script>
        new TomSelect("#select-book", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>

    <script>
        document.getElementById('SelectCategory').addEventListener('change', function() {
            var selectedValue = this.value;
            var nameInput = document.getElementById('nameInputShow');
            var nicInput = document.getElementById('nicInputShow');
            var firstInputs = document.getElementById('firstInputShow');

            firstInputs.style.display = 'none';

            if (selectedValue === '1') {
                nameInput.style.display = 'block';
                nicInput.style.display = 'none';
            } else if (selectedValue === '2') {
                nameInput.style.display = 'none';
                nicInput.style.display = 'block';
            } else {
                nameInput.style.display = 'none';
                nicInput.style.display = 'none';
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault();

                var formData = {
                    _token: $('input[name="_token"]').val(),
                    book_id: $('#select-book').val() !== "" ? $('#select-book').val() : null,
                    user_id: $('#nameInput').val().trim() !== "" ? $('#nameInput').val().trim() : null,
                    nic_id: $('#nicInput').val().trim() !== "" ? $('#nicInput').val().trim() : null
                };

                console.log(formData);

            });
        });
    </script>

@endsection
