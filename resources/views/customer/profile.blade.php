@extends('main')
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
                            <div class="col-sm-3">
                                <h6>Name:</h6>
                                <h6>Email:</h6>
                                <h6>Contact Info:</h6>
                                <h6>Address:</h6>
                                <h6>Member Since:</h6>
                            </div>
                            <div class="col-sm-9">
                                <h6>Cole Richard <span class="pull-right mr-4 mt-2" style="float: right;">
                                        <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i
                                                class="fa fa-edit"></i> Edit</a>
                                    </span>
                                </h6>
                                <h6>nuwinyquv@mailinator.com</h6>
                                <h6>N/a</h6>
                                <h6>N/a</h6>
                                <h6>Feb 13, 2021</h6>
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
                        <th class="hidden"></th>
                        <th>Date</th>
                        <th>Transaction#</th>
                        <th>Amount</th>
                        <th>Full Details</th>
                    </thead>
                    <tbody>

                        <tr>
                            <td class='hidden'></td>
                            <td>Feb 13, 2021</td>
                            <td>i9j30jmip</td>
                            <td>&#36; 1,747.97</td>
                            <td><button class='btn btn-sm btn-flat btn-info ' data-id='11'><i class='fa fa-search'></i>
                                    View</button></td>
                        </tr>
                        <?php for ($i = 0; $i < 50; $i++) { ?> <tr>
                            <td class='hidden'></td>
                            <td>Feb 13, 2021</td>
                            <td><?php echo Str::random(40); ?></td>
                            <td>&#36; 0.00</td>
                            <td><button class='btn btn-sm btn-flat btn-info ' data-id='12'><i class='fa fa-search'></i>
                                    View</button></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
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
