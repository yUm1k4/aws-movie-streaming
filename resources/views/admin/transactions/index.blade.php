@extends('admin.layouts.base')

@section('title', 'Transactions')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transactions</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="transaction-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Package</th>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Transaction Code</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->package->name }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->amount }}</td>
                                        <td>{{ $row->transaction_code }}</td>
                                        <td>{{ $row->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('#transaction-table').DataTable();
    </script>
@endsection