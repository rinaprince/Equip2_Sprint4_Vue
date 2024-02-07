<template>
  <div class="d-flex align-items-center">
    <a @click="modalNewEmployee()" class="m-2 btn btn-success">Create new</a>
    <form method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 mb-lg-1" role="search">
      <input name="q" type="search" class="form-control form-control-light text-dark"
             placeholder="Buscar..." aria-label="Search">
    </form>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Cognom</th>
        <th>Tipus</th>
        <th>Accions</th>
      </tr>
    </thead>
    <tbody>
    <tr v-for="employee in employees">
      <td>{{ employee.name }}</td>
      <td>{{ employee.lastname }}</td>
      <td>{{ employee.type }}</td>
      <td>
        <a @click="showModal(employee.id)" class="btn btn-outline-dark">Mostrar</a>
        <a :href="employeeEditPath(employee.id)" class="btn btn-primary">Editar</a>
        <a :href="employeeDeletePath(employee.id)" class="btn btn-danger">Esborrar</a>
      </td>
    </tr>
    </tbody>
  </table>
  <!-- Modal -->
  <div class="modal" style="background-color: rgba(0,0,0,0.5)" ref="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Empleat</h5>
          <button type="button" class="btn-close" @click="hideModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- Content goes here -->
          <!-- You can add form elements, text, etc. -->
      </div>
    </div>
  </div>
  </div>

</template>

<script setup>
import axios from 'axios';

defineProps({
  employees: Array,
  e: String
});

const employeeShowPath = (id) => `/employees/${id}/details`;
const employeeEditPath = (id) => `/employees/${id}/edit`;
const employeeNewPath = `/employees/new`;
const employeeDeletePath = (id) => `/employees/${id}`;


// ... (resto del código)
// Hacer la solicitud Axios aquí
function showModal(id) {
  axios.get('/employees/'+id+'/details')
      .then(response => {
        // Actualizar el contenido del modal
        const modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = response.data;

        // Mostrar el modal
        const myModal = document.querySelector('.modal');
        myModal.style.display = 'block';

        /**const confirmModal = document.querySelector('.modal-confirmation')


         const deleteButton = document.getElementById('#deleteProvider')
         deleteButton.addEventListener('click',confirmationModal(id))
         */
      })
      .catch(error => {
        console.error('Error fetching modal content:', error);
      });
}
function hideModal(){
  const myModal = document.querySelector('.modal');
  myModal.style.display = 'none';
}

function modalNewEmployee(){
  axios.get('/employees/new')
      .then(response => {
        // Actualizar el contenido del modal
        const modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = response.data;

        // Mostrar el modal
        const myModal = document.querySelector('.modal');
        myModal.style.display = 'block';
      })
      .catch(error => {
        console.error('Error fetching modal content:', error);
      });
}

/**
 function confirmationModal(id){
 axios.get('/providers/'+id)
 .then(response => {
 // Actualizar el contenido del modal
 const confirmModal = document.querySelector('.modal-confirmation')
 confirmModal.innerHTML = response.data;

 })
 .catch(error => {
 console.error('Error fetching modal content:', error);
 });
 }*/
</script>