<?php

namespace App\Http\Controllers;

use App\Models\MarketingCampaign;
use App\Models\Lead;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index() { return view('marketing.index'); }
    public function campaigns() { return view('marketing.index', ['campaigns' => MarketingCampaign::latest()->paginate(20)]); }
    public function createCampaign() { return view('marketing.index'); }
    public function storeCampaign(Request $request) { return redirect()->route('marketing.campaigns'); }
    public function showCampaign(MarketingCampaign $campaign) { return view('marketing.index'); }
    public function updateCampaign(Request $request, MarketingCampaign $campaign) { return redirect()->route('marketing.campaigns'); }
    public function socialScheduler() { return view('marketing.index'); }
    public function schedulePost(Request $request) { return redirect()->route('marketing.social-scheduler'); }
    public function events() { return view('marketing.index'); }
    public function storeEvent(Request $request) { return redirect()->route('marketing.events'); }
    public function leads() { return view('marketing.index', ['leads' => Lead::latest()->paginate(20)]); }
    public function storeLead(Request $request) { return redirect()->route('marketing.leads'); }
}
