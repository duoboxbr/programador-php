<template>
    <div class="col-md-12 mt-4">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Data de nascimento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="aluno in alunosMatriculados" :key="aluno.id">
                        <td>{{ aluno.nome }}</td>
                        <td>{{ aluno.email }}</td>
                        <td>{{ aluno.dat_nascimento }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <Button @click="removerMatricula(aluno)" icon="pi pi-trash" class="rounded" severity="danger" outlined></Button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-12 d-flex justify-content-end mt-3">
            <Pagination :pagination="pagination" @page-changed="onPageChanged" />
        </div>
    </div>
</template>

<script>
import Pagination from './Pagination.vue';
import Button from 'primevue/button';

export default {
    props: ['pagination', 'alunosMatriculados'],
    components: {
        Pagination,
        Button,
    },
    methods: {
        onPageChanged(page) {
            this.$emit('pageChange', page);
        },
        removerMatricula(aluno) {
            this.axios.delete(`remover-matricula/${aluno.id}`).then(res => {
                if (res.status == 200) {
                    this.$toast.add({ severity: 'success', summary: 'Sucesso!', detail: res.data, life: 3000 });
                    this.$emit('pageChange', 1);
                }
            });
        }
    }
}
</script>

<style>

</style>