@extends('admin::layouts.master')

@section('content')
    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            Error occured.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputStock" class="col-sm-2 col-form-label">Stock Quantity</label>
            <div class="col-sm-10">
                <input type="number" step="any" class="form-control" id="inputStock" placeholder="Stock Quantity"
                       name="stock_quantity">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="inputPrice" placeholder="Price" name="price">
            </div>
        </div>

        <div class="form-group row">
            <label for="customFile" class="col-sm-2 col-form-label">Images</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" class="orm-control-file" id="customFile" multiple name="images[]">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
