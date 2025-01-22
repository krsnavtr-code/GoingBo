<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function addMembers(Request $request){
        // Retrieve data from the request
        $yourName = $request->input('yourName');
        $yourAge = $request->input('yourAge');
        $yourAadharNo = $request->input('yourAadharNo');
        $yourImage = $request->input('yourImage');
        $yourPhoneNo = $request->input('yourPhoneNo');
        $yourEmail = $request->input('yourEmail');
 
        $partnerName = $request->input('partnerName');
        $partnerAge = $request->input('partnerAge');
        $partnerAadharNo = $request->input('partnerAadharNo');
        $partnerImage = $request->input('partnerImage');
        $partnerPhoneNo = $request->input('partnerPhoneNo');
        $partnerEmail = $request->input('partnerEmail');
        $partnerGender = $request->input('partnerGender');
        
        $child1Name = $request->input('child1Name');
        $child1Age = $request->input('child1Age');
        $child1Gender = $request->input('child1Gender');
        
        $child2Name = $request->input('child2Name');
        $child2Age = $request->input('child2Age');
        $child2Gender = $request->input('child2Gender');

        // Save data to the database using the Member model
        $member = new Member();

        $member->your_name = $yourName;
        $member->your_age = $yourAge;
        $member->your_aadhar_no = $yourAadharNo;
        $member->your_image = $yourImage;
        $member->your_phone_no = $yourPhoneNo ;        
        $member->your_email = $yourEmail;


        $member->partner_name = $partnerName;
        $member->partner_age = $partnerAge;
        $member->partner_aadhar_no = $partnerAadharNo;
        $member->partner_image = $partnerImage;
        $member->partner_phone_no = $partnerPhoneNo;
        $member->partner_email = $partnerEmail;
        $member->partner_gender = $partnerGender;

        $member->child1_name = $child1Name;
        $member->child1_age = $child1Age;
        $member->child1_gender = $child1Gender;

        $member->child2_name = $child2Name;
        $member->child2_age = $child2Age;
        $member->child2_gender = $child2Gender;
        $member->save();
        return self::api_response(["success"=>true]);
    }
}
