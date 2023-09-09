<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Devis N°{{ $quotation->number }}.pdf</title>
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
                <td style="width: 50%;">
                    <img src="{{ $settings->logo }}" alt="Logo"
                        style="object-fit: cover; width: auto; height: 8rem; border-radius: 0.375rem;" />
                </td>
                <td style="width: 50%; text-align: left;">
                    <span style="font-size: 1em; font-weight: 600; color: #333;">{{ $organization->name }}</span>
                    <table style="width: 100%; font-size: 0.65em; color: #333;">
                        <tr>
                            <td>
                                <div>
                                    Adresse:
                                    {{ $organization->billingAddress ? $organization->billingAddress->address : '' }}<br>
                                    Téléphone: {{ $organization->phone_number }}<br>
                                    Email: {{ $organization->email }}<br>
                                </div>
                            </td>
                            <td>
                                <div>
                                    SIREN: {{ $organization->siren }}<br>
                                    {{ $organization->licence ? 'Licence: ' . $organization->licence : '' }}<br>
                                    {{ $organization->code_ape ? 'Code APE: ' . $organization->code_ape : '' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- Devis and Client Details -->
        <table style="width: 100%; margin-top: 8px;">
            <tr>
                <td style="width: 50%; text-align: left; border: 1px solid #ccc; padding: 8px; border-radius: 8px;">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2"
                                style=" border-bottom: 1px solid #ccc; font-size: 0.65em; font-weight: 600; padding: 8px;">
                                Devis N°<span style="font-weight: 900;"> {{ $quotation->number }}</span>
                            </td>
                            <td colspan="2"
                                style=" border-bottom: 1px solid #ccc; font-size: 0.65em; font-weight: 600; padding: 8px;">
                                Date:<span style="font-weight: 900;">
                                    {{ \Carbon\Carbon::parse($quotation->created_at)->format('d/m/Y') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="border-bottom: 1px solid #ccc; font-size: 0.65em; color: #333; padding: 8px;">
                                Conseiller: {{ $advisor->getFullName() }}
                            </td>
                            <td colspan="2"
                                style="border-bottom: 1px solid #ccc; font-size: 0.65em; color: #333; padding: 8px;">
                                Tél:
                                {{ $advisor->phone_number }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="border-bottom: 1px solid #ccc; font-size: 0.65em; color: #333; padding: 8px;">
                                {{ $quotation->movingJob->client->type === 'individual' ? 'Formule: ' . $quotation->movingJob->formula : 'Catégorie: professionnel' }}
                            </td>
                            <td colspan="2"
                                style="border-bottom: 1px solid #ccc; font-size: 0.65em; color: #333; padding: 8px;">
                                Validité: {{ $quotation->validity_duratation }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size: 0.65em; color: #333; padding: 8px;">Volume:
                                {{ $quotation->movingJob->capacity }} m³</td>
                            <td colspan="2" style="font-size: 0.65em; color: #333; padding: 8px;">Distance:
                                {{ $quotation->movingJob->distance }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 50%; border: 1px solid #ccc; padding: 8px; border-radius: 8px; font-size: 0.65em;">
                    <span style="color: #333;">CLIENT :</span>
                    <span
                        style="color: #333;">{{ $quotation->movingJob->client->type === 'individual' ? $quotation->movingJob->client->getFullName() : $quotation->movingJob->client->clientOrganization?->name }}
                    </span>
                    @if ($quotation->movingJob->client->type === 'professional')
                        <br>
                        <span style="color: #333;">{{ $quotation->movingJob->client->getFullName() }}</span>
                    @endif
                    <address style="color: #777;">
                        {{ $quotation->movingJob->client->address ? $quotation->movingJob->client->address->address : '' }}<br />
                        {{ $quotation->movingJob->client->address ? $quotation->movingJob->client->address->postal_code . ' ' . $quotation->movingJob->client->address->city : '' }}
                        <br />
                        Tél : {{ $quotation->movingJob->client->phone_number }}
                    </address>
                </td>
            </tr>
        </table>
        <!-- Livraison -->
        <table
            style="width: 50%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em; float: right;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Livraison</th>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px; border-bottom: 1px solid #ccc;">Adresse:
                    {{ $quotation->movingJob->shipping_address }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Date ou
                    période: {{ $quotation->movingJob->shipping_date }}
                </td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Étage:
                    {{ $quotation->movingJob->shipping_floor }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Portage:
                    {{ $quotation->movingJob->shipping_portaging }}</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Ascenseur:
                    {{ $quotation->movingJob->shipping_elevator }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px;">Détails: {{ $quotation->movingJob->shipping_details }}</td>
            </tr>
        </table>
        <!-- Chargement -->
        <table
            style="width: 50%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Chargement</th>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px; border-bottom: 1px solid #ccc;">Adresse:
                    {{ $quotation->movingJob->loading_address }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Date ou
                    période: {{ \Carbon\Carbon::parse($quotation->movingJob->loading_date)->format('d/m/Y') }}
                </td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Étage:
                    {{ $quotation->movingJob->loading_floor }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Portage:
                    {{ $quotation->movingJob->loading_portaging }}</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Ascenseur:
                    {{ $quotation->movingJob->loading_elevator }}</td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px;">Détails: {{ $quotation->movingJob->loading_details }}</td>
            </tr>
        </table>
        <!-- Options Table -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em; color: #333;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th style="padding: 8px; border-right: 1px solid #ccc;">Details prestation</th>
                <th style="padding: 8px; border-right: 1px solid #ccc;">Quantité</th>
                <th style="padding: 8px; border-right: 1px solid #ccc;">Prix unitaire HT</th>
                <th style="padding: 8px;">Prix total HT</th>
            </tr>
            @foreach ($options as $item)
                <tr>
                    @if ($item->type === 'moving-option' && $quotation->movingJob->client->type === 'individual')
                        <td
                            style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc; display: flex; justify-content: space-between;">
                            <table style="width: 100%;">
                                <tr>
                                    <th style="text-decoration: underline; font-weight: 600;">A notre charge</th>
                                    <th style="text-decoration: underline; font-weight: 600;">A votre charge</th>
                                </tr>
                                <tr>
                                    <td style="width: 50%; border-right: 1px solid #ccc;">
                                        <ul>
                                            @foreach ($movingJobFormula['organization-side'] as $option)
                                                <li>{{ $option->text }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="width: 50%;">
                                        <ul>
                                            @foreach ($movingJobFormula['client-side'] as $option)
                                                <li>{{ $option->text }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @else
                        <td
                            style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                            {{ $item->designation }}
                        </td>
                    @endif
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
        <!-- Montant final du devis -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Montant final du devis</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;"> Prix total des
                    prestations HT @if ($quotation->movingJob->discount && $quotation->movingJob->discount != '0')
                        (Remise en {{ $quotation->movingJob->discount }}%)
                    @endif
                </td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">
                    {{ $quotation->movingJob->amount_ht }} €</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">TVA
                    ({{ $settings->vat }}%)</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">
                    {{ $quotation->movingJob->amount_tva }} €</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; font-weight: 600;">Total TTC</td>
                <td style="padding: 8px; font-weight: 600;">
                    {{ $quotation->movingJob->amount_ttc }} €</td>
            </tr>
        </table>

        <!-- Modalité de réglement -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Modalité de réglement</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Accompte
                    ({{ $quotation->movingJob->getAdvanceOrBalance('advance') }}%)
                    TTC</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $quotation->movingJob->advance }} €</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Solde
                    ({{ $quotation->movingJob->getAdvanceOrBalance('balance') }}%) TTC</td>
                <td style="padding: 8px;">{{ $quotation->movingJob->balance }} €</td>
            </tr>
        </table>
        <!-- Footer -->
        <table style="width: 100%; margin-top: 8px; font-size: 0.55em;">
            <tr>
                <td style="width: 50%;">
                    Coordonnées bancaire pour un paiement par virement : <br>
                    IBAN: {{ $settings->iban ?? '-' }}<br>
                    BIC: {{ $settings->bic ?? '-' }}<br>
                </td>
                <td
                    style="width: 50%; height: 65px; background-color: rgb(240, 240, 240); color: {{ $settings->ducuments_secondary_color }}; border: 1px solid #ccc; border-radius: 8px; text-align: center; vertical-align: top;">
                    <span>
                        Date et Signature du Client <br>
                        Précédé de la mention “lu et approuvé”.<br><br>
                        .............................................................................<br>
                        .............................................................................
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>

    <div style="width: 100%; text-align: center; font-size: 0.65em; text-decoration: underline; font-weight: 600;">
        CONDITIONS DE
        RÉALISATION DU
        DÉMÉNAGEMENT</div>
    <?php
    $text = $settings->ducuments_general_conditions;
    $length = strlen($text);
    $halfway = floor($length / 2);
    
    $last_space = strrpos(substr($text, 0, $halfway), ' ');
    
    $part1 = substr($text, 0, $last_space);
    $part2 = substr($text, $last_space + 1);
    ?>

    <div style="width: 100%; margin-top: 8px; font-size: 0.45em;">
        <div style="width: 50%; float: left; margin-right: 2%;">
            Les présentes conditions générales de vente et les conditions particulières négociées entre l'entreprise et
            le client déterminent les droits et obligations de chacun d'eux. Elles s'appliquent de plein droit aux
            opérations de déménagement objet du présent contrat.
            {!! $part1 !!}
        </div>
        <div style="width: 50%; float: left;">
            {!! $part2 !!}
        </div>
    </div>

    {!! $organization->getDocumentFooterDetails() !!}
</body>

</html>
