
<template>
  <!--
  <section>
    <h2>Nou vehicle</h2>
    <p v-if="flashMessage.message" class="message">{{ flashMessage.message }}</p>

    <form @submit.prevent="submitForm" enctype="multipart/form-data">

      <label for="plate">Plate:</label>
      <input v-model="formData.plate" type="text" id="plate" name="plate">

      <label for="observed_damages">Danys observats:</label>
      <textarea v-model="formData.observedDamages" id="observed_damages" name="observed_damages"></textarea>

      <label for="kilometers">Kilometres:</label>
      <input v-model="formData.kilometers" type="number" id="kilometers" name="kilometers">

      <label for="buy_price">Preu de compra:</label>
      <input v-model="formData.buyPrice" type="text" id="buy_price" name="buy_price">

      <label for="sell_price">Preu de venda:</label>
      <input v-model="formData.sellPrice" type="text" id="sell_price" name="sell_price">

      <label for="fuel">Tipus de combustible:</label>
      <select v-model="formData.fuel" id="fuel" name="fuel">
        <option value="gasolina">Gasolina</option>
        <option value="diesel">Diesel</option>
        <option value="electric">Electric</option>
      </select>

      <label for="iva">IVA:</label>
      <input v-model="formData.iva" type="text" id="iva" name="iva">

      <label for="description">Descripcio:</label>
      <textarea v-model="formData.description" id="description" name="description"></textarea>

      <label for="chassis_number">Chassis Number:</label>
      <input v-model="formData.chassisNumber" type="text" id="chassis_number" name="chassis_number">

      <label for="gearbox">Gear Shift:</label>
      <input v-model="formData.gearbox" type="text" id="gearbox" name="gearbox">

      <label for="is_new">El vehicle es nou?:</label>
      <select v-model="formData.isNew" id="is_new" name="is_new">
        <option value="true">Si</option>
        <option value="false">No</option>
      </select>

      <label for="transport_included">Transport incluit?:</label>
      <select v-model="formData.transportIncluded" id="transport_included" name="transport_included">
        <option value="true">Si</option>
        <option value="false">No</option>
      </select>

      <label for="color">Color:</label>
      <input v-model="formData.color" type="text" id="color" name="color">

      <label for="registration_date">Data de registre:</label>
      <input v-model="formData.registrationDate" type="date" id="registration_date" name="registration_date">

      <label for="model">Model:</label>
      <select v-model="formData.modelId" id="model" name="model_id">
        <option v-for="model in models" :key="model.id" :value="model.id">{{ model.name }}</option>
      </select>

      <label for="provider">Provider:</label>
      <select v-model="formData.providerId" id="provider" name="provider_id">
        <option v-for="provider in providers" :key="provider.id" :value="provider.id">{{ provider.name }}</option>
      </select>

      <label for="image">Image:</label>
      <input type="file" id="image" name="image[]" multiple @change="handleFileChange">


      <button type="submit" @click="crearVehiculo">Crear</button>
    </form>

    <form @submit.prevent="cancelForm" action="/vehicle_list.php" method="get">
      <button type="submit">Cancelar</button>
    </form>
  </section>
  <!--
    {{ form_start(form) }}
    <div class="row">
      <div class="col-2">
        {{ form_row(form.plate) }}
      </div>

      <div class="col-5">
        {{ form_row(form.model) }}
      </div>
      <div class="col-5">
        {{ form_row(form.gearShit) }}
      </div>

      <div class="col-4">
        {{ form_row(form.chassisNumber) }}
      </div>
      <div class="col-4">
        {{ form_row(form.buyPrice) }}
      </div>
      <div class="col-4">
        {{ form_row(form.sellPrice) }}
      </div>

      <div class="col-4">
        {{ form_row(form.kilometers) }}
      </div>
      <div class="col-4">
        {{ form_row(form.fuel) }}
      </div>
      <div class="col-4">
        {{ form_row(form.iva) }}
      </div>
      <div class="col-4">
        {{ form_row(form.isNew) }}
      </div>
      <div class="col-4">
        {{ form_row(form.transportIncluded) }}
      </div>
      <div class="col-4">
        {{ form_row(form.color) }}
      </div>
      <div class="col-4">
        {{ form_row(form.registrationDate) }}
      </div>
      <div class="col-4">
        {{ form_row(form.provider) }}
      </div>
      <div class="col-4">
        {{ form_row(form.vehicleOrder) }}
      </div>
      <div class="col-12">
        {{ form_row(form.description) }}
      </div>
      <div class="col-12">
        {{ form_row(form.observedDamages) }}
      </div>

    </div>
    {{ form_widget(form) }}
    <button class="btn">{{ button_label|default('Save') }}</button>
    {{ form_end(form) }}
  -->





</template>
<!--  <script>
  import axios from 'axios';
  import datosVehiculos from './datosVehiculos.json';

  export default {

    methods: {
      async crearVehiculo() {
        try {
          // Aquí debes reemplazar la URL con la ruta correcta hacia tu controlador Symfony
          const response = await axios.post('/vehicles/new', {
            // Puedes enviar datos adicionales si es necesario
            // datos: 'valor',
          });

          // Manejar la respuesta si es necesario
          console.log(response.data);

          // Redireccionar o hacer algo más después de la inserción exitosa
        } catch (error) {
          // Manejar errores aquí
          console.error('Error al crear vehículo:', error);
        }
      },
    },
  };
  </script>-->
<script>
/**import axios from 'axios';
import datosVehiculos from './datosVehiculos.json';

export default {
  data() {
    return {
      formData: {
        plate: "",
        observed_damages: "",
        kilometers: null,
        buy_price: "",
        sell_price: "",
        fuel: "gasolina",
        iva: "",
        description: "",
        chassis_number: "",
        gearbox: "",
        is_new: "true",
        transport_included: "true",
        color: "",
        registration_date: "",
        model_id: null,
        provider_id: null,
        image: null,
      },
      flashMessage: {
        message: ""
      },
      models:datosVehiculos.models,
      providers:datosVehiculos.providers,
      /* models: [ {"id": 1, "name": "ModeloX"},
       {"id": 2, "name": "ModeloY"},
       {"id": 3, "name": "ModeloZ"}],
   providers: [{"id": 1, "name": "ProveedorA"},
       {"id": 2, "name": "ProveedorB"},
       {"id": 3, "name": "ProveedorC"}],
   
    };
  },
  methods: {
    async crearVehiculo() {
      try {
        const response = await axios.post('/vehicles/new', this.formData);


        // Manejar la respuesta si es necesario
        console.log(response.data);

        // Redireccionar o hacer algo más después de la inserción exitosa
      } catch (error) {
        // Manejar errores aquí
        console.error('Error al crear vehículo:', error);
      }
    },
  },
};
/*mounted() {
this.cargarDatos();
},
methods: {
  cargarDatos() {
  fetch('datosVehiculos.json')
    .then(response => response.json())
    .then(data => {
      console.log('Data from JSON:', data);
      this.models = data.models;
      this.providers = data.providers;
    })
    .catch(error => {
      console.error('Error al cargar los datos:', error);
    });
},
},*/


</script>

<style scoped>

</style>
  
