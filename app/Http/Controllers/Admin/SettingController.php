<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //seo page show method
    public function seo()
    {
        $data = DB::table('seos')->first();
        return view('admin.setting.seo', compact('data'));
    }

    //update seo method
    public function seoUpdate(Request $request, $id)
    {
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_adsense'] = $request->google_adsense;

        DB::table('seos')->where('id', $id)->update($data);

        $notification = array('messege' => 'SEO Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //website setting page
    public function website()
    {
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('setting'));
    }

    //website update
    public function websiteUpdate(Request $request, $id)
    {
        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;

        if ($request->logo) {
            // working with image
            $logo = $request->logo;
            $logo_name = uniqid() . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(240, 120)->save(public_path('files/setting/') . $logo_name); // image intervention
            $data['logo'] = 'files/setting/' . $logo_name;
        } else {
            $data['logo'] = $request->old_logo;
        };

        if ($request->favicon) {
            // working with image
            $favicon = $request->logo;
            $favicon_name = uniqid() . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save(public_path('files/setting/') . $favicon_name); // image intervention
            $data['favicon'] = 'files/setting/' . $favicon_name;
        } else {
            $data['favicon'] = $request->old_favicon;
        };

        DB::table('settings')->where('id', $id)->update($data);
        $notification = array('messege' => 'Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //smtp setting page
    public function smtp()
    {
        $smtp = DB::table('smtp')->first();
        return view('admin.setting.smtp', compact('smtp'));
    }

    //smtp update
    public function smtpUpdate(Request $request)
    {
        // $data = array();
        // $data['mailer'] = $request->MAIL_MAILER;
        // $data['host'] = $request->MAIL_HOST;
        // $data['port'] = $request->MAIL_PORT;
        // $data['user_name'] = $request->MAIL_USERNAME;
        // $data['password'] = $request->MAIL_PASSWORD;

        // DB::table('smtp')->where('id', $id)->update($data);

        // $notification = array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        // return redirect()->back()->with($notification);

        foreach ($request->types as $key => $type) {
            $this->updateEnvFile($type, $request[$type]);
        }
        $notification = array('messege' => 'SMTP Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function updateEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents(
                    $path,
                    str_replace(
                        $type . '="' . env($type) . '"',
                        $type . '=' . $val,
                        file_get_contents($path)
                    )
                );
            } else {
                file_put_contents($path, file_get_contents($path) . $type . '=' . $val);
            }
        }
    }
}