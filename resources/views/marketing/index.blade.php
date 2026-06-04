@extends('layouts.app')
@section('title', 'Marketing')
@section('content')
<div class="page-header"><div style="font-size:10px;letter-spacing:0.2em;text-transform:uppercase;color:rgba(201,168,76,0.5);margin-bottom:6px;">Module 09</div><h1 class="page-title">📣 Marketing</h1></div>
<div class="page-body">
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;">
    <a href="{{ route('marketing.campaigns') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Campaigns</div><div style="font-size:24px;margin-top:8px;">📢</div></a>
    <a href="{{ route('marketing.social-scheduler') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Social Scheduler</div><div style="font-size:24px;margin-top:8px;">📱</div></a>
    <a href="{{ route('marketing.events') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Events</div><div style="font-size:24px;margin-top:8px;">🎪</div></a>
    <a href="{{ route('marketing.leads') }}" class="card" style="padding:20px;text-decoration:none;display:block;"><div style="font-size:10px;letter-spacing:0.12em;text-transform:uppercase;color:rgba(201,168,76,0.5);">Leads</div><div style="font-size:24px;margin-top:8px;">🎯</div></a>
</div>
</div>
@endsection
