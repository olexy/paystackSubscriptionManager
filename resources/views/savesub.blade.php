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
            <p>You are 10 seconds away from saving a subscription to database!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Safe Subscription</h3>
                    <form  action="/refsub" name="createRe" method="POST">
                    {{ csrf_field() }}
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="customerlist" class="form-control customerlist">
                                    <option class="hidden"  selected disabled>Please select a customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->customer}}">{{$customer->customer}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtplan" id="custcode" class="form-control txtcust" placeholder="Customer Code *" readonly="true"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtauthcode" id="authcode" class="form-control" placeholder="Payment Authorization *" readonly="true"/>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <select name="selectplan" id="selectplan" class="form-control lstplan">
                            </select>
                            <!-- <div class="form-group">
                                <input type="hidden" name="planName" id="planName" class="form-control"/>
                            </div> -->
                            <div class="form-group">
                                <input type="text" name="txtplancode" id="plancode" class="form-control" placeholder="Plan Code *" readonly="true"/>
                            </div>
                            <input type="submit" class="btnRegister"  value="Save Subscription"/>
                        </div>
                    </form>
                </div>
            </div>    
</body>
</html>

<!-- For the subscriber name select -->
<script>
$(document).ready(function(){

    $(document).on('change','.customerlist', function(){
        // console.log('its changed!');

        var cust_name = $(this).val();
        // console.log(cust_name);

        var op=" ";
        
        $.ajax({
            type:'get',
            url:'{!!URL::to('findAuth')!!}',
            data:{'name':cust_name},
            // dataType:'json', //return data will be json
            success:function(merged){
                // console.log('success');
                console.log(merged)
                $('#authcode').val(merged[0].auth_code);
                $('#custcode').val(merged[1].cust_code);
                // $('#planName').val(merged[0].plan);

				op+='<option value="0" selected disabled>Subscribed Plan</option>';
                op+='<option value="'+merged[0].plan+'">'+merged[0].plan+'</option>';
  
                // var plan_name = $('#planName').val();        
                // console.log(plan_name);
                
                $('#selectplan').html(" ")
                $('#selectplan').append(op)

            },            
            error:function(){               

            }

        })
    });

});
</script>

<!-- For the plan name select -->
<script>
$(document).ready(function(){

    $(document).on('change','.lstplan', function(){
        // console.log('its changed!');

        var plan_name = $(this).val();
        // console.log(cust_name);

        var op=" ";

        
        $.ajax({
            type:'get',
            url:'{!!URL::to('findPlan')!!}',
            data:{'plan':plan_name},
            // dataType:'json', //return data will be json
            success:function(plan){
                // console.log('success');
                console.log(plan)
                $('#plancode').val(plan[0].plan_code);

            },            
            error:function(){               

            }

        })
    });

});
</script>
@endsection

