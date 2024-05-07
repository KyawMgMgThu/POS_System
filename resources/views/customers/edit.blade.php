@extends('layouts.admin')
@section('navtitle', 'Edit Customer')
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">

            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">{{ __('Edit Customer') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customers.update', ['customer' => $customer['id']]) }}"
                                data-toggle="validator" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $customer['id'] }}">
                                            <label for="first_name">First Name</label>
                                            <input type="text"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                id="name" placeholder="Enter First Name" name="first_name"
                                                data-errors="Please Enter Name"
                                                value="{{ old('first_name', $customer['first_name']) }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text"
                                                class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                                placeholder="Enter Last Name" name="last_name"
                                                data-errors="Please Enter Name"
                                                value="{{ old('last_name', $customer['last_name']) }}">
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control @error('email')
                                            is-invalid

                                        @enderror"
                                                placeholder="Enter Email" name="email" data-errors="Please Enter email"
                                                value="{{ old('email', $customer['email']) }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone No:</label>
                                            <input name="phone"
                                                class="form-control @error('phone')
                                            is-invalid

                                        @enderror form-control"
                                                data-style="py-0" value="{{ old('phone', $customer['phone']) }}"
                                                placeholder="Enter phone number">
                                            </input>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text"
                                                class="form-control @error('address')
                                        is-invalid

                                        @enderror"
                                                value="{{ old('address', $customer['address']) }}" name="address"
                                                placeholder="Enter address" data-errors="Please Enter Address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
