<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/pssub
.css" rel="stylesheet" type="text/css" media="all" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
            <h3>Welcome</h3>
            <p>You are 30 seconds away from creating a subscription!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Create A Subscription</h3>
                    <form  action="" name="createRe" method="POST">
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="customer" class="form-control">
                                    <option class="hidden"  selected disabled>Please select a customer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="plan" class="form-control">
                                    <option class="hidden"  selected disabled>Please select a plan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="amount" class="form-control" placeholder="Plan Price *" value=""/>
                            </div>
                            <input type="submit" class="btnRegister"  value="Make Payment"/>
                        </div>
                    </form>
                </div>
            </div>
