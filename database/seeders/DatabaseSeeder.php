<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $admin = User::factory()->create([
            'nom' => 'ADMIN',
            'prenom' => 'admin',
            'email' => 'admin@socisso.fr',
            'password' => Hash::make('Socisso$2024$Admin')
        ]);
        Bouncer::role()->firstOrCreate(['name' => 'admin', 'title' => 'Administrateur']);
        Bouncer::role()->firstOrCreate(['name' => 'user', 'title' => 'Utilisateur']);
        Bouncer::allow('admin')->everything();
        Bouncer::allow('user')->to('view', User::class);
        Bouncer::allow('user')->to('update', User::class);
        Bouncer::allow('user')->to('delete', User::class);
        Bouncer::assign('admin')->to($admin);
        Bouncer::allow('user')->to('view-payments');
        Bouncer::allow('admin')->to(['view-payments', 'manage-payments']);
    }
}
