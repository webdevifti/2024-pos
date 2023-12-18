@extends('layouts.app')
@section('title', 'Site Setting')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Setting</li>
        </ol>

        <div class="card mb-2">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Setting
            </div>
            <div class="card-body">
                <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <input type="text" name="name" placeholder="Site or Company Name" class="form-control" value="{{ get_option('site_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                @if(get_option('site_logo'))
                                <img src="{{ asset('uploads/logo/'.get_option('site_logo')) }}" alt="logo">
                                @endif
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <textarea name="description" cols="30" rows="3" placeholder="Decsription"
                            class="form-control">{{ get_option('site_description') }}</textarea>
                    </div>
                  
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <input type="text" name="currency_name" placeholder="Currency Name" class="form-control" value="{{ get_option('currency_name') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <input type="text" name="currency_icon" placeholder="Currency Icon" class="form-control" value="{{ get_option('currency_icon') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ get_option('phone') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <input type="text" name="email" placeholder="Email" class="form-control" value="{{ get_option('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <input type="text" name="address" placeholder="Address" class="form-control" value="{{ get_option('address') }}">
                            </div>
                        </div>
                       
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer_script')
    @if (Session::has('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        </script>
    @endif
    @error('product_name')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
@endsection
