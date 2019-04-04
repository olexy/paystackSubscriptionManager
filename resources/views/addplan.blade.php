@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/pssub.css" rel="stylesheet" type="text/css" media="all" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <title>Subscription Plan Creation</title>
</head>
<body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Welcome</h3>
            <p>You are 30 seconds away from creating a new plan!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Create Subscription Plan</h3>
                    <form  action="/addplan" name="createRe" method="POST">
                    {{ csrf_field() }}
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="txtname" type="text" class="form-control" placeholder="Plan Name *" value="" />
                            </div>
                            <div class="form-group">
                                <textarea name="description" rows="2" cols="50" class="form-control"> Plan Description * </textarea>
                            </div>
                            <div class="form-group">
                                <div class="maxl">
                                    <label class="radio inline"> 
                                        <input type="radio" name="invoice" value="true">
                                        <span> Invoice </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="invoice" value="false">
                                        <span>No Invoice </span> 
                                    </label>
                                </div>
                                <div class="maxl">
                                    <label class="radio inline"> 
                                        <input type="radio" name="sms" value="true">
                                        <span> SMS </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="sms" value="false">
                                        <span> No SMS </span> 
                                    </label>
                                </div>                           
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="txtamount" class="form-control" placeholder="Plan Price *" value="" />
                            </div>
                            <div class="form-group">
                            <select name="interval" class="form-control">
                                <option class="hidden"  selected disabled>Subscription Interval * </option>
                                <option value="monthly">Monthly</option>
                                <option value="biannually">Bi-Annually</option>
                                <option value="annually">Annually</option>
                            </select>
                            </div>
                            <input type="submit" class="btnRegister"  value="Register"/>
                        </div>
                    </form>
                </div>
            </div>
</body>
</html>
@endsection