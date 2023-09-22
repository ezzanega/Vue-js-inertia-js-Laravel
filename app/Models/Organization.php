<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Location;
use App\Models\MovingJob;
use App\Models\CalendarEvent;
use App\Models\EmailTemplates;
use App\Models\MovingJobFormula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'siret',
        'email',
        'phone_number',
        'siren',
        'code_ape',
        'status',
        'licence',
        'owner_id',
        'taskpro_organization_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'organization_role');
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function emailTemplates(): HasMany
    {
        return $this->hasMany(EmailTemplates::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(Settings::class);
    }

    public function movingJobFormulas(): HasMany
    {
        return $this->hasMany(MovingJobFormula::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function addRole($roleName)
    {
        $role = Role::findOrCreate($roleName);
        $this->roles()->attach($role);
    }

    public function calendarEvents(): HasMany
    {
        return $this->hasMany(CalendarEvent::class);
    }

    public function getDocumentFooterDetails()
    {
        $line1 =  $this->name . ' - Adresse: ' . $this->billingAddress?->full_address . ' - Tél: ' . $this->phone_number;
        $line2 =  'E-mail: ' . $this->email . ' - Siren: ' . $this->siren;
        return '<script type="text/php">
            if ( isset($pdf) ) {
                $font_size = 7;
                $pageWidth = 595.28;
                $line1Text = "' . $line1 . '";
                $line2Text = "' . $line2 . '";
                $line1TextWidth = strlen($line1Text) * $font_size * 0.5;
                $line2TextWidth = strlen($line2Text) * $font_size * 0.5;
                $x = ($pageWidth - $line1TextWidth) / 2;
                $x2 = ($pageWidth - $line2TextWidth) / 2;
                $pdf->page_text($x, 805, $line1Text, null, $font_size, array(0,0,0));
                $pdf->page_text($x2, 815, $line2Text, null, $font_size, array(0,0,0));
                $pdf->page_text(550, 820, "{PAGE_NUM} / {PAGE_COUNT}", null, 6, array(0,0,0));
            }
        </script>';
    }
}
