<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class Investors extends Model implements AuthAuthenticatable, CanResetPassword
{
    use Notifiable;
    use Authenticatable;


    protected $guarded = [];
    protected $table = "investors";
    public function getEmailForPasswordReset()
    {
        return $this->email; // Assuming 'email' is the column in your database that stores the email address of the warehouse user.
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotificationInvestor($token));
    }
}
