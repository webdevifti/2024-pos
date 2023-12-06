@extends('layouts.app')
@section('title', 'Point of the sale')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pos</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pos</li>
            </ol>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
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
                                                <select name="product_id[]" id="product_id"
                                                    class="form-control product_id productSelecta" required>
                                                    <option value="">--select product--</option>
                                                    @foreach ($get_active_product as $item)
                                                        <option data-price="{{ $item->price }}"
                                                            value="{{ $item->id }}">{{ $item->product_name }}</option>
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
                                    <h4 class="total_amount"></h4>
                                </strong>
                                <input type="hidden" value="" name="total_amount" id="totalcost" required>
                                <h5 class="text-info">Choose Payment Method</h5>
                                <label for="cash" class="form-check-label">
                                    <input type="radio" class="form-check-input" id="cash" name="payment_method"
                                        value="cash" checked> Cash</label><br>
                                <label for="bank" class="form-check-label">
                                    <input type="radio" class="form-check-input" id="bank" name="payment_method"
                                        value="bank"> Bank</label><br>

                                <label for="">Paid</label>
                                <input type="text" class="form-control payable" name="paid_amount" required>
                                <label for="">Due</label>
                                <input type="text" class="form-control due" name="due" readonly>
                                <label for="">Change</label>
                                <input type="text" class="form-control return" name="return" readonly>

                                <div class="mb-2 mt-2">
                                    <label for="">Customer</label>
                                    <select name="customer_id" class="form-control" required>
                                        <option value="">customer</option>
                                        @foreach($get_active_customer as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Done</button>
                </div>
            </form>

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
            var de = totalAmount() - sub_total;
            $('.total_amount').hmtl(de);
        });

        function totalAmount() {
            var total = 0;
            $('.sub_total').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total_amount').html(total);
        }

        $('.addMoreProduct').delegate('.product_id', 'change', function() {
            var tr = $(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
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
            var total = 0;
            $('.due').val('');
            $('.return').val('');
            $('.sub_total').each(function(i, e) {
                var amount = $(this).val() - 0;
                total += amount;
            });
            var a = $('#totalcost').val(total);
            var b = $('.payable').val();
            if (parseInt(a.val()) > parseInt(b)) {

                var due = parseInt(a.val()) - parseInt(b);
                $('.due').val(due);
            } else if (parseInt(a.val()) < parseInt(b)) {
                var backmoney = parseInt(b) - parseInt(a.val());
                $('.return').val(backmoney);
            }
        });
    </script>


@endsection
