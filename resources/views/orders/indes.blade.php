@extends('layouts.admin')
@section('navtitle', 'Order List')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">{{ __('Order List') }}</h4>
                        </div>
                        <a href="{{ route('cart.index') }}" class="btn btn-primary add-list"><svg class="svg-icon mr-2"
                                id="p-dash2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>Open POS</a>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>
                                        ID
                                    </th>
                                    <th>Customer Name</th>
                                    <th>Total</th>
                                    <th>Recieved Amount</th>
                                    <th>Status</th>
                                    <th>To pay</th>
                                    <th>Created at</th>

                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                        <td>{{ $order->getCustomerName() }}</td>
                                        <td>{{ $order->formattedTotal() }}{{ config('settings.currency_symbol') }}</td>
                                        <td>{{ $order->formattedReceivedAmount() }}{{ config('settings.currency_symbol') }}
                                        </td>
                                        <td>{{ $order->phone }}</td>
                                        <td><span
                                                class="badge badge-{{ $order->status ? 'success' : 'danger' }}">{{ $order->status }}</span>
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>

    </div>
@endsection
