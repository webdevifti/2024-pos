@extends('layouts.app')
@section('title','Orders Management')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>    
        {{-- <a class="btn btn-success mb-4" href="{{ route('users.create') }}"></a> --}}
        <!-- Button trigger modal -->
        <a href="{{ route('pos.order') }}" class="btn btn-primary mb-4" >
            Add New Order
        </a>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Order List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Payment Method</th>
                            <th>Customer</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        @foreach ($orders as $item)
                            
                        <tr>
                            <td>
                                <a href="{{ route('pos.invoice', $item->id) }}" target="_blank">
                                    {{ $item->invoice_number }}
                                </a>
                            </td>
                            <td>{{ $item->total_amount }}</td>
                            <td>{{ $item->paid_amount }}</td>
                            <td>{{ $item->due }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>{{ $item->customer?->fullname }}</td>
                           
                            <td>
                                @if($item->payment_status == 'Due')
                                    <span class="badge bg-warning">{{ $item->payment_status }}</span>
                                    @elseif($item->payment_status == 'Paid')
                                    <span class="badge bg-success">{{ $item->payment_status }}</span>
                                @endif
                                   
                            </td>
                            <td>
                                <a target="_blank" href="{{ route('pos.invoice', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmation_{{ $item->id }}" ><i class="fa fa-trash"></i></button>
                                 <!-- Modal -->
                                <div class="modal fade" id="deleteConfirmation_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationLabel">Delete Confirmation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Are Your Sure!? Your Action can not be undone</h4>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger btn-sm" href="{{ route('products.destroy',$item->id) }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-form').submit();">
                                            {{ __('Dleete') }}
                                        </a>

                                        <form id="delete-form" action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                    
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('footer_script')
@if(Session::has('success'))
    <script>
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if(Session::has('error'))
    <script>
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    </script>
@endif
@endsection