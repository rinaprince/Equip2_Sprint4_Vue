<script setup>
//import {computed, ref} from "vue";

//const { dates } = defineProps(['data']);
defineProps({
  data: Array,
  config: Array
});

/*const filters = ref({
  global: {value: null, matchMode: 'CONTAINS'},
});

const applyFilters = (data, filters) => {
  return data.filter((invoice) => {
    return (
        (!filters.global.value || JSON.stringify(invoice).toLowerCase().includes(filters.global.value.toLowerCase()))
    );
  });
};

const filteredData = computed(() => {
  return applyFilters(dates, filters.value);
});*/
</script>

<template>
  <div>
    <!--<input type="text" id="global-filter" v-model="filters.global.value" @input="applyFilters" placeholder="Buscador Global"/>-->
  </div>

  <table id="backoffice-table">
    <thead>
    <tr>
        <th v-for="(item, index) in config" :key="index">{{ item }}</th>
        <th>Operaciones</th>
    </tr>
    </thead>
    <tbody>
    <!-- imprime Los datos del array-->
    <tr v-for="(data, index) in data" :key="index">
      <!-- Imprime el data-title correspondiente al td -->
      <td v-for="(value, titleIndex) in config" :key="titleIndex" :data-title="config[titleIndex]">
        {{ data[titleIndex] }}
      </td>
    <!--  <td>
        <a :href="invoiceShowPath(data.id)">
          <button class="details-button"><i class="fas fa-eye"></i></button>
        </a>
        <a :href="invoiceEditPath(data.id)">
          <button class="edit-button"><i class="fas fa-pencil-alt"></i></button>
        </a>
        <a :href="invoiceDeletePath(data.id)">
          <button class="delete-button"><i class="fas fa-trash"></i></button>
        </a>
      </td>-->
    </tr>
    </tbody>
  </table>

  <a :href="invoiceCreatePath"><button>Create new</button></a>
</template>