<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ClientReviews;
use App\Models\PrimaryServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client as guzzleClient;
use Illuminate\Support\Facades\Http;
// use Google\Client;
use Auth;
use DB;

class ReviewsController extends Controller
{
    public function index()
    {
        return view('admin.reviews.index');
    }
    public function list()
    {
        $records        =      ClientReviews::selectRaw("*,DATE_FORMAT(created_at,'%Y-%m-%d %h:%i') as created")->orderBy('created_at', 'DESC')->get();
        return response()->JSON([
            'status'    =>     'success',
            'records'   =>     $records,
        ]);
    }
    // public function getGoogleReviews()
    // {   
    //     $clientId       =   '103500389880783888334';
    //     $clientSecret   =   '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';
    //     $tokenUrl       =   'https://oauth2.googleapis.com/token';
    //     $clientEmail    =   'service-account@akzat-410207.iam.gserviceaccount.com';
    //     $accessTokenUrl =   'https://www.googleapis.com/oauth2/v4/token';
    //     $clientKeyFile  =   './allomate-website-test-b714fd6fbf97.json'; //allomate
    //     // $clientKeyFile = './akzat-410207-b90c6a79a840.json'; //akzat
    //     $accountId      =   "1981595142120453172"; //allomate
    //     // $accountId   =   "8167693655459993212"; //akzat
    //     $locationId     =   'ChIJmSuIEqL5RT4R2GdYMBx2Gxk';
    //     https://business.google.com/n/8167693655459993212/profile?fid=1809169538761648088
    //     // $locationId  =   'ChIJH3X9-NJS2zgRXJIU5veht0Y';
    //     // $serviceAccountKey = json_decode(file_get_contents($clientKeyFile), true);

    //     // // Get the access token using the service account key
    //     // $accessToken = getServiceAccountAccessToken(
    //     //     $serviceAccountKey['client_email'],
    //     //     $serviceAccountKey['private_key']
    //     // );
    //     // dd($accessToken);
    //     $client         =   new Client();
    //     $httpclient     =   new guzzleClient();
    //     $client->setAuthConfig($clientKeyFile); // Use setAuthConfig instead of setAuthConfGoogle_Clientig
    //     $client->setScopes([
    //         'https://www.googleapis.com/auth/business.manage',
    //     ]);

    //     // Obtain an access token
    //     $accessToken    =   $client->fetchAccessTokenWithAssertion();
    //     $token          =   $accessToken['access_token'];
    //     $headers        =   [
    //                             'Authorization' =>  'Bearer ' . $token,
    //                             'Accept'        =>  'application/json',
    //                         ];
    //     $apiKey         =   "AIzaSyCwKn5jt1eY_F9BTKREjHMldJl43FVZFOQ"; //allomate
    //     $endpoint       =   "https://maps.googleapis.com/maps/api/place/details/json";
    //     $placeId        =   "ChIJjyEBTEgBGTkRMa9H7wcF3yc"; //allomate
    //     // $apiEndpoint =   'https://mybusiness.googleapis.com/v4/accounts/'.$accountId.'/locations/'.$locationId.'/reviews';
    //     //get account detail
    //     // $accountendPoint = "https://mybusinessaccountmanagement.googleapis.com/v1/accounts";
    //     // $response    = $httpclient->get($accountendPoint, ['headers' => $headers]);
    //     // dd($response);
    //     $response       =   $httpclient->get($endpoint,['query' => [
    //         'place_id'  =>  $placeId,
    //         'key'       =>  $apiKey
    //     ]]);
    //     $response       =   json_decode($response->getBody(), true);
    //     $reviews        =   isset($response['result']['reviews']) ? $response['result']['reviews'] : [];
    //     if(collect($reviews)->count() > 0){
    //         DB::table('google_reviews')->delete();
    //         foreach($reviews as $key => $review){
    //             $timestamp                  =   $review['time'];
    //             $dateTime                   =   Carbon::createFromTimestamp($timestamp);
    //             $formattedDate              =   $dateTime->format('Y-m-d H:i:s');

    //             $save                       =   new GoogleReviews();
    //             $save->review_id            =   $key+1;
    //             $save->author_name          =   $review['author_name'];
    //             $save->author_profile_photo =   $review['profile_photo_url'];
    //             $save->rating               =   $review['rating'];
    //             $save->content              =   $review['text'];
    //             $save->review_type          =   1; //general
    //             $save->status               =   1; //pending
    //             $save->synced_at            =   Carbon::now();
    //             $save->synced_by            =   GetActiveGuardDetail()->id;
    //             $save->created_by           =   GetActiveGuardDetail()->id;
    //             $save->created_at           =   $formattedDate;
    //             $save->updated_at           =   null;
    //             $save->data_json            =   json_encode($review);
    //             $save->save();
    //         }
    //         return response()->JSON([
    //             'status'    =>  'success',
    //             'msg'       =>  'reviews found and added'
    //         ]);
    //     }else{
    //         return response()->JSON([
    //             'status'    =>  'success',
    //             'msg'       =>  'reviews not found'
    //         ]);
    //     }
    // }
    public function saveAssignment(Request $request)
    {
        if ($request->review_id) {
            $save                       =   ClientReviews::find($request->review_id);
        } else {
            $save                       =   new ClientReviews();
        }
        $save->author_name              =   $request->author_name;
        $save->author_description       =   $request->author_description;
        $save->review_content           =   $request->review_content;
        $save->rating                   =   $request->rating;
        $save->review_type              =   $request->review_type;
        if ($request->review_id) {
            $save->updated_by           =   GetActiveGuardDetail()->id;
            $save->updated_at           =   Carbon::now();
        } else {
            $save->created_by           =   GetActiveGuardDetail()->id;
            $save->created_at           =   Carbon::now();
        }
        if ($save->save()) {
            return response()->JSON([
                'status'    =>  'success',
                'msg'       =>  'review added successfully'
            ]);
        } else {
            return response()->JSON([
                'status'    =>  'failed',
                'msg'       =>  'Review not added at this moment'
            ]);
        }
    }
    public function review_status_change(Request $request)
    {
        $status_blog            =   ClientReviews::where('id', $request->id)->update([
            'status'            =>  $request->review_status,
            'updated_by'        =>  GetActiveGuardDetail()->id,
            'updated_at'        =>  Carbon::now()
        ]);
        return response()->JSON([
            'status'            =>   'success',
            'msg'               =>   'status_change'
        ]);
    }
    // sfrFormIndex
    public function sfrFormIndex()
    {
        return view('admin.sfr-forms.index');
    }
    public function sfrFormRecords()
    {
        $records            =   DB::table('sfr_properties')->selectRaw("
                                    sfr_properties.*,
                                    DATE(sfr_properties.created_at) AS created_date,
                                    (SELECT name from cities where id = sfr_properties.city_id) as city_name,
                                    (SELECT name from states where id = sfr_properties.state_id) as state_name
                                ")
            ->orderBy('id', 'DESC')
            ->get();
        return response()->JSON([
            'status'        =>  'success',
            'records'       =>  $records
        ]);
    }
}
