@extends('layout.app')
@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3 mb-3 text-center">
                        @cache(1,50)<h1>Welcome to php-CLI</h1>@endcache
                        <LINK href="/">Home page</LINK>
                        <p>This is the default index page. Replace this with you code!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3 mb-3 text-center">
                        <h1>Any contributions you make are greatly appreciated.</h1>
                        <p>If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection