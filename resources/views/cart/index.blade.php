@extends('layouts.admin')
@section('navtitle', 'Cart Page')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col mb-2">
                            <input type="text" class="form-control" placeholder="Scan Barcode...">
                        </div>
                        <div class="col mb-2">
                            <select name="" id="" class="form-control">
                                <option value="">Customer</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive user-cart">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th class="text-right">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Apple</td>
                                            <td><input type="text" class="form-control form-control-sm qty count"
                                                    value="1"><button type="submit"
                                                    class="btn btn-sm bg-danger ml-1"><i
                                                        class="ri-delete-bin-line"></i></button></td>
                                            <td class="text-right">4000Ks</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">Total:</div>
                        <div class="col-6 text-right">4000Ks</div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger btn-block">Cancel</button>
                        </div>
                        <div class="col-6 ">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>





                <div class="col-md-6">
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Search Product...">
                    </div>
                    <div class="order-product">
                        <div class="item mr-2"><img src="http://localhost:8000/storage/products/1714982008meats.jpg"
                                alt="">
                            <h5>Chicken</h5>
                        </div>
                        <div class="item mr-2"><img src="http://localhost:8000/storage/products/1714982008meats.jpg"
                                alt="">
                            <h5>Chicken</h5>
                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>
@endsection
