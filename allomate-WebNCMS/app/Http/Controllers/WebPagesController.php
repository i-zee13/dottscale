<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationValidate;
use App\Models\AboutUs;
use App\Models\ApplicationForm;
use App\Models\BlogCategory;
use App\Models\Staff;
use App\Models\Blogs;
use App\Models\Career;
use App\Models\City;
use App\Models\ClientReviews;
use App\Models\ContactForm;
use App\Models\ContactUs;
use App\Models\Faqs;
use App\Models\FooterPageContent;
use App\Models\PrContactForm;
use App\Models\StaticPages;
use App\Models\SubscribersList;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

class WebPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFrontEndIndexPage()
    {

        if ((in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8001', 'www.demo.crm.allomate.solutions', env('ADMIN_URL', 'demo.crm.allomate.solutions')])) && (Route::currentRouteName() == null || Route::currentRouteName() == 'home')
        ) {
            if (!Auth::guard('web')->check()) {
                return redirect(route('login'));
            } else {
                return redirect(route('index'));
            }
        }
        $landing_page = DB::table('pagebuilder__pages')
            ->selectRaw("pagebuilder__page_translations.route")
            ->join("pagebuilder__page_translations", "pagebuilder__page_translations.page_id", "=", "pagebuilder__pages.id")
            ->where('page_status', 2)->where('page_type', 1)->where('landing_page_status', 1)->first();

        if ($landing_page) {
            $query =    "select * from `pagebuilder__page_translations` inner join `pagebuilder__pages` on `pagebuilder__pages`.`id` = `pagebuilder__page_translations`.`page_id` where pagebuilder__page_translations.route = '{$landing_page->route}'";
            $data   =   DB::select($query);
            $data   =   collect($data)->first();

            $data =  json_decode($data->data, true);
            return view('dynamic-page', compact('data'));
        } else {
            return view("home");
        }
    }

    public function getFrontEndAboutusPage()
    {
        $data    =   AboutUs::first();
        $staff   =   Staff::all();
        return view("who-we-are", compact('data', 'staff'));
    }
    public function getClientsLogo(){
        $data = DB::table('client_logos')->orderBy('sequence', 'ASC')->get();
        return response()->JSON([
            'data'       =>  $data,
            'status'     =>  'success',
        ]);
    }
    public function getAllCareerJobs()
    {
        $allJobs = Career::where('status', 1)->Select('id', 'slug', 'location', 'title')->get();
        return response()->JSON([
            'allJobs'    =>  $allJobs,
            'status'     =>  'success',
        ]);
    }
    public function getFrontEndBlogsPage()
    {
        $services = BlogCategory::where('publish', '1')
        ->whereIn('id', function($query) {
            $query->select('blog_category_id')
                  ->from('blogs')
                  ->where('published', '1');
        })
        ->get();
        $all_blogs      =   Blogs::where('blogs.published', '1')->orderBy('blogs.id', 'DESC')
            ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')
            ->selectRaw('blogs.title,
                                blogs.short_description ,
                                DATE_FORMAT(blogs.blog_date,"%d %b, %Y") as date,
                                blogs.blog_date,
                                blogs.slug,
                                blogs.blog_details,
                                blogs.blog_category_id,
                                blogs.after_header_image,
                                blog_categories.service_name as category_name
                            ')
            ->orderBy('blog_date', 'DESC')
            ->get();
        return response()->JSON([
            'categories'    =>  $services,
            'all_blogs'     =>  $all_blogs,
        ]);
    }
    public function saveJobApplication(JobApplicationValidate $request)
    {
        $resume         =   null;
        $validatedData  = $request->sanitizedAndValidated();
        if ($request->hasFile('resume')) {
            $completeFileName         =   $request->file('resume')->getClientOriginalName();
            $fileNameOnly             =   pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension                =   $request->file('resume')->getClientOriginalExtension();
            $file                     =   str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path                     =   $request->file('resume')->storeAs('public/jobApplications/', $file);
            $resume                   =   '/storage/jobApplications/' . $file;
        }
        $jobApplication                     =   new ApplicationForm();
        $jobApplication->application_for    =   $validatedData['career_id'];
        $jobApplication->first_name         =   $validatedData['first_name'];
        $jobApplication->last_name          =   $validatedData['last_name'];
        $jobApplication->email              =   $validatedData['email'];
        $jobApplication->phone_number       =   $validatedData['phone_number'];
        $jobApplication->message            =   $validatedData['introduction'];
        $jobApplication->linked_in          =   $validatedData['linkedInUrl'];
        $jobApplication->resume             =   $resume;
        $jobApplication->save();
        return response()->JSON([
            'status'                    =>  'success',
            'msg'                       =>  'form_submit'
        ]);
    }
    public function getFrontEndPrivacyPage()
    {
        $privacy    =   StaticPages::where('page_id', '1')->value('document');
        return view("privacy-policy", compact('privacy'));
    }
    public function getFrontEndTermsPage()
    {
        $terms_of_use    =   StaticPages::where('page_id', '2')->value('document');
        return view("terms-of-use", compact('terms_of_use'));
    }
    public function getFrontEndFaqs(Request $request)
    {
        if ($request->faqs_for) {
            $where      =   " AND faq_type = 2 AND page_id = $request->faqs_for";
        } else {
            $where      =   " AND faq_type = 1";
        }
        $faqs           =   Faqs::whereRaw("status = 1 $where")->get();
        if(collect($faqs)->count() == 0){
            $faqs       =   Faqs::whereRaw("status = 1 AND faq_type = 1")->get();
        }
        return response()->JSON([
            'faqs'      =>  $faqs
        ]);
    }
    public function blog_details($page_slug)
    {
        $blog_details           =   Blogs::selectRaw("blogs.*,DATE_FORMAT(blogs.blog_date,'%d %b, %Y') as pdate")->where('slug', $page_slug)->first();
        $service_name           =   BlogCategory::where('id', $blog_details->blog_category_id)->value('service_name');
        $all_related_blogs      =   Blogs::where('published', '1')
                                            ->WHERE('id', '!=', $blog_details->id)
                                            ->where('blog_category_id', $blog_details->blog_category_id)
                                            ->selectRaw("blogs.*,DATE_FORMAT(blogs.blog_date,'%d %b, %Y') as pdate")
                                            ->limit(3)
                                            ->orderBy('id', 'DESC')->get();
        return view("insights-details", compact(['blog_details', 'service_name', 'all_related_blogs']));
    }
    public function get_in_touch()
    {
        $all_records            =   ContactUs::first();
        return view("get-in-touch", compact(['all_records', 'services']));
    }
    public function save_contact_form(Request $request)
    {
        $validate = $this->validate($request, [
            'name'        =>  'required',
            'email'             =>  'required',
            'phone'             =>  'required',
            'message'           =>  'required',
        ]);
        $save_contact                   =   new ContactForm();
        $save_contact->name             =   $request->name;
        $save_contact->email            =   $request->email;
        $save_contact->phone            =   $request->phone;
        $save_contact->subject          =   $request->subject;
        $save_contact->message          =   $request->message;
        $save_contact->page_reference   =   $request->page_reference;
        if($save_contact->save()){
            $receiverEmail              =   DB::table('organization')->selectRaw("IFNULL(notification_received_email,'') as notification_received_email")->value('notification_received_email');
            if($receiverEmail){
                Mail::send('emails.forms.contact-form', [
                    'name'              =>  $request->name,
                    'email'             =>  $request->email,
                    'phone'             =>  $request->phone,
                    'subject'           =>  $request->subject,
                    'note'              =>  $request->message,
                ],
                function ($message) use($receiverEmail) {
                    $message->from('info@allomate.solutions', 'Allomate Solutions');
                    $message->to($receiverEmail, 'Allomate Solutions')->subject('New Contact Form Submission - '.date('d-m-Y'));
                });
            }
        }
        return response()->JSON([
            'status'                    =>  'success',
            'msg'                       =>  'form_submit'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFrontEndWhatWeDo()
    {
        return view("what-we-do");
    }
    public function getFrontEndTheDifference()
    {
        return view("the-differences");
    }
    public function getFrontEndServices()
    {
        $all_blogs  =   Blogs::where('published', '1')->orderBy('id', 'DESC')->get();
        return view("services", compact('all_blogs'));
    }
    public function getTestimonialsList()
    {
        $records            =   DB::table('testimonials')->WHERE('status', 1)->get();
        return response()->JSON([
            'status'        =>  'success',
            'review_record' =>  $records
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = intval($request->id);
        if ($id) {
            FooterPageContent::find($id)->delete();
            return response()->JSON([
                'status'            =>  'success',
                'msg'               =>  'Deleted'
            ]);
        } else {
            return response()->JSON([
                'status'            =>  'error',
                'msg'               =>  'invalid id'
            ]);
        }
    }
    public function footerContent()
    {
        $pages  =  [
            (object)['title' => 'Terms of Use', 'url' => '/terms-of-use'],
            (object)['title' => 'Privacy Policy', 'url' => '/privacy-policy'],
            (object)['title' => 'Investor Login', 'url' => env('INVESTOR_URL','https://investor.demo.allomate.solutions/investor-login')]
        ];
        $new_pages_cat = DB::table('pagebuilder__pages')
            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
            ->select(
                'pagebuilder__pages.name as title',
                'pagebuilder__page_translations.route as url'
            )
            ->get();

            $record = FooterPageContent::all();
            $record = $record->sortBy('id')->values()->all();


        return view('admin.footer-page', compact('record', 'pages', 'new_pages_cat'));
    }
    public function saveFooterContent(Request $request)
    {

        $footer_content = $request->footer_links;
        foreach ($footer_content as $key => $content) {
            $id             =   intval($content['id']);
            $page_link      =   $content['page_link'];
            $header_title   =   $content['header_title'];
            $save           =   FooterPageContent::find($id);
            if (!$save) {
                $save       =   new FooterPageContent();
                $save->created_by = GetActiveGuardDetail()->id;
                $save->created_at = Carbon::now();
                $save->updated_by = null;
                $save->updated_at = null;
            } else {
                $save->updated_by = GetActiveGuardDetail()->id;
                $save->updated_at = Carbon::now();
            }
            $isTitleAlreadyExist  = FooterPageContent::where('header_title', $header_title)->where('id', '!=', $id)->exists();
            if ($isTitleAlreadyExist) {
                $key = $key + 1;
                return response()->json([
                    'status' => 'duplicate',
                    'msg' => "Header title at row $key is already exist in someother row",
                ]);
            }
            $save->footer_menu    = json_encode($page_link);
            $save->header_title   = $header_title;
            $save->save();
        }
        return response()->JSON([
            'status'            =>  'success',
            'msg'               =>  'content added successfully'
        ]);
    }
    public function subscribersList()
    {
        return view('admin.web-inquiries-and-subscribers-list.subscribers-list');
    }
    public function subscriberListRecords()
    {
        $records        =   SubscribersList::selectRaw("subscribers_list.*,DATE_FORMAT(subscribers_list.created_at,'%d-%m-%Y %h:%i') as subscribed_at")->orderBy('id', 'DESC')->get();
        return response()->JSON([
            'status'    =>  'success',
            'records'   =>  $records
        ]);
    }
    // saveSubscriberForm
    public function saveSubscriberForm(Request $request)
    {
        if ($request->subscriber_email) {
            $alreadySubsc   =   DB::table("subscribers_list")->whereRaw("email = '$request->subscriber_email'")->first();
            if($alreadySubsc){
                return response()->JSON([
                    'status'=>  'failed',
                    'msg'   =>  'You have already subscribed!'
                ]);
            }
            $save           =   new SubscribersList();
            $save->email    =   $request->subscriber_email;
            if ($save->save()) {
                return response()->JSON([
                    'status' =>  'success',
                    'msg'   =>  'Subscribed successfully'
                ]);
            }
        } else {
            return response()->JSON([
                'status'    =>  'error',
                'msg'       =>  'An Error occured please try again later'
            ]);
        }
    }
    public function inquiriesList()
    {
        $records    =   DB::table('contact_us_forms')->orderBy('id','DESC')->get();
        return view('admin.web-inquiries-and-subscribers-list.web-inquiries-list',compact('records'));
    }
    // public function inquiriesListRecords()
    // {
    //     $records        =   SubscribersList::selectRaw("subscribers_list.*,DATE_FORMAT(subscribers_list.created_at,'%d-%m-%Y %h:%i') as subscribed_at")->orderBy('id', 'DESC')->get();
    //     return response()->JSON([
    //         'status'    =>  'success',
    //         'records'   =>  $records
    //     ]);
    // }

    public function save_pr_contact_form(Request $request)
    {
        $validate = $this->validate($request, [
            'first_name'        =>  'required',
            'last_name'         =>  'required',
            'email'             =>  'required',
            'phone'             =>  'required',
            'notes'             =>  'required',
            'state_id'          =>  'required',
            'city_name'         =>  'required',
            'street_address'    =>  'required',
        ]);
        $city_id                        =   null;
        if($request->city_name){
            $checkCity                  =   DB::table('cities')->selectRaw("id")->whereRaw("lower(name) = lower('$request->city_name')")->first();
            if($checkCity){
                $city_id                =   $checkCity->id;
            }else{
                $save_city              =   new City();
                $save_city->name        =   $request->city_name;
                $save_city->state_id    =   $request->state_id;
                if($save_city->save()){
                    $city_id            =   $save_city->id;
                }
            }
        }
        $save_contact                   =   new PrContactForm();
        $save_contact->first_name       =   $request->first_name;
        $save_contact->last_name        =   $request->last_name;
        $save_contact->email            =   $request->email;
        $save_contact->phone_no         =   $request->phone;
        $save_contact->street_address   =   $request->street_address;
        $save_contact->city_id          =   $city_id;
        $save_contact->state_id         =   $request->state_id;
        $save_contact->zip_code         =   $request->zip_code;
        $save_contact->asking_price     =   $request->asking_price;
        $save_contact->notes            =   $request->notes;
        $save_contact->page_reference   =   $request->page_reference;
        if($save_contact->save()){
            $receiverEmail              =   DB::table('organization')->selectRaw("IFNULL(notification_received_email,'') as notification_received_email")->value('notification_received_email');
            $city_name                  =   DB::table('cities')->whereRaw("id = $city_id")->value('name');
            $state_name                 =   DB::table('states')->whereRaw("id = $request->state_id")->value('name');
            if($receiverEmail){
                Mail::send('emails.forms.property-form', [
                    'first_name'        =>  $request->first_name,
                    'last_name'         =>  $request->last_name,
                    'email'             =>  $request->email,
                    'phone'             =>  $request->phone,
                    'street_address'    =>  $request->street_address,
                    'state_name'        =>  $state_name ? $state_name : '',
                    'city_name'         =>  $city_name ? $city_name : '',
                    'zip_code'          =>  $request->zip_code,
                    'asking_price'      =>  $request->asking_price ? $request->asking_price : '',
                    'page_reference'    =>  $request->page_reference ? $request->page_reference : '',
                    'notes'             =>  $request->notes,
                ],
                function ($message) use($receiverEmail) {
                    $message->from('info@demo.allomate.solutions', 'Allomate Solutions');
                    $message->to($receiverEmail, 'Allomate Solutions')->subject('New SFR Property Listing Request - '.date('d-m-Y'));
                });
            }
        }
        return response()->JSON([
            'status'                    =>  'success',
            'msg'                       =>  'form_submit'
        ]);
    }
    public function getLatestBlogs()
    {
        $blogs  =   Blogs::where('published', '1')->latest('blog_date')->take('3')->get();
        foreach ($blogs as $blog) {
            $date               =  new DateTime($blog->blog_date);
            $blog->category     =  $blog->blog_type == 1 ? 'General' : DB::table('blog_categories')->select('service_name')->where('id', $blog->blog_category_id)->value('service_name');
            $blog->blog_date    =  $date->format('d F Y');
        }
        return response()->json(['blogs' => $blogs]);
    }
    public function getTestimonials()
    {
        $reviews = ClientReviews::where('status', 1)->get();
        return response()->json(['status' => 'success', 'reviews' => $reviews]);
    }
    public function getServices($limit = null)
    {
        if($limit){
            $limitClause = "LIMIT 3";
        } else {
            $limitClause = "";
        }
        $services = DB::select(DB::raw("
            SELECT
                main_services.service_name,
                main_services.description,
                main_services.icon,
                pagebuilder__page_translations.route
            FROM
                pagebuilder__pages
            LEFT JOIN
                pagebuilder__page_translations ON pagebuilder__page_translations.page_id = pagebuilder__pages.id
            LEFT JOIN
                main_services ON main_services.id = pagebuilder__pages.primary_service_id
            WHERE
                pagebuilder__pages.page_type = 2 AND pagebuilder__pages.page_status = 2 AND pagebuilder__pages.data IS NOT NULL
            $limitClause
        "));
        return response()->json(['status' => 'success', 'services' => $services]);
    }
    public function getCareersPositions()
    {
        $positions = Career::where('status', 1)->select('title', 'slug', 'location')->get();
        return response()->json(['status' => 'success', 'positions' => $positions]);
    }
    public function blogs_list()
    {
        $services = BlogCategory::where('publish', '1')->select('id', 'service_name')->get();
        $blogs      = Blogs::where('published', '1')->leftJoin('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category_id')->select('blogs.*', 'blog_categories.service_name')->orderBy("created_at", "desc")->get();

        return view("blogs-list", compact("services", "blogs"));
    }
    public function getCareerDetail($slug)
    {
        $latest_blogs = Blogs::latest()->take(3)->get();
        $career = Career::where('status', 1)->where('slug', '' . $slug . '')->first();
        return view('career-detail', compact('career', 'latest_blogs'));
    }
    public function getFrontEndPortfolios($isLimit = null){

        $limit = '';
        if($isLimit != null){
            $limit = 'Limit 4';
        }
        $data = DB::select(DB::raw("
            SELECT
                portfolios.portfolio_name,
                portfolios.portfolio_categories,
                portfolios.id,
                (
                    SELECT GROUP_CONCAT(pr.service_name)
                    FROM portfolio_categories pr
                    WHERE FIND_IN_SET(pr.id,portfolios.portfolio_categories)
                ) as category_names,
                portfolios.thumbnail,
                pagebuilder__page_translations.route
            FROM
                pagebuilder__pages
            LEFT JOIN
                pagebuilder__page_translations ON pagebuilder__page_translations.page_id = pagebuilder__pages.id
            LEFT JOIN
                portfolios ON portfolios.id = pagebuilder__pages.portfolio_id
            WHERE
                pagebuilder__pages.page_type = 2 AND pagebuilder__pages.page_status = 2 AND pagebuilder__pages.data IS NOT NULL AND portfolios.is_slider_show = 1
            $limit
            ORDER BY
            portfolios.id DESC
        "));
    return response()->json(["status"=> "success","data"=> $data]);
    }

}
