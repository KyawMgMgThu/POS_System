@extends('layouts.admin')
@section('navtitle', 'Update Settings')
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">

            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">{{ __('Update Settings') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.store') }}" data-toggle="validator" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="app_name">App name</label>
                                            <input type="text"
                                                class="form-control @error('app_name') is-invalid @enderror" id="app_name"
                                                placeholder="Enter App Name" name="app_name"
                                                data-errors="Please Enter App Name"
                                                value="{{ old('app_name', config('settings.app_name')) }}">
                                            @error('app_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="app_description">App Description</label>
                                            <textarea type="text" class="form-control @error('app_description') is-invalid @enderror" id="app_description"
                                                placeholder="Enter App Description" name="app_description" data-errors="Please Enter App Description">{{ old('app_description', Config('settings.app_description')) }}</textarea>
                                            @error('app_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="currency_symbol">Currency</label>
                                            <input type="text"
                                                class="form-control @error('currency_symbol') is-invalid @enderror"
                                                id="currency_symbol" placeholder=" Currency Symbol" name="currency_symbol"
                                                data-errors="Please Enter Currency"
                                                value="{{ old('currency_symbol', config('settings.currency_symbol')) }}">
                                            @error('currency_symbol')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="warning_quantity">Warning Quantity</label>
                                            <input type="text"
                                                class="form-control @error('warning_quantity') is-invalid @enderror"
                                                id="warning_quantity" placeholder="Warning Quantity" name="warning_quantity"
                                                data-errors="Please Enter Warning Quantity"
                                                value="{{ old('warning_quantity', config('settings.warning_quantity')) }}">
                                            @error('warning_quantity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Change Setting</button>
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
