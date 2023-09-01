<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> Lettre de voiture N°{{ $waybill->number }}.pdf</title>
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
    {{-- Exemplaire A --}}
    <div style="background-color: #fff;">
        <div style="text-align: center;">
            <p style="font-size: 0.45em; color: #333;">
                Document obligatoire par l'arrêté du 09/11/1999,
                A conserver deux ans par l'entreprise
            </p>
        </div>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 34%;">
                    <img src="{{ $settings->logo }}" alt="Logo"
                        style="object-fit: cover; width: 50%; height: 8rem; border-radius: 0.375rem;" />
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

        <div style="text-align: center; margin-top: 10px;">
            <span
                style="font-size: 1em; font-weight: 600; background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }}; padding: 2px;">
                Lettre de voiture N°<span style="font-weight: 900;">{{ $waybill->number }}</span> - Exemplaire A
                (Chargement)
            </span>
        </div>

        <!-- Devis and Client Details -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr style="">
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Client</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Distance</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Volume</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->type === 'individual' ? 'Formule' : 'Catégorie' }}</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc;">Nom de la Société exécutante</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->type === 'individual' ? $waybill->movingJob->client->getFullName() : $waybill->movingJob->client->clientOrganization?->name }}
                </td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->distance }}</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->capacity }} m³</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->type === 'individual' ? $waybill->movingJob->formula : 'professionnel' }}
                </td>
                <td style="padding: 8px;">
                    {{ $waybill->executing_company && $waybill->executing_company != '' ? $waybill->executing_company : $organization->name }}
                </td>
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
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->designation }}
                    </td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->quantity }}</td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->unit_price_ht }} €</td>
                    <td style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif">
                        {{ $item->total_price_ht }} €</td>
                </tr>
            @endforeach
        </table>

        <!-- Véhicules -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Véhicules</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc;">Type de Véhicules</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">--</td>
                <td style="padding: 8px;">--</td>
            </tr>
        </table>

        <!-- Observation(s) -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Observation(s)</th>
            </tr>
            <tr style="font-weight: 900;">
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Observation(s) du
                    Client</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Observation(s) du Déménageur</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; height: 65px;"></td>
                <td style="padding: 8px; height: 65px;"></td>
            </tr>
        </table>

        {{-- Mentions Légales --}}
        <div style="font-size: 0.55em; margin-top: 8px; font-weight: 400;">
            <span style="font-weight: 600;">IMPORTANT:</span> La livraison donne lieu à des
            formaliteés impératives
            (reportez-vous à l'article 16 des conditions générales du devis). Dans tous les cas, vous devez donner
            décharge à l'entreprise en fin de livraison en signant ce document. En cas de dommages, utilisez la grille
            ci-dessus pour identifier avec précision les pertes et avaries constatées, la mention "sous réserve de
            déballage ou de controôle" n'ayant aucune valeur de preuve. Si vos réserves émises à la réception du
            mobilier ne sont pas acceptées par le professionnel, ou si vous n'avez émis aucune réserve à la
            livraison, vous ne disposez alors que d'un délai de dix jours calendaires à compter de la réception des
            objets transportés pour émettre par lettre recommandée une protestation motivée sur l'état du mobilier
            réceptionné en application de l'article L.121-95 du code de la consommation.
        </div>

        <!-- Montant restant due à la livraison -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="3" style="padding: 8px; text-transform: uppercase;">Montant restant due à la livraison
                </th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Solde restant dû :
                    {{ $waybill->movingJob->balance }} €</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Accompte :
                    {{ $waybill->movingJob->advance }} €</td>
                <td style="padding: 8px;">Total TTC: {{ $waybill->movingJob->amount_ttc }} €</td>
            </tr>
        </table>

        <!-- Signatures -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Signatures</th>
            </tr>
            <tr style="font-weight: 900;">
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Signature du
                    Client</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Signature du Déménageur</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; height: 65px; font-size: 0.55em;">
                    Date et Signature du Client <br>
                    <span style="font-style: italic;">Précédé de la mention “lu et approuvé”.</span>
                </td>
                <td style="padding: 8px; height: 65px; font-size: 0.55em;">
                    Date et Signature du Déménageur <br>
                    <span style="font-style: italic;">Précédé de la mention “lu et approuvé”.</span>
                </td>
            </tr>
        </table>
    </div>


    <div class="page-break"></div>


    {{-- Exemplaire B --}}
    <div style="background-color: #fff;">
        <div style="text-align: center;">
            <p style="font-size: 0.45em; color: #333;">
                Document obligatoire par l'arrêté du 09/11/1999,
                A conserver deux ans par l'entreprise
            </p>
        </div>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 34%;">
                    <img src="{{ $settings->logo }}" alt="Logo"
                        style="object-fit: cover; width: 50%; height: 8rem; border-radius: 0.375rem;" />
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

        <div style="text-align: center; margin-top: 10px;">
            <span
                style="font-size: 1em; font-weight: 600; background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }}; padding: 2px;">
                Lettre de voiture N°<span style="font-weight: 900;">{{ $waybill->number }}</span> - Exemplaire B
                (Livraison)
            </span>
        </div>

        <!-- Devis and Client Details -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr style="">
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Client</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Distance</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Volume</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->type === 'individual' ? 'Formule' : 'Catégorie' }}</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc;">Nom de la Société exécutante</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->getFullName() }}</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->distance }}</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->capacity }} m³</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">
                    {{ $waybill->movingJob->client->type === 'individual' ? $waybill->movingJob->formula : 'professionnel' }}
                </td>
                <td style="padding: 8px;">
                    {{ $waybill->executing_company && $waybill->executing_company != '' ? $waybill->executing_company : $organization->name }}
                </td>
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
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->designation }}
                    </td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->quantity }}</td>
                    <td
                        style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif border-right: 1px solid #ccc;">
                        {{ $item->unit_price_ht }} €</td>
                    <td style="padding: 8px; @if (!$loop->last) border-bottom: 1px solid #ccc; @endif">
                        {{ $item->total_price_ht }} €</td>
                </tr>
            @endforeach
        </table>

        <!-- Véhicules -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Véhicules</th>
                <th style="padding: 8px; border-bottom: 1px solid #ccc;">Type de Véhicules</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">--</td>
                <td style="padding: 8px;">--</td>
            </tr>
        </table>

        <!-- Observation(s) -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Observation(s)</th>
            </tr>
            <tr style="font-weight: 900;">
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Observation(s)
                    du
                    Client</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Observation(s) du Déménageur</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; height: 65px;"></td>
                <td style="padding: 8px; height: 65px;"></td>
            </tr>
        </table>

        {{-- Mentions Légales --}}
        <div style="font-size: 0.55em; margin-top: 8px; font-weight: 400;">
            <span style="font-weight: 600;">IMPORTANT:</span> La livraison donne lieu à des
            formaliteés impératives
            (reportez-vous à l'article 16 des conditions générales du devis). Dans tous les cas, vous devez donner
            décharge à l'entreprise en fin de livraison en signant ce document. En cas de dommages, utilisez la grille
            ci-dessus pour identifier avec précision les pertes et avaries constatées, la mention "sous réserve de
            déballage ou de controôle" n'ayant aucune valeur de preuve. Si vos réserves émises à la réception du
            mobilier ne sont pas acceptées par le professionnel, ou si vous n'avez émis aucune réserve à la
            livraison, vous ne disposez alors que d'un délai de dix jours calendaires à compter de la réception des
            objets transportés pour émettre par lettre recommandée une protestation motivée sur l'état du mobilier
            réceptionné en application de l'article L.121-95 du code de la consommation.
        </div>

        <!-- Montant restant due à la livraison -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="3" style="padding: 8px; text-transform: uppercase;">Montant restant due à la livraison
                </th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Solde restant dû :
                    {{ $waybill->movingJob->balance }} €</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Accompte :
                    {{ $waybill->movingJob->advance }} €</td>
                <td style="padding: 8px;">Total TTC: {{ $waybill->movingJob->amount_ttc }} €</td>
            </tr>
        </table>

        <!-- Signatures -->
        <table
            style="width: 100%; margin-top: 8px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em;">
            <tr
                style="background-color: {{ $settings->ducuments_primary_color }}; color: {{ $settings->ducuments_secondary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Signatures</th>
            </tr>
            <tr style="font-weight: 900;">
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Signature du
                    Client</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Signature du Déménageur</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; height: 65px; font-size: 0.55em;">
                    Date et Signature du Client <br>
                    <span style="font-style: italic;">Précédé de la mention “lu et approuvé”.</span>
                </td>
                <td style="padding: 8px; height: 65px; font-size: 0.55em;">
                    Date et Signature du Déménageur <br>
                    <span style="font-style: italic;">Précédé de la mention “lu et approuvé”.</span>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
