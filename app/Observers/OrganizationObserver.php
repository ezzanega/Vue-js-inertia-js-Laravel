<?php

namespace App\Observers;

use App\Models\Insurance;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Support\MovingJobFormula;
use App\Models\Enums\InsuranceType;

class OrganizationObserver
{

    public function creating(Organization $movingjob): void
    {
        $movingjob->uuid = Str::uuid();
    }

    public function created(Organization $organization): void
    {
        $organization->addRole('admin');
        $organization->addRole('sales');
        $organization->addRole('operator');
        $organization->addRole('lead-operator');

        $organization->settings()->create([
            "quotation_validity_duratation" => "",
            "ducuments_general_conditions" => "
            <p><strong>CHAPITRE I : INFORMATION SUR LES CONDITIONS DE RÉALISATION DU DÉMÉNAGEMENT</strong> <strong>Article 1 - INFORMATION SUR LES CONDITIONS DE RÉALISATION DU DÉMÉNAGEMENT</strong></p><p>A la demande de l'entreprise, le client doit fournir toutes informations dont il a connaissance permettant la réalisation matérielle du déménagement, tant au lieu de chargement que de livraison (conditions d'accès pour le personnel et le véhicule, possibilité de stationnement (Si la pause des panneaux n'est pas prévue par la mairie la pause des panneaux reste à la charge du client), distance de portage supérieur à 15 m, travaux en cours et toutes autres particularités). Le client est préalablement informé des suppléments chiffrés qu'il serait éventuellement amené à supporter en cas d'absence d'informations ou d'inexactitude de celles-ci et notamment si les informations détaillant clairement les accès ne sont pas mentionnées dans le devis. Le client doit également signaler les objets dont le transport est assujetti à une réglementation spéciale (vins, alcools, armes, etc.), les formalités administratives éventuelles étant à sa charge. Un devis gratuit décrivant les caractéristiques de l'opération projetée est fourni par l'entreprise au client.</p><p><strong>Article 2 - RÉSILIATION DU CONTRAT</strong>&nbsp;</p><p>Sauf stipulation contraire des conditions particulières, toute somme versée d'avance est qualifiée d'arrhes. Sauf cas de force majeure :</p><ul><li>en cas de résiliation par le client, les arrhes ne sont pas remboursées,</li><li>en cas de résiliation par l'entreprise ou défaillance de celle-ci, le professionnel les restitue.</li></ul><p><strong>Article 3 - DÉMARCHAGE À DOMICILE</strong>&nbsp;</p><p>En cas de démarchage à domicile et de souscription d'un contrat hors établissement, le client, en application de l'article L 221-28 12° du Code de la Consommation, ne bénéficie pas d'un droit de rétractation. Aucun paiement ne sera perçu avant l'expiration d'un délai de sept jours à compter de la conclusion du contrat hors établissement.</p><p><strong>Article 4 - ASSURANCE DOMMAGE</strong>&nbsp;</p><p>L'entreprise a la faculté de proposer au client de souscrire une assurance dommage destinée à garantir le mobilier contre certains risques pour lesquels elle n'assume légalement aucune responsabilité. Son coût est porté à la connaissance du client, qui a la possibilité d'y souscrire ou non.</p><p><strong>Article 5 - DÉLAIS D'EXÉCUTION INDETERMINES</strong>&nbsp;</p><p>Si, à la demande du client, il n'est pas fixé de date ou de période formelle d'exécution, le client peut adresser une mise en demeure par lettre recommandée à l'entreprise, au cas où celle-ci n'a pas entrepris le transport dans un délai normalement prévisible. A compter de cette mise en demeure, l'entreprise dispose d'un délai de dix jours pour exécuter l'opération convenue. A défaut d'exécution, dans le délai de dix jours, sauf cas de force majeure, le contrat est considéré comme résilié par l'entreprise et les sommes versées sont restituées.</p><p><strong>CHAPITRE II : PRIX ET MODALITES DE REGLEMENT ARTICLE 6 - PRIX ET MODALITES DE RÈGLEMENT</strong>&nbsp;</p><p>Les prix fixés au contrat ne peuvent être modifiés que si des charges imprévisibles et indépendantes de la volonté de l'entreprise, liées aux modalités de réalisation, surviennent avant le début de l'opération. Le client et l'entreprise peuvent toutefois décider d'un commun accord de modifier les dispositions prévues au contrat sous réserve de convenir de nouvelles modalités et des conséquences pouvant en résulter sur le prix fixé, notamment pour toutes prestations supplémentaires non prévues au contrat initial.</p><p><strong>ARTICLE 7 - VALIDITÉ DES PRIX</strong>&nbsp;</p><p>Si la date de réalisation n'a pas été fixée, l'entreprise et le client déterminent la durée de validité des prix à compter de la date d'établissement du devis.</p><p><strong>ARTICLE 8 - MODALITÉS DE RÈGLEMENT</strong>&nbsp;</p><p>Les conditions particulières doivent prévoir après négociation :</p><ul><li>le montant des arrhes versé à la commande,</li><li>le montant du versement intermédiaire, le cas échéant à la fin du chargement,</li><li>le solde à la fin du contrat de déménagement.</li></ul><p><strong>CHAPITRE III : RÉALISATION DES PRESTATIONS</strong> <strong>ARTICLE 9 - PENALITE DE RETARD</strong>&nbsp;</p><p>En cas de retard de paiement une pénalité égal à trois fois le taux d'intérêt légal sera appliquée. Pas d'escompte à l'échéance.</p><p><strong>ARTICLE 10 - PRESTATIONS EFFECTUÉES PAR L'ENTREPRISE</strong>&nbsp;</p><p>Les prestations sont convenues avec le client préalablement à chaque opération et précisément définies dans le devis. L'entreprise n'assume pas la prise en charge des personnes, des animaux, des végétaux, des matières dangereuses, infectes, explosives ou inflammables, des bijoux, monnaies, métaux précieux ou valeurs. Toute exception à cette règle doit être l'objet d'un accord écrit entre l'entreprise et le client avant le début de la réalisation.</p><p><strong>ARTICLE 11 - RÉALISATION PAR UNE TIERCE ENTREPRISE</strong>&nbsp;</p><p>L'entreprise conserve la faculté de confier, sous son entière responsabilité, la réalisation totale ou partielle du déménagement à une tierce entreprise dénommée \"entreprise exécutante\". Dans le cas où l'entreprise contractante utilise cette faculté, l'information du client sur l'identité de l'entreprise exécutante doit être réalisée dans un délai minimum de 48 heures avant la date de réalisation ; le client est en droit de refuser et les sommes lui sont alors restituées.</p><p><strong>ARTICLE 12 - PRÉSENCE OBLIGATOIRE DU CLIENT</strong>&nbsp;</p><p>Le client ou son mandataire doit être présent tant au chargement qu'à la livraison ; il doit vérifier, avant le départ du véhicule, qu'aucun objet n'a été oublié dans les locaux et dépendances où se trouvait le mobilier. Le représentant de l'entreprise est en droit d'exiger du client la constatation par écrit de toute détérioration antérieure au déménagement. L'entreprise est tenue de réaliser le déménagement suivant la date de chargement et de livraison, ou en cas de groupage suivant la période indiquée sur la lettre de voiture. Sauf cas de force majeure, l'indemnité due en cas de retard est calculée suivant le préjudice démontré et supporté par le client.</p><p><strong>CHAPITRE IV : RESPONSABILITE DE L'ENTREPRISE ARTICLE 13 - RESPONSABILITÉ POUR RETARD</strong></p><p><strong>ARTICLE 14 - RESPONSABILITÉ POUR PERTE OU AVARIES</strong>&nbsp;</p><p>L'entreprise est responsable des meubles et objets qui lui ont été confiés, sauf cas de force majeure, vice propre de la chose ou faute du client. Elle décline toute responsabilité en ce qui concerne les opérations qui ne seraient pas exécutées par ses préposés ou ses intermédiaires substitués.</p><p><strong>ARTICLE 15 - INDEMNISATION POUR PERTES ET AVARIES</strong> Suivant la nature des dommages, les pertes et avaries donnent lieu à réparation, remplacement ou indemnité compensatrice. L'indemnisation intervient dans la limite du préjudice matériel prouvé, déduction faite de la franchise s'élevant à 300, et des conditions particulières négociées entre l'entreprise et le client. Ces conditions particulières fixent - sous peine de nullité de plein droit du contrat - le montant de l'indemnisation maximum pour la totalité du mobilier et pour chaque objet ou élément de mobilier. Elles peuvent également fixer l'indemnisation maximum des objets figurant sur une liste valorisée. Le client est informé des coûts en résultant.</p><p><strong>ARTICLE 16 - PRESCRIPTION</strong>&nbsp;</p><p>Les actions en justice pour avarie, perte ou retard auxquelles peut donner lieu le contrat de déménagement doivent être intentées dans l'année qui suit la livraison du mobilier.</p><p><strong>CHAPITRE V : LIVRAISON DU MOBILIER ET FORMALITÉS EN CAS DE DOMMAGE</strong></p><p><strong>ARTICLE 17 - LIVRAISON DU MOBILIER À DOMICILE</strong></p><p>A la réception, le client doit vérifier l'état de son mobilier et en donner décharge dès la livraison terminée à l'aide de la déclaration de fin de travail. En cas de perte ou d'avarie, et pour sauvegarder ses droits et moyens de preuve, le client a intérêt à émettre dès la livraison et la mise en place, en présence des représentants de l'entreprise, des réserves écrites, précises et détaillées. En cas d'absence de réserves à la livraison ou en cas de réserves contestées par les représentants de l'entreprise sur la lettre de voiture, le client doit, en cas de perte ou d'avarie, adresser sa protestation motivée à l'entreprise par une lettre recommandée. Ces formalités doivent être accomplies dans les 10 jours à compter de la réception des objets transportés tel que prévu par l'article L.224-63 du code de la consommation, (avec samedi, dimanche et jours fériés inclus). A défaut, le client est privé du droit d'agir contre l'entreprise.</p><p>La livraison en garde meubles est assimilée à une livraison à domicile et met fin au contrat de déménagement. Les frais d'entrée en garde meubles sont distincts et facturés au client par le garde meubles qui assume la garde du mobilier</p><p><strong>ARTICLE 18 - LIVRAISON DU MOBILIER AU GARDE MEUBLES À LA DEMANDE DU CLIENT</strong></p><p><strong>ARTICLE 19 - DÉPÔT NÉCESSAIRE PAR SUITE D'EMPÊCHEMENT À LA LIVRAISON</strong> En cas d'absence du client aux adresses de livraison par lui indiquées, ou d'impossibilité matérielle n'étant pas le fait de l'entreprise, le mobilier est placé d'office dans un garde meubles, à la diligence de l'entreprise et aux frais du client. Par tous moyens appropriés, l'entreprise rend compte au client de cette opération de dépôt, qui met fin au contrat de déménagement.</p><p><strong>ARTICLE 20 - REGLEMENT AMIABLE DES DIFFERENDS _ MEDIATION DES LITIGES DE LA CONSOMMATION</strong> Conformément aux dispositions du code de la consommation relatives au « processus de médiation des litiges de la consommation », le client a le droit, en vue de la résolution amiable d'un litige né du contrat et l'opposant à l'entreprise, de recourir gratuitement et aux conditions fixées par ledit code, à un médiateur de la consommation. Le médiateur référent de l'entreprise est le Centre de médiation et de règlement amiable des huissiers de justice MEDICYS, qui peut être joint par voie :</p><ul><li>électronique : <a href='http://www.medicys.fr/'>www.medicys.fr</a> ou <a href='mailto:contact@medicys.fr'>contact@medicys.fr</a></li><li>postale : MEDICYS - Centre de médiation et de règlement amiable des huissiers de justice - 73, Boulevard de Clichy 75009 Paris. Le déménagement s'effectuera aux présentes conditions générales et aux conditions particulières figurant au recto ; après en avoir pris connaissance, le client déclare les accepter.</li></ul><p>Fait à ………………………………………………………………………………………..</p><p>Le ……………………………………………………………………………………………</p><p>SIGNATURE DU CLIENT…………………………………………………………………</p> 
            ",
            "ducuments_primary_color" => "rgb(240, 240, 240)",
            "ducuments_secondary_color" => "rgb(0, 0, 0)",
            "calendar_meeting_color" => "rgb(67, 138, 122)",
            "calendar_moving_color" => "rgb(146, 145, 244)",
            "calendar_cartons_delivery_color" => "rgb(228, 146, 146)",
            "calendar_others_color" => "rgb(67, 138, 122)",
            "legal_notice" => "",
            "vat" => "20"
        ]);

        Insurance::create([
            'type' => InsuranceType::ADVALOREM,
            'max_value' => "",
            'franchise' => "",
            'amount_ht' => "",
            'organization_id' => $organization->id
        ]);

        Insurance::create([
            'type' => InsuranceType::CONTRACTUAL,
            'max_value' => "",
            'franchise' => "",
            'amount_ht' => "",
            'organization_id' => $organization->id
        ]);

        foreach (MovingJobFormula::all() as $key => $formula) {
            $movingJobFormula = $organization->movingJobFormulas()->create([
                "name" => $key,
                "slug" => Str::slug($key)
            ]);
            foreach ($formula['organization-side'] as $item) {
                $movingJobFormula->options()->create([
                    'type' => 'organization-side',
                    'text' => $item,
                ]);
            }

            foreach ($formula['client-side'] as $item) {
                $movingJobFormula->options()->create([
                    'type' => 'client-side',
                    'text' => $item,
                ]);
            }
        }
    }
}
