@extends('admin.main-layout')

@section('body')
    <div class="row">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer Table</h3>
                    <div class="text-right">
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-warning btn-sm">Add Customer</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S No:</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email Address</th>
                                <th>Pin</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->mobile_no }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->pincode }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <img src="{{ asset('customer/' . $customer->image . '') }}" class="rounded-circle"
                                            width="50" height="50">

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>

                                        {{-- <a href="{{ route('admin.customers.delete', $customer->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a> --}}
                                        <form method="post" class="d-inline"
                                            action="{{ route('admin.customers.destroy', $customer->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
