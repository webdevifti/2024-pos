@extends('layouts.app')
@section('title', 'User or Employee Management')
@section('content')
<main>
    <div class="container-fluid px-4">
   
        <h1 class="mt-4">Employees</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Employee</li>
        </ol>    
        {{-- <a class="btn btn-success mb-4" href="{{ route('users.create') }}"></a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add New Employee
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add a new Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" placeholder="Name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <input type="text" placeholder="Phone Number" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <input type="email" placeholder="Email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <select name="role" class="form-control" required>
                                <option value="owner">Owner</option>
                                <option value="manager">Manager</option>
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
                 Employee List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($all_users as $item)
                            
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td><span class="badge bg-success">1234567890</span></td>
                            <td>
                                @if($item->role == 'owner')
                                    <span class="badge bg-info">Owner</span>
                                 @elseif($item->role == 'manager')
                                    <span class="badge bg-primary">Manager</span>
                                 @endif
                                 
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editation_{{ $item->id }}"><i class="fa fa-pencil"></i></button>
                                <div class="modal fade" id="editation_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editationLabel">Update Employee Info</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Name" name="name" class="form-control" required value="{{ $item->name }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="text" placeholder="Phone Number" name="phone" class="form-control" required value="{{ $item->phone }}">
                                                    </div>
                                                    <div class="mb-4">
                                                        <input type="email" placeholder="Email" name="email" value="{{ $item->email }}" class="form-control" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <select name="role" class="form-control" required>
                                                            <option {{ ($item->role == 'owner' ? 'selected': '' ) }} value="owner">Owner</option>
                                                            <option {{ ($item->role == 'manager' ? 'selected': '' ) }}  value="manager">Manager</option>
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
                                            <h4>Are Your Sure!? Your action can not be undone</h4>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger  btn-sm" href="{{ route('users.destroy',$item->id) }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-form').submit();">
                                            {{ __('Delete') }}
                                        </a>

                                        <form id="delete-form" action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-none">
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
@error('phone')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
    toastr.error("{{ $message }}");
</script>
@enderror
@error('email')
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