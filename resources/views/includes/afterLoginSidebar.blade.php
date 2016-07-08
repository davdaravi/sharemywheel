<nav class="navbar navbar-default">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
	<div class="container">
        <div class="container-fluid xs-PLR0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/home')}}">
                	<div class="col-md-3 col-sm-3 col-xs-3">
                		<img src="/images/logo.png" width="50" class="mainLogo">
                	</div>
                	<div class="col-md-9 col-sm-9 col-xs-9">
                		<p class="logoContent">Share My Wheels</p>
                	</div>
                </a>
                <a href="{{url('/findride')}}" class="btn btn-info margin-top-5">Find a ride</a>&nbsp;<label style="color:black">or&nbsp;</label> 
                <a href="{{url('/offerride')}}" class="btn btn-success margin-top-5">Offer a ride</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="wallet text-center">
                        <i class="zmdi zmdi-card zmdi-hc-fw"></i>
                        <div>
                            <span>My Wallet</span>
                            <br>
                            <span><b>Rs. <span id="walletamount">25.00</span></b></span>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" style="padding-top: 0px;padding-bottom: 0px;line-height: 49px;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <img id="loginuserpic" src="@if(session('profilePic')=='default.png'){{'/images/default.png'}}@else{{'/images/profile/'.session('userId').'/'.session('profilePic')}}@endif" style="padding: 4px;margin-right: 10px;border-radius: 8px;width: 35px;height: 35px;">@if(session('userName')){{ session('userName') }}@else{{""}}@endif<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </div>
</nav>
<script type="text/javascript">
    
    $.ajax({
        async:false,
        headers: { 'X-CSRF-Token' : $("#token").val() } ,
        type:'GET',
        url:'{{route('get.wallet.amount')}}',
        dataType:'json',
        beforeSend:function(){
            
        },
        success:function(response){
            if(response!=-1)
            {
                $("#walletamount").text(response);
            }
            else
            {

            }
        },
        error:function(response)
        {
            console.log(response);
            $("#walletamount").text(0);
            //$.toaster({ priority : 'danger', title : 'Title', message : 'Please try again'});
        },
        complete:function(){
            //removeOverlay();
        }
    });
</script>