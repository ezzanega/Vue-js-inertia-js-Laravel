<?php

namespace App\Observers;

use App\Models\Settings;
use App\Models\Quotation;
use Illuminate\Support\Str;
use App\Models\CalendarEvent;
use Illuminate\Support\Carbon;
use App\Models\Enums\EventType;
use Illuminate\Support\Facades\Auth;
use App\Models\Enums\QuotationStatus;

class QuotationObserver
{
    public function creating(Quotation $quotation): void
    {
        $date = Carbon::now();

        $number = Str::of(strval($date->format('d')))->append(strval($date->format('m')));
        $number = Str::of($number)->append(strval($date->year));
        $organization = Auth::user()->organization;
        $quotationCount = Quotation::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->where('organization_id', $organization->id)
            ->count();

        $number = Str::of($number)->append(strval(str_pad(($quotationCount + 1), 3, '0', STR_PAD_LEFT)));

        $quotation->number = $number;
        $quotation->uuid = Str::uuid();
    }


    public function updated(Quotation $quotation)
    {
        if ($quotation->isDirty('status') && $quotation->status == QuotationStatus::ACCEPTED) {

            $quotation = Quotation::where('id', $quotation->id)->with(['movingJob.client', 'movingJob.client.clientOrganization', 'movingJob.loadingLocation', 'movingJob.shippingLocation'])->first();

            $clientName = $quotation->movingJob?->client?->type === 'individual' ?  $quotation->movingJob?->client?->getFullName() : $quotation->movingJob?->client?->clientOrganization?->name;

            $details = '<div class="flex flex-col border border-gray-200 rounded-md p-2">';
            $details .= '<div class="font-bold text-center underline">CLIENT</div>';
            $details .= '<div><span class="text-gray-600">Nom du client:</span> ' . $quotation->movingJob?->client?->getFullName() . '</div>';
            $details .= '<div><span class="text-gray-600">Tél:</span>' . $quotation->movingJob?->client?->phone_number . '</div>';
            $details .= '<div><span class="text-gray-600">Adresse:</span>' . $quotation->movingJob?->loading_address . '</div>';
            $details .= '</div>';

            $details .= '<div class="flex flex-col border border-gray-200 rounded-md p-2">';
            $details .= '<div class="font-bold text-center underline">Déménagement</div>';
            $details .= '<div><span class="text-gray-600">Volume:</span>' . $quotation->movingJob?->capacity . 'm³</div>';
            $details .= '<div><span class="text-gray-600">Formule:</span>' . $quotation->movingJob?->formula . '</div>';
            $details .= '<div><span class="text-gray-600">Distance:</span>' . $quotation->movingJob?->distance . '</div>';
            $details .= '<div><span class="text-gray-600">Acompte:</span>' . $quotation->movingJob?->advance . ' €</div>';
            $details .= '<div><span class="text-gray-600">Solde:</span>' . $quotation->movingJob?->balance . ' €</div>';
            $details .= '</div>';

            $details .= '<div class="flex space-x-3">';
            $details .= '<div class="flex flex-col border border-gray-200 rounded-md p-2">';
            $details .= '<div class="font-bold text-center underline">CHARGEMENT</div>';
            $details .= '<div><span class="text-gray-600">Date:</span> ' . $quotation->movingJob?->loading_date . '</div>';
            $details .= '<div><span class="text-gray-600">Adresse:</span> <a href="' . $quotation->movingJob?->loadingLocation?->google_map_url . '" target="_blank" class="text-blue-500 underline">' . $quotation->movingJob?->loading_address . '</a></div>';
            $details .= '<div><span class="text-gray-600">Étage:</span> ' . $quotation->movingJob?->loading_floor . '</div>';
            $details .= '<div><span class="text-gray-600">Ascenseur:</span> ' . $quotation->movingJob?->loading_elevator . '</div>';
            $details .= '<div><span class="text-gray-600">Portage:</span> ' . $quotation->movingJob?->loading_portaging . '</div>';
            $details .= '<div><span class="text-gray-600">Détails:</span> ' . $quotation->movingJob?->shipping_details . '</div>';
            $details .= '</div>';

            $details .= '<div class="flex flex-col border border-gray-200 rounded-md p-2">';
            $details .= '<div class="font-bold text-center underline">LIVRAISON</div>';
            $details .= '<div><span class="text-gray-600">Date:</span> ' . $quotation->movingJob?->shipping_date . '</div>';
            $details .= '<div><span class="text-gray-600">Adresse:</span> <a href="' . $quotation->movingJob?->shippingLocation?->google_map_url . '" target="_blank" class="text-blue-500 underline">' . $quotation->movingJob?->shipping_address . '</a></div>';
            $details .= '<div><span class="text-gray-600">Étage:</span> ' . $quotation->movingJob?->shipping_floor . '</div>';
            $details .= '<div><span class="text-gray-600">Ascenseur:</span> ' . $quotation->movingJob?->shipping_elevator . '</div>';
            $details .= '<div><span class="text-gray-600">Portage:</span> ' . $quotation->movingJob?->shipping_portaging . '</div>';
            $details .= '<div><span class="text-gray-600">Détails:</span> ' . $quotation->movingJob?->shipping_details . '</div>';
            $details .= '</div>';
            $details .= '</div>';
            $details .= '<a href="' . route('6dem.documents.quotation.preview', ['id' => $quotation->id]) . '" class="text-blue-500 underline">Voir le devis</a>';

            if ($quotation->movingJob?->loading_date) {
                $organization = Auth::user()->organization;
                $settings = Settings::where('organization_id', $organization->id)->first();
                CalendarEvent::create([
                    'title' => 'Déménagement - ' . $clientName,
                    'type' => EventType::MOVING,
                    'details' => $details,
                    'color' => $settings->calendar_moving_color,
                    'start' => $quotation->movingJob->loading_date,
                    'end' => $quotation->movingJob->loading_date,
                    'all_day' => true,
                ]);
            }
        }
    }
}
