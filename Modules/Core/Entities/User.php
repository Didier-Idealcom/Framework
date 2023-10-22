<?php

namespace Modules\Core\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;
use Modules\Core\Database\Factories\UserFactory;
use Modules\Core\Traits\HasDomains;
use Modules\Core\Traits\HasUrlPresenter;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *
 *     @OA\Property(
 *         property="id",
 *         ref="#/components/schemas/BaseModel/properties/id")
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         description="Active",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="lang",
 *         title="Lang",
 *         description="Lang",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="firstname",
 *         title="Firstname",
 *         description="Firstname",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="lastname",
 *         title="Lastname",
 *         description="Lastname",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         title="Email",
 *         description="Email",
 *         type="string",
 *         format="email"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         title="Password",
 *         description="Password",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         ref="#/components/schemas/BaseModel/properties/created_at")
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         ref="#/components/schemas/BaseModel/properties/updated_at")
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         title="Email verified at",
 *         description="Email verified at",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45"
 *     )
 * )
 */
class User extends Authenticatable /* implements MustVerifyEmail*/
{
    use HasApiTokens, HasDomains, HasFactory, HasProfilePhoto, HasRoles, HasUrlPresenter, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'lang', 'firstname', 'lastname', 'email', 'password', 'avatar', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api', 'profile_photo_url'];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getFullnameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function setPasswordAttribute($value)
    {
        if (! empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    /**
     * Return if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        if (! empty($this->roles)) {
            foreach ($this->roles as $role) {
                if ($role->guard_name == 'admin') {
                    return true;
                }
            }
        }

        return false;
    }
}
