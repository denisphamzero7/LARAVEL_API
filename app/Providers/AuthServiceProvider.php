<?php

namespace App\Providers;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\GroupPolicy;
use App\Models\Groups;
use App\Models\Post;
use Illuminate\Auth\Notifications\ResetPassword;
use Carbon\CarbonInterval;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Modules;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        // Groups::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        // Passport::ignoreRoutes();
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::enablePasswordGrant();
        Passport::tokensExpireIn(CarbonInterval::minutes(60));
        Passport::refreshTokensExpireIn(CarbonInterval::days(7));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(6));
        ResetPassword::createUrlUsing(function ($doctor, string $token) {
            return 'http://example.com/doctors/reset-password?token=' . $token . '&email=' . urlencode($doctor->email);
        });
        // // Định nghĩa gate: user này có quyền thêm bài viết không
        // Gate::define('post.add', function (User $user) {

        //     return true;
        // });

        // // Gate::define('post.add', [PostPolicy::class,'add']);

        // Gate::define('post.update', function (User $user, Post $post) {
        //     return $user->id === $post->user_id;
        //     // dd($post);
        // });
        // 1, lấy danh sách module
         $modulesList = Cache::remember('modules_permissions', 3600, function () {
             try {
                 return Modules::all();
             } catch (\Throwable $e) {
                 return collect([]);
             }
         });
         if($modulesList->count()>0) {
            foreach ($modulesList as $module){
                Gate::define($module->name,function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name);
                        return $check;
                      }
                      return false;
                });
                 Gate::define($module->name.'.add',function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name,'add');
                        return $check;
                      }
                      return false;
                });
                Gate::define($module->name.'.edit',function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name,'edit');
                        return $check;
                      }
                      return false;
                });
                Gate::define($module->name.'.delete',function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name,'delete');
                        return $check;
                      }
                      return false;
                });
                Gate::define($module->name.'.permission',function (User $user) use ($module)  {
                      $roleJson= $user->group->permissions;
                      if(!empty($roleJson)){
                        $roleArr= json_decode($roleJson,true);
                        $check= isRole($roleArr,$module->name,'permission');
                        return $check;
                      }
                      return false;
                });
            }
         }
    }
}
