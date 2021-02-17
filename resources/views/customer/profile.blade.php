@extends('customer.main')
@section('content')
    <div class="col-sm-9">
        <div class="font-weight-bold mb-3">

            Profile
        </div>
        <div class="card p-2">
            <div class="box box-solid">
                <div class="box-body row">
                    <div class="col-sm-3">
                        <img src="images/profile.jpg" width="100%">
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table class="table table-sm table-bordered table-striped">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email || Phone</th>
                                        <td>{{ Auth::user()->email }} || {{ Auth::user()->contact->phone ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ Auth::user()->contact->address ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Member Since</th>
                                        <td>{{ Auth::user()->created_at->diffForHumans() }}</td>
                                    </tr>
                                </table>
                                <span class="pull-right mr-4 mt-2" style="float: right;">
                                    <a href="#change_password" class="btn btn-success btn-flat btn-sm"
                                        data-toggle="modal"><i class="fa fa-edit"></i> Update Password</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="p-3 font-weight-bold mb-n4">
                Transactions
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered" id="table1">
                    <thead>
                        <th>Date</th>
                        <th>Transaction#</th>
                        <th>Amount</th>
                        <th>Full Details</th>
                    </thead>
                    <tbody>


                        @foreach ($transactions as $transaction)
                            <td>{{ $transaction->created_at->diffForHumans() }}</td>
                            <td>{{ $transaction->ref }}</td>
                            <td>&#8358; {{ $transaction->amount }}</td>
                            <td><button class='btn btn-sm btn-flat btn-info ' data-id='12'><i class='fa fa-search'></i>
                                    View</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <!-- Transaction History -->
    <div class="modal fade" id="transaction">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Transaction Full Details</b></h4>
                </div>
                <div class="modal-body">
                    <p>
                        Date: <span id="date"></span>
                        <span class="pull-right">Transaction#: <span id="transid"></span></span>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody id="detail">
                            <tr>
                                <td colspan="3" align="right"><b>Total</b></td>
                                <td><span id="total"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile -->
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="old_password" class="col-form-label">Old Password:</label>
                            <input type="password" class="form-control" id="old_password" required />
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" required />
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_password" class="col-form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirm_new_password" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Profile</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function() {

            $('#table1').DataTable();

        })

    </script>
@endsection
