@extends('layouts.app')
@section('title', 'Point of sale')

@section('content')
    <main>
        <div class="container-fluid px-4 mb-5">
            <h1 class="mt-4">Pos</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pos</li>
            </ol>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-2 mt-2">
                        <div class="d-flex align-items-end justify-content-start gap-3">
                            <div>
                                <label for="">Customer</label>
                                <select name="customer_id" class="form-control" required>
                                    <option value="">--select customer--</option>
                                    @foreach ($get_active_customer as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#newcustomerModal">New Customer</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Make sale
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Discount %</th>
                                            <th>Total</th>
                                            <th><button type="button" onclick="addRow()" class="btn btn-success btn-sm"><i
                                                        class="fa-solid fa-plus"></i></button></th>
                                        </thead>
                                        <tbody class="addMoreProduct">
                                            <tr class="product_row">
                                                <td>1</td>
                                                <td id="product_loop" width="40%">
                                                    <input type="hidden" name="product_name" class="product_name_class">
                                                    <select name="product_id[]" id="product_id"
                                                        class="form-control product_id productSelecta product_names"
                                                        required>
                                                        <option value="">--select product--</option>
                                                        @foreach ($get_active_product as $item)
                                                            <option 
                                                                data-productname="{{ $item->product_name }}"
                                                                data-price="{{ $item->price }}"
                                                                value="{{ $item->id }}">{{ $item->product_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control quantity" id="quantity"
                                                        name="quantity[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control price" id="price"
                                                        name="price[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control discount" id="discount"
                                                        name="discount[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control sub_total" id="subtotal"
                                                        name="sub_total[]">
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                Paying Information
                            </div>
                            <div class="card-body">
                                <strong>
                                    Total Amount
                                  
                                    <h4 class=" text-success">{{ get_option('currency_icon') }}<span class="total_amount"></span></h4>
                                </strong>
                                <input type="hidden" value="" name="total_amount" id="totalcost" required>
                                <h6 class="text-info">Choose Payment Method</h6>
                                <label for="cash" class="form-check-label">
                                    <input type="radio" class="form-check-input" id="cash" name="payment_method"
                                        value="cash" checked> Cash</label><br>
                                <label for="bank" class="form-check-label">
                                    <input type="radio" class="form-check-input" id="bank" name="payment_method"
                                        value="bank"> Bank</label><br>
                                    <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="">Tax %</label>
                                                <input type="text" class="form-control tax_rate" name="tax_rate">
                                               <input type="hidden" name="tax_amount" class="tax_amount">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">Discount %</label>
                                                <input type="text" class="form-control discount_rate" name="discount_rate">
                                                <input type="hidden" name="discount_amount" class="discount_amount">
                                            </div>
                                        </div>
                                    <hr>
                                    <label for="">Paid</label>
                                    <input type="text" class="form-control payable" name="paid_amount" required>
                                    <label for="">Due</label>
                                    <input type="text" class="form-control due" name="due" readonly>
                                <label for="">Change</label>
                                <input type="text" class="form-control return" name="return" readonly>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Done</button>
                </div>
            </form>

            <div class="modal fade" id="newcustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationLabel">New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form  action="{{ route('customers.store') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
                </div>
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

    <script>
        // $(document).ready(function() {
        //     $('.product_names').each(function() {
        //         $(this).select2();
        //     });
        // });
    </script>
    <script>
        function addRow() {
            var product = $('#product_loop').html();
            var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
            var tr = ' <tr class="product_row"> <td>' + numberofrow + '</td><td>' + product +
                '</td><td> <input type="number" class="form-control quantity" name="quantity[]"></td><td><input type="number" class="form-control price" name="price[]"></td><td><input type="text" class="form-control discount" name="discount[]"></td><td> <input type="text" class="form-control sub_total" name="sub_total[]"></td><td><button type="button" class="btn btn-danger btn-sm delete_row"><i class="fa-solid fa-minus"></i></button></td></tr>';

            $('.addMoreProduct').append(tr);
        }

        $('.addMoreProduct').delegate('.delete_row', 'click', function() {


            $(this).parent().parent().remove();
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var qty = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var sub_total = (qty * price) - ((qty * price * discount) / 100);
            tr.find('.sub_total').val(sub_total);
            totalAmount() - sub_total;
        });

        function totalAmount() {
            var total = 0;
            $('.sub_total').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total_amount').html(total);
            $('#totalcost').val(total);
        }

        $('.addMoreProduct').delegate('.product_id', 'change', function() {
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var pname = tr.find('.product_id option:selected').attr('data-productname');
            tr.find('.product_name_class').val(pname);

            var qty = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var sub_total = (qty * price) - ((qty * price * discount) / 100);
            tr.find('.sub_total').val(sub_total);
            totalAmount();

        });

        $('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantity').val() - 0;
            var discount = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var sub_total = (qty * price) - ((qty * price * discount) / 100);
            tr.find('.sub_total').val(sub_total);
            totalAmount();
        });

        $('.payable').on('keyup', function() {
          
            $('.due').val('');
            $('.return').val('');
           
            var a = $('#totalcost').val();
            var b = $('.payable').val();
            if (parseFloat(a) > parseFloat(b)) {
                let due = parseFloat(a) - parseFloat(b);
                let due_amount = due.toFixed(2);
                $('.due').val(due_amount);
            } else if (parseFloat(a) < parseFloat(b)) {
                let backmoney = parseFloat(b) - parseFloat(a);
                let back_amount = backmoney.toFixed(2);
                $('.return').val(back_amount);
            }
        });

        $('.tax_rate').on('keyup', function(){
            let tax_rate = $(this).val();
            let total = $('#totalcost').val();
            let tax_amount = parseFloat(tax_rate) / 100 * parseFloat(total);
            let newTotal = parseFloat(tax_amount) + parseFloat(total);
            let grandTotal = parseFloat(newTotal).toFixed(2);
            if(tax_rate > 0){
                $('#totalcost').val(grandTotal);
                $('.total_amount').html(grandTotal);
                $('.tax_amount').val(tax_amount);

            }else{
                totalAmount();
            }

        });
        $('.discount_rate').on('keyup', function(){
            let discount_rate = $(this).val();
            let total = $('#totalcost').val();
            let discount_amount = parseFloat(discount_rate) / 100 * parseFloat(total);
            let newTotal = parseFloat(total) - parseFloat(discount_amount) ;
            let grandTotal = parseFloat(newTotal).toFixed(2);
            if(discount_rate > 0){
                $('#totalcost').val(grandTotal);
                $('.total_amount').html(grandTotal);
                $('.discount_amount').val(discount_amount);

            }else{
                totalAmount();
            }
        });
    </script>


@endsection
