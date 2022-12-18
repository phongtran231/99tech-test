@extends('admin::layouts.guest')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <form method="post" action="{{route('login.post')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class="display-5">Login Form</h3>
                        </div>
                        <div class="text-center">
                            @if($errors->any())
                                {!! implode('', $errors->all('<p class="text text-danger">:message</p>')) !!}
                            @endif
                        </div>
                        <div class="card-body">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"/>

                            <label for="pass">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password"/>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-block" id="login">Login</button>
                        </div>
                    </DIV>
                </form>
            </div>
            <div class="col">

            </div>

        </div>
    </div>
@endsection
