<template>
<div>
    <h1>Ajouter un utilisateur</h1>
    <div v-if="saved" class="alert alert-success" role="alert">
      User saved
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">
                Nom et prénom de l'utilisateur
            </label>
            <input type="text" class="form-control" id="name" v-model="name" @input="saved = false"/>
        </div>
        <button class="btn btn-primary" @click="submit">
            Submit
        </button>
    </div>
</div>

</template>
<script>
import axios from "axios"
export default {
  name: "AddUser",
  data() {
    return {
      name: null,
      saved: false
    }
  },
  methods: {
    submit() {
      this.saved = false
      if (this.name) {
        axios
            .post('api/users', {
              name: this.name
            })
            .then(() => {
              this.saved = true
              this.name = null
            })
      }
    }
  }
}
</script>