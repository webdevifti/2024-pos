@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Product</h1>
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">Edit Product</li>
            </ol>
            {{-- <a class="btn btn-success mb-2" href="{{ route('users.create') }}"></a> --}}
            <!-- Button trigger modal -->
            <a href="{{ route('products.index') }}" class="btn btn-primary mb-2">
                Products
            </a>



            <div class="card mb-2">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Product
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-2">
                            <input type="text" placeholder="Product Name" name="product_name" class="form-control"
                                required value="{{ $product->product_name }}">
                        </div>
                        <div class="mb-2">
                            <textarea name="product_description" cols="30" rows="5" placeholder="Product Decsription"
                                class="form-control">{{ $product->product_description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-2">
                                    <input type="text" name="quantity" placeholder="Quantity" class="form-control" value="{{ $product->quantity }}" required >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <input type="text" name="price" placeholder="Price" class="form-control" value="{{ $product->price }}" required>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <select name="unit" class="form-control" required>
                                        <option value="">select unit</option>
                                        <option {{ ($product->unit == 'kg' ? 'selected': '' ) }}  value="kg">kg</option>
                                        <option {{ ($product->unit == 'pcs' ? 'selected': '' ) }} value="pcs">pcs</option>
                                        <option {{ ($product->unit == 'inches' ? 'selected': '' ) }} value="inches">inches</option>
                                        <option {{ ($product->unit == 'litre' ? 'selected': '' ) }} value="litre">litre</option>
                                        <option {{ ($product->unit == 'package' ? 'selected': '' ) }} value="package">package/boundle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-2">
                                    <input type="text" name="brand" placeholder="Brand Name" class="form-control" value="{{ $product->brand }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <select name="status" class="form-control" >
                                        <option {{ ($product->status == 1 ? 'selected': '' ) }} value="1">Active</option>
                                        <option {{ ($product->status == 0 ? 'selected': '' ) }}  value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
                           
                        </div>


                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('products.index') }}" type="button" class="btn btn-secondary">Cancel</a>
                    </form>
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
    @error('product_description')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
    @error('quantity')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
    @error('price')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
    @error('brand')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
    @error('unit')
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ $message }}");
        </script>
    @enderror
@endsection
