@extends('layouts.admin')
@section('navtitle', 'Customer List')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">{{ __('Customer List') }}</h4>
                        </div>
                        <a href="{{ route('customers.create') }}" class="btn btn-primary add-list"><i
                                class="las la-plus mr-3"></i>Add
                            Customer</a>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Address</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>
                                            {{ $customer->id }}
                                        </td>
                                        <td>{{ $customer->first_name }}</td>
                                        <td>{{ $customer->last_name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->created_at }}</td>
                                        <td>{{ $customer->updated_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit"
                                                    href="{{ route('customers.edit', $customer['id']) }}"><button
                                                        type="submit" class="badge bg-success mr-2"><i
                                                            class="ri-pencil-line mr-0"></i></button></a>
                                                <a data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Delete"
                                                    href="{{ route('customers#delete', $customer['id']) }}"><button
                                                        type="submit" class="badge bg-danger mr-2 btn-delete"><i
                                                            class="ri-delete-bin-line mr-0"></i></button></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="module">
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                var $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: {{ __('customer.sure') }},
                    text: {{ __('customer.really_delete') }},
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: {{ __('customer.yes_delete') }},
                    cancelButtonText: {{ __('customer.No') }},
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        }, function(res) {
                            $this.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
