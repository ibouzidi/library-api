<template>
  <div>
    <h1>Liste des utilisateurs</h1>
    <div class="row">
      <UserDetails
          v-for="user in users"
          :name="user.name"
          :key="user.id"
      />
    </div>
  </div>
</template>

<script>
import UserDetails from "../components/UserDetails"
import axios from "axios"
export default {
  name: "UserList",
  components: {UserDetails},
  data() {
    return {
      users: []
    }
  },
  created: function () {
    axios
    .get('/api/users')
    .then(response => (this.users = response.data))
  }
}
</script>