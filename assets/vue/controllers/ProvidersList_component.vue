<template>
  <table class="table">
    <thead>
    <tr>
      <th>Id</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Dni</th>
      <th>Cif</th>
      <th>Address</th>
      <th>BankTitle</th>
      <th>ManagerNif</th>
      <th>LOPDdoc</th>
      <th>ConstitutionArticle</th>
      <th>actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="provider in providers">
      <td>{{ provider.id }}</td>
      <td>{{ provider.email }}</td>
      <td>{{ provider.phone }}</td>
      <td>{{ provider.dni }}</td>
      <td>{{ provider.cif }}</td>
      <td>{{ provider.address }}</td>
      <td>{{ provider.bankTitle }}</td>
      <td>{{ provider.managerNif }}</td>
      <td>{{ provider.LOPDdoc }}</td>
      <td>{{ provider.constitutionArticle }}</td>
      <td>
        <a href="{{ path('app_provider_show', {'id': provider.id}) }}">show</a>
        <a href="{{ path('app_provider_edit', {'id': provider.id}) }}">edit</a>
      </td>
    </tr>
    <tr>
      <td colspan="11">no records found</td>
    </tr>
    </tbody>
  </table>

  <a href="{{ path('app_provider_new') }}">Create new</a>
</template>

<script setup>
defineProps({
  providers: Array
});
</script>