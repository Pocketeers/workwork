<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            
        	[
	            'name' => 'job_seeker',
	            'label' => 'Job Seeker',
            ],
            [
            	'name' => 'employer',
	            'label' => 'Employer',
            ],
            [
                'name' => 'admin',
                'label' => 'Administrator',
            ]
            
        ]);



        DB::table('permissions')->insert([

        	[
	            'name' => 'click_apply',
	            'label' => 'Click The Apply Button',
            ],
            [
            	'name' => 'edit_advert',
	            'label' => 'Edit Own Ads',
            ],
            [
            	'name' => 'edit_company',
	            'label' => 'Edit Company Page',
            ],
            [
            	'name' => 'edit_info',
	            'label' => 'Edit Job Seeker Info',
            ],
            [
            	'name' => 'rate_company',
	            'label' => 'Rate Company',
            ],
            [
            	'name' => 'rate_jobSeeker',
	            'label' => 'Rate Job Seeker Profile',
            ],
            [
            	'name' => 'view_my_adverts',
	            'label' => 'View Own Adverts',
            ],
            [
            	'name' => 'view_request',
	            'label' => 'View Job Request',
            ],
            [
                'name' => 'view_dashboard',
                'label' => 'View Dashboard',
            ],
            [
                'name' => 'view_admin_features',
                'label' => 'View Administrator tools and features',
            ],
        ]);


        DB::table('permission_role')->insert([
            
        	[
	            'permission_id' => 1,
	            'role_id' => 1,
            ],
            [
            	'permission_id' => 4,
	            'role_id' => 1,
            ],
            [
            	'permission_id' => 5,
	            'role_id' => 1,
            ],
            [
                'permission_id' => 9,
                'role_id' => 1,
            ],
            [
            	'permission_id' => 2,
	            'role_id' => 2,
            ],
            [
            	'permission_id' => 3,
	            'role_id' => 2,
            ],
            [
            	'permission_id' => 6,
	            'role_id' => 2,
            ],
            [
            	'permission_id' => 7,
	            'role_id' => 2,
            ],
            [
            	'permission_id' => 8,
	            'role_id' => 2,
            ],
            [
                'permission_id' => 9,
                'role_id' => 2,
            ],
            [
                'permission_id' => 10,
                    'role_id' => 3,
            ],
        ]);
    }
}
