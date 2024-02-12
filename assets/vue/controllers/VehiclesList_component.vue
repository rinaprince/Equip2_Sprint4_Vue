<script setup>
const {vehicles} = defineProps(['vehicles']);

import {ref, onMounted, computed} from 'vue';
import axios from "axios";
import Swal from 'sweetalert2';


//Tipus de filtració
const filters = ref({
  global: {value: null, matchMode: 'CONTAINS'},
  kilometers: {value: null, matchMode: 'CONTAINS'},
  ChassisNumber: {value: null, matchMode: 'IN'},
  date: {value: null, matchMode: 'EQUALS'},
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

//Constants
const filteredVehicles = computed(() => {
  return applyFilters(vehicles, filters.value);
});

const vehiclesCreatePath = `/vehicles/new`;

const vehiclesShowPath = (id) => `/vehicles/${id}`;

const vehiclesEditPath = (id) => `/vehicles/${id}/edit`;

const vehiclesAddImagePath = (id) => `/vehicles/${id}/images/add`;

function sweetAlertDelete(id) {
  Swal.fire({
    title: 'Estàs segur?',
    text: "No podras desfer la teua decissió!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#aa8e31ff',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, elimina definitivament!'
  }).then((result) => {
    if (result.isConfirmed === true) {
      axios.post(`/vehicles/${id}/delete`)
          .then(response => {
            Swal.fire({
              title: "Eliminat!",
              text: "El vehicle ha sigut eliminat.",
              icon: "success"
            });
          })
          .catch(error => {
            console.error(error);
            Swal.fire({
              title: "Error",
              text: "S'ha produït un error en eliminar el vehicle.",
              icon: "error"
            });
          });
    }
  });
}
</script>

<template>
  <h1>Index de Vehicles</h1>

  <div class="d-flex justify-content-between align-items-center mb-2">
    <form method="get" role="search" class="d-flex">
      <input type="search" class="form-control" name="q" placeholder="Matrícula, combustible, color..."
             aria-label="Search">
      <button type="submit" class="btn btn-outline-dark">Search</button>
    </form>
    <input type="search" class="border border-0 rounded p-1" id="global-filter" v-model="filters.global.value"
           @input="applyFilters" placeholder="Kilòmetres, data..."/>
    <a :href="vehiclesCreatePath">
      <button class="btn btn-warning">Crea nou</button>
    </a>
  </div>


  <!--
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

  -->

  <div class="col-12 p-3 d-flex justify-content-center">

    <div class="container-fluid">
      <div class="row">
        <div class="col-4 p-3" v-for="vehicle in vehicles">
          <div>
            <img src="/public/equip1/img/" alt="Imatge Vehicle 1" width="250px" height="200px" class="rounded-top-3">
            <div class="bg-white mt-1">
              <div class="d-flex align-items-center justify-content-end">
                <a :href="vehiclesShowPath(vehicle.id)">
                  <button class="border-0 bg-transparent p-1">
                    <i class="bi bi-eye fnt-tertiary-BHEC"></i>
                  </button>
                </a>
                <a :href="vehiclesEditPath(vehicle.id)">
                  <button class="border-0 bg-transparent p-1">
                    <i class="bi bi-pencil-square fnt-tertiary-BHEC"></i>
                  </button>
                </a>
                <a @click="sweetAlertDelete(vehicle.id)">
                  <button class="border-0 bg-transparent p-1">
                    <i class="bi bi-trash"></i>
                  </button>
                </a>
                <a :href="vehiclesAddImagePath(vehicle.id)">
                  <button class="border-0 bg-transparent p-1 fnt-tertiary-BHEC">
                    <i class="bi bi-image"></i>
                  </button>
                </a>

              </div>
              <p class="text-center fw-bold pt-1 m-0">{{ vehicle.model.brand.name }}</p>
              <div class="d-flex justify-content-between">
                <p class="text-center ps-4">{{ vehicle.model.name }}</p>
                <p class="text-center pe-4">{{ vehicle.fuel }}</p>
              </div>
              <div class="d-flex justify-content-between px-4">
                <p>{{ vehicle.plate }}</p>
                <p>{{
                    vehicle.registrationDate ? new Date(vehicle.registrationDate.date).toLocaleDateString() : ''
                  }}</p>
                <p>{{ vehicle.kilometers }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>