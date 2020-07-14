<?php

namespace Modules\User\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 * )
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasUrlPresenter, HasApiTokens, Notifiable;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Active",
     *     description="Active",
     * )
     *
     * @var string
     */
    private $active;

    /**
     * @OA\Property(
     *     title="Firstname",
     *     description="Firstname",
     * )
     *
     * @var string
     */
    private $firstname;

    /**
     * @OA\Property(
     *     title="Lastname",
     *     description="Lastname",
     * )
     *
     * @var string
     */
    private $lastname;

    /**
     * @OA\Property(
     *     title="Email",
     *     description="Email",
     *     format="email",
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     title="Email verified at",
     *     description="Email verified at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $email_verified_at;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'firstname', 'lastname', 'email', 'password', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
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
        return true;
    }
}
