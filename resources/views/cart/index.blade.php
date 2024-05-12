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
                <div class="col-md-8">
                    <div class="row">
                        <div class="col mb-2">
                            <input type="text" class="form-control" placeholder="Scan Barcode...">
                        </div>
                        <div class="col mb-2">
                            <input type="text" class="form-control" placeholder="Search Product...">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive user-cart">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th class="text-right">Price</th>
                                            <th>Total Price</th>
                                            <th><a href="#" class="btn-sm btn-success add_more"><i
                                                        class="fa fa-plus"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="addMoreProduct">
                                        <tr>
                                            <td>1</td>
                                            <td><select name="product_id" id="product_id" class="form-control product_id">
                                                    @foreach ($products as $product)
                                                        <option data-price="{{ $product->price }}"
                                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td><input type="number" name="quantity"
                                                    class="form-control form-control-sm qty count" value="1"
                                                    id="quantity"></td>
                                            <td><input type="text" class="form-control form-control-sm discount"
                                                    name="discount" id="discount"></td>
                                            <td class="text-right price" name="price" id="price">
                                            </td>
                                            <td class="text-right total_amount" name="total_amount" id="total_amount">
                                            </td>
                                            <td><a class="btn-sm btn-danger delete" href=""><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-6">Total:</div>
                        <div class="col-6 text-right total"></div>

                        <div class="col-6">
                            <button type="submit" class="btn btn-danger btn-block">Cancel</button>
                        </div>
                        <div class="col-6 ">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="mb-2">
                            <select name="" id="" class="form-control">
                                <option value="">Customer</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td>Payment Method <br>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="cash" checked="checked">
                                            <label for="payment_method"><i
                                                    class="fa fa-money-bill text-success mr-2"></i>Cash</label>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="bank_transfer" checked="checked">
                                            <label for="payment_method"><i
                                                    class="fa fa-university text-danger mr-2"></i>Bank Transfer</label>
                                        </span>
                                        <span class="radio-item">
                                            <input type="radio" name="payment_method" id="payment_method" class="true"
                                                value="credit Card" checked="checked">
                                            <label for="payment_method"><i
                                                    class="fa fa-credit-card text-info mr-2"></i>Credit Card</label>
                                        </span>
                                    </td>
                                </tr>

                            </table>
                            <div>
                                Payment <input type="text" name="paid_amount" class="form-control">
                            </div>
                            <div>
                                Returning Change <input type="text" readonly name="balance" id="balance"
                                    class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
            $('.add_more').on('click', function() {
                var product = $('.product_id').html();
                var numberfrow = $('.addMoreProduct tr').length + 1;
                var tr = '<tr><td class="no">' + numberfrow + '</td>' +
                    '<td><select class="form-control product_id" name="product_id">' + product + '</select></td>' +
                    '<td><input type="number" name="quantity" class="form-control form-control-sm qty count" value="1"></td>' +
                    '<td><input type="text" class="form-control form-control-sm discount" name="discount" id="discount"></td>' +
                    '<td class="text-right price" name="price"></td>' +
                    '<td class="text-right total_amount" name="total_amount"></td>' +
                    '<td><a class="btn-sm btn-danger delete" href="#"><i class="fa fa-times"></i></a></td></tr>';
                $('.addMoreProduct').append(tr);
            });

            // Delete row
            $('.addMoreProduct').on('click', '.delete', function() {
                $(this).closest('tr').remove();
                calculateTotal();
            });

            // Calculate total
            function calculateTotal() {
                var total = 0;
                $('.total_amount').each(function() {
                    var amount = parseFloat($(this).text());
                    total += amount;
                });
                $('.total').text(total.toFixed(2) + ' Ks');
            }

            // Update total when quantity changes
            $('.addMoreProduct').on('change', '.product_id', function() {
                var tr = $(this).closest('tr');
                var price = parseFloat(tr.find('.product_id option:selected').data('price'));
                var quantity = tr.find('.qty').val() - 0;
                var discount = tr.find('.discount').val() - 0;
                var total = (price * quantity) - ((discount * quantity * price) / 100);
                tr.find('.price').text(price.toFixed(2) + 'Ks');
                tr.find('.total_amount').text(total.toFixed(2) + 'Ks');
                calculateTotal();
            });

            // Trigger change event to calculate total on page load
            $('.product_id').change();
        </script>
    @endsection
