<div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907" id="sidebar-id">
    <p class="tittle-list-sidebar mt-4">View Data</p>
    <a href="#" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datamember.png')}}" alt="" width="30" />
        <p class="m-0">Data Member</p>
    </a>
    <a href="#" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datamember.png')}}" alt="" width="30" />
        <p class="m-0">Data Mentor</p>
    </a>
    <a href="" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datamember.png')}}" alt="" width="30" />
        <p class="m-0">Data Super Admin</p>
    </a>
    {{-- <a href="#" class="list-sidebar">
        <img src="img/datamember.png" alt="" width="30" />
        <p class="m-0 text-white">Pengajuan Mentor</p>
    </a> --}}

    <p class="tittle-list-sidebar mt-4">Learn</p>
    <a href="{{route('admin.course')}}" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datacourses.png')}}" alt="" width="30" />
        <p class="m-0">Courses</p>
    </a>
    <a href="{{route('admin.category')}}" class="list-sidebar">
        <img src="{{ asset('nemolab/admin/img/datacourses.png')}}" alt="" width="30" />
        <p class="m-0">Category</p>
    </a>
</div>
