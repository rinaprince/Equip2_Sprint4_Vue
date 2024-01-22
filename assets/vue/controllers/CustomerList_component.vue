<template>
  <div>
    <h1>Customer index</h1>

    <div id="div-table">
      <table class="table mt-3 contingut">
        <thead>
          <tr>
            <th>Name</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Dni</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Customer_type</th>
            <th>Operations</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers" >
            <td data-title="Name:">{{ customer.name }}</td>
            <td data-title="Lastname">{{ customer.lastname }}</td>
            <td data-title="Address">{{ customer.address }}</td>
            <td data-title="DNI">{{ customer.dni }}</td>
            <td data-title="Phone">{{ customer.phone }}</td>
            <td data-title="Email">{{ customer.email }}</td>
            <td data-title="Type">{{ customer.type }}</td>
            <td data-title="Operations">
              <template v-if="customer.type === 'private'">
                <a :href="privateShowPath(customer.id)"><button class="details-button" data-invoice-id="3"><i class="fas fa-eye"></i></button></a>
                <a :href="privateEditPath(customer.id)"><button class="edit-button" data-invoice-id="3"><i class="fas fa-pencil-alt"></i></button></a>
              </template>
              <template v-else-if="customer.type === 'professional'">
                <a :href="professionalShowPath(customer.id)"><button class="details-button" data-invoice-id="3"><i class="fas fa-eye"></i></button></a>
                <a :href="professionalEditPath(customer.id)"><button class="edit-button" data-invoice-id="3"><i class="fas fa-pencil-alt"></i></button></a>
              </template>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


  </div>

</template>

<script setup>

defineProps({
  customers: Array
});

const privateShowPath = (id) => `/private/customer/${id}`;
const privateEditPath = (id) => `/private/customer/${id}/edit`;
const professionalShowPath = (id) => `/professional/${id}`;
const professionalEditPath = (id) => `/professional/${id}/edit`;

</script>

