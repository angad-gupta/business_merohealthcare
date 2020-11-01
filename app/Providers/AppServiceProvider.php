<?php

namespace App\Providers;

use App\Admin;
use App\Advertise;
use App\Blog;
use App\Category;
use App\Classes\GeniusMailer;
use App\Currency;
use App\Generalsetting;
use App\Language;
use App\Page;
use App\Pagesetting;
use App\Product;
use App\Seotool;
use App\Sociallink;
use App\User;
use Auth;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Admin::auth_admins();
        Schema::defaultStringLength(191);

        $smtpdata = Generalsetting::find(1);
        Config::set('mail.port', $smtpdata->smtp_port);
        Config::set('mail.host', $smtpdata->smtp_host);
        Config::set('mail.username', $smtpdata->smtp_user);
        Config::set('mail.password', $smtpdata->smtp_pass);

        // $date_users = User::all();
        // foreach ($date_users as  $user) {
        //     if($user->is_vendor == 2)
        //     {
        //         $lastday = $user->date;
        //         $today = Carbon::now()->format('Y-m-d');
        //         $newday = strtotime($today);
        //         $secs = strtotime($lastday)-$newday;
        //         $days = $secs / 86400;
        //         if($days <= 5)
        //         {
        //           if($user->mail_sent == 1)
        //           {
        //             $settings = Generalsetting::find(1);
        //             if($settings->is_smtp == 1)
        //             {
        //                 $data = [
        //                     'to' => $user->email,
        //                     'type' => "subscription_warning",
        //                     'cname' => $user->name,
        //                     'oamount' => "",
        //                     'aname' => "",
        //                     'aemail' => "",
        //                 ];
        //                 $mailer = new GeniusMailer();
        //                 $mailer->sendAutoMail($data);
        //             }
        //             else
        //             {
        //             $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
        //             mail($user->email,'Your subscription plan duration will end after five days. Please renew your plan otherwise all of your products will be deactivated.Thank You.',$headers);
        //             }
        //             $user->mail_sent = 0;
        //             $user->update();                    
        //           }

        //         }
        //         if($today > $lastday)
        //         {
        //             $user->is_vendor = 1;
        //             $user->update();
        //         }
        //     }
        // }

        view()->composer('*',function($settings){
            
            $settings->with('gs', Generalsetting::find(1));
            $settings->with('sl', Sociallink::find(1));
            $settings->with('seo', Seotool::find(1));
            $settings->with('ps', Pagesetting::find(1));
            if (Session::has('language')) 
            {
                $settings->with('lang', Language::find(Session::get('language')));
            }
            else
            {
                $settings->with('lang', Language::where('is_default','=',1)->first());
            }
            if (!Session::has('popup')) 
            {
                $settings->with('visited', 1);
            }
            Session::put('popup' , 1);
            if (Session::has('currency')) 
            {
                $settings->with('curr', Currency::find(Session::get('currency')));
            }
            else
            {
                $settings->with('curr', Currency::where('is_default','=',1)->first());
            }
            
            $categories = Category::where('status','=',1)->where('cat_name','!=','Medicines')->get();
            $settings->with('categories', $categories);

            if($categories->count() > 10)
            {
                $settings->with('catgories', Category::where('status','=',1)->where('cat_name','!=','Medicines')->skip(10)->take($categories->count() - 10)->get());
            }

            $settings->with('lblogs', Blog::orderBy('created_at', 'desc')->limit(4)->get());
            $settings->with('pages', Page::orderBy('pos','asc')->get());
        });

        view()->composer('*',function(View $view){

            if(Auth::guard('user')->user()){
            $user_id = Auth::guard('user')->user();
            $wishlist = Wishlist::where(['user_id' => $user_id->id])->get()->count();
            $view->with('wishlist',$wishlist);
            }
            
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
