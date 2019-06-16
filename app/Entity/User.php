<?php

namespace App\Entity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
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
    public const ROLE_USER = 'user';

    protected $fillable = [
        'name', 'email', 'password', 'status', 'verify_code', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name' => $name,
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
        if(!\in_array($role, [self::ROLE_USER, self::ROLE_ADMIN], true)){
            throw new \InvalidArgumentException('Undefined role "'. $role . '""');
        }
        if ($this->role === $role){
            throw new \DomainException('Role is already assigned');
        }

        $this->update(['role' => $role]);
    }
}
