<template>
    <div class="col-md-12 p-3">
        <div v-if="isLoading">
            <ProgressBar mode="indeterminate" style="height: 6px"></ProgressBar>
        </div>
        
        <div v-else>
            <div class="col-md-12">
                <Breadcrumb :breadcrumbItems="breadcrumbItems" />
            </div>

            <div class="col-md-12 mt-3">
                <TabView>
                    <TabPanel header="Alunos Matrículados">
                        <div class="col-md-12">
                            <label for="" class="form-label fw-bold">Selecione o curso</label>
                            <Dropdown v-model="curso_selecionado" :options="cursos" filter optionLabel="titulo" placeholder="Selecione" class="w-full" @change="getAlunoMatriculadoPorCurso($event)">
                                <template #value="slotProps">
                                    <div v-if="slotProps.value" class="flex align-items-center">
                                        <div>{{ slotProps.value.titulo }}</div>
                                    </div>
                                    <span v-else>
                                        {{ slotProps.placeholder }}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    <div class="flex align-items-center">
                                        <div>{{ slotProps.option.titulo }}</div>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>

                        <div class="col-md-12">
                            <TableMatriculas :alunosMatriculados="alunos_matriculados" :pagination="alunos_matriculados_pagination" @pageChange="pageChange" />
                        </div>
                    </TabPanel>
                    
                    <TabPanel header="Matrícular novo aluno">
                        <div class="col-md-12">
                            <label for="" class="form-label fw-bold">Selecione o aluno</label>
                            <Dropdown v-model="matricular.aluno_matricula" :options="alunos" filter optionLabel="nome" placeholder="Selecione" class="w-full">
                                <template #value="slotProps">
                                    <div v-if="slotProps.value" class="flex align-items-center">
                                        <div>{{ slotProps.value.nome }}</div>
                                    </div>
                                    <span v-else>
                                        {{ slotProps.placeholder }}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    <div class="flex align-items-center">
                                        <div>{{ slotProps.option.nome }}</div>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>

                        <div class="col-md-12 mt-3" v-if="matricular.aluno_matricula != ''">
                            <label for="" class="form-label fw-bold">Selecione o curso</label>
                            <Dropdown v-model="matricular.curso_matricula" :options="cursos" filter optionLabel="titulo" placeholder="Selecione" class="w-full">
                                <template #value="slotProps">
                                    <div v-if="slotProps.value" class="flex align-items-center">
                                        <div>{{ slotProps.value.titulo }}</div>
                                    </div>
                                    <span v-else>
                                        {{ slotProps.placeholder }}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    <div class="flex align-items-center">
                                        <div>{{ slotProps.option.titulo }}</div>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>

                        <div class="col-md-12 mt-3" v-if="matricular.aluno_matricula != '' && matricular.curso_matricula != ''">
                            <Button label="Matrícular" class="rounded" @click="matricularAluno" />
                        </div>
                    </TabPanel>
                </TabView>
            </div>
        </div>
        <Toast />
    </div>
</template>

<script>
import Breadcrumb from '@/components/Breadcrumb.vue';
import ProgressBar from "primevue/progressbar";
import Dropdown from 'primevue/dropdown';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import TableMatriculas from '@/components/TableMatriculas.vue';

export default {
    components: {
        Breadcrumb,
        ProgressBar,
        Dropdown,
        TabView,
        TabPanel,
        Button,
        Toast,
        TableMatriculas,
    },
    data() {
        return {
            breadcrumbItems: [
                { label: "Matrículas", route: "/matriculas" },
            ],
            isLoading: false,
            cursos: [],
            curso_selecionado: '',
            alunos: [],
            matricular: {
                aluno_matricula: '',
                curso_matricula: '',
            },
            alunos_matriculados: [],
            alunos_matriculados_pagination: [],
        }
    },
    methods: {
        getCursos(page = 1) {
            this.isLoading = true;

            this.axios.get(`cursos?page=${page}`).then((res) => {
                this.cursos = res.data.data;
            }).catch((err) => {
                console.log(err);
            }).finally(() => {
                this.isLoading = false;
            });
        },
        getAlunoMatriculadoPorCurso(event) {
            this.isLoading = true;

            sessionStorage.setItem('cursoId', event.value.id)

            this.axios.get(`alunos-matriculados/${event.value.id}`).then((res) => {
                this.alunos_matriculados = res.data.data
                this.alunos_matriculados_pagination = res.data
            }).catch((err) => {
                console.log(err);
            }).finally(() => {
                this.isLoading = false;
            });
        },
        getAlunos(page = 1) {
            this.isLoading = true;

            this.axios.get(`alunos?page=${page}`).then((res) => {
                this.alunos = res.data.data;
            }).catch((err) => {
                console.log(err);
            }).finally(() => {
                this.isLoading = false;
            });
        },
        matricularAluno() {
            this.axios.put(`matricular-aluno/${this.matricular.aluno_matricula.id}`, {curso_id: this.matricular.curso_matricula.id}).then(res => {
                if (res.status == 200) {
                    this.$toast.add({
                        severity: "success",
                        summary: res.data,
                        detail: "",
                        life: 3000,
                    });

                    this.matricular = {
                        aluno_matricula: '',
                        curso_matricula: '',
                    }
                }
            }).catch(err => {
                this.$toast.add({ severity: 'error', summary: 'Erro', detail: err.response.data.error, life: 3000 });
            }).finally(() => {

            });
        },
        pageChange() {
            const event = {
                value: {
                    id: sessionStorage.getItem('cursoId')
                }
            }

            this.getAlunoMatriculadoPorCurso(event);
        },
    },
    mounted() {
        this.getCursos();
        this.getAlunos();
    }
}
</script>

<style>

</style>