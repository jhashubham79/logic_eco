@extends('gp247-shop-front::email.layout')

@section('main')
<h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;
           font-size:19px;font-weight:bold;margin-top:0;text-align:center">
    {{$title ?? 'Welcome to Our Store'}}
</h1>

<p>Hi {{ $name ?? '' }},</p>

<p>Welcome to our site! Your account has been created successfully.</p>

<p>Here are your login details:</p>
<ul>
    <li><strong>Email:</strong> {{ $email }}</li>
    <li><strong>Password:</strong> {{ $password }}</li>
</ul>

<p>Please log in using the above credentials and change your password after your first login for security.</p>

<p>Thank you for joining us!</p>
@endsection
