<?php

namespace App\Models;

use DateTimeInterface;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail as VerifyableContract;
use Illuminate\Contracts\Auth\CanResetPassword as ResetableContract;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract, VerifyableContract, ResetableContract
{

    /**********************************************************************************************************/

        use Authenticatable, Authorizable, HasFactory, SoftDeletes, Notifiable, MustVerifyEmail, CanResetPassword;

        const CREATED_AT = 'created_at';
        const DELETED_AT = 'deleted_at';
        const UPDATED_AT = null;

        /**
         * @param \DateTimeInterface $date
         * @return string
         */
        protected function serializeDate(DateTimeInterface $date)
        {
            return $date->format('d-m-Y');
        }

        /**
         * @return string
         */
        public function receivesBroadcastNotificationsOn()
        {
            return 'auth' . '.' . $this->getKey();
        }

    /**********************************************************************************************************/

    /**
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', ];

    /**
     * @var array
     */
    protected $hidden = [ 'password', 'email_verified_at', ];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return '@' . $this->attributes['name'];
    }

    /**
     * @param string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }
}