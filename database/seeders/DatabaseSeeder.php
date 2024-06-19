<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'admin',
            'lastname' => '',
            'email' => 'admin@techzone.vn',
            'username' => 'admin',
            'image' => 'avatar.jpg',
            'password' => bcrypt('admin'),
            'active' => 1,

            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'firstname' => 'Khách hàng không đăng nhập',
            'lastname' => '',
            'email' => 'null',
            'username' => 'guest_customer',
            'image' => 'avatar.jpg',
            'password' => bcrypt('guest_customer'),
            'active' => 1,

            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('abouts')->insert([
            'icon' => 'icon.jpg',
            'logo' => 'logo.png',
            'name' => 'TechZone',
            'title' => 'Nhóm 3',
            'phone' => '0912345678',
            'email' => 'group3@gmail.com',
            'address' => '12 Chùa Bộc, Đống Đa, Hà Nội',
            'linkfanpage' => 'https://www.facebook.com/hocviennganhang1961',
            'copyright' => 'TechZone',
            'worktime' => '7:00 - 17:30'
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'user']);

        Permission::create(['name' => 'list category']);
        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'list brands']);
        Permission::create(['name' => 'add brands']);
        Permission::create(['name' => 'edit brands']);
        Permission::create(['name' => 'delete brands']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'add products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'list discounts']);
        Permission::create(['name' => 'add discounts']);
        Permission::create(['name' => 'edit discounts']);
        Permission::create(['name' => 'delete discounts']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list banners']);
        Permission::create(['name' => 'add banners']);
        Permission::create(['name' => 'edit banners']);
        Permission::create(['name' => 'delete banners']);

        $user = User::find(1);
        $user->assignRole('admin');
        
        $permission = Permission::all();
        $user->givePermissionTo($permission);

        $user = User::find(2);
        $user->assignRole('user');
    }
}
