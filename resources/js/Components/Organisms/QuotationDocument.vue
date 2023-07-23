<template>
  <div>
    <div>
      <div id="pdf-content" ref="pdfContent" class="pdf-content">
        <h2>Devis N° {{ document.number }}</h2>
      </div>
    </div>
    <iframe
      id="pdf-preview"
      :style="{ width: '100%', height: previewHeight + 'px' }"
    ></iframe>
  </div>
</template>
  
  <script setup>
import { jsPDF } from "jspdf";
import html2canvas from "html2canvas";
import { onMounted, ref } from "vue";
const test = ref(true);

defineProps({
  document: {
    required: true,
  },
});

const previewHeight = ref(60);
const pdfContent = ref(null);

onMounted(() => {
  previewHeight.value = window.innerHeight - (window.innerHeight * 20) / 100;
  pdfContent.value.style.display = "block";
  const pdf = new jsPDF("p", "mm", "a4");
  html2canvas(pdfContent.value).then((canvas) => {
    const imgData = canvas.toDataURL("image/png");
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
    pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);

    const blob = pdf.output("blob");
    const blobURL = URL.createObjectURL(blob);
    document.getElementById("pdf-preview").src = blobURL;

    pdfContent.value.style.display = "none";
  });
});
</script>

<style scoped>
.pdf-content {
  background-color: #438a7a;
  text-align: center;
  padding: 20px;
  display: none;
}

.pdf-content h2 {
  font-size: 20px;
  font-weight: bold;
  color: white;
}

@media print {
  .pdf-content {
    display: block;
  }
}
</style>
