<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Gateway;
use App\Models\ShippingCompany;
use App\Models\ShippingCompanyService;
use App\Models\ShippingService;
use App\Models\ShippingServiceDay;
use App\Models\ShippingZone;
use App\Models\ShippingZoneDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class GatewaysController extends Controller
{
    // public function index(){
    //     return view('gateways.index');
    // }

    public function PaypalIndex()
    {
        return view('gateways.paypal-index');
    }

    public function VivaWalletIndex()
    {
        return view('gateways.vivawallet-index');
    }

    public function MandrilMailIndex()
    {
        return view('admin.gateways.mandril-mail-index');
    }

    public function CODIndex()
    {
        return view('gateways.cod-index');
    }

    public function BankTransferIndex()
    {
        return view('gateways.bank-transfer-index');
    }

    public function RoyalMailIndex()
    {
        return view('gateways.royal-mail-index');
    }

    public function GoogleTagManagerIndex()
    {
        return view('admin.gateways.google-tag-manager-index');
    }
    public function AramexManagerIndex()
    {
        return view('gateways.aramex-manager-index');
    }
    public function PusherManagerIndex()
    {
        return view('gateways.pusher-manager-index');
    }
    public function SMSManagerIndex()
    {
        return view('gateways.sms-manager-index');
    }
    public function StripeManagerIndex()
    {
        return view('gateways.stripe-manager-index');
    }

    public function DPDIndex()
    {
        return view('gateways.dpd-index');
    }

    public function detail()
    {
        $gateways = Gateway::all();
        $gateways = $gateways->map(function ($x) {
            $x->setting = json_decode($x->setting);
            return $x;
        });
        echo json_encode($gateways);
    }

    public function store(Request $request)
    {
        $imagePath = '';



        $gateway = Gateway::where('type', $request->type)->first();
        $gateWaysettings = json_decode($gateway->setting, true);

       
      
        $data = [
            'type' => $request->type,
            'status' => $request->status,
            'setting' => $request->setting,
            'section' => $request->section,
        ];
        

        if ($gateway) {
            $data['updated_by'] = Auth::user()->id;
            $data['updated_at'] = now();
            $gateway->update($data);
        } else {
            $data['created_by'] = Auth::user()->id;
            $data['created_at'] = now();
            $data['updated_by'] = Auth::user()->id;
            $data['updated_at'] = now();
            $gateway = new Gateway($data);
            $gateway->save();
        }
        if ($request->type == "mandril") {


            if (isset($request->setting) && $request->setting != '') {
                $settings       =   json_decode($request->setting, true);
                $mode           =   isset($settings['mode']) ? $settings['mode'] : '';
                $setting        =   isset($settings[$mode]) ? $settings[$mode] : array();
            
              
            }
            $mail_mailer       = isset($setting['mail_mailer']) ? str_replace(' ', '', $setting['mail_mailer']) : '';
            $mail_host         = isset($setting['mail_host']) ? str_replace(' ', '', $setting['mail_host']) : '';
            $mail_port         = isset($setting['mail_port']) ? str_replace(' ', '', $setting['mail_port']) : '';
            $mail_username     = isset($setting['mail_username']) ? str_replace(' ', '', $setting['mail_username']) : '';
            $mail_password     = isset($setting['mail_password']) ? str_replace(' ', '', $setting['mail_password']) : '';
            $mail_encryption   = isset($setting['mail_encryption']) ? str_replace(' ', '', $setting['mail_encryption']) : '';
            $mail_sender_name  = isset($setting['mail_sender_name']) ? str_replace(' ', '', $setting['mail_sender_name']) : '';
            $sender_email      = isset($setting['sender_email']) ? str_replace(' ', '', $setting['sender_email']) : '';
            
            $path               =   base_path('.env');
 
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'MAIL_MAILER=' . env('MAIL_MAILER'),
                    'MAIL_MAILER=' . $mail_mailer,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_HOST=' . env('MAIL_HOST'),
                    'MAIL_HOST=' . $mail_host,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_PORT=' . env('MAIL_PORT'),
                    'MAIL_PORT=' . $mail_port,
                    file_get_contents($path)
                )); 
                file_put_contents($path, str_replace(
                    'MAIL_USERNAME=' . env('MAIL_USERNAME'),
                    'MAIL_USERNAME=' . $mail_username,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_PASSWORD=' . env('MAIL_PASSWORD'),
                    'MAIL_PASSWORD=' . $mail_password,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_ENCRYPTION=' . env('MAIL_ENCRYPTION'),
                    'MAIL_ENCRYPTION=' . $mail_encryption,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_FROM_ADDRESS=' . env('MAIL_FROM_ADDRESS'),
                    'MAIL_FROM_ADDRESS=' . $mail_sender_name,
                    file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_FROM_NAME=' . env('MAIL_FROM_NAME'),
                    'MAIL_FROM_NAME=' . $sender_email,
                    file_get_contents($path)
                ));
                Artisan::call('config:clear');
                Artisan::call('cache:clear');
                Artisan::call('optimize:clear');
            }
        }
 


        
        echo json_encode($gateway);
    }

    public function shippingList()
    {
        $list = ShippingService::all();
        return view('gateways.shipping.list', compact('list'));
    }

    public function MarckShippingServiceStatus($serviceId)
    {
        $service = ShippingService::find($serviceId);
        $data['is_active'] = ($service->is_active) ? 0 : 1;
        $service->update($data);
        $service = ShippingService::find($serviceId);
        echo json_encode($service);
    }

    public function shipping_form($id = null)
    {
        // $shippingzones = ShippingZone::all();
        // $shippingcompanies = ShippingCompany::all();
        // $shippingcompanyservices = ShippingCompanyService::all();
        $service            =   ($id) ? ShippingService::findORFail($id) : null;
        $servicedays        =   ($service) ? $service->days->pluck('day') : null;
        // dd($servicedays);
        return view('gateways.shipping.form', compact('service', 'servicedays'));
    }

    public function SaveShippingService(Request $request, $id = null)
    {
        $data                       =   $request->except('_token', 'days', 'is_free_shipping');
        $data['is_free_shipping']   =   (isset($request->is_free_shipping)) ? 1 : 0;
        if ($id) {
            $service                =   ShippingService::findORFail($id);
            $service->update($data);
        } else {
            $service                =   new ShippingService($data);
            $service->save();
        }

        /**
         * Get all shipping servie days
         */

        if ($service->days->count() > 0) {
            foreach ($service->days as $key => $day) {
                $day->delete();
            }
        }

        if (isset($request->days)) {
            foreach ($request->days as $key => $day) {
                $DAYS               =   config('constants.DAYS');
                $dayResult          =   null;
                foreach ($DAYS as $key => $value) {
                    if ($value['id'] == $day) {
                        $dayResult  =   $DAYS[$key];
                    }
                }
                $serviceDayData['shipping_service_id']  =   $service->id;
                $serviceDayData['day']                  =   $day;
                $serviceDayData['half']                 =   ($dayResult) ? $dayResult['half'] : '';
                $serviceDayData['full']                 =   ($dayResult) ? $dayResult['full'] : '';
                $serviceDayData['created_at']           =   date('Y-m-d H:i:s');
                $serviceDayData['updated_at']           =   date('Y-m-d H:i:s');
                $serviceDay                             =   new ShippingServiceDay($serviceDayData);
                $serviceDay->save();
            }
        }
        return redirect()->route('admin.shipping-list');
    }

    public function shipping_zones_list()
    {
        $shippingzones = ShippingZone::all();
        return view('gateways.shipping.zones_list', compact('shippingzones'));
    }

    public function shipping_zones_form($zone_id = null)
    {
        $zone = ($zone_id) ? ShippingZone::findORFail($zone_id) : null;
        return view('gateways.shipping.zones_form', compact('zone'));
    }

    public function GetShippingZoneData($id = null)
    {
        $data['countries']  =   Country::all();
        $data['zone']       =   ($id) ? ShippingZone::with('detail')->where('id', $id)->first() : null;
        echo json_encode($data);
    }

    public function SaveShippingZone(Request $request)
    {
        $zone_id = $request->zone_id;
        $ShippingZone = ShippingZone::find($zone_id);

        $zoneData['name'] = $request->name;
        $zoneData['updated_at'] = date('Y-m-d H:i:s');
        if ($ShippingZone) {
            $ShippingZone->update($zoneData);
        } else {
            $zoneData['created_at'] = date('Y-m-d H:i:s');
            $ShippingZone = new ShippingZone($zoneData);
            $ShippingZone->save();
        }

        /**
         * Deleting all Shipping Zone Countries
         */
        $ShippingZoneDetail = ShippingZoneDetail::where('shipping_zone_id', $ShippingZone->id)->get();
        if ($ShippingZoneDetail->count() > 0) {
            foreach ($ShippingZoneDetail as $key => $SZD) {
                $SZD->delete();
            }
        }

        if (collect($request->country_id)->count() > 0) {
            foreach ($request->country_id as $key => $country_id) {
                $ShippingZoneDetailData['shipping_zone_id'] = $ShippingZone->id;
                $ShippingZoneDetailData['country_id'] = $country_id;
                $ShippingZoneDetailData['created_at'] = date('Y-m-d H:i:s');
                $ShippingZoneDetailData['updated_at'] = date('Y-m-d H:i:s');
                $ShippingZoneDetail1 = new ShippingZoneDetail($ShippingZoneDetailData);
                $ShippingZoneDetail1->save();
            }
        }

        echo json_encode($ShippingZone);
    }
}
