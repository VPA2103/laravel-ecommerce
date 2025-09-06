@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Review</h2>
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
              <a href="{{ route('user.account.address') }}" class="menu-link d-flex align-items-center">
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
          <div class="page-content my-account__address">
            <div class="row">
              <div class="col-6">
                <h3 class="notice">Review for.</h3>
                <style>
                  .pname {
                    display: grid;
                    padding: 2rem;
                    grid-template-columns: 130px 1fr;
                    gap: 1rem;
                    align-items: center;
                    max-width: 800px;
                    margin: 0 auto;
                    font: 500 100%/1.5 system-ui;
                  }

                  .pname .name {
                    max-width: 100%;
                    height: auto;
                  }
                </style>
                <style>
                  .star-rating {
                    display: flex;
                    justify-content: space-between;
                    margin: 20px;
                  }

                  .star-rating input[type="radio"] {
                    display: none;
                  }

                  .star-rating label {
                    font-size: 24px;
                    color: #ccc;
                    cursor: pointer;
                  }

                  .star-rating label:hover {
                    color: #ffd700;
                  }

                  .star-rating input[type="radio"].checked-label+label {
                    color: #ffd700;
                  }

                  .checked-label {
                    color: #ffd700;
                  }
                </style>
                <div class="pname">
                  <div class="image">
                    <img src="http://localhost:8000/uploads/products/thumbnails/1718066538.jpg" alt="" class="image">
                  </div>
                  <div class="name">
                    <a href="#" target="_blank" class="body-title-2">Product1</a>
                  </div>
                </div>
              </div>
              <div class="col-6 text-right">
                <a href="#" class="btn btn-sm btn-danger">Back</a>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="col-md-6">
                  <div class="star-rating">
                    <input type="radio" id="star-1" class="checked-label" name="rating" value="1">
                    <label for="star-1"><i class="fa fa-star"></i></label>
                    <input type="radio" id="star-2" class="checked-label" name="rating" value="2">
                    <label for="star-2"><i class="fa fa-star"></i></label>
                    <input type="radio" id="star-3" class="checked-label" name="rating" value="3">
                    <label for="star-3"><i class="fa fa-star"></i></label>
                    <input type="radio" id="star-4" class="checked-label" name="rating" value="4">
                    <label for="star-4"><i class="fa fa-star"></i></label>
                    <input type="radio" id="star-5" class="checked-label" name="rating" value="5">
                    <label for="star-5"><i class="fa fa-star"></i></label>
                  </div>
                </div>
                <p>New review for product 1. Best Product in this price range.</p>
                <form action="#" method="POST">
                  <button type="submit" class="btn btn-danger btn-sm">Remove Review</button>
                </form>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-md-8">
                <div class="card mb-5">
                  <div class="card-header">
                    <h5>Add Review</h5>
                  </div>
                  <div class="card-body">
                    <form action="#" method="POST">                    
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-floating my-3">
                            <label for="rating">Rating *</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="star-rating">
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4"><i class="fa fa-star"></i></label>
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5"><i class="fa fa-star"></i></label>
                          </div>
                        </div>

                        <div class="col-md-12 mt-5">
                          <div class="form-floating my-3">
                            <textarea class="form-control" name="comment" style="height:165px;"></textarea>
                            <label for="comments">Comments *</label>
                            <span class="text-danger">
                            </span>
                          </div>
                        </div>
                        <div class="col-md-12 text-right">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection