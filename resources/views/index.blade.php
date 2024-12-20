@extends('layout.main')
@section('title')
    Dashboard
@endsection
@section('page-name')
Dashboard
@endsection
@section('content')
<div class="row">
<!-- Top Products by -->
  <div class="col-12 col-lg-8 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-6">
          <div class="card-header d-flex align-items-center justify-content-between mb-4">
            <h5 class="card-title m-0 me-2">Top Products by <span class="text-primary">Sales</span></h5>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="topSales"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topSales">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/oneplus.png')}}" alt="oneplus" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Oneplus Nord</h6>
                    <small class="text-muted d-block mb-1">Oneplus</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <span class="fw-bold">$98,348</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{('assets/img/icons/unicons/watch-primary.png')}}" alt="smart band" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Smart Band 4</h6>
                    <small class="text-muted d-block mb-1">Xiaomi</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <span class="fw-bold">$15,459</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{('assets/img/icons/unicons/surface.png')}}" alt="Surface" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Surface Pro X</h6>
                    <small class="text-muted d-block mb-1">Miscrosoft</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <span class="fw-bold">$4,589</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/iphone.png')}}" alt="iphone" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">iphone 13</h6>
                    <small class="text-muted d-block mb-1">Apple</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <span class="fw-bold">$84,345</span>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/earphone.png')}}" alt="Bluetooth Earphone" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Bluetooth Earphone</h6>
                    <small class="text-muted d-block mb-1">Beats</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <span class="fw-bold">$10,374</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-header d-flex align-items-center justify-content-between mb-4">
            <h5 class="card-title m-0 me-2">Top Products by <span class="text-primary">Volume</span></h5>
            <div class="dropdown">
              <button
                class="btn p-0"
                type="button"
                id="topVolume"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topVolume">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img
                    src="{{url('assets/img/icons/unicons/laptop-secondary.png')}}"
                    alt="ENVY Laptop"
                    class="rounded"
                  />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">ENVY Laptop</h6>
                    <small class="text-muted d-block mb-1">HP</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-3">
                    <span class="fw-semibold">124k</span>
                    <span class="badge bg-label-success">+12.4%</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/computer.png')}}" alt="Apple" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Apple</h6>
                    <small class="text-muted d-block mb-1">iMac Pro</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-3">
                    <span class="fw-semibold">74.9k</span>
                    <span class="badge bg-label-danger">-8.5%</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/watch.png')}}" alt="Smart Watch" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Smart Watch</h6>
                    <small class="text-muted d-block mb-1">Fitbit</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-3">
                    <span class="fw-semibold">4.4k</span>
                    <span class="badge bg-label-success">+62.6%</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img
                    src="{{url('assets/img/icons/unicons/oneplus-success.png')}}"
                    alt="Oneplus RT"
                    class="rounded"
                  />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Oneplus RT</h6>
                    <small class="text-muted d-block mb-1">Oneplus</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-3">
                    <span class="fw-semibold">12,3k.71</span>
                    <span class="badge bg-label-success">+16.7%</span>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{url('assets/img/icons/unicons/pixel.png')}}" alt="Pixel 4a" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Pixel 4a</h6>
                    <small class="text-muted d-block mb-1">Google</small>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-3">
                    <span class="fw-semibold">834k</span>
                    <span class="badge bg-label-danger">-12.9%</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Top Products by -->
<!-- Earning Reports -->
<div class="col-md-6 col-lg-4 col-xl-4 mb-4">
  <div class="card h-100">
    <div class="card-header d-flex justify-content-between">
      <div class="card-title mb-0">
        <h5 class="m-0 me-2">Earning Reports</h5>
        <small class="text-muted">Weekly Earnings Overview</small>
      </div>
      <div class="dropdown">
        <button
          class="btn p-0"
          type="button"
          id="earningReports"
          data-bs-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReports">
          <a class="dropdown-item" href="javascript:void(0);">Select All</a>
          <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
          <a class="dropdown-item" href="javascript:void(0);">Share</a>
        </div>
      </div>
    </div>
    <div class="card-body pb-0">
      <ul class="p-0 m-0">
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-primary"
              ><i class="bx bx-trending-up"></i
            ></span>
          </div>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <h6 class="mb-0">Net Profit</h6>
              <small class="text-muted">12.4k Sales</small>
            </div>
            <div class="user-progress">
              <small class="fw-semibold">$1,619</small
              ><i class="bx bx-chevron-up text-success ms-1"></i>
              <small class="text-muted">18.6%</small>
            </div>
          </div>
        </li>
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-dollar"></i></span>
          </div>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <h6 class="mb-0">Total Income</h6>
              <small class="text-muted">Sales, Affiliation</small>
            </div>
            <div class="user-progress">
              <small class="fw-semibold">$3,571</small
              ><i class="bx bx-chevron-up text-success ms-1"></i>
              <small class="text-muted">39.6%</small>
            </div>
          </div>
        </li>
        <li class="d-flex mb-4 pb-1">
          <div class="avatar flex-shrink-0 me-3">
            <span class="avatar-initial rounded bg-label-secondary"
              ><i class="bx bx-credit-card"></i
            ></span>
          </div>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <h6 class="mb-0">Total Expenses</h6>
              <small class="text-muted">ADVT, Marketing</small>
            </div>
            <div class="user-progress">
              <small class="fw-semibold">$430</small><i class="bx bx-chevron-up text-success ms-1"></i>
              <small class="text-muted">52.8%</small>
            </div>
          </div>
        </li>
      </ul>
      <div id="reportBarChart"></div>
    </div>
  </div>
</div>

   <!-- Team Members -->
   <div class="col-md-6 col-lg-5 mb-md-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Team Members</h5>
        <div class="dropdown">
          <button
            class="btn p-0"
            type="button"
            id="teamMemberList"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>Name</th>
              <th>Project</th>
              <th>Task</th>
             
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="{{url('assets/img/avatars/17.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Nathan Wagner</h6>
                    <small class="text-truncate text-muted">iOS Developer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-primary rounded-pill text-uppercase">Zipcar</span></td>
              <td><small class="fw-semibold">87/135</small></td>
              <td>
                <div class="chart-progress" data-color="primary" data-series="65"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="{{url('assets/img/avatars/8.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Emma Bowen</h6>
                    <small class="text-truncate text-muted">UI/UX Designer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-danger rounded-pill text-uppercase">Bitbank</span></td>
              <td><small class="fw-semibold">320/440</small></td>
              <td>
                <div class="chart-progress" data-color="danger" data-series="85"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded-circle bg-label-warning">AM</span>
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Adrian McGuire</h6>
                    <small class="text-truncate text-muted">PHP Developer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-warning rounded-pill text-uppercase">Payers</span></td>
              <td><small class="fw-semibold">50/82</small></td>
              <td>
                <div class="chart-progress" data-color="warning" data-series="73"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="{{url('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Alma Gonzalez</h6>
                    <small class="text-truncate text-muted">Product Manager</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-info rounded-pill text-uppercase">Brandi</span></td>
              <td><small class="fw-semibold">98/260</small></td>
              <td>
                <div class="chart-progress" data-color="info" data-series="61"></div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex justify-content-start align-items-center">
                  <div class="avatar me-2">
                    <img src="{{url('assets/img/avatars/11.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-truncate">Allan kristian</h6>
                    <small class="text-truncate text-muted">Frontend Designer</small>
                  </div>
                </div>
              </td>
              <td><span class="badge bg-label-success rounded-pill text-uppercase">Crypter</span></td>
              <td><small class="fw-semibold">690/760</small></td>
              <td>
                <div class="chart-progress" data-color="success" data-series="77"></div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Team Members -->

 <!-- Customer Table -->
 <div class="col-md-6 col-lg-7 mb-0">
  <div class="card">
    <div class="card-datatable table-responsive">
      <table class="invoice-list-table table border-top">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Amount</th>
            <th>Status</th>
            <th class="cell-fit">Paid By</th>
            <th class="cell-fit">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <img src="{{url('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >Henry Barnes</a
                  >
                  <small class="text-truncate text-muted">jok@puc.co.uk</small>
                </div>
              </div>
            </td>
            <td>$459.65</td>
            <td><span class="badge bg-label-success"> Paid </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/master-light.png')}}"
                class="img-fluid"
                width="50"
                alt="masterCard"
                data-app-light-img="icons/payments/master-light.png"
                data-app-dark-img="icons/payments/master-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <img src="{{url('assets/img/avatars/20.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >Hallie Warner</a
                  >
                  <small class="text-truncate text-muted">hellie@war.co.uk</small>
                </div>
              </div>
            </td>
            <td>$93.81</td>
            <td><span class="badge bg-label-warning"> Pending </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/visa-light.png')}}"
                class="img-fluid"
                width="50"
                alt="visaCard"
                data-app-light-img="icons/payments/visa-light.png"
                data-app-dark-img="icons/payments/visa-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <img src="{{url('assets/img/avatars/9.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >Gerald Flowers</a
                  >
                  <small class="text-truncate text-muted">initus@odemi.com</small>
                </div>
              </div>
            </td>
            <td>$934.35</td>
            <td><span class="badge bg-label-warning"> Pending </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/visa-light.png')}}"
                class="img-fluid"
                width="50"
                alt="visaCard"
                data-app-light-img="icons/payments/visa-light.png"
                data-app-dark-img="icons/payments/visa-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <img src="{{url('assets/img/avatars/14.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >John Davidson</a
                  >
                  <small class="text-truncate text-muted">jtum@upkesja.gov</small>
                </div>
              </div>
            </td>
            <td>$794.97</td>
            <td><span class="badge bg-label-success"> Paid </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/paypal-light.png')}}"
                class="img-fluid"
                width="50"
                alt="paypalCard"
                data-app-light-img="icons/payments/paypal-light.png"
                data-app-dark-img="icons/payments/paypal-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <span class="avatar-initial rounded-circle bg-label-warning">JH</span>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >Jayden Harris</a
                  >
                  <small class="text-truncate text-muted">wipare@tin.com</small>
                </div>
              </div>
            </td>
            <td>$19.49</td>
            <td><span class="badge bg-label-success"> Paid </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/master-light.png')}}"
                class="img-fluid"
                width="50"
                alt="masterCard"
                data-app-light-img="icons/payments/master-light.png"
                data-app-dark-img="icons/payments/master-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex justify-content-start align-items-center">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-2">
                    <img src="{{url('assets/img/avatars/8.png')}}" alt="Avatar" class="rounded-circle" />
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <a href="pages-profile-user.html" class="text-body text-truncate fw-semibold"
                    >Rena Ferguson</a
                  >
                  <small class="text-truncate text-muted">nur@kaomor.edu</small>
                </div>
              </div>
            </td>
            <td>$636.27</td>
            <td><span class="badge bg-label-danger"> Failed </span></td>
            <td>
              <img
                src="{{url('assets/img/icons/payments/paypal-light.png')}}"
                class="img-fluid"
                width="50"
                alt="paypalCard"
                data-app-light-img="icons/payments/paypal-light.png"
                data-app-dark-img="icons/payments/paypal-dark.png"
              />
            </td>
            <td>
              <div class="d-flex align-items-center">
                <div class="dropdown">
                  <a
                    href="javascript:;"
                    class="btn dropdown-toggle hide-arrow text-body p-0"
                    data-bs-toggle="dropdown"
                    ><i class="bx bx-dots-vertical-rounded"></i
                  ></a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item">Edit</a>
                    <a href="javascript:;" class="dropdown-item">Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Customer Table -->
</div>
@endsection