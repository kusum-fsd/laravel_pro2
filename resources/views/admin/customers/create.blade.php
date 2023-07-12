@extends('admin.main-layout')
@section('body')
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">

                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Customer </h3>
                    <div class="text-right">
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-danger btn-sm">View Customer</a>
                    </div>

                </div>

                <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"
                                        class="form-control @error('name')
                                    is-invalid
              @enderror"
                                        name="name" placeholder="Enter Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text"
                                        class="form-control @error('mobile_no')
                                    is-invalid
              @enderror"
                                        minlength="10" maxlength="12" size="10" name="mobile_no"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                        placeholder="Enter Your Mobile No." value="">
                                </div>
                                @error('mobile_no')
                                    <span class=" text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="email"
                                        class="form-control 
                                      @error('email')
                                                      is-invalid
                                @enderror "
                                        name="email" placeholder="Enter email">
                                    @error('email')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea type="text"
                                        class="form-control @error('address')
                                    is-invalid
              @enderror"
                                        name="address" rows="4" placeholder="Enter Address"></textarea>
                                </div>
                                @error('address')
                                    <span class=" text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Upload Image</label>

                                    <input type="file" class="form-control" name="ur_image">

                                </div>
                                @error('image')
                                    <span class=" text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

            </form>


        </div>

    </div>
@endsection
