<?php

namespace Modules\Formulaire\Entities;

use \Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Formulaire",
 *     description="Formulaire model",
 * )
 */
class Formulaire extends Model
{
    use Translatable, HasUrlPresenter;

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
    protected $fillable = ['active', 'code', 'tracking'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'resume'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    /**
     * Get the FormulaireField records associated with the Formulaire.
     */
    public function formulaire_fields()
    {
        return $this->hasMany('Modules\Formulaire\Entities\FormulaireField');
    }
}
