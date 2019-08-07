<?php

namespace App\Entity;

use App\Entity\Adverts\Advert\Advert;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $status
 * @property string $phone
 * @property bool $phone_verified
 * @property bool $role
 * @property bool $phone_auth
 * @property string $phone_verify_token
 * @property Carbon $phone_verify_token_expire
 * @property mixed password
 * @method static orderBy(string $string, string $string1)
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_USER = 'user';

    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'password', 'status', 'verify_code', 'role', 'phone_auth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'phone_verified' => 'boolean',
        'phone_verify_token_expire' => 'datetime'
    ];

    public static function rolesList(): array
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_MODERATOR => 'Moderator',
            self::ROLE_USER => 'User'
        ];
    }

    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name' => $name,
            'last_name' => '',
            'email' => $email,
            'password' => bcrypt($password),
            'verify_code' => Str::uuid(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_WAIT
        ]);
    }

    public static function new($name, $email): self
    {
        return static::create([
            'name' => $name,
            'last_name' => '',
            'email' => $email,
            'password' => bcrypt(Str::random()),
            'verify_code' => Str::uuid(),
            'role' => self::ROLE_USER,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isPhoneAuthEnabled(): bool
    {
        return $this->phone_auth == 1;
    }

    public function enabledPhoneAuth()
    {
        $this->update([
            'phone_auth' => true
        ]);
    }

    public function disabledPhoneAuth()
    {
        $this->update([
            'phone_auth' => false
        ]);
    }

    public function hasFailedProfile()
    {
        return (empty($this->name) || empty($this->last_name) || !$this->isPhoneVerified()) ? false : true;
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User already verified');
//             back()->with('error','User already verified');
        }

        $this->update([
            'status' => self::STATUS_ACTIVE,
            'verify_code' => null
        ]);
    }

    public function changeRole($role): void
    {
        if (!in_array($role, self::rolesList(), true)) {
            throw new \InvalidArgumentException('Undefined role "' . $role . '""');
        }
        if ($this->role === $role) {
            throw new \DomainException('Role is already assigned');
        }

        $this->update(['role' => $role]);
    }

    public function unverifyPhone(): void
    {
        $this->phone_verified = false;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    public function isPhoneVerified(): bool
    {
        return $this->phone_verified;
    }

    public function requestPhoneVerification(Carbon $now): string
    {
        if (empty($this->phone)) {
            throw new \DomainException('Phone number is empty');
        }

        if (!empty($this->phone_verify_token) && $this->phone_verify_token_expire && $this->phone_verify_token_expire->gt($now)) {
            throw new \DomainException('Token is already requested');
        }

        $this->phone_verified = false;
        $this->phone_verify_token = (string)random_int(10000, 999999);
        $this->phone_verify_token_expire = $now->copy()->addSeconds(300);
        $this->saveOrFail();

        return $this->phone_verify_token;
    }

    public function verifyPhone($token, Carbon $now): void
    {
        if ($token != $this->phone_verify_token) {
            throw new \DomainException('Incorrect verify token');
        }

        if ($this->phone_verify_token_expire->lt($now)) {
            throw new \DomainException('Token is expired');
        }

        $this->phone_verified = true;
        $this->phone_verify_token = null;
        $this->phone_verify_token_expire = null;
        $this->saveOrFail();
    }

    public function favorites()
    {
        return $this->belongsToMany(Advert::class, 'advert_favorites', 'user_id', 'advert_id');
    }

}
