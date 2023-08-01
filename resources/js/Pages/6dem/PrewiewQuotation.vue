<template>
  <Head title="Details devis" />
  <DemLayout>
    <div class="flex flex-col space-y-2 mb-4 text-sm text-gray-600">
      <div class="relative z-20 flex h-navbar shrink-0 bg-secondary shadow">
        <span class="h-navbar border-r border-neutral-200 lg:block" />
        <div class="flex flex-1 justify-between pr-4 sm:pr-6 lg:pr-8">
          <div class="w-full flex justify-between">
            <div class="mx-8 max-w-xs py-5 lg:block">
              <h1 class="text-primary truncate font-semibold">
                Devis N° {{ quotation.number }}
              </h1>
            </div>
            <span class="h-navbar border-l border-neutral-200 hidden xl:block">
            </span>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton> Modifier </SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton> Créer une lettre de voiture </SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton @click="download">Télécharger</SecondaryButton>
            </div>

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton @click="preview">Aperçu</SecondaryButton>
            </div>

            <!-- <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton>Envoyer par mail</SecondaryButton>
            </div> -->

            <div class="mx-5 hidden xl:flex items-center">
              <SecondaryButton>Supprimer</SecondaryButton>
            </div>

            <div class="mx-1 flex items-center justify-end">
              <Dropdown placement="bottom-end">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="h-6 w-6 cursor-pointer"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                  />
                </svg>
                <template #popper>
                  <QuotationActionsPopperContent :id="quotation.id" />
                </template>
              </Dropdown>
            </div>
          </div>
        </div>
      </div>
      <iframe v-if="pdfUrl" :src="pdfUrl" width="100%" height="600px"></iframe>
      <div ref="pdfContent" class="pdf-content">
        <QuotationDocument :document="quotation" />
      </div>
    </div>
  </DemLayout>
</template>
      
  <script setup>
import DemLayout from "@/Layouts/DemLayout.vue";
import QuotationActionsPopperContent from "@/Components/Molecules/QuotationActionsPopperContent.vue";
import QuotationDocument from "@/Components/Documents/QuotationDocument.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import html2pdf from "html2pdf.js";
import { Dropdown } from "floating-vue";
import { Head, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const quotation = usePage().props.quotation;

const pdfContent = ref(null);
const pdfUrl = ref(null);

onMounted(() => {
  pdfContent.value.style.display = "block";

  const opt = {
    margin: 0,
    filename: `Devis N°${quotation.number}.pdf`,
    image: { type: "webp", quality: 1 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
  };
  html2pdf()
    .set(opt)
    .from(pdfContent.value)
    .outputPdf("blob")
    .then((blob) => {
      if (pdfUrl.value) {
        URL.revokeObjectURL(pdfUrl.value);
      }
      pdfUrl.value = URL.createObjectURL(blob);
      pdfContent.value.style.display = "none";
    });
});

const preview = () => {
  const config = {
    filename: "test.pdf",
    image: { type: "webp", quality: 1.0 },
    html2canvas: { dpi: 75, scale: 2, letterRendering: true },
    pagebreak: { mode: ["avoid-all", "css", "legacy"] },
    jsPDF: {
      orientation: "portrait",
      unit: "in",
      format: "a4",
      compressPDF: true,
    },
  };

  pdfContent.value.style.display = "block";
  html2pdf()
    .from(pdfContent.value)
    .set(config)
    .toPdf()
    .get("pdf")
    .then((pdf) => {
      var totalPages = pdf.internal.getNumberOfPages();
      for (let i = 1; i <= totalPages; i++) {
        pdf.setPage(i);
        pdf.setFontSize(10);
        pdf.setTextColor(150);
        pdf.text(
          "okay for testing",
          pdf.internal.pageSize.getWidth() - 30,
          pdf.internal.pageSize.getHeight() - 10
        );
      }
      pdfContent.value.style.display = "none";
    })
    .save();
};

const download = () => {
  const opt = {
    margin: 0,
    filename: `Devis N°${quotation.number}.pdf`,
    image: { type: "html", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
  };
  html2pdf().set(opt).from(pdfContent.value).save();
};
</script>

<style scoped>
.pdf-content {
  display: none;
}

@media print {
  .pdf-content {
    display: block;
  }
}
</style>