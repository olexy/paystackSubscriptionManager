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
            <p>You are 30 seconds away from creating a new plan!</p>
        </div>
        <div class="col-md-9 register-right">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Create A Plan</h3>
                    <form  action="" name="createRe" method="POST">
                    <div class="row register-form">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Plan Name*" value="" />
                            </div>
                            <div class="form-group">
                                <textarea rows="2" cols="50" class="form-control"> Plan Description* </textarea>
                            </div>
                            <div class="form-group">
                                <div class="maxl">
                                    <label class="radio inline"> 
                                        <input type="radio" name="invoice" value=1 checked>
                                        <span> Invoice </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="non_invoice" value=0>
                                        <span>No Invoice </span> 
                                    </label>
                                </div>
                                <div class="maxl">
                                    <label class="radio inline"> 
                                        <input type="radio" name="sms" value=1>
                                        <span> SMS </span> 
                                    </label>
                                    <label class="radio inline"> 
                                        <input type="radio" name="non_sms" value=0  checked>
                                        <span> No SMS </span> 
                                    </label>
                                </div>                           
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="amount" class="form-control" placeholder="Plan Price *" value="" />
                            </div>
                            <input type="submit" class="btnRegister"  value="Register"/>
                        </div>
                    </form>
                </div>
            </div>
