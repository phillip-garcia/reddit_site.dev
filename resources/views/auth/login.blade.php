@extends('layouts.master')

@section('content')
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Login to site.com</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="well">

                        <form id="loginForm" method="POST" action="/auth/login/" novalidate="novalidate">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="email" class="control-label">Username</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        id="email">
                                @include('forms.error', ['field' => 'email'])                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        id="password">
                                @include('forms.error', ['field' => 'username'])                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember"> Remember login
                                </label>
                                <p class="help-block">(if this is a private computer)</p>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                            <a href="/forgot/" class="btn btn-default btn-block">Help to login</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop