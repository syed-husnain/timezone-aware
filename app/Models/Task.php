<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $user = auth()->user();

        if ($user && $user->timezone) {
            // Convert to user's timezone
            // return Carbon::parse($value)->setTimezone($user->timezone)->format('Y-m-d H:i:s');
            $userTimezone = $user->timezone;
            $formattedTime = Carbon::parse($value)
                ->setTimezone($userTimezone)
                ->format('F jS \a\t g:i A');

            return $formattedTime;
        }

        // Fallback to UTC if user or timezone is not available
        return Carbon::parse($value)->format('F jS \a\t g:i A');
    }
}
