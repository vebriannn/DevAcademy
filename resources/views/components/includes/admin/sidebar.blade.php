<div class="col-3 d-none d-lg-block p-4 rounded-4 text-white scroll-sidebar" style="background-color: #faa907" id="sidebar-id">
    @if (Auth::user()->role == 'superadmin')
        <p class="tittle-list-sidebar mt-4 mb-4">View Data</p>
        <a href="{{ route('admin.member') }}"
            class="list-sidebar {{ request()->is('admin/user/member') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/member') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Member</p>
        </a>
        <a href="{{ route('admin.mentor') }}"
            class="list-sidebar {{ request()->is('admin/user/mentor') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/mentor') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Mentor</p>
        </a>
        <a href="{{ route('admin.superadmin') }}"
            class="list-sidebar {{ request()->is('admin/user/superadmin') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin/user/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
                alt="" width="30" />
            <p class="m-0">Data Super Admin</p>
        </a>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datapengajuanmentor.png') }}" alt="" width="30" />
            <p class="m-0">Pengajuan Mentor</p>
        </a>
        {{-- <p class="tittle-list-sidebar mt-4 mb-4">Learn</p>
        <a href="{{ route('admin.course') }}" class="list-sidebar {{ request()->is('admin') ? 'active' : '' }}">
            <img src="{{ asset(request()->is('admin') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
            <p class="m-0">Courses Video</p>
        </a>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
            <p class="m-0">Courses Ebook</p>
        </a>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datalesson.png') }}" alt="" width="30" />
            <p class="m-0">Lesson</p>
        </a>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datachapter.png') }}" alt="" width="30" />
            <p class="m-0">Chapter</p>
        </a>
        <p class="tittle-list-sidebar mt-4 mb-4">Data User</p>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datachapter.png') }}" alt="" width="30" />
            <p class="m-0">Chapter</p>
        </a>
        <p class="tittle-list-sidebar mt-4 mb-4">Category</p>
        <a href="" class="list-sidebar">
            <img src="{{ asset('nemolab/admin/img/datacategory.png') }}" alt="" width="30" />
            <p class="m-0">Category</p>
        </a> --}}

    @endif 
    {{-- <a href="#" class="list-sidebar">
        <img src="img/datamember.png" alt="" width="30" />
        <p class="m-0 text-white">Pengajuan Mentor</p>
    </a> --}}
    
    <p class="tittle-list-sidebar">Course</p>
    <a href="{{ route('admin.course') }}" class="list-sidebar {{ request()->is('admin') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
        <p class="m-0">Courses Video</p>
    </a>
    <a href="" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
        <p class="m-0">Courses Ebook</p>
    </a>
    <a href="{{ route('admin.category') }}" class="list-sidebar {{ request()->is('admin/category') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/category') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
        <p class="m-0">Category</p>
    </a>
    <a href="{{ route('admin.transaction') }}" class="list-sidebar {{ request()->is('admin/course/transaction') ? 'active' : '' }}">
        <img src="{{ asset(request()->is('admin/course/transaction') ? 'nemolab/admin/img/datacourses-active.png' : 'nemolab/admin/img/datacourses.png') }}" alt="" width="30" />
        <p class="m-0">Transaction</p>
    </a>
    <p class="tittle-list-sidebar mt-5">View Data</p>
    <a href="{{ route('admin.superadmin') }}"
    class="list-sidebar {{ request()->is('admin/user/superadmin') ? 'active' : '' }}">
    <img src="{{ asset(request()->is('admin/user/superadmin') ? 'nemolab/admin/img/datamember-active.png' : 'nemolab/admin/img/datamember.png') }}"
        alt="" width="30" />
    <p class="m-0">Data Portofolio</p>
</a>
</div>
