@extends('layouts.admin')
@section('navtitle', 'Product List')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">{{ __('Product List') }}</h4>
                        </div>
                        <a href="{{ route('products.create') }}" class="btn btn-primary add-list"><i
                                class="las la-plus mr-3"></i>Add
                            Product</a>
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
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            {{ $product->id }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ Storage::url($product->image) }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="">
                                                <div>
                                                    {{ $product->name }}
                                                    <p class="mb-0"><small>{{ $product->description }}</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->barcode }}</td>
                                        <td>Beauty</td>
                                        <td>{{ $product->price }}</td>

                                        <td
                                            class="badge mr-2 mt-4 rounded-pill badge-{{ $product->status ? 'success' : 'danger' }}">
                                            {{ $product->status ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit"
                                                    href="{{ route('products.edit', $product['id']) }}"><button
                                                        type="submit" class="badge bg-success mr-2"><i
                                                            class="ri-pencil-line mr-0"></i></button></a>
                                                <a data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Delete"
                                                    href="{{ route('products.destroy', $product['id']) }}"><button
                                                        type="submit" class="badge bg-danger mr-2"><i
                                                            class="ri-delete-bin-line mr-0"></i></button></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <div class="media align-items-top justify-content-between">
                                <h3 class="mb-3">Product</h3>
                                <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                            </div>
                            <div class="content edit-notes">
                                <div class="card card-transparent card-block card-stretch event-note mb-0">
                                    <div class="card-body px-0 bukmark">
                                        <div
                                            class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                            <div class="quill-tool">
                                            </div>
                                        </div>
                                        <div id="quill-toolbar1">
                                            <p>Virtual Digital Marketing Course every week on Monday, Wednesday and
                                                Saturday.Virtual Digital Marketing Course every week on Monday</p>
                                        </div>
                                    </div>
                                    <div class="card-footer border-0">
                                        <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                            <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                            <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
