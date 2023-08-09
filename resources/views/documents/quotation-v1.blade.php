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
    </style>
</head>

<body>
    <div style="background-color: #fff;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <h1 style="font-size: 1em; font-weight: 600;">Logo</h1>
                </td>
                <td style="width: 50%; text-align: left;">
                    <span style="font-size: 1em; font-weight: 600; color: #333;">{{ $organization->name }}</span>
                    <table style="width: 100%; font-size: 0.65em; color: #333;">
                        <tr>
                            <td>
                                <address>
                                    Adresse: {{ $organization->billingAddress->address }}<br>
                                    Téléphone: {{ $organization->phone_number }}<br>
                                    Email: {{ $organization->email }}<br>
                                </address>
                            </td>
                            <td>
                                <address>
                                    SIREN: {{ $organization->siren }}<br>
                                    Licence: {{ $organization->licence }}<br>
                                    Code APE: {{ $organization->code_ape }}
                                </address>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- Devis and Client Details -->
        <table style="width: 100%; margin-top: 4px;">
            <tr>
                <td style="width: 50%; text-align: left; border: 1px solid #ccc; padding: 8px; border-radius: 8px;">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="4"
                                style=" border-bottom: 1px solid #ccc; font-size: 0.65em; font-weight: 600; color: #777; padding: 8px;">
                                Devis N°<span style="color: #438A7A; font-weight: 900;">{{ $quotation->number }}</span>
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
                                Formule: {{ $quotation->movingJob->formula }}
                            </td>
                            <td colspan="2"
                                style="border-bottom: 1px solid #ccc; font-size: 0.65em; color: #333; padding: 8px;">
                                Validité: {{ $quotation->validity_duratation }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size: 0.65em; color: #333; padding: 8px;">Volume:
                                {{ $quotation->movingJob->volume }}</td>
                            <td colspan="2" style="font-size: 0.65em; color: #333; padding: 8px;">Distence:
                                {{ $quotation->movingJob->distance }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 50%; border: 1px solid #ccc; padding: 8px; border-radius: 8px; font-size: 0.65em;">
                    <span style="color: #333;">CLIENT :</span>
                    <span style="color: #333;">{{ $quotation->movingJob->client->getFullName() }}</span>
                    <address style="color: #777;">
                        {{ $quotation->movingJob->client->address->address }}<br />
                        {{ $quotation->movingJob->client->address->postal_code . ' ' . $quotation->movingJob->client->address->city }}
                        <br />
                        Tél : {{ $quotation->movingJob->client->phone_number }}
                    </address>
                </td>
            </tr>
        </table>
        <!-- Livraison -->
        <table
            style="width: 50%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em; float: right;">
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
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
            style="width: 50%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Chargement</th>
            </tr>
            <tr>
                <td colspan="2" style="padding: 8px; border-bottom: 1px solid #ccc;">Adresse:
                    {{ $quotation->movingJob->loading_address }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Date ou
                    période: {{ $quotation->movingJob->loading_date }}
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
        @if ($quotation->movingJob->client->type === 'individual')
            <table
                style="width: 100%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: center; font-size: 0.65em; color: #333;">
                <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Details prestation</th>
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Prix HT</th>
                    <th style="padding: 8px;">Prix TTC</th>
                </tr>
                <tr>
                    <td
                        style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; display: flex; justify-content: space-between;">
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
                    <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">500 €</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc;">600 €</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">Monte meuble</td>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">150 €</td>
                    <td style="padding: 8px;">180 €</td>
                </tr>
            </table>
        @else
            <table
                style="width: 100%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em; color: #333;">
                <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Details prestation</th>
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Quantité</th>
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Valeur</th>
                    <th style="padding: 8px; border-right: 1px solid #ccc;">Prix HT</th>
                    <th style="padding: 8px;">Prix TTC</th>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Description 1
                    </td>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">5</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">100 €</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">500 €</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ccc;">600 €</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">Description 2</td>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">3</td>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">50 €</td>
                    <td style="padding: 8px; border-right: 1px solid #ccc;">150 €</td>
                    <td style="padding: 8px;">180 €</td>
                </tr>
            </table>
        @endif
        <!-- Montant final du devis -->
        <table
            style="width: 100%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                <th colspan="3" style="padding: 8px; text-transform: uppercase;">Montant final du devis</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Total des
                    prestations</td>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Prix HT</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Prix TTC</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Remise en %</td>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Prix HT</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Prix TTC</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Tarif final</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Prix HT</td>
                <td style="padding: 8px;">Prix TTC</td>
            </tr>
        </table>
        <!-- Assurance -->
        <table
            style="width: 100%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                <th colspan="5" style="padding: 8px; text-transform: uppercase;">Assurance</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Assurance
                    contractuelle</td>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Valeur max. par
                    objet</td>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Franchise</td>
                <td style="padding: 8px; border-right: 1px solid #ccc; border-bottom: 1px solid #ccc;">Prix HT</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">Prix TTC</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Assurance ad valorem</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Valeur max. par objet</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Franchise</td>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Prix HT</td>
                <td style="padding: 8px;">Prix TTC</td>
            </tr>
        </table>
        <!-- Modalité de réglement -->
        <table
            style="width: 100%; margin-top: 4px; border: 1px solid #ccc; border-radius: 8px; text-align: left; font-size: 0.65em;">
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
                <th colspan="2" style="padding: 8px; text-transform: uppercase;">Modalité de réglement</th>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;">Accompte en %
                    TTC</td>
                <td style="padding: 8px; border-bottom: 1px solid #ccc;">50% - 500 €</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-right: 1px solid #ccc;">Solde % TTC</td>
                <td style="padding: 8px;">50% - 500 €</td>
            </tr>
        </table>
        <!-- Footer -->
        <table style="width: 100%; margin-top: 4px; font-size: 0.55em;">
            <tr>
                <td style="width: 50%;">
                    Coordonnées bancaire pour un paiement par virement : <br>
                    IBAN: XXXX-XXXX-XXXX-XXXX<br>
                    BIC: XXXX-XXXX<br>
                </td>
                <td
                    style="width: 50%; height: 65px; background-color: {{ $settings->ducuments_primary_color }}; border: 1px solid #ccc; border-radius: 8px; text-align: center;">
                    Date et Signature du Client <br>
                    Précédé de la mention “lu et approuvé”.
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
