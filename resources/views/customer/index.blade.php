@extends('layouts.app')
@section('title', 'Customer Management')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customers</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>    
        {{-- <a class="btn btn-success mb-4" href="{{ route('users.create') }}"></a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add New Customer
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" placeholder="Name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Phone Number" name="phone_number" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Email" name="email" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Address" name="address" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="notes" id="" cols="30" rows="4" placeholder="Notes" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <select name="gender" class="form-control">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                  
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
            </div>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Customer List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Points</th>
                            <th>Due</th>
                            <th>Total Spent</th>
                            <th>Join Date</th>
                            <th>Last Purchase Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($all_customer as $item)
                            
                        <tr>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->points }}</td>
                            <td>{{ $item->due }}</td>
                            <td>{{ $item->total_spent }}</td>
                            <td>{{ date('m-d-Y', strtotime($item->join_date)) }}</td>
                            <td>{{ date('m-d-Y', strtotime($item->last_purchase_date)) }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                 @endif
                                 
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editation_{{ $item->id }}"><i class="fa fa-pencil"></i></button>
                                <div class="modal fade" id="editation_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editationLabel">Update Customer Info</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('customers.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Name" name="name" class="form-control" required value="{{ $item->fullname }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Phone" name="phone_number" value="{{ $item->phone_number }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="Email" name="email" class="form-control"  value="{{ $item->email }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="Address" name="address" class="form-control" required  value="{{ $item->address }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <textarea name="notes" id="" cols="30" rows="4" placeholder="Notes" class="form-control"> {{ $item->notes }}</textarea>
                                                    </div>
                                                    <div class="mb-2">
                                                        <select name="gender" class="form-control">
                                                            <option {{ ($item->gender == 'male' ? 'selected': '' ) }} value="male">Male</option>
                                                            <option {{ ($item->gender == 'female' ? 'selected': '' ) }} value="female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <select name="status" class="form-control" required>
                                                            <option {{ ($item->status == 1 ? 'selected': '' ) }} value="1">Active</option>
                                                            <option {{ ($item->status == 0 ? 'selected': '' ) }}  value="0">Deactive</option>
                                                        </select>
                                                    </div>
                                                   
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </form>
                                                </div>
                                                  
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>

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
                                            <a class="btn btn-danger btn-sm" href="{{ route('customers.destroy',$item->id) }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-form').submit();">
                                            {{ __('Delete') }}
                                        </a>

                                        <form id="delete-form" action="{{ route('customers.destroy', $item->id) }}" method="POST" class="d-none">
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
@error('name')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('phone_number')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@endsection