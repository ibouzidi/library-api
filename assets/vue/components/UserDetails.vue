<template>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ name }}</h5>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "UserDetails",
  props: ["name"]
}
</script>