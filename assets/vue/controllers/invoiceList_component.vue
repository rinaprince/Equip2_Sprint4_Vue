<script setup>
defineProps({
  invoices: Array
});

const invoiceShowPath = (id) => `/invoices/${id}`;

const invoiceCreatePath = '/invoices/new';
const invoiceEditPath = (id) => `/invoices/${id}/edit`;
const invoiceDeletePath = (id) => `/invoices/${id}/delete`;

</script>

<template>
  <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
    <input name="q" type="search" class="form-control text-bg-light" placeholder="Search..."
           aria-label="Search">
  </form>

  <table id="backoffice-table">
    <thead>
    <tr>
      <th>Numero</th>
      <th>Usuario</th>
      <th>Precio</th>
      <th>Fecha</th>
      <th>Operacions</th>
    </tr>
    </thead>
    <tbody>

    <tr v-for="invoice in invoices">
      <td data-title="Numero:">{{invoice.number}}</td>
      <td data-title="Usuario:">{{invoice.customer.name}}</td>
      <td data-title="Precio:">{{invoice.price}}</td>
      <td data-title="Fecha:">{{ invoice.date.date.substring(0,10)}}</td>
      <td>
        <a :href="invoiceShowPath(invoice.id)">
          <button class="details-button"><i class="fas fa-eye"></i></button>
        </a>
        <a :href="invoiceEditPath(invoice.id)">
          <button class="edit-button"><i class="fas fa-pencil-alt"></i></button>
        </a>
        <a :href="invoiceDeletePath(invoice.id)"><button class="delete-button" ><i
            class="fas fa-trash"></i></button></a>
      </td>
    </tr>
    </tbody>
  </table>


  <a :href="invoiceCreatePath"><button>Create new</button></a>

</template>