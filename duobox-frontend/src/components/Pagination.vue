<template>
  <div>
    <div class="d-flex justify-content-end">
      (<span class="text-muted">Página {{ pagination.current_page }} de {{ pagination.last_page }}</span>)
    </div>
    <div class="d-flex justify-content-end">
      <span class="text-muted">Total de registros: {{ pagination.total }}</span> 
    </div>
    <nav aria-label="Page navigation" class="d-flex justify-content-end mt-4">
      <ul class="pagination">
        <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
          <a
            class="page-link"
            href="#"
            @click.prevent="changePage(pagination.current_page - 1)"
          >
            &laquo;
          </a>
        </li>
        <li
          class="page-item"
          v-for="page in pages"
          :key="page"
          :class="{ active: pagination.current_page === page }"
        >
          <a class="page-link" href="#" @click.prevent="changePage(page)">
            {{ page }}
          </a>
        </li>
        <li
          class="page-item"
          :class="{ disabled: pagination.current_page === pagination.last_page }"
        >
          <a
            class="page-link"
            href="#"
            @click.prevent="changePage(pagination.current_page + 1)"
          >
            &raquo;
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
  
  <script>
export default {
  props: {
    pagination: {
      type: Object,
      required: true,
    },
  },
  computed: {
    pages() {
      const pages = [];
      for (let i = 1; i <= this.pagination.last_page; i++) {
        pages.push(i);
      }
      return pages;
    },
  },
  methods: {
    changePage(page) {
      this.$emit("page-changed", page);
    },
  },
};
</script>
  
<style>
.page-item.active a {
  color: #fff !important;
}

.page-item.disabled {
  color: #c1c1c1 !important;
}
.page-link.active, .active > .page-link {
    background-color: #059669;
}
</style>