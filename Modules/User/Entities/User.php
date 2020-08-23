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
     *     property="id",
     *     ref="#/components/schemas/BaseModel/properties/id")
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Active",
     *     description="Active",
     *     type="string",
     *     enum={"Y","N"}
     * )
     *
     * @var string
     */
    private $active;

    /**
     * @OA\Property(
     *     title="Firstname",
     *     description="Firstname",
     *     type="string"
     * )
     *
     * @var string
     */
    private $firstname;

    /**
     * @OA\Property(
     *     title="Lastname",
     *     description="Lastname",
     *     type="string"
     * )
     *
     * @var string
     */
    private $lastname;

    /**
     * @OA\Property(
     *     title="Email",
     *     description="Email",
     *     type="string",
     *     format="email"
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="Password",
     *     type="string"
     * )
     *
     * @var string
     */
    private $password;

    /**
     * @OA\Property(
     *     property="created_at",
     *     ref="#/components/schemas/BaseModel/properties/created_at")
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     property="updated_at",
     *     ref="#/components/schemas/BaseModel/properties/updated_at")
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *     title="Email verified at",
     *     description="Email verified at",
     *     type="string",
     *     format="date-time",
     *     example="2020-01-27 17:50:45"
     * )
     *
     * @var \DateTime
     */
    private $email_verified_at;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'firstname', 'lastname', 'email', 'password', 'avatar', 'last_login_at', 'last_login_ip'];

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
