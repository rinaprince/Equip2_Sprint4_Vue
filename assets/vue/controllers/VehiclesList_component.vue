<script setup>
defineProps({
  vehicles: Array
});

const vehiclesCreatePath = `/vehicles/new`;

const vehiclesShowPath = (id) => `/vehicles/${id}`;

const vehiclesEditPath = (id) => `/vehicles/${id}/edit`;

const vehiclesDeletePath = (id) => `/vehicles/${id}/delete`;

</script>

<template>
  <h1>Vehicle index</h1>

  <form method="get" role="search">
    <input type="search" name="q" placeholder="Search..." aria-label="Search">
    <button type="submit">Search</button>
  </form>

  <table class="table">
    <thead>
    <tr>
      <th>Id</th>
      <th>Plate</th>
      <th>ObservedDamages</th>
      <th>Kilometers</th>
      <th>BuyPrice</th>
      <th>SellPrice</th>
      <th>Fuel</th>
      <th>Iva</th>
      <th>Description</th>
      <th>ChassisNumber</th>
      <th>GearShit</th>
      <th>IsNew</th>
      <th>TransportIncluded</th>
      <th>Color</th>
      <th>RegistrationDate</th>
      <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="vehicle in vehicles">
      <td>{{ vehicle.id }}</td>
      <td>{{ vehicle.plate }}</td>
      <td>{{ vehicle.observedDamages }}</td>
      <td>{{ vehicle.kilometers }}</td>
      <td>{{ vehicle.buyPrice }}</td>
      <td>{{ vehicle.sellPrice }}</td>
      <td>{{ vehicle.fuel }}</td>
      <td>{{ vehicle.iva }}</td>
      <td>{{ vehicle.description }}</td>
      <td>{{ vehicle.chassisNumber }}</td>
      <td>{{ vehicle.gearShit }}</td>
      <td>{{ vehicle.isNew ? 'Yes' : 'No' }}</td>
      <td>{{ vehicle.transportIncluded ? 'Yes' : 'No' }}</td>
      <td>{{ vehicle.color }}</td>
      <td>{{ vehicle.registrationDate ? vehicle.registrationDate | date('Y-m-d') : '' }}</td>
      <td>
        <a :href="vehiclesShowPath(vehicle.id)"><button class="details-button"><i class="fas fa-eye"></i></button></a>
        <a :href="vehiclesEditPath(vehicle.id)"><button class="edit-button"><i class="fas fa-pencil-alt"></i></button></a>
        <a :href="vehiclesDeletePath(vehicle.id)"><button class="delete-button" ><i
            class="fas fa-trash"></i></button></a>
      </td>
    </tr>
    <tr>
      <td colspan="16">no records found</td>
    </tr>
    </tbody>
  </table>

  <a :href="vehiclesCreatePath">
    <button>Create new</button>
  </a>
</template>