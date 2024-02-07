<script setup>
/*defineProps({
  vehicles: Array
});*/

const { vehicles } = defineProps(['vehicles']);

import { ref, onMounted, computed } from 'vue';

//Tipus de filtració
const filters = ref({
  global: { value: null, matchMode: 'CONTAINS' },
  kilometers: { value: null, matchMode: 'CONTAINS' },
  ChassisNumber: { value: null, matchMode: 'IN' },
  date: { value: null, matchMode: 'EQUALS' },
});

//Filtrador
const applyFilters = (data, filters) => {
  return data.filter((vehicle) => {
    return (
        (!filters.global.value || JSON.stringify(vehicle).toLowerCase().includes(filters.global.value.toLowerCase())) &&
        (!filters.kilometers.value || vehicle.kilometers.toLowerCase().includes(filters.kilometers.value.toLowerCase())) &&
        (!filters.ChassisNumber.value || filters.ChassisNumber.value.includes(vehicle.ChassisNumber.toString())) &&
        (!filters.date.value || vehicle.date.date.substring(0, 10) === filters.date.value)
    );
  });
};

const filteredVehicles = computed(() => {
  return applyFilters(vehicles, filters.value);
});

const vehiclesCreatePath = `/vehicles/new`;

const vehiclesShowPath = (id) => `/vehicles/${id}`;

const vehiclesEditPath = (id) => `/vehicles/${id}/edit`;

const vehiclesAddImagePath = (id) => `/vehicles/${id}/images/add`;

</script>

<template>
  <h1>Index de Vehicles</h1>

  <div class="d-flex justify-content-between align-items-center mb-2">
    <form method="get" role="search" class="d-flex">
      <input type="search" class="form-control" name="q" placeholder="Matrícula, combustible, color..." aria-label="Search">
      <button type="submit" class="btn btn-outline-dark">Search</button>
    </form>
    <input type="search" class="border border-0 rounded p-1" id="global-filter" v-model="filters.global.value" @input="applyFilters" placeholder="Kilòmetres, data..."/>
    <a :href="vehiclesCreatePath">
      <button class="btn btn-warning">Crea nou</button>
    </a>
  </div>

  <table class="table">
    <thead>
    <tr>
      <th class="d-none">Id</th>
      <th>Plate</th>
      <th class="d-none">ObservedDamages</th>
      <th>Kilometers</th>
      <th>BuyPrice</th>
      <th>SellPrice</th>
      <th>Fuel</th>
      <th>Iva</th>
      <th class="d-none">Description</th>
      <th>ChassisNumber</th>
      <th>GearShit</th>
      <th>IsNew</th>
      <th class="d-none">TransportIncluded</th>
      <th>Color</th>
      <th>RegistrationDate</th>
      <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="vehicle in filteredVehicles" :key="vehicle.id">
      <td class="d-none">{{ vehicle.id }}</td>
      <td>{{ vehicle.plate }}</td>
      <td class="d-none">{{ vehicle.observedDamages }}</td>
      <td>{{ vehicle.kilometers }}</td>
      <td>{{ vehicle.buyPrice }}</td>
      <td>{{ vehicle.sellPrice }}</td>
      <td>{{ vehicle.fuel }}</td>
      <td>{{ vehicle.iva }}</td>
      <td class="d-none">{{ vehicle.description }}</td>
      <td>{{ vehicle.chassisNumber }}</td>
      <td>{{ vehicle.gearShit }}</td>
      <td>{{ vehicle.isNew ? 'Yes' : 'No' }}</td>
      <td class="d-none">{{ vehicle.transportIncluded ? 'Yes' : 'No' }}</td>
      <td>{{ vehicle.color }}</td>
      <td>{{ vehicle.registrationDate ? new Date(vehicle.registrationDate.date).toLocaleDateString() : '' }}</td>
      <td>
        <a :href="vehiclesShowPath(vehicle.id)"><button class="btn btn-primary"><i class="fas fa-eye"></i></button></a>
        <a :href="vehiclesEditPath(vehicle.id)"><button class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a>
        <a :href="vehiclesAddImagePath(vehicle.id)"><button class="btn btn-danger"><i class="fa-regular fa-image"></i></button></a>
      </td>
    </tr>
    </tbody>
  </table>
</template>