<?php

namespace App\Console\Commands\User;

use App\Entity\User;
use Illuminate\Console\Command;

class RoleCommand extends Command
{
    protected $signature = 'user:role {email} {role}';

    protected $description = 'Change user role';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $role = $this->argument('role');
        $email = $this->argument('email');

        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user wuth email ' . $email);
            return false;
        }
        try {
            $user->changeRole($role);
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
        }

        $this->info('Role is successfully changed');
        return true;
    }
}
