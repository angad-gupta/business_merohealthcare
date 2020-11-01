<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\UserResetPasswordNotification;
use App\Notifications\UserVerificationNotification;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
   
    use HasApiTokens, Notifiable;

    protected $guard = 'user';

    protected $fillable = ['name', 'photo', 'zip', 'residency', 'city', 'address','latlong', 'phone', 'fax', 'email','password','shop_name','owner_name','shop_number','shop_address','reg_number','shop_message','is_vendor','shop_details','f_url','g_url','t_url','l_url','f_check','g_check','t_check','l_check','shipping_cost','affilate_code','activation_code','service_areas','nearest_landmark','address_type','pan_number'];

    protected $hidden = [
        'password'
    ];  

    protected $remember_token = false;  

    public function prescriptions()
    {
        return $this->hasMany('App\Prescription');
    }

    public function family()
    {
        return $this->hasMany('App\Family');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function vendororders()
    {
        return $this->hasMany('App\VendorOrder');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    public function subreplies()
    {
        return $this->hasMany('App\SubReply');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
    public function favorites()
    {
        return $this->hasMany('App\FavoriteSeller');
    }
    public function socialProviders()
    {
        return $this->hasMany(SocialProvider::class);
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function labProducts()
    {
        return $this->hasMany('Modules\Lab\Entities\LabProductUser');
    }

    public function sliders()
    {
        return $this->hasMany('App\VendorSlider');
    }
    public function IsVendor(){
        if ($this->is_vendor == 2) {
           return true;
        }
        return false;
    }
    
    public function descriptions(){
        return $this->hasOne('App\VendorDescription');
    }

    public function withdraws()
    {
        return $this->hasMany('App\Withdraw');
    }
    public function senders()
    {
        return $this->hasMany('App\Conversation','sent_user');
    }
    public function recievers()
    {
        return $this->hasMany('App\Conversation','recieved_user');
    }
    public function conversations()
    {
        return $this->hasMany('App\AdminUserConversation');
    }
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    public function notivications()
    {
        return $this->hasMany('App\Notification','vendor_id');
    }
    public function subscribes()
    {
        return $this->hasMany('App\UserSubscription');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserVerificationNotification());
    }

    public function getPhotoUrlAttribute()
    {
        return "https://merohealthcare.com/assets/images/"+$this->photo;
    }
}
