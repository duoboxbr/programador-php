<template>
   <!-- Sidebar-->
   <div class="border-end bg-white" id="sidebar-wrapper">
      <div class="sidebar-heading border-bottom bg-light fw-bold">Duobox</div>
      <div class="list-group list-group-flush">
         <router-link
            class="list-group-item list-group-item-action list-group-item-light p-3"
            to="/"
         >
            Cursos
         </router-link>
         <router-link
            class="list-group-item list-group-item-action list-group-item-light p-3"
            to="/alunos"
         >
            Alunos
         </router-link>
         <router-link
            class="list-group-item list-group-item-action list-group-item-light p-3"
            to="/matriculas"
         >
            Matrículas
         </router-link>
      </div>
   </div>
</template>

<script>
export default {
   mounted() {
      const sidebarToggle = document.body.querySelector("#sidebarToggle");
      if (sidebarToggle) {
         if (localStorage.getItem("sb|sidebar-toggle") === "true") {
            document.body.classList.toggle("sb-sidenav-toggled");
         }
         sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
               "sb|sidebar-toggle",
               document.body.classList.contains("sb-sidenav-toggled")
            );
         });
      }
   },
   methods: {
      toggleSidebar() {
         document.body.classList.toggle("sb-sidenav-toggled");
         localStorage.setItem(
            "sb|sidebar-toggle",
            document.body.classList.contains("sb-sidenav-toggled")
         );
      },
   },
};
</script>

<style></style>
