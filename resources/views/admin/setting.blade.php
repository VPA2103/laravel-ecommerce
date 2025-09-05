@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Settings</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Brands</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="name" name="name"
                        tabindex="0" value="{{ old('name', Auth::user()->name) }}" aria-required="true" required="">
                </fieldset>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <fieldset class="mobile">
                    <div class="body-title">Mobile<span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Mobile" name="mobile"
                        tabindex="0" value="{{ old('mobile', Auth::user()->mobile) }}" required>
                </fieldset>
                @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <fieldset class="email">
                    <div class="body-title">Email<span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="email" name="email"
                        tabindex="0" value="{{ old('email', Auth::user()->email) }}" aria-required="true" readonly>
                </fieldset>
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="col-md-12">
                    <div class="my-3">
                      <h5 class="text-uppercase mb-0">Password Change</h5>
                    </div>
                  </div>
                <fieldset class="old_password">
                    <div class="body-title">Old Password</div>
                    <input type="password" placeholder="old password" name="old_password" autocomplete="new-password">
                </fieldset>
                @error('old_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <fieldset class="new_password">
                    <div class="body-title">New Password</div>
                    <input type="password" placeholder="new password" name="new_password" autocomplete="new-password">
                </fieldset>
                @error('new_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <fieldset class="new_password_confirmation">
                    <div class="body-title">Confirm New Password</div>
                    <input type="password" placeholder="confirm new password" name="new_password_confirmation" autocomplete="new-password">
                </fieldset>
                @error('confilm_new_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('.delete').on('click',function(e){
            e.preventDefault();
            var form= $(this).closest('form');
            swal({
                title: 'Are you sure?',
                text: "You want to delete this brand?",
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