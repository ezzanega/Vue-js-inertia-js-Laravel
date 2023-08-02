<template>
  <div class="containe-123">
    <div class="flex justify-between">
      <div class="w-full flex space-x-3">
        <div class="w-1/3 text-xl text-primary font-bold">
          <!-- <img class="logo" src="/img/logo/logo-01.png" alt="logo" /> -->
          SysDem
        </div>
        <div class="w-1/3 devis-background font-size-12 color-2 text-bold-d">
          1 Rue Aristide Briand 94250 Gentilly Bat Y <br />
          Téléphone : 01 75 43 25 00 <br />
          Téléphone : 01 48 30 55 49
        </div>
        <div class="w-1/3 devis-background font-size-12 color-2 text-bold-d">
          SIREN : 840 635 957<br />
          code APE : 4942Z<br />
          Licence N° : 2018 /11/ 0001547
        </div>
      </div>
    </div>

    <div class="flex justify-between color-black mt-2-d">
      <div class="w-45-d">
        <div class="devis-background font-size-12 text-bold-d">
          Devis N°
          <span class="color-1 text-italic-d">{{ document.number }}</span> du
          11/08/2023
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1">
          <div class="w-60-d devis-background">Conseiller: M.</div>
          <div class="w-40-d devis-background">Tél: 06 71 77 37 22</div>
        </div>
        <div class="devis-background font-size-12 text-bold-d mt-1-d">
          Validité devis : 1 mois
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Volume : 20 m3</div>
          <div class="w-60-d devis-background">
            Catégorie :
            <span class="color-3 uppercase">okay</span>
          </div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Distance</div>
          <div class="w-60-d devis-background">56 KM</div>
        </div>
      </div>

      <div class="w-45-d devis-background font-size-12 text-bold-d">
        CLIENT : <br />
        M. Jhon Doe
        <br /><br />
        123, rue de Sysdem <br />
        12300 Saas ville<br />
        Tél : 0919783783
      </div>
    </div>

    <!-- chargemet livraison -->

    <div class="flex justify-between mt-2-d text-bold-d color-3">
      <div class="w-50-d devis-background font-size-1 text-center-d p-1-d">
        CHARGEMENT
      </div>

      <div class="w-50-d devis-background font-size-1 text-center-d p-1-d">
        LIVRAISON
      </div>
    </div>

    <!-- Détails -->
    <div class="flex justify-between mt-1 text-bold-d color-black">
      <div class="w-50-d">
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Date ou période</div>
          <div class="w-60-d devis-background">12/12/2023</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Adresse</div>
          <div class="w-60-d devis-background">
            123, rue de Sysdem 9018762 SysVille
          </div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">CP : 9018762</div>
          <div class="w-60-d devis-background">Ville : SysVille</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Étage : RDC</div>
          <div class="w-60-d devis-background">Ascenseur : NON</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Portage : 10m</div>
          <div class="w-60-d devis-background">Monte meuble : OUI</div>
        </div>
        <div class="font-size-12 text-bold-d mt-1-d">
          <div class="devis-background">Détails : Nan</div>
        </div>
      </div>

      <div class="w-50-d">
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Date ou période</div>
          <div class="w-60-d devis-background">12/12/2023</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Adresse</div>
          <div class="w-60-d devis-background">
            123, rue de Sysdem 9018762 SysVille
          </div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">CP : 9018762</div>
          <div class="w-60-d devis-background">Ville : SysVille</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Étage : RDC</div>
          <div class="w-60-d devis-background">Ascenseur : NON</div>
        </div>
        <div class="flex justify-between font-size-12 text-bold-d mt-1-d">
          <div class="w-40-d devis-background">Portage : 22m</div>
          <div class="w-60-d devis-background">Monte meuble : NON</div>
        </div>
        <div class="font-size-12 text-bold-d mt-1-d">
          <div class="devis-background">Détails : RAS</div>
        </div>
      </div>
    </div>

    <div class="flex justify-between mt-2-d font-size-2 color-3">
      <div class="w-60-d devis-background text-center-d p-1-d text-bold-d">
        DETAILS PRESTATION
      </div>

      <div class="w-40-d flex justify-between text-center-d">
        <div class="w-50-d devis-background p-1-d text-bold-d">PRIX UHT</div>
        <div class="w-50-d devis-background p-1-d text-bold-d">
          PRIX TOTAL HT
        </div>
      </div>
    </div>

    <div class="flex justify-between mt-1-d font-size-2">
      <div class="w-60-d flex justify-between">
        <div class="w-50-d color-black">
          <div class="devis-background p-1-d text-center-d color-3 text-bold-d">
            A NOTRE CHARGE
          </div>
          <div
            v-for="i in 7"
            :key="i"
            class="devis-background p-1-d mt-1-d font-size-12"
          >
            Element {{ i }}
          </div>
        </div>

        <div class="w-50-d color-black">
          <div class="devis-background p-1-d text-center-d color-3 text-bold-d">
            A VOTRE CHARGE
          </div>
          <div
            v-for="i in 7"
            :key="i"
            class="devis-background p-1-d mt-1-d font-size-12"
          >
            Element {{ i }}
          </div>
        </div>
      </div>

      <div
        class="w-40-d flex justify-between text-center-d color-black text-bold-d"
      >
        <div class="w-50-d">
          <div class="devis-background p-1-d h-100-px">123 €</div>
          <div class="devis-background p-1-d color-3 mt-1-d">TOTAL HT</div>
          <div class="devis-background p-1-d color-3 mt-1-d">TVA à 20%</div>
        </div>
        <div class="w-50-d">
          <div class="devis-background p-1-d h-100-px">123 €</div>
          <div class="devis-background p-1-d mt-1-d">123 €</div>
          <div class="devis-background p-1-d mt-1-d">12 €</div>
        </div>
      </div>
    </div>

    <div class="flex justify-between mt-2-d font-size-12">
      <div class="w-60-d flex justify-between">
        <div class="w-50-d">
          <div class="devis-background text-center-d p-2 color-3">
            Modalités de règlement
          </div>

          <div
            class="devis-background p-1-d flex justify-between mt-1-d text-bold-d color-black"
          >
            <div>Acompte :</div>
            <div>30%</div>
            <div>100 €</div>
          </div>

          <div
            class="devis-background p-1-d flex justify-between mt-1-d text-bold-d color-black"
          >
            <div>Solde :</div>
            <div>70%</div>
            <div>309 €</div>
          </div>
        </div>

        <div class="w-50-d font-size-3 devis-background p-1-d color-black">
          <div class="text-bold-d">Acompte</div>
          : A régler à la commande par chèque ou virement <br /><br />

          <div class="text-bold-d">Solde </div>
           : Si virement paiement à effectuer deux jours avant la livraison
        </div>
      </div>

      <div class="w-40-d">
        <div
          class="flex justify-between text-center-d color-black text-bold-d font-size-2"
        >
          <div class="w-50-d devis-background p-1-d color-3">TOTAL TTC</div>
          <div class="w-50-d devis-background p-1-d">4253 €</div>
        </div>
        <div class="devis-background p-1-d mt-1-d font-size-3 color-black">
          <span class="text-bold-d"
            >En cas d’imprévus ou élément non signalé :
          </span>
          Main d’œuvre : <br />
          190 € TT / ½ Journée <br />
          Monte meuble : 350 € TTC / ½ journée <br />
          Véhicules : 200 € TTC / ½ journée
        </div>
      </div>
    </div>

    <div class="flex justify-between mt-2-d font-size-12 color-black">
      <div class="w-33-d devis-background p-1-d">
        Date : <br /><br />
        ........................................................................
      </div>
      <div class="w-33-d devis-background p-1-d">
        Écrire la mention bon pour accord : <br /><br />
        ........................................................................
      </div>
      <div class="w-33-d devis-background p-1-d">
        Signature : <br /><br />
        ........................................................................
      </div>
    </div>

    <div class="mt-1-d flex justify-between devis-background color-black">
      <div class="w-50-d font-size-10">
        IBAN : FR76 1820 6002 0465 0531 3721 559
      </div>
      <div class="w-50-d font-size-10 text-center-d">
        CODE SWIFT : AGRIFRPP882
      </div>
    </div>

    <div class="color-2 text-center-d font-size-10 devis-background mt-1-d">
      HD DEM – L’AGENCE DU DEMENAGEMENT – BL TRANSPORTS SARL AU CAPITAL DE 5500
      € <br />
      1 RUE ARISTIDE BRIAND 94250 GENTILLY BAT Y – TEL : 01 75 43 25 00 – TEL :
      01 48 30 55 49 – Email :
      <span class="email-style">agencedemenagement@gmail.com</span> -
      <span class="email-style">contact@bltransports.fr</span> <br />
      SIRET 840 635 957 00029 – CODE APE: 4942Z – N° TVA intracommunautaire FR
      33 840635957 <br />
    </div>
  </div>
</template>

<script setup>
defineProps({
  document: {
    required: true,
  },
});
</script>