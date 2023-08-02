<template>
  <!-- <div id="content-to-pdf">
    <div class="w-full mx-auto">
      <div class="content">
        <div class="bg-[white] rounded-b-md">
          <div class="p-9">
            <div class="space-y-6 text-slate-700">
              <img
                class="object-cover h-12"
                src="https://www.hicom.fr/wp-content/uploads/2017/09/Logo_TV_2015.png"
              />

              <p
                class="text-xl font-extrabold tracking-tight uppercase font-body"
              >
                Devis N° {{ document.number }}
              </p>
            </div>
          </div>

          <div class="p-9">
            <div class="flex w-full">
              <div class="grid grid-cols-4 gap-12">
                <div class="text-sm font-light text-slate-500">
                  <p class="text-sm font-normal text-slate-700">
                    Invoice Detail:
                  </p>
                  <p>Unwrapped</p>
                  <p>Fake Street 123</p>
                  <p>San Javier</p>
                  <p>CA 1234</p>
                </div>
                <div class="text-sm font-light text-slate-500">
                  <p class="text-sm font-normal text-slate-700">Billed To</p>
                  <p>The Boring Company</p>
                  <p>Tesla Street 007</p>
                  <p>Frisco</p>
                  <p>CA 0000</p>
                </div>
                <div class="text-sm font-light text-slate-500">
                  <p class="text-sm font-normal text-slate-700">
                    Invoice Number
                  </p>
                  <p>000000</p>

                  <p class="mt-2 text-sm font-normal text-slate-700">
                    Date of Issue
                  </p>
                  <p>00.00.00</p>
                </div>
                <div class="text-sm font-light text-slate-500">
                  <p class="text-sm font-normal text-slate-700">Terms</p>
                  <p>0 Days</p>

                  <p class="mt-2 text-sm font-normal text-slate-700">Due</p>
                  <p>00.00.00</p>
                </div>
              </div>
            </div>
          </div>

          <div class="p-9">
            <div class="flex flex-col mx-0 mt-8">
              <table class="min-w-full divide-y divide-slate-500">
                <thead>
                  <tr>
                    <th
                      scope="col"
                      class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0"
                    >
                      Description
                    </th>
                    <th
                      scope="col"
                      class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell"
                    >
                      Quantity
                    </th>
                    <th
                      scope="col"
                      class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell"
                    >
                      Rate
                    </th>
                    <th
                      scope="col"
                      class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0"
                    >
                      Amount
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-slate-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                      <div class="font-medium text-slate-700">Tesla Truck</div>
                      <div class="mt-0.5 text-slate-500 sm:hidden">
                        1 unit at $0.00
                      </div>
                    </td>
                    <td
                      class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell"
                    >
                      48
                    </td>
                    <td
                      class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell"
                    >
                      $0.00
                    </td>
                    <td
                      class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>
                  <tr class="border-b border-slate-200">
                    <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                      <div class="font-medium text-slate-700">
                        Tesla Charging Station
                      </div>
                      <div class="mt-0.5 text-slate-500 sm:hidden">
                        1 unit at $75.00
                      </div>
                    </td>
                    <td
                      class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell"
                    >
                      4
                    </td>
                    <td
                      class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell"
                    >
                      $0.00
                    </td>
                    <td
                      class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>

                </tbody>
                <tfoot>
                  <tr>
                    <th
                      scope="row"
                      colspan="3"
                      class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                    >
                      Subtotal
                    </th>
                    <th
                      scope="row"
                      class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                    >
                      Subtotal
                    </th>
                    <td
                      class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>
                  <tr>
                    <th
                      scope="row"
                      colspan="3"
                      class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                    >
                      Discount
                    </th>
                    <th
                      scope="row"
                      class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                    >
                      Discount
                    </th>
                    <td
                      class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>
                  <tr>
                    <th
                      scope="row"
                      colspan="3"
                      class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0"
                    >
                      Tax
                    </th>
                    <th
                      scope="row"
                      class="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden"
                    >
                      Tax
                    </th>
                    <td
                      class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>
                  <tr>
                    <th
                      scope="row"
                      colspan="3"
                      class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0"
                    >
                      Total
                    </th>
                    <th
                      scope="row"
                      class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden"
                    >
                      Total
                    </th>
                    <td
                      class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0"
                    >
                      $0.00
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="footer p-9">
        <div class="border-t pt-5 pb-12 border-slate-200">
          <div class="text-sm font-light text-slate-700">
            <p>
              Payment terms are 14 days. Please be aware that according to the
              Late Payment of Unwrapped Debts Act 0000, freelancers are entitled
              to claim a 00.00 late fee upon non-payment of debts after this
              time, at which point a new invoice will be submitted with the
              addition of this fee. If payment of the revised invoice is not
              received within a further 14 days, additional interest will be
              charged to the overdue account and a statutory rate of 8% plus
              Bank of England base of 0.5%, totalling 8.5%. Parties cannot
              contract out of the Act’s provisions.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="html2pdf__page-break" />
  </div> -->

  <div id="content-to-pdf">
    <Page1 :document="document" />
    <div class="html2pdf__page-break" />
    <Page2 :document="document" />
    <div class="html2pdf__page-break" />
    <Page3 :document="document" />
  </div>
</template>
  
  <script setup>
import Page1 from "@/Components/Documents/QuotationTenplate/v1/Page1.vue";
import Page2 from "@/Components/Documents/QuotationTenplate/v1/Page2.vue";
import Page3 from "@/Components/Documents/QuotationTenplate/v1/Page3.vue";
defineProps({
  document: {
    required: true,
  },
});
</script>

<!-- 
<style scoped>
#content-to-pdf {
  position: relative;
  padding-bottom: 50px; /* height of your footer */
}

.footer {
  position: absolute;
  bottom: 0;
}
</style> -->


<style>
.containe-123 {
  margin: 20px;
}

.devis-background {
  background-color: #f5f5f5;
  padding: 5px;
}

.d-flex-123 {
  display: flex;
}

.space-betwee-122 {
  justify-content: space-between;
}

.h-100-px {
  height: 250px;
}

.w-100-d {
  width: 100%;
}

.w-70-d {
  width: 64.5%;
}

.w-60-d {
  width: 60.5%;
}

.w-30-d {
  width: 29.5%;
}

.w-40-d {
  width: 39%;
}

.w-45-d {
  width: 45%;
}

.w-90-d {
  width: 89.5%;
}

.w-10-d {
  width: 9.5%;
}

.w-20-d {
  width: 22.5%;
}

.w-10-d {
  width: 12.5%;
}

.w-50-d {
  width: 49.7%;
}

.w-50-devis {
  width: 48.5%;
}

.w-55-d {
  width: 54.5%;
}

.w-50-1 {
  width: 48.5%;
}

.w-33-d {
  width: 32.5%;
}

.logo {
  width: 100%;
  height: auto;
}

.label-qualite {
  width: 70%;
  height: auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.color-black {
  color: black;
}

.color-1 {
  color: #1f497e;
}

.color-2 {
  color: #3c56ab;
}

.color-3 {
  color: #d93281;
}

.color-4 {
  color: #f2f2f2;
}

.color-5 {
  color: #4170fe;
}

.color-6 {
  color: #2627ff;
}

.color-7 {
  color: #868686;
}

.color-8 {
  color: #010101;
}

.color-9 {
  color: #4e549f;
}

.color-red {
  color: red;
}

.text-bold-d {
  font-weight: bold;
}

.text-italic-d {
  font-style: italic;
}

.text-justify-d {
  text-align: justify;
}

.text-center-d {
  text-align: center;
}

.uppercase {
  text-transform: uppercase;
}

.underline {
  text-decoration: underline;
}

.email-style {
  color: #2627ff;
  text-decoration: underline;
}

.font-size-1 {
  font-size: 15.5px;
}

.font-size-2 {
  font-size: 13px;
}

.font-size-4 {
  font-size: 6px;
}

.font-size-3 {
  font-size: 8.3px;
}

.font-size-12 {
  font-size: 12px;
}

.font-size-10 {
  font-size: 9px;
}

.rounded-1-d {
  background-color: #f2f2f2;
  border-radius: 12px;
}

.rounded-2-2 {
  border: solid #f2f2f2;
  border-radius: 25px;
}

.p-5-d {
  padding: 6.5px;
}

.p-1-d {
  padding: 4.5px;
}

.mt-1-d {
  margin-top: 2px;
}

.mt-2-d {
  margin-top: 6px;
}

.mt-1-2 {
  margin-top: 5px;
}

.m-auto-d {
  margin: auto;
}

.border-right-d {
  border-right: 4px solid #7f7f7f;
}
</style>