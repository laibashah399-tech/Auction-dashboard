<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('settings.index', compact('settings'));
    }


    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => [
                'required',
                'string',
                'max:255',
            ],

            'admin_email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'currency' => [
                'required',
                'string',
                'max:10',
            ],

            'timezone' => [
                'required',
                'string',
                'max:100',
            ],

            'site_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'email_notifications' => [
                'nullable',
                'boolean',
            ],

            'system_notifications' => [
                'nullable',
                'boolean',
            ],

            'auction_auto_approval' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Boolean Settings
        |--------------------------------------------------------------------------
        */

        $validated['email_notifications'] =
            $request->has('email_notifications') ? '1' : '0';

        $validated['system_notifications'] =
            $request->has('system_notifications') ? '1' : '0';

        $validated['auction_auto_approval'] =
            $request->has('auction_auto_approval') ? '1' : '0';


        /*
        |--------------------------------------------------------------------------
        | Save Settings
        |--------------------------------------------------------------------------
        */

        foreach ($validated as $key => $value) {

            Setting::updateOrCreate(
                [
                    'key' => $key,
                ],
                [
                    'value' => $value,
                ]
            );
        }


        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Settings updated successfully.'
            );
    }
}