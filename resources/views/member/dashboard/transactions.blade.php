@extends('components.layouts.member.dashboard')

@section('content-transactions')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/tabel.css') }}">
<div class="container">
    <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
              <img src="{{ asset('nemolab/assets/image/profile2.png') }}" alt="" width="70"
                  class="d-flex mx-lg-auto mt-3" />
              <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">Kenzo Ardiano</h4>
              <p class="m-0 fw-light">Status Member</p>
              <div class="mt-5">
                  <a href="#" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/course.png') }}" alt="" width="30" />
                      <p class="m-0">My Courses</p>
                  </a>
                  <a href="#" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/portofolio.png') }}" alt="" width="30" />
                      <p class="m-0">My Portofolio</p>
                  </a>
                  <a href="dashboard-transactions.html" class="list-sidebar active">
                      <img src="{{ asset('nemolab/assets/image/transaksi active.png') }}" alt="" width="30" />
                      <p class="m-0">Transactions</p>
                  </a>
                  <a href="#" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/setting.png') }}" alt="" width="30"/>
                      <p class="m-0">Settings</p>
                  </a>
              </div>
            </div>
            <!-- End Sidebar -->
            <!-- Tabel -->
            <div class="col-lg-9 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
                <div class="my-4">
                    <h3 class="fw-semibold text-center text-lg-start" style="color: #faa907">My Transactions</h3>
                </div>
        
                <div class="table-responsive p-3 rounded-5 border border-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center ms-3 mt-2">
                            <p class="mb-0 me-2">Show</p>
                            <select id="entries" class="form-select form-select-sm rounded-3">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <p class="mb-0 ms-2">entries</p>
                        </div>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Name</th>
                                <th>Tipe Courses</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>
                                    <a href="#" class="me-2"><img src="{{ asset('nemolab/assets/image/edit.png') }}" alt="" width="35" height="35"><a>
                                    <a href="#"><img src="{{ asset('nemolab/assets/image/delete.png') }}" alt="" width="35" height="35"></a>
                                </td>
                            </tr>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>password123</td>
                                <td>
                                    <a href="#" class="me-2"><img src="{{ asset('nemolab/assets/image/edit.png') }}" alt="" width="35" height="35"><a>
                                    <a href="#"><img src="{{ asset('nemolab/assets/image/delete.png') }}" alt="" width="35" height="35"></a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between p-1">
                        <p class="show">Showing 10 of 10</p>
                        <div class="d-flex gap-3">
                            <button class="pagination" id="prev-button">Previous</button>
                            <button class="pagination" id="next-button">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>
@endsection