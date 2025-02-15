<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Facture N°{{ $invoice->number }}.pdf</title>
    <style>
        @font-face {
            font-family: 'Arial';
            font-style: normal;
            font-weight: normal;
            src: url('/fonts/arial.ttf') format('truetype');
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div style="background-color: #fff;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 34%;">
                    <img src="{{ $settings->logo }}" alt="Logo"
                        style="object-fit: cover; width: auto; height: 8rem; border-radius: 0.375rem;" />
                </td>
                <td style="width: 66%; text-align: left;">
                    <span style="font-size: 1em; font-weight: 600; color: #333;">{{ $organization->name }}</span>
                    <table style="width: 100%; font-size: 0.65em; color: #333;">
                        <tr>
                            <td>
                                <span>
                                    Adresse:
                                    {{ $organization->billingAddress ? $organization->billingAddress->address : '' }}<br>
                                    Téléphone: {{ $organization->phone_number }}<br>
                                    Email: {{ $organization->email }}<br>
                                </span>
                            </td>
                            <td>
                                <span>
                                    SIREN: {{ $organization->siren }}<br>
                                    {{ $organization->licence ? 'Licence: ' . $organization->licence : '' }}<br>
                                    {{ $organization->code_ape ? 'Code APE: ' . $organization->code_ape : '' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 20px; padding: 2px;">
            <span
                style="font-size: 1em; font-weight: 600; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }}; padding: 2px;">
                Facture N°<span style="font-weight: 900;">{{ $invoice->number }}</span>
            </span>
        </div>

        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 50%;">
                    <table
                        style="width: 100%; margin-top: 8px; border: 1px solid #ccc; text-align: left; font-size: 0.65em;">
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Date:</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">
                                {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Type:
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->getTypeName() }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Devis
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">N°{{ $invoice->number }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Lettre de voiture
                            </td>
                            <td style="padding: 8px;">N°{{ $invoice->number }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 50%; text-align: right; padding: 8px; font-size: 0.75em;">
                    <span style="color: #333;">CLIENT :</span>
                    <span
                        style="color: #333;">{{ $invoice->movingJob->client->type === 'individual' ? $invoice->movingJob->client->getFullName() : $invoice->movingJob->client->clientOrganization?->name }}
                    </span>
                    @if ($invoice->movingJob->client->type === 'professional')
                        <br>
                        <span style="color: #333;">{{ $invoice->movingJob->client->getFullName() }}</span>
                    @endif
                    {{-- <span style="color: #333;">{{ $invoice->movingJob->client->getFullName() }}</span> --}}
                    <address style="color: #777;">
                        {{ $invoice->movingJob->client->address->address }}<br />
                        {{ $invoice->movingJob->client->address->postal_code . ' ' . $invoice->movingJob->client->address->city }}
                        <br />
                        Tél : {{ $invoice->movingJob->client->phone_number }}
                    </address>
                </td>
            </tr>
        </table>

        <!-- Options Table -->
        <table
            style="width: 100%; margin-top: 20px; border: 1px solid #ccc; text-align: center; font-size: 0.65em; color: #333;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                <th style="padding: 8px; border-right: 1px solid #ccc;">Désignation</th>
                <th style="padding: 8px; border-right: 1px solid #ccc;">Quantité</th>
                <th style="padding: 8px; border-right: 1px solid #ccc;">Prix unitaire HT</th>
                <th style="padding: 8px;">Prix total HT</th>
            </tr>
            @foreach ($options as $item)
                <tr>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc; text-align: left;">
                        {{ $item->designation }}
                    </td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->quantity }}
                    </td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->unit_price_ht }} €
                    </td>
                    <td style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif">
                        {{ $item->total_price_ht }} €
                    </td>
                </tr>
            @endforeach
        </table>

        <div style="font-size: 0.65em; margin-top: 20px; font-weight: 400;">
            <span style="font-weight: 600; text-decoration: underline;">Rappel des termes du contrat:</span>
            Déménagement {{ $invoice->movingJob->client->type === 'individual' ? 'particulier ' : 'professionnel' }},
            <span style="font-weight: 500;">Volume: {{ $invoice->movingJob->capacity }} m³</span>,
            <span style="font-weight: 500;">Distance: {{ $invoice->movingJob->distance }}</span>.
            <p style="font-weight: 500;">Prix total TTC: {{ $invoice->movingJob->amount_ttc }} €</p>
        </div>

        <!-- Footer -->
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 40%; font-size: 0.55em;">
                    Coordonnées bancaire pour un paiement par virement : <br>
                    IBAN: {{ $settings->iban ?? '-' }}<br>
                    BIC: {{ $settings->bic ?? '-' }}<br>
                </td>
                <td style="width: 60%;">
                    <table
                        style="width: 100%; margin-top: 8px; border: 1px solid #ccc; text-align: left; font-size: 0.65em;">
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Prix HT ({{ $invoice->getTypeName() }})</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->amount_ht }} €</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                TVA(20%)</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->amount_tva }} €</td>
                        </tr>
                        <tr style="font-weight: 900;">
                            <td
                                style="padding: 8px; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};  color: {{ $settings->ducuments_secondary_color }};">
                                Prix TTC
                            </td>
                            <td style="padding: 8px;">{{ $invoice->amount_ttc }} €</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="font-size: 0.65em; margin-top: 20px; font-weight: 400;">
            En cas de retard, une pénalité au taux annuel de 5 % sera appliquée, à laquelle s’ajoutera une indemnité
            forfaitaire pour frais de recouvrement de 40 €
        </div>
    </div>
    {!! $organization->getDocumentFooterDetails() !!}
</body>

</html>
