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
    </style>
</head>

<body>
    <div style="background-color: #fff;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 34%;">
                    <h1 style="font-size: 1em; font-weight: 600;">Logo</h1>
                </td>
                <td style="width: 66%; text-align: left;">
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

        <div style="text-align: center; margin-top: 20px; padding: 2px;">
            <span
                style="font-size: 1em; font-weight: 600; background-color: {{ $settings->ducuments_primary_color }}; padding: 2px;">
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
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                Date:</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">
                                {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                Type:
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->getTypeName() }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                Devis
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">N°{{ $invoice->number }}</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                Lettre de voiture
                            </td>
                            <td style="padding: 8px;">N°{{ $invoice->number }}</td>
                        </tr>
                    </table>
                </td>

                <td style="width: 50%; text-align: right; padding: 8px; font-size: 0.75em;">
                    <span style="color: #333;">CLIENT :</span>
                    <span style="color: #333;">{{ $invoice->movingJob->client->getFullName() }}</span>
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
            <tr style="background-color: {{ $settings->ducuments_primary_color }};">
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
                        {{ $item->quantity }} €
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
            <span style="font-weight: 600;">Rappel des termes du contrat:</span>
            Déménagement d'un volume de {{ $invoice->movingJob->capacity }} à une distance de
            {{ $invoice->movingJob->distance }}.
            <p style="font-weight: 500;">Prix total TTC: {{ $invoice->movingJob->amount_ttc }} €</p>
        </div>

        <!-- Footer -->
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td style="width: 40%; font-size: 0.55em;">
                    Coordonnées bancaire pour un paiement par virement : <br>
                    IBAN: XXXX-XXXX-XXXX-XXXX<br>
                    BIC: XXXX-XXXX<br>
                </td>
                <td style="width: 60%;">
                    <table
                        style="width: 100%; margin-top: 8px; border: 1px solid #ccc; text-align: left; font-size: 0.65em;">
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                Prix HT ({{ $invoice->getTypeName() }})</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->amount_ht }} €</td>
                        </tr>
                        <tr>
                            <td
                                style="padding: 8px; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
                                TVA(20%)</td>
                            <td style="padding: 8px; border-bottom: 1px solid #ccc;">{{ $invoice->amount_tva }} €</td>
                        </tr>
                        <tr style="font-weight: 900;">
                            <td
                                style="padding: 8px; border-right: 1px solid #ccc; background-color: {{ $settings->ducuments_primary_color }};">
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


        <p style="font-size: 0.65em; margin-top: 20px; font-weight: 400;">
            <span style="font-weight: 600;">Mentions légales:</span> La livraison donne lieu à des
            formaliteés impératives
            (reportez-vous à l'article 16 des conditions générales du devis). Dans tous les cas, vous devez donner
            décharge à l'entreprise en fin de livraison en signant ce document. En cas de dommages, utilisez la grille
            ci-dessus pour identifier avec précision les pertes et avaries constatées, la mention "sous réserve de
            déballage ou de controôle" n'ayant aucune valeur de preuve. Si vos réserves émises à la réception du
            mobilier ne sont pas acceptées par le professionnel, ou si vous n'avez émis aucune réserve à la
            livraison, vous ne disposez alors que d'un délai de dix jours calendaires à compter de la réception des
            objets transportés pour émettre par lettre recommandée une protestation motivée sur l'état du mobilier
            réceptionné en application de l'article L.121-95 du code de la consommation.
        </p>
    </div>
</body>

</html>
