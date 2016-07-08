<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Validator; 
use DB;
use App\Http\Controllers\HelperController;
use Response;
use Illuminate\Foundation\Bus\DispatchesJobs;

class offerRideRepository
{
    protected $request,$ip;
	public function __construct(Request $request)
	{
		$this->request=$request;
        $this->request->headers->set('Last-Modified', gmdate('D, d M Y H:i:s').'GMT');
        $this->request->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->request->headers->set('Cache-Control', 'post-check=0, pre-check=0');
        $this->request->headers->set('Pragma', 'no-cache');
        $this->ip=$request->ip();
        //return redirect()->back()->withErrors(["error"=>"Could not add details! Please try again."]);
	}
    
    //this function is for load offerride
    public function viewOfferRide()
    {
        //select all car
        $carList=DB::table('car_details')->where('userId',session('userId'))->where('is_deleted',0)->get();
        //leave
        $leave=DB::table('leave_on')->where('is_deleted',0)->get();
        //detour
        $detour=DB::table('detour')->where('is_deleted',0)->get();
        //luggage
        $luggage=DB::table('luggage')->where('is_deleted',0)->get();
        return view('offerRide',['car'=>$carList,'leave'=>$leave,'detour'=>$detour,'luggage'=>$luggage]);
    }
    //function for create ride
    public function createRide()
    {
        try
        {
            $request=$this->request->all();
            $param=json_decode($request['json'],true);
            
            //check if field exists or not
            $requiredFieldArray=array("place","lat","lng","city","original","fromdate","todate","returnHour","returnMin","car","luggage","leave","detour","comments","ladies","return","daily","way1","way2","way3","way4","from","to","licence","seat","costseat");
            $check=HelperController::checkParameter($requiredFieldArray,$param);
            if($check==1)
            {
                $errors=array();
                $errors['error']="Your request is incorrect";
                return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);
            }

            $place=$param['place'];
            $lat=$param['lat'];
            $lng=$param['lng'];
            $city=$param['city'];
            $original=$param['original'];
            $fromdate=$param['fromdate'];
            $todate=$param['todate'];
            $returnHour=$param['returnHour'];
            $returnMin=$param['returnMin'];
            $car=$param['car'];
            $luggage=$param['luggage'];
            $leave=$param['leave'];
            $detour=$param['detour'];
            $comments=$param['comments'];
            $ladies=$param['ladies'];
            $return=$param['return'];
            $daily=$param['daily'];
            $from=$param['from'];//source place
            $to=$param['to'];//destination place
            $licence=$param['licence'];
            $seat=$param['seat'];
            $costseat=$param['costseat'];
            $errors=array();
            $flg=0;
            if(count($place)>0)
            {
                if(isset($place[0]))
                {
                    if($place[0]=="")
                    {
                        $errors['from'][0]="Enter Valid location";
                        $flg=1;    
                    }
                    else
                    {
                        if($original[0]!=$from)
                        {
                            $errors['from'][0]="Enter Valid location";
                            $flg=1;
                        }
                    }
                }   
                else
                {
                    $errors['from'][0]="Enter Valid location";
                    $flg=1;
                }

                if(isset($place[1]))
                {
                    if($place[1]=="")
                    {
                        $errors['to'][0]="Enter Valid location";       
                        $flg=1;
                    }
                    else
                    {
                        if($original[1]!=$to)
                        {
                            $errors['to'][0]="Enter Valid location";       
                            $flg=1;       
                        }
                    }
                }
                else
                {
                    $errors['to'][0]="Enter Valid location";
                    $flg=1;
                }

                if(isset($place[2]))
                {
                    if(isset($place[3]))
                    {
                        if(($place[2]=="" && $param['way1']!="") || ($original[2]!=$param['way1']) || ($place[2]!="" && $param['way1']==""))
                        {
                            $errors['areafrom_0'][0]="Enter Valid location";    
                            $flg=1;
                        }
                        if(($place[3]=="" && $param['way2']!="") || ($place[3]!="" && $param['way2']=="") || ($original[3]!=$param['way2']))
                        {
                            $errors['areafrom_1'][0]="Enter Valid location";
                            $flg=1;
                        }
                    }
                    else
                    {
                        if($param['way1']!="")
                        {
                            if(($place[2]=="" && $param['way1']!="") || ($original[2]!=$param['way1']))
                            {
                                $errors['areafrom_0'][0]="Enter Valid location";    
                                $flg=1;
                            }

                            if($param['way2']!='0')
                            {
                                $errors['areafrom_1'][0]="Enter Valid location";
                                $flg=1;
                            }
                        }
                    }
                }
                else
                {
                    if($param['way1']!="")
                    {
                        $errors['areafrom_0'][0]="Enter Valid location";
                        $flg=1;
                    }
                    if($param['way2']!='0')
                    {
                        if(isset($place[3]))
                        {
                            if($original[3]!=$param['way2'])
                            {
                                $errors['areafrom_1'][0]="Enter Valid location";
                                $flg=1;
                            }
                        }
                        else
                        {
                            $errors['areafrom_1'][0]="Enter Valid location";
                            $flg=1;
                        }
                    }
                }

                if(isset($place[4]))
                {
                    if(($place[4]=="") || ($place[4]!="" && $param['way3']=="") || ($original[4]!=$param['way3']))
                    {
                        $errors['areafrom_2'][0]="Enter Valid location";
                        $flg=1;    
                    }
                }
                else
                {
                    if($param['way3']!='0')
                    {
                        $errors['areafrom_2'][0]="Enter Valid location";
                        $flg=1;
                    }
                }

                if(isset($place[5]))
                {
                    if(($place[5]=="") || ($place[5]!="" && $param['way4']=="") || ($original[5]!=$param['way4']))
                    {
                        $errors['areafrom_3'][0]="Enter Valid location";
                        $flg=1;
                    }
                }
                else
                {
                    if($param['way4']!='0')
                    {
                        $errors['areafrom_3'][0]="Enter Valid location";
                        $flg=1;
                    }
                }

                if($flg==1)
                {
                    return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);       
                }
            }
            else
            {
                
                $errors['from'][0]="Enter Valid location";
                $errors['to'][0]="Enter Valid location";
                return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);
            }

            $checkArray=array("car"=>$car,"luggage"=>$luggage,"leave"=>$leave,"detour"=>$detour,"comments"=>$comments,"licence"=>$licence,"fromdate"=>$fromdate,"seat"=>$seat,"costseat"=>$costseat);
            $message=[
                    'car.required'      =>  'Select car',
                    'luggage.required'  =>  'Select luggage',
                    'leave.required'    =>  'Select leave',
                    'detour.required'   =>  'Select detour',
                    'licence.required'  =>  'Select licence',
                    'fromdate.required' =>  'Select departure date',
                    'fromdate.date'     =>  'Select correct departure date',
                    'seat.required'     =>  'Select no of seats',
                    'seat.integer'      =>  'Wrong value select',
                    'costseat.required' =>  'Cost per seat is required',
                    'costseat.integer'  =>  'Cost must be in integer'
                ];
            $Validator=Validator::make($checkArray,[
                    'car'       =>  'required',
                    'luggage'   =>  'required',
                    'leave'     =>  'required',
                    'detour'    =>  'required',
                    'licence'   =>  'required',
                    'fromdate'  =>  'required|date',
                    'seat'      =>  'required|integer',
                    'costseat'  =>  'required|integer'
                ],$message);

            if($Validator->fails())
            {
                return Response::json(array('status'=>false,'error'=>$Validator->getMessageBag()->toArray(),'message'=>'','class'=>'danger'),200);
            }
            else
            {
                //check return date if not daily and return date
                if($daily==0 && $return==1)
                {
                    if($todate!="")
                    {
                        $message1=[
                            'fromdate.required' =>  'Select departure date',
                            'fromdate.date'     =>  'Select correct departure date',
                            'todate.required'   =>  'Select return date',
                            'todate.date'       =>  'Select correct return date',
                            'todate.after'      =>  'Return date must be greater than departure date'
                        ];
                        $checkRetunDate=array("fromdate"=>$fromdate,"todate"=>$todate);
                        $Validator1=Validator::make($checkRetunDate,[
                                'fromdate'  =>  'required|date',
                                'todate'    =>  'required|date|after:fromdate'
                            ],$message1);
                        if($Validator1->fails())
                        {
                            return Response::json(array('status'=>false,'error'=>$Validator1->getMessageBag()->toArray(),'message'=>'','class'=>'danger'),200);
                        }
                    }
                    else
                    {
                        //if return date is null
                        $errors['todate'][0]="Select Return Date";
                        return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);
                    }
                }
                else
                {
                    if($daily==1 && $return==1)
                    {
                        $fromhour=date("H",strtotime($fromdate));
                        $frommin=date("i",strtotime($fromdate));
                        $fromtime=$fromhour.":".$frommin;
                        $endtime=$returnHour.":".$returnMin;
                        $strfromtime=strtotime($fromtime);
                        $strendtime=strtotime($endtime);
                        if($strfromtime>=$strendtime)
                        {
                            //departure date time grater than return hour and min
                            $errors['returnHour'][0]="Return time should be greater than departure time";
                            return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);
                        }
                    }
                }
                if($costseat>0)
                {   
                    if($todate!="")
                    {
                        $todate=date("Y-m-d H:i:s",strtotime($todate));
                    }
                    else
                    {
                        $todate="0000-00-00 00:00:00";
                    }

                    $return_time=$returnHour.":".$returnMin;
                    $insertRideArray=array("userId"=>session('userId'),"carId"=>$car,"departure"=>$place[0],"departure_lat_long"=>$lat[0].",".$lng[0],"departureCity"=>strtolower(trim($city[0])),"departureOriginal"=>$original[0],"arrival"=>$place[1],"arrival_lat_long"=>$lat[1].",".$lng[1],"arrivalCity"=>strtolower(trim($city[1])),"arrivalOriginal"=>$original[1],"offer_seat"=>$seat,"available_seat"=>$seat,"cost_per_seat"=>$costseat,"departure_date"=>date("Y-m-d H:i:s",strtotime($fromdate)),"return_date"=>$todate,"return_time"=>$return_time,"is_round_trip"=>$return,"isDaily"=>$daily,"ladies_only"=>$ladies,"luggage_size"=>$luggage,"leave_on"=>$leave,"can_detour"=>$detour,"status"=>0,"view_count"=>0,"licence_verified"=>$licence,"comment"=>$comments,"ratting"=>0);

                    //transaction
                    DB::beginTransaction();
                    //
                    $rideID=DB::table('rides')->insertGetId($insertRideArray);
                    if($rideID>0)
                    {
                        //insert waypoints
                        if(count($place)>2)
                        {
                            for($i=2;$i<count($place);$i++)
                            {
                                $ff=array("rideId"=>$rideID,"city"=>$place[$i],"cityName"=>strtolower(trim($city[$i])),"cityOriginal"=>$original[$i],"city_lat_long"=>$lat[$i].",".$lng[$i]);
                                $new[]=$ff;
                            }
                            $rideViaInsert=DB::table('ride_via_points')->insert($new);
                            if($rideViaInsert>0)
                            {
                                DB::commit();
                                //data inserted successfully
                                return Response::json(array('status'=>true,'error'=>$errors,'message'=>'Ride has been offered successfully','class'=>'success'),200);
                            }   
                            else
                            {
                                DB::rollBack();
                                //something wrong
                                $errors[]="Please try again for creating ride..";
                                return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),501);
                            }
                        }
                        else
                        {
                            DB::commit();
                            //ride created without waypoints
                            return Response::json(array('status'=>true,'error'=>$errors,'message'=>'Ride has been offered successfully','class'=>'success'),200);
                        }
                    }
                    else
                    {
                        DB::rollBack();
                        //something went wrong while inserting rides
                        $errors[]="Please try again for creating ride..";
                        return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),501);
                    }
                }
                else
                {
                    $errors['costseat'][0]="Cost of seat must be greater than zero..";
                        return Response::json(array('status'=>false,'error'=>$errors,'message'=>'','class'=>'danger'),200);
                }
            }
        }
        catch(\Exception $e)
        {
            \Log::error('createRide function error: ' . $e->getMessage());
            return Response::json(array('error'=>true), 400);
        }
    }
}
