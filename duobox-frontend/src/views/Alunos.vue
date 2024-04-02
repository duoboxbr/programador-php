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
                    <Button type="button" class="rounded ms-3 pt-1 pb-1" label="Cadastrar Aluno" @click="dialogCadastrar = true" />
                </div>
            </div>

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
                            <tr v-for="aluno in alunos" :key="aluno.id">
                                <td>{{ aluno.nome }}</td>
                                <td>{{ aluno.email }}</td>
                                <td>{{ aluno.dat_nascimento }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <Button @click="alunoSelecionado(aluno)" icon="pi pi-pencil" class="rounded" severity="info" outlined></Button>
                                        <Button @click="deleteAluno(aluno)" icon="pi pi-trash" class="rounded" severity="danger" outlined></Button>
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
        </div>

        <Dialog v-model:visible="dialogCadastrar" modal header="Novo aluno" :style="{ width: '25rem' }">
            <div class="col-md-12">
                <label for="nome" class="font-semibold form-label">Nome</label>
                <InputText id="nome" class="form-control" autocomplete="off" v-model="nome" />
            </div>

            <div class="col-md-12 mt-2">
                <label for="email" class="font-semibold form-label">Email</label>
                <InputText id="email" class="form-control" autocomplete="off" v-model="email" placeholder="exemplo@email.com" />
            </div>

            <div class="col-md-12 mt-2">
                <label for="dat_nascimento" class="font-semibold form-label">Data de nascimento</label>
                <Calendar
                    v-model="dat_nascimento"
                    dateFormat="dd/mm/yy"
                    inputId="data_inicial"
                    class="w-100"
                    showIcon
                    iconDisplay="input"
                    placeholder="00/00/0000"
                    showButtonBar
                    v-mask="'##/##/####'"
                />
            </div>  

            <div class="flex justify-content-end gap-2 mt-3">
                <Button type="button" label="Cancelar" severity="secondary" @click="dialogCadastrar = false"></Button>
                <Button type="button" label="Salvar aluno" class="rounded" @click="salvar"></Button>
            </div>
        </Dialog>

        <Dialog v-model:visible="dialogEditar" modal header="Editar aluno" :style="{ width: '25rem' }">
            <div class="col-md-12">
                <label for="nome" class="font-semibold form-label">Nome</label>
                <InputText id="nome" class="form-control" autocomplete="off" v-model="aluno_selecionado.nome" />
            </div>

            <div class="col-md-12 mt-2">
                <label for="email" class="font-semibold form-label">Email</label>
                <InputText id="email" type="email" class="form-control" autocomplete="off" v-model="aluno_selecionado.email" placeholder="exemplo@email.com" />
            </div>

            <div class="col-md-12 mt-2">
                <label for="dat_nascimento" class="font-semibold form-label">Data de nascimento</label>
                <Calendar
                    v-model="aluno_selecionado.dat_nascimento"
                    dateFormat="dd/mm/yy"
                    inputId="dat_nascimento"
                    class="w-100"
                    showIcon
                    iconDisplay="input"
                    placeholder="00/00/0000"
                    showButtonBar
                />
            </div>

            <div class="flex justify-content-end gap-2 mt-3">
                <Button type="button" label="Cancelar" severity="secondary" @click="dialogEditar = false"></Button>
                <Button type="button" label="Editar aluno" class="rounded" @click="editarAluno"></Button>
            </div>
        </Dialog>

        <OverlayPanel ref="op">
            <div class="col-md-12">
                <label for="nome" class="form-label">Nome</label>
                <InputText type="text" v-model="filtros.nome" class="w-full" />
            </div>

            <div class="col-md-12 mt-3">
                <label for="email" class="form-label">Email'</label>
                <InputText type="text" v-model="filtros.email" id="email" class="w-full" placeholder="exemplo@email.com" />
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
import Calendar from 'primevue/calendar';

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
        Calendar,
    },
    data() {
        return {
            breadcrumbItems: [
                { label: "Alunos", route: "/alunos" },
            ],
            nome: '',
            email: '',
            dat_nascimento: '',
            dialogCadastrar: false,
            dialogEditar: false,
            isLoading: false,
            tem_filtro: false,
            pagination: [],
            alunos: [],
            filtros: {
                nome: '',
                email: '',
            },
            aluno_selecionado: {
                nome: '',
                email: '',
                dat_nascimento: '',
            },
        }
    },
    methods: {
        toggle(event) {
            this.$refs.op.toggle(event);
        },
        onPageChanged(page) {
            this.getAlunos(page);
        },
        salvar() {
            const data = {
                nome: this.nome,
                email: this.email,
                dat_nascimento: this.dat_nascimento,
            }

            this.axios.post('aluno', data).then(res => {
                if (res.status == 201) {
                    this.nome = '';
                    this.email = '';
                    this.dat_nascimento = '';

                    this.dialogCadastrar = false;
                    this.getAlunos();
                }
            }).catch(err => {
                this.$toast.add({ severity: 'error', summary: 'Erro', detail: err.response.data.error, life: 3000 });
            })
        },
        editarAluno() {
            this.isLoading = true;

            const dados = {
                nome: this.aluno_selecionado.nome,
                email: this.aluno_selecionado.email,
                dat_nascimento: this.aluno_selecionado.dat_nascimento,
            };

            this.axios.put(`aluno/${this.aluno_selecionado.id}`, dados).then((res) => {
                if (res.status == 200) {
                    this.$toast.add({
                        severity: "success",
                        summary: "Aluno editado com sucesso",
                        detail: "",
                        life: 3000,
                    });

                    this.getAlunos();

                    this.dialogEditar = false;
                }
            }).catch((err) => {
                this.$toast.add({ severity: 'error', summary: 'Erro', detail: err.response.data.error, life: 3000 });
            }).finally(() => {
                this.isLoading = false;
            });
        },
        getAlunos(page = 1) {
            this.isLoading = true;

            this.axios.get(`alunos?page=${page}`, {
                params: {
                    nome: this.filtros.nome,
                    email: this.filtros.email,
                }
            }).then((res) => {
                this.alunos = res.data.data;
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
            this.getAlunos();
        },
        removerFiltro() {
            this.tem_filtro = !this.tem_filtro;
            this.filtros = {
                nome: '',
                email: '',
            }
            this.getAlunos();
        },
        deleteAluno(aluno) {
            this.$confirm.require({
                message: `Deseja realmente deletar o aluno: ${aluno.nome}`,
                header: 'Excluír aluno',
                icon: 'pi pi-info-circle',
                rejectLabel: 'Cancel',
                acceptLabel: 'Delete',
                rejectClass: 'p-button-secondary p-button-outlined',
                acceptClass: 'p-button-danger rounded',
                accept: () => {
                    this.axios.delete(`aluno/${aluno.id}`).then(res => {
                        if (res.status == 200) {
                            this.$toast.add({ severity: 'success', summary: 'Sucesso!', detail: res.data, life: 3000 });
                            this.getAlunos();
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
        alunoSelecionado(item) {
            this.aluno_selecionado = item;
            this.dialogEditar = true;
        },
    },
    mounted() {
        this.getAlunos();
    }
}
</script>

<style>

</style>