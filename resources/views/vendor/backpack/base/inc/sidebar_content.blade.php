<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@role('super-admin')
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('child') }}'><i class='nav-icon las la-male'></i> Children</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon las la-briefcase'></i> Projects</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sponsor') }}'><i class='nav-icon las la-hands-helping'></i> Sponsors</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coordinator') }}'><i class='nav-icon las la-phone '></i> Coordinators</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bank') }}'><i class='nav-icon las la-money-check-alt'></i> Banks</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('childprofile') }}"><i class='nav-icon las la-address-card'></i> Child Profile</a></li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-school"></i> Bio Data</a>
        <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bio') }}'><i class="nav-icon las la-school"></i> Bio Data</a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('approval1') }}"><i class='nav-icon las la-school'></i> Bio Data <b class='badge badge-success'>Approval</b></a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('approval2') }}"><i class='nav-icon las la-address-card'></i> Allocation Notices</a></li>
    
</ul>
</li>
<li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-comment"></i> Leaving Notices</a>
        <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('leaving-notice') }}'><i class="nav-icon las la-comment"></i> Leaving Notices</a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('lnapproval') }}"><i class='nav-icon las la-comment'></i> Leaving Notices <b class='badge badge-success'>Approval</b></a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('lnapproval1') }}"><i class='nav-icon las la-comment'></i> Leaving Notices <b class='badge badge-primary'>Approved</b></a></li>
</ul>
</li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('reports') }}"><i class='nav-icon las la-th-list'></i> Reports</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gift') }}'><i class='nav-icon las la-gift'></i> Gifts</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('emails') }}'><i class='nav-icon las la-envelope'></i> Emails</a></li>

    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        </ul>
    </li>
    @endrole
    @role('admin')
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('child') }}'><i class='nav-icon las la-male'></i> Children</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon las la-briefcase'></i> Projects</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sponsor') }}'><i class='nav-icon las la-hands-helping'></i> Sponsors</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coordinator') }}'><i class='nav-icon las la-phone '></i> Coordinators</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bank') }}'><i class='nav-icon las la-money-check-alt'></i> Banks</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('childprofile') }}"><i class='nav-icon las la-address-card'></i> Child Profile</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bio') }}'><i class="nav-icon las la-school"></i> Bio Data</a></li>
    
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('leaving-notice') }}'><i class="nav-icon las la-comment"></i> Leaving Notices</a></li>
    
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('reports') }}"><i class='nav-icon las la-th-list'></i> Reports</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gift') }}'><i class='nav-icon las la-gift'></i> Gifts</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('emails') }}'><i class='nav-icon las la-envelope'></i> Emails</a></li>
    @endrole

    @role('user-level1')
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('child') }}'><i class='nav-icon las la-male'></i> Children</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon las la-briefcase'></i> Projects</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sponsor') }}'><i class='nav-icon las la-hands-helping'></i> Sponsors</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coordinator') }}'><i class='nav-icon las la-phone '></i> Coordinators</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bank') }}'><i class='nav-icon las la-money-check-alt'></i> Banks</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('childprofile') }}"><i class='nav-icon las la-address-card'></i> Child Profile</a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('approval1') }}"><i class='nav-icon las la-school'></i> Bio Data <b class='badge badge-success'>Approval</b></a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('lnapproval') }}"><i class='nav-icon las la-comment'></i> Leaving Notices <b class='badge badge-success'>Approval</b></a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('reports') }}"><i class='nav-icon las la-th-list'></i> Reports</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gift') }}'><i class='nav-icon las la-gift'></i> Gifts</a></li>
    
    @endrole

    @role('user-level2')
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('child') }}'><i class='nav-icon las la-male'></i> Children</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon las la-briefcase'></i> Projects</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sponsor') }}'><i class='nav-icon las la-hands-helping'></i> Sponsors</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('coordinator') }}'><i class='nav-icon las la-phone '></i> Coordinators</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('bank') }}'><i class='nav-icon las la-money-check-alt'></i> Banks</a></li>
  <li class='nav-item'><a class='nav-link' href="{{ backpack_url('childprofile') }}"><i class='nav-icon las la-address-card'></i> Child Profile</a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('approval2') }}"><i class='nav-icon las la-address-card'></i> Allocation Notices</a></li>
        <li class='nav-item'><a class='nav-link' href="{{ backpack_url('lnapproval1') }}"><i class='nav-icon las la-comment'></i> Leaving Notices <b class='badge badge-primary'>Approved</b></a></li>
    <li class='nav-item'><a class='nav-link' href="{{ backpack_url('reports') }}"><i class='nav-icon las la-th-list'></i> Reports</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gift') }}'><i class='nav-icon las la-gift'></i> Gifts</a></li>

   
    @endrole