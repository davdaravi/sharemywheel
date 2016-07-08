@extends("master")

@section("head")
    <title>Share My Wheel - login</title>
@endsection
@section("nav")
    @include("includes.beforeLoginSidebar")
@endsection
@section("content")
<!-- main Content -->
<div class="container-fluid">
    <div class="row">
        <div class="bannerImage">
            <img src="images/slider1.png" class="bannerImg"/>
            <div id="slider-pattern"></div>
        </div>
    </div>
</div>

<!-- <div class="container">
    <div class="col-xs-12 col-sm-6 col-md-4 searchForm">
        <div class="col-md-12">
            <h3>Book a Car</h3>
        </div>
        <div class="clearfix"></div><hr/>
        <form role="form" method="POST" action="{{route('post.ride.search')}}">
            <div class="form-group col-md-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="zmdi zmdi-pin zmdi-hc-lg"></i></span>
                    <input type="text" name="from" id="from" class="form-control" placeholder="From" />
                    <input type="hidden" name="fromcity" id="fromcity"/>
                </div>
            </div>
            <div class="form-group col-md-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="zmdi zmdi-pin zmdi-hc-lg"></i></span>
                    <input type="text" name="to" id="to" class="form-control" placeholder="To" />
                    <input type="hidden" name="tocity" id="tocity"/> 
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1"><i class="zmdi zmdi-calendar-note zmdi-hc-lg"></i></span>
                    <input type="text" class="form-control" name="rideFindDatepicker" id="rideFindDatepicker" placeholder="Date Picker" />    
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12 text-right">
                <input type="submit" name="submit" id="submit" value="Search" class="btn btn-primary">
            </div>
        </form>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 carImages">
        <img src="images/slider_front_img.png">
    </div>
</div>
<div class="clearfix"></div> -->

<div class="container margin-top-25 blocks">
    <div class="col-md-12 text-center">
        <div class="col-xs-12 col-sm-3 col-md-3 block">
            <i class="zmdi zmdi-movie-alt zmdi-hc-2x"></i>
            <p class="margin-top-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 block">
            <i class="zmdi zmdi-label zmdi-hc-2x"></i>
            <p class="margin-top-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 block">
            <i class="zmdi zmdi-car-taxi zmdi-hc-2x"></i>
            <p class="margin-top-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 block">
            <i class="zmdi zmdi-camera zmdi-hc-2x"></i>
            <p class="margin-top-10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
        </div>
    </div>
</div>
<div class="clearfix"></div>

{{--login modal--}}
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" name="loginform" action="{{route('post.login.check')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="zmdi zmdi-close"></i>
                    </button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                        
                            @if($errors->has('error'))<label id="commonlogin" class="validation_error loginerror" style="padding-left:15px"><b>{{ $errors->first('error') }}</b></label>@endif                
                        
                        <div class="col-md-12">
                            <label class="control-label">Username</label>
                            <input type="text" name="username" id="username" value="@if(old('username')){{ old('username') }}@else{{""}}@endif" placeholder="Enter Username/Email Id" class="form-control" required/>
                            @if($errors->has('username'))<label id="unameerror" class="validation_error loginerror" style="padding:0px"><b>{{ $errors->first('username') }}</b></label>@endif                
                        </div>

                        <div class="col-md-12 margin-top-10">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" id="password" value="@if(old('password')){{ old('password') }}@else{{""}}@endif" placeholder="Enter Password" class="form-control" required/> 
                            @if($errors->has('password'))<label id="passworderror" class="validation_error loginerror" style="padding:0px"><b>{{ $errors->first('password') }}</b></label>@endif                
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="token" value="{{config('app.token')}}"/>
                        <div class="clearfix"></div>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Login" />
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
{{--sign up modal--}}
<div class="modal fade" id="signUpModal" tabindex="-1">
    <div class="modal-dialog">
        <form name="signupform" method="POST" action="{{route('post.signup')}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="zmdi zmdi-close"></i>
                    </button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-md-12">
                            <label class="control-label">Username</label>
                            <input type="text" name="signuser" id="signuser" placeholder="Enter Username" value="@if(old('signuser')){{ old('signuser') }}@else{{""}}@endif" class="form-control" required/>
                            @if($errors->has('signuser'))<label class="validation_error signerror" style="padding:0px"><b>{{ $errors->first('signuser') }}</b></label>@endif                
                        </div>

                        <div class="col-md-12 margin-top-10">
                            <label class="control-label">Password</label>
                            <input type="password" placeholder="Enter Password" name="signpassword" id="signpassword" value="@if(old('signpassword')){{ old('signpassword') }}@else{{""}}@endif" class="form-control" required/>
                            @if($errors->has('signpassword'))<label class="validation_error signerror" style="padding:0px"><b>{{ $errors->first('signpassword') }}</b></label>@endif                
                        </div>

                        <div class="col-md-12 margin-top-10">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" placeholder="Enter Confirm Password" value="@if(old('signconfirm')){{ old('signconfirm') }}@else{{""}}@endif" name="signconfirm" id="signconfirm" class="form-control" required/>
                            @if($errors->has('signconfirm'))<label class="validation_error signerror" style="padding:0px"><b>{{ $errors->first('signconfirm') }}</b></label>@endif
                        </div>

                        <div class="col-md-12 margin-top-10">
                            <label class="control-label">Email Address</label>
                            <input type="email" placeholder="Enter Email Address" name="signemail" value="@if(old('signemail')){{ old('signemail') }}@else{{""}}@endif" id="signemail" class="form-control" required/>
                            @if($errors->has('signemail'))<label class="validation_error signerror" style="padding:0px"><b>{{ $errors->first('signemail') }}</b></label>@endif
                        </div>

                        <div class="col-md-12 margin-top-10">
                            <label class="control-label">Contact Number</label>
                            <input type="number" placeholder="Enter Contact Number" min="1111111111" max="9999999999" name="signcontact" value="@if(old('signcontact')){{ old('signcontact') }}@else{{""}}@endif" id="signcontact" class="form-control" required/>
                            @if($errors->has('signcontact'))<label class="validation_error signerror" style="padding:0px"><b>{{ $errors->first('signcontact') }}</b></label>@endif
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="token" value="{{config('app.token')}}"/>
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="signupSubmit" id="signupSubmit" class="btn btn-primary" value="Sign Up" />
                </div>
            </div>
            
        </form>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
@section("js")
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzn37QRF8u0MBNXd2MGsTQs1IOBUXMH4Q&libraries=places&callback=initialize" async defer></script>
    <script type="text/ecmascript">
        <?php
        if(isset($errors))
        {
            if(count($errors)>0)
            {
                if($errors->has('username') || $errors->has('password') || $errors->has('error'))
                {
                ?>
                    $("#loginModal").modal('show');
                <?php
                }
                else if($errors->has('signuser') || $errors->has('signpassword') || $errors->has('signconfirm') || $errors->has('signemail') || $errors->has('signcontact'))
                {?>
                    $("#signUpModal").modal('show');
                <?php
                }
                else
                {?>
                    $("#loginModal").modal('hide');
                    $("#signUpModal").modal('hide');
                <?php
                }
            }    
        }
        ?>
        //login modal click clear value
        $(".login").click(function(){
            $("#username").val('');
            $("#password").val('');
            $(".loginerror").each(function(){
                $(this).text('');
                $(this).hide();
            });
        });
        //if signup modal click
        $(".signup").click(function(){
            $("#signuser").val('');
            $("#signpassword").val('');
            $("#signconfirm").val('');
            $("#signemail").val('');
            $("#signcontact").val('');
            $(".signerror").each(function(){
                $(this).text('');
                $(this).hide();
            });
        });

        var autocomplete,autocomplete1;
        $(document).ready(function(){
         //   initialize();
            $('#rideFindDatepicker').datetimepicker({
                lang:'ch',
                timepicker:false,
                format:'d-m-Y',
                minDate:'-1970/01/01', // yesterday is minimum date
            });
        });
        function initialize() 
        {
            var options = {
                //types: ['(cities)'],
                componentRestrictions: {country: "ind"}
            };

            var input = document.getElementById('from');
            var input1 = document.getElementById('to');
            autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', fillInAddress);
            autocomplete1 = new google.maps.places.Autocomplete(input1, options);
            autocomplete1.addListener('place_changed', fillInAddress1);
        }
        function fillInAddress() 
        {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
          
            $("#fromcity").val(place.name);
            console.log(place.name);
            var from_lat=autocomplete.getPlace().geometry.location.lat();
            var to_lat=autocomplete.getPlace().geometry.location.lng();
            //****************************
            get_city_name(from_lat,to_lat);
            //****************************
            for (var component in componentForm) 
            {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for(var i = 0; i < place.address_components.length; i++) 
            {
                var addressType = place.address_components[i].types[0];
                if(componentForm[addressType]) 
                {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }
        function fillInAddress1()
        {
            // Get the place details from the autocomplete object.
            var place = autocomplete1.getPlace();
            console.log(place);
            $("#tocity").val(place.name);
            var from_lat=autocomplete1.getPlace().geometry.location.lat();
            var to_lat=autocomplete1.getPlace().geometry.location.lng();
             //****************************
            get_city_name(from_lat,to_lat);
            //****************************
            for (var component in componentForm) 
            {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for(var i = 0; i < place.address_components.length; i++) 
            {
                var addressType = place.address_components[i].types[0];
                if(componentForm[addressType]) 
                {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }
        function get_city_name(lat,lng)
        {

            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);

            geocoder.geocode(
                {'latLng': latlng}, 
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                var add= results[0].formatted_address ;
                                var  value=add.split(",");

                                count=value.length;
                                country=value[count-1];
                                state=value[count-2];
                                city=value[count-3];
                                alert("city name is: " + city);
                            }
                            else  {
                                alert("address not found");
                            }
                    }
                     else {
                        alert("Geocoder failed due to: " + status);
                    }
                }
            );
        }
    </script>
@endsection