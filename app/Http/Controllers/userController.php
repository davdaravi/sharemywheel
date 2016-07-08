<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\userRepository;
use App\Http\Requests;

class userController extends Controller
{
    //this function is for getting user details
    public function getUserDetails(userRepository $userRepository)
    {
        return $userRepository->getUserDetails();
    }
    //this function is for updating user personal information
    public function updateUserDetails(userRepository $userRepository)
    {
    	return $userRepository->updateUserDetails();
    }
    //this function is for email confirmation
    public function emailConfirmation(userRepository $userRepository)
    {
        return $userRepository->emailConfirmation();
    }
    //function for mobile confirmation
    public function mobileConfirmation(userRepository $userRepository)
    {
        return $userRepository->mobileConfirmation();
    }
    //save user preference
    public function savePreference(userRepository $userRepository)
    {
        return $userRepository->savePreference();
    }
    //function for user image upload
    public function imageUpload(userRepository $userRepository)
    {
        return $userRepository->imageUpload();
    }
    //function for send email verification code
    public function sendEmailCode(userRepository $userRepository)
    {
        return $userRepository->sendEmailCode();
    }
    //function for send mobile verification code
    public function sendMobileCode(userRepository $userRepository)
    {
        return $userRepository->sendMobileCode();
    }
    //function for get details of user
    public function getProfile(userRepository $userRepository,$id,$rideid)
    {
        return $userRepository->getProfile($id,$rideid);
    }
}
