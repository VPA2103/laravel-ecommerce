@extends('layouts.app')
@section('content')

<style>
    .delete {
    cursor: pointer;


}
</style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Addresses</h2>
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
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="col-6">
                                <p class="notice">The following addresses will be used on the checkout page by default.</p>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('user.account.address.add') }}" class="btn btn-sm btn-info">Add New</a>
                            </div>
                        </div>
                        <div class="my-account__address-list row">
                            <h5>Shipping Address</h5>
                            @foreach ($addresses as $address)
                                <div class="my-account__address-item col-md-6">
                                    <div class="my-account__address-item__title">
                                        <h5>{{$address->name}} <i class="fa fa-check-circle text-success"></i></h5>
                                        <div>
                                            <a href="{{ route('user.address.edit', $address->id) }}">
                                                <div class="item edit" style="cursor: pointer; color: green;">
                                                    <i class="icon-edit-3"></i> Edit
                                                </div>
                                            </a>                                            
                                            <form action="{{ route('user.address.delete', $address->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete" >
                                                    <i class="icon-trash-2"></i> Delete
                                                </div>
                                            </form>
                                        </div>              
                                    </div>
                                    <div class="my-account__address-item__detail">
                                        <p>{{$address->address}}</p>
                                        <p>{{$address->locality}}</p>
                                        <p>{{$address->city}},{{$address->country}}</p>
                                        <p>{{$address->landmark}}</p>
                                        <p>{{$address->zip}}</p>
                                        <br>
                                        <p>Mobile : {{$address->phone}}</p>
                                    </div>
                                </div>
                            @endforeach

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
    $(function(){
        $('.delete').on('click',function(e){
            e.preventDefault();
            var form= $(this).closest('form');
            swal({
                title: 'Are you sure?',
                text: "You want to delete this address?",
                type: 'warning',
                buttons: ["Cancel","Yes"],
                confirmButtonColor: '#dc3545',
            }).then(function(result){
                if(result){
                    form.submit();
                }
            })
        })
    })
</script>
@endpush