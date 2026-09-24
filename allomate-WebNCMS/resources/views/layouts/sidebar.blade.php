<div class="sidebarblue">
    <div class="aside-primary">
        <div class="sell360"><a href="{{ route('admin.index') }}"><img alt="DottScale"
                    src="{{ url('/images/dottscale-logo-alt.png') }}"></a></div>
        <div class="main-links">
            <ul>
                <li><a><img src="{{ url('/admin/images/search-icon.svg') }}" alt="" /> Search</a></li>
                <!-- <li><a><img src="{{ url('/admin/images/add-pluse-icon.svg') }}" alt="" /> Create New</a></li> -->
                <li><a><img src="{{ url('/admin/images/icon-dash-board.svg') }}" alt="" /> Dashboard</a></li>
                <hr>
                <li><a href="{{ route('admin.organization') }}"><img src="{{ url('/admin/images/emp-icon.svg') }}"
                            alt="" /> Organization</a></li>
                <!-- <li><a><img src="{{ url('/admin/images/customer-list-icon.svg') }}" alt="" /> Clients</a></li> -->
                <!-- <li><a><img src="{{ url('/admin/images/correspondence-icon-2.svg') }}" alt="" /> Business Contacts</a></li> -->
                <li><a id="open-side-service"><img src="{{ url('/admin/images/correspondence-icon.svg') }}"
                            alt="" /> Service Areas</a></li>
                <li><a id="open-side-blog"><img src="{{ url('/admin/images/correspondence-icon.svg') }}"
                            alt="" /> Blogs</a></li>
                <li><a><img src="{{ url('/admin/images/api-icon.svg') }}" alt="" /> Integrations</a></li>
                <!-- <li><a><img src="{{ url('/admin/images/mth-setting-icon.svg') }}" alt="" /> Site Settings</a></li> -->
                <li><a id="open-side-leads"><img src="{{ url('/admin/images/mth-setting-icon.svg') }}"
                            alt="" /> Leads</a></li>
                <li><a id="open-side-webpages"><img src="{{ url('/admin/images/dashboard-icon.svg') }}"
                            alt="" /> Website Pages</a></li>
                <li><a id="open-side-career"><img src="{{ url('/admin/images/mth-setting-icon.svg') }}"
                            alt="" />Careers</a></li>
                <li><a href="{{ route('admin.testimonial-list') }}"><img src="{{ url('/admin/images/emp-icon.svg') }}"
                    alt="" /> Testimonials</a></li>


            </ul>
        </div>




        <div class="_user-nav">
            <a href="javascript:void(0);"><img src="{{ url('/admin/images/bell-icon-2.svg') }}" alt="Notification"
                    title="Notification" />
                <span class="badge">4</span>
            </a>
            <a href="{{ route('admin.profile') }}" class="userIMG">
                <img src="{{ Auth::user()->picture ? URL::to(Auth::user()->picture) : '/admin/images/avatar.svg' }}"
                    alt="" />
            </a>
            <a href="javascript:void(0);" class="float-right">
                <img src="{{ url('/admin/images/setting-icon.svg') }}" alt="Setting" title="Setting" />
            </a>
        </div>


        <div class="sidebar-BL">
            <ul>
                <li><a href="/logout"><img src="{{ url('') }}/admin/images/logout-icon.svg" alt="Employee" />
                        Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="_subNav-id" class="open-side-service hide-leads-menu">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left"></i></a>
        <h2>Service Areas</h2>
        <ul>
            <li><a href="{{ route('admin.primary-services') }}"><img src="images/create-page-icon.svg"
                        alt="" />Primary Service </a></li>

            <li><a href="{{ route('admin.secondary-services') }}"><img src="images/activity-icon.svg"
                        alt="" />Secondary Service</a></li>
            <li><a href="{{ route('admin.blog-categories') }}"><img src="images/activity-icon.svg"
                        alt="" />Blog Categories</a></li>
        </ul>
    </div>
</div>

<div id="_subNav-id" class="open-side-blog hide-leads-menu">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left"></i></a>
        <h2>Blogs</h2>
        <ul>
            <li><a href="{{ route('admin.add-blog') }}"><img src="{{ url('/admin/images/create-page-icon.svg') }}"
                        alt="" />Add New</a></li>
            <li><a href="{{ route('admin.blogs') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />List</a></li>
            <li><a href="{{ route('admin.blog-categories') }}"><img src="images/activity-icon.svg"
                        alt="" />Blog Categories</a></li>
        </ul>
    </div>
</div>


<div id="_subNav-id" class="open-side-leads hide-leads-menu">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left"></i></a>
        <h2>Leads & Subscription</h2>
        <ul>
            <li><a href="{{ route('admin.leads') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Leads </a></li>
            <li><a href="{{ route('admin.demo-requests') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Demo Requests </a></li>
            <li><a href="{{ route('admin.subscriptions') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Subscriptions</a></li>
        </ul>
    </div>
</div>
<div id="_subNav-id" class="open-side-career hide-career-menu">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left"></i></a>
        <h2>Career</h2>
        <ul>
            <li> <a href="{{ route('admin.careers') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Career List</a></li>
            <li><a href="{{ route('admin.applications') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Applications </a></li>
        </ul>
    </div>
</div>


<div id="_subNav-id" class="open-side-webpages hide-leads-menu">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left"></i></a>
        <h2>Website Pages</h2>
        <ul>
            <li><a href="javascript:void(0);"><img src="{{ url('/admin/images/create-page-icon.svg') }}" alt="" />Create
                    Page </a></li>
            <li><a href="{{ route('admin.index') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Home Page</a></li>
            <li><a href="{{ route('admin.aboutus') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />About Us</a></li>
            <li><a href="{{ route('admin.contactus') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Contact Us</a></li>
            <li><a href="javascript:void(0);"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Testimonial</a></li>
            <li><a href="{{ route('admin.faqs') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />FAQs</a></li>
            <li><a href="{{ route('admin.privacy-policy') }}"><img
                        src="{{ url('/admin/images/activity-icon.svg') }}" alt="" />Privacy Policy</a></li>
            <li><a href="{{ route('admin.terms-of-use') }}"><img src="{{ url('/admin/images/activity-icon.svg') }}"
                        alt="" />Terms of Use</a></li>
        </ul>
    </div>
</div>
