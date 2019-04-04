@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="card-header">
                    <div class="links">
                        <a href="/addcust">Register Customer</a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="links">
                        <a href="/addplan">Create Plan</a>
                    </div>
                </div>
                <div class="card-header">
                    <div class="links">
                        <a href="/addsub">Buy Subscription</a>
                    </div>
                </div>
                <div class="card-header">
                <div class="links">
                    <a href="/refsub">Verify Purchase</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
