@extends('layouts.app')
@section('title', 'Company Management')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Companies</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Company</li>
        </ol>    
        {{-- <a class="btn btn-success mb-4" href="{{ route('users.create') }}"></a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add New Company
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add new company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" placeholder="Name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Phone Number" name="phone_number" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Address" name="address" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="Type" name="type" class="form-control">
                        </div>
                        <div class="mb-2">
                            <input type="text" placeholder="TaxID" name="taxID" class="form-control">
                        </div>
                        <div class="mb-2">
                            <textarea name="notes" id="" cols="30" rows="4" placeholder="Notes" class="form-control"></textarea>
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
                 Company List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>TaxID</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($companies as $item)
                            
                        <tr>
                            <td>{{ $item->company_name }}</td>
                            <td>{{ $item->company_phone }}</td>
                            <td>{{ $item->company_email }}</td>
                            <td>{{ $item->company_address }}</td>
                            <td>{{ $item->business_type }}</td>
                            <td>{{ $item->taxID }}</td>
                            <td>{{ date('m-d-Y', strtotime($item->registration_date)) }}</td>
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
                                                <h5 class="modal-title" id="editationLabel">Update Company Info</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('companies.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Name" name="name" class="form-control" required value="{{ $item->company_name }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Phone" name="phone_number" value="{{ $item->company_phone }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="Email" name="email" class="form-control"  value="{{ $item->company_email }}" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="Address" name="address" class="form-control" required  value="{{ $item->company_address }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="Type" value="{{ $item->business_type }}" name="type" class="form-control">
                                                    </div>
                                                    <div class="mb-2">
                                                        <input type="text" placeholder="TaxID" name="taxID" class="form-control" value="{{ $item->taxID }}">
                                                    </div>
                                                    <div class="mb-2">
                                                        <textarea name="notes" id="" cols="30" rows="4" placeholder="Notes" class="form-control"> {{ $item->notes }}</textarea>
                                                    </div>
                                                    <div class="mb-4">
                                                        <select name="status" class="form-control">
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
                                            <a class="btn btn-danger btn-sm" href="{{ route('companies.destroy',$item->id) }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-form').submit();">
                                            {{ __('Delete') }}
                                        </a>

                                        <form id="delete-form" action="{{ route('companies.destroy', $item->id) }}" method="POST" class="d-none">
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