<template>
  <div class="d-flex" id="wrapper">
    <Sidebar />
    <div id="page-content-wrapper">
      <Navbar />
      <router-view />
     </div>
  </div>
</template>

<script>
import Sidebar from "@/components/Sidebar.vue";
import Navbar from "@/components/Navbar.vue";

export default {
   components: {
      Sidebar,
      Navbar,
   },
};
</script>

<style>
a {
  text-decoration: none !important;
}

hr {
  margin: 0;
}

ul, li {
  padding-left: 5px;
}
</style>
