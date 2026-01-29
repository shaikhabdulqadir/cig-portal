<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\UChatPartnerService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uchat_password',
        'company_name',
        'license',
        'phone',
        'is_admin',
        'workspace_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'uchat_password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function createUChatWorkspace()
    {
        $user = $this;
        $uchatService = new UChatPartnerService();
        $workspace = $uchatService->createWorkspace([
            'email' => $user->email,
            'password' => Crypt::decryptString($user->uchat_password),
            'name' => $user->name,
            'email' => $user->email,
            'team_name' => empty($user->company_name) ? $user->name : $user->company_name,
            'channel' => "webchat",
            "auto_verify" => true,
        ]);
        
        if(isset($workspace['success']) && $workspace['success'] == false){
            $workspace = $uchatService->createWorkspaceForExistingUser([
                'email' => $user->email,
                'password' => Crypt::decryptString($user->uchat_password),
                'name' => $user->name,
                'email' => $user->email,
                'team_name' => empty($user->company_name) ? $user->name : $user->company_name,
                'channel' => "webchat",
                "auto_verify" => true,
            ]);
        }

        $user->workspace_id = $workspace['data']['id'];
        $user->save();
    }
    
    public static function boot() {
        parent::boot();
        self::created(function($user) {
            $user->createUChatWorkspace();
        });
    }
}
