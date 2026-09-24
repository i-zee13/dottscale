<div class="sidebarblue" id="sidebarblue">
    <div class="aside-primary">
        <div class="sell360">
            <a href="/admin/index"><img alt="Allomate Solutions" src="{{ url('/admin/images/allomate-logow.svg') }}"></a>
        </div>
        <div class="main-links">
            <ul id="parentModulesUl">
            </ul>
        </div>
        <div class="_user-nav">
            <a href="#"><img src="{{ url('/admin/images/bell-icon-2.svg') }}" alt="Notification" title="Notification" /><span class="badge new_notification">1</span></a>
            <a href="{{ url('/admin/profile')}}" class="userIMG">
                @if(GetActiveGuardDetail()->is_web == 1)
                <img src="{{@GetActiveGuardDetail()->picture ? str_replace('./', '/', @GetActiveGuardDetail()->picture) : '/images/avatar.svg' }}" alt="" />
                @else
                <img src="/images/warehouse.png" alt="" />
                @endif
            </a>
            @if(GetActiveGuardDetail()->is_web == 1)
            <a href="{{url(GetActiveGuardDetail()->is_web == 1 ? '/admin/manage_settings' : '#')}}" class="float-right"><img src="{{ url('/admin/images/setting-icon.svg') }}" alt="Setting" title="Setting" /></a>
            @endif
        </div>
        <div class="sidebar-BL">
            <ul>
                {{-- <li>
                    <a href="/Tasks"><img src="/images/task-icon.svg" alt="" /> Tasks <span
                            class="badge">00</span></a>
                </li> --}}
                <li>
                    <form  id="submitLogOutForm" action="{{ route(GetActiveGuardDetail()->is_web == 1 ? 'logout' :'investor-logout') }}" style="display: none" method="POST">
                        @csrf
                    </form>
                    <a  href="{{GetActiveGuardDetail()->is_web?"/logout":"/investor-logout"}}" id="logout_btn" ><img src="{{ url('') }}/admin/images/logout-icon.svg" alt="Employee" /> Logout</a>
                    <script>

                    </script>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="_subNav-id">
    <div class="_subNav"> <a id="SN-close" class="SN-close-btn"><i class="fa fa-arrow-left snCloseBtn"></i></a>
        <h2 id="subNavHeader"></h2>
        <ul id="subNavItems">
        </ul>
    </div>
</div>
