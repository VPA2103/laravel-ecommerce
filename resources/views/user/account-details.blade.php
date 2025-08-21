@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Account Details</h2>
      <div class="row">
        <div class="col-lg-3">
                <ul class="account-nav">
            <li>
                <a href="{{ route('user.index') }}" class="menu-link d-flex align-items-center">
                    <i class="icon-grid me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.orders')}}" class="menu-link d-flex align-items-center">
                    <i class="icon-shopping-cart me-2"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="account-address.html" class="menu-link d-flex align-items-center">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>Addresses</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.account.details')}}" class="menu-link d-flex align-items-center">
                    <i class="icon-user me-2"></i>
                    <span>Account Details</span>
                </a>
            </li>
            <li>
                <a href="{{route('wishlist.index')}}" class="menu-link d-flex align-items-center">
                    <i class="icon-heart me-2"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" class="menu-link d-flex align-items-center"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="icon-log-out me-2"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__edit">
            <div class="my-account__edit-form">

              {{-- Hiển thị thông báo thành công / lỗi --}}
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              @if($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form name="account_edit_form" action="{{ route('account.update') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-floating my-3">
                      <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name', $user->name) }}" required>
                      <label for="name">Name</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ old('mobile', $user->mobile) }}">
                      <label for="mobile">Phone</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="email" class="form-control" name="email" id="account_email" 
                            value="{{ $user->email }}" readonly>
                      <label for="account_email">Email</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="my-3">
                      <h5 class="text-uppercase mb-0">Password Change</h5>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="Old password" class="form-control" id="old_password" name="old_password"
                        placeholder="Old password" autocomplete="off">
                      <label for="old_password">Old password</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="new_password" class="form-control" id="new_password" name="new_password"
                        placeholder="New password">
                      <label for="account_new_password">New password</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-floating my-3">
                      <input type="confirmation_password" class="form-control"
                        id="new_password_confirmation" name="new_password_confirmation"
                        placeholder="Confirm new password">
                      <label for="new_password_confirmation">Confirm new password</label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="my-3">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection