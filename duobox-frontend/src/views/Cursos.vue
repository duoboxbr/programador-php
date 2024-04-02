<template>
    <div class="col-md-12 p-3">
        <div v-if="isLoading">
            <ProgressBar mode="indeterminate" style="height: 6px"></ProgressBar>
        </div>
        
        <div v-else>
            <div class="col-md-12">
                <Breadcrumb :breadcrumbItems="breadcrumbItems" />
            </div>

            <div class="d-flex justify-content-between col-md-12 mt-3">
                <div>
                    <Button type="button" icon="pi pi-filter" severity="info" class="rounded pt-1 pb-1" label="Filtros" @click="toggle" />
                    <Button type="button" severity="danger" icon="pi pi-filter-slash" class="rounded ms-3 pt-1 pb-1" label="Remover Filtros" @click="removerFiltro"  v-if="tem_filtro" />
                </div>
                <div>
                    <Button type="button" class="rounded ms-3 pt-1 pb-1" label="Cadastrar Curso" @click="dialogCadastrar = true" />
                </div>
            </div>

            <div class="col-md-12 mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Descrição</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="curso in cursos" :key="curso.id">
                            <td>{{ curso.titulo }}</td>
                            <td>{{ curso.descricao }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <Button @click="cursoSelecionado(curso)" icon="pi pi-pencil" class="rounded" severity="info" outlined></Button>
                                    <Button @click="deleteCurso(curso)" icon="pi pi-trash" class="rounded" severity="danger" outlined></Button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>

                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <Pagination :pagination="pagination" @page-changed="onPageChanged" />
                </div>
            </div>
        </div>

        <Dialog v-model:visible="dialogCadastrar" modal header="Novo curso" :style="{ width: '25rem' }">
            <div class="col-md-12">
                <label for="titulo" class="font-semibold form-label">Título</label>
                <InputText id="titulo" class="form-control" autocomplete="off" v-model="titulo" />
            </div>
            <div class="col-md-12 mt-2">
                <label for="descricao" class="font-semibold form-label">Descrição</label>
                <InputText id="descricao" class="form-control" autocomplete="off" v-model="descricao" />
            </div>
            <div class="flex justify-content-end gap-2 mt-3">
                <Button type="button" label="Cancelar" severity="secondary" @click="dialogCadastrar = false"></Button>
                <Button type="button" label="Salvar curso" class="rounded" @click="salvar"></Button>
            </div>
        </Dialog>

        <Dialog v-model:visible="dialogEditar" modal header="Novo curso" :style="{ width: '25rem' }">
            <div class="col-md-12">
                <label for="titulo" class="font-semibold form-label">Título</label>
                <InputText id="titulo" class="form-control" autocomplete="off" v-model="curso_selecionado.titulo" />
            </div>
            <div class="col-md-12 mt-2">
                <label for="descricao" class="font-semibold form-label">Descrição</label>
                <InputText id="descricao" class="form-control" autocomplete="off" v-model="curso_selecionado.descricao" />
            </div>
            <div class="flex justify-content-end gap-2 mt-3">
                <Button type="button" label="Cancelar" severity="secondary" @click="dialogEditar = false"></Button>
                <Button type="button" label="Editar curso" class="rounded" @click="editarCurso"></Button>
            </div>
        </Dialog>

        <OverlayPanel ref="op">
            <div class="col-md-12">
                <label for="titulo" class="form-label">Título</label>
                <InputText type="text" v-model="filtros.titulo" class="w-full" />
            </div>

            <div class="col-md-12 mt-3">
                <label for="descricao" class="form-label">Descrição'</label>
                <InputText type="text" v-model="filtros.descricao" id="descricao" class="w-full" />
            </div>

            <div class="col-md-12 mt-3">
                <Button label="Filtrar" class="rounded w-full" @click="filtrar" />
            </div>
        </OverlayPanel>

        <ConfirmDialog></ConfirmDialog>

        <Toast />
    </div>
    
</template>

<script>
import Breadcrumb from '@/components/Breadcrumb.vue';
import Toast from 'primevue/toast';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Pagination from '../components/Pagination.vue';
import ProgressBar from "primevue/progressbar";
import OverlayPanel from 'primevue/overlaypanel';
import ConfirmDialog from 'primevue/confirmdialog';

export default {
    components: {
        Breadcrumb,
        Toast,
        Dialog,
        Button,
        InputText,
        Pagination,
        ProgressBar,
        OverlayPanel,
        ConfirmDialog,
    },
    data() {
        return {
            breadcrumbItems: [
                { label: "Cursos", route: "/" },
            ],
            titulo: '',
            descricao: '',
            dialogCadastrar: false,
            dialogEditar: false,
            isLoading: false,
            tem_filtro: false,
            pagination: [],
            cursos: [],
            filtros: {
                titulo: '',
                descricao: '',
            },
            curso_selecionado: {
                titulo: '',
                descricao: '',
            },
        }
    },
    methods: {
        toggle(event) {
            this.$refs.op.toggle(event);
        },
        onPageChanged(page) {
            this.getCursos(page);
        },
        salvar() {
            const data = {
                titulo: this.titulo,
                descricao: this.descricao,
            }

            this.axios.post('curso', data).then(res => {
                if (res.status == 201) {
                    this.titulo = '';
                    this.descricao = '';

                    this.dialogCadastrar = false;
                    this.getCursos();
                }
            }).catch(err => {
                this.$toast.add({ severity: 'error', summary: 'Erro', detail: err.response.data.error, life: 3000 });
            })
        },
        editarCurso() {
            this.isLoading = true;

            const dados = {
                titulo: this.curso_selecionado.titulo,
                descricao: this.curso_selecionado.descricao,
            };

            this.axios.put(`curso/${this.curso_selecionado.id}`, dados).then((res) => {
                if (res.status == 200) {
                    this.$toast.add({
                        severity: "success",
                        summary: "Curso editado com sucesso",
                        detail: "",
                        life: 3000,
                    });

                    this.getCursos();

                    this.dialogEditar = false;
                }
            }).catch((err) => {
                this.$toast.add({ severity: 'error', summary: 'Erro', detail: err.response.data.error, life: 3000 });
            }).finally(() => {
                this.isLoading = false;
            });
        },
        getCursos(page = 1) {
            this.isLoading = true;

            this.axios.get(`cursos?page=${page}`, {
                params: {
                    titulo: this.filtros.titulo,
                    descricao: this.filtros.descricao,
                }
            }).then((res) => {
                this.cursos = res.data.data;
                this.pagination = res.data;
            }).catch((err) => {
                console.log(err);
            }).finally(() => {
                this.isLoading = false;
            });
        },
        filtrar() {
            this.$refs.op.hide();
            this.tem_filtro = !this.tem_filtro;
            this.getCursos();
        },
        removerFiltro() {
            this.tem_filtro = !this.tem_filtro;
            this.filtros = {
                titulo: '',
                descricao: '',
            }
            this.getCursos();
        },
        deleteCurso(curso) {
            this.$confirm.require({
                message: `Deseja realmente deletar o curso: ${curso.titulo}`,
                header: 'Excluír curso',
                icon: 'pi pi-info-circle',
                rejectLabel: 'Cancel',
                acceptLabel: 'Delete',
                rejectClass: 'p-button-secondary p-button-outlined',
                acceptClass: 'p-button-danger rounded',
                accept: () => {
                    this.axios.delete(`curso/${curso.id}`).then(res => {
                        if (res.status == 200) {
                            this.$toast.add({ severity: 'success', summary: 'Sucesso!', detail: res.data, life: 3000 });
                            this.getCursos();
                        }
                    }).catch(err => {
                        console.log(err)
                    })
                },
                // reject: () => {
                //     this.$toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
                // }
            });
        },
        cursoSelecionado(item) {
            this.curso_selecionado = item;
            this.dialogEditar = true;
        },
    },
    mounted() {
        this.getCursos();
    }
}
</script>

<style>

</style>