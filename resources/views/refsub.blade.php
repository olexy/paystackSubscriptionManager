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
    <title>Create Subscription</title>
</head>
<body>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Welcome</h3>
            <p>You are 10 seconds away from verifying a subscription!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Verify Subscription</h3>
                    <form  action="" name="createRe" method="POST">
                    {{ csrf_field() }}
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="customerlist" class="form-control customerlist">
                                    <option class="hidden"  selected disabled>Please select a customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->email}}">{{$customer->name}}</option>
                                    @endforeach 
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="txtrefcode" id="refcode" class="form-control" placeholder="Sub Ref. *" readonly="true"/>
                            </div>
                            <input type="submit" class="btnRegister"  value="Make Payment"/>
                        </div>
                    </form>
                </div>
            </div>    
</body>
</html>
@endsection

<script>
$(document).ready(function(){

    $(document).on('change','.customerlist', function(){
        // console.log('its changed!');

        var cust_name = $(this).val();
        // console.log(plan_name);
        
        var div=$(this).parent();

        $.ajax({
            type:'get',
            url:'{!!URL::to('findAmount')!!}',
            data:{'name':cust_name},
            // dataType:'json', //return data will be json
            success:function(data){
                // console.log('success');
                // console.log(data[0].email);
                $('#refcode').val(data[0].ref_code);

            },            
            error:function(){               

            }

        })
    });

});
</script>


