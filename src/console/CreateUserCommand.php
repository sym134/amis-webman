<?php

namespace jizhi\admin\console;

use Illuminate\Console\Command;
use jizhi\admin\model\AdminUser;
use jizhi\admin\model\AdminRole;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for admin panel.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $username = $this->ask('Please enter a username to login');

        $password = password_hash($this->secret('Please enter a password to login'), PASSWORD_DEFAULT);

        $name = $this->ask('Please enter a name to display');

        $roles = AdminRole::all();

        /** @var array $selected */
        $selected =
            $this->choice('Please choose a role for the user', $roles->pluck('name')->toArray(), null, null, true);

        $roles = $roles->filter(function ($role) use ($selected) {
            return in_array($role->name, $selected);
        });

        $user = new AdminUser(compact('username', 'password', 'name'));

        $user->save();

        $user->roles()->attach($roles);

        $this->info("User [$name] created successfully.");
    }
}
