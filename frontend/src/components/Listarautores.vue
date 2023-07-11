<template>
    <div>
      <v-data-table
        :headers="headers"
        :items="listadoAutores"
        :options.sync="options"
        :server-items-length="cantTotalListadoAutores"
        :loading="loading"
        :footer-props="footerProps"
        sort-by="id"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Listado Autores</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="agregarautores">Agregar Autor</v-btn>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editarAutores(item)">
            mdi-pencil
          </v-icon>
          <v-icon small @click="mostrarConfirmacionEliminar(item)"> mdi-delete </v-icon>
        </template>
      </v-data-table>
  
      <v-dialog v-model="mostrarAbmautores" max-width="500px" persistent>
        <Abmautores
          :autores="autoresSeleccionada"
          :editar="editar"
          @guardar="guardarAbmautores"
          @cancelar="cancelarAbmautores"
        />
      </v-dialog>
  
      <v-dialog v-model="mostrarConfirmDialog" max-width="320px" persistent>
        <ConfirmDialog
          :id="autoresSeleccionada.id"
          @confirmar="eliminarautores(autoresSeleccionada)"
          @cancelar="mostrarConfirmDialog = false"
        />
      </v-dialog>
  
    </div>
  </template>
  
  <script lang="ts">
  
  import Abmautores from "./Abmautores.vue";
  import ConfirmDialog from "./ConfirmDialog.vue"
  export default {
    components: {
      Abmautores,
      ConfirmDialog
  },
    data() {
      return {
        cantTotalListadoAutores: 0,
        loading: true,
        options: {},
        headers: [
          { text: "ID", value: "id" },
          { text: "Nombre", value: "nombre" },
          { text: "Acciones", value: "actions", sortable: false },
        ],
        footerProps:{
          'items-per-page-options': [10, 25, 50]
        },
        listadoAutores: [],
        mostrarAbmautores: false,
        autoresSeleccionada: {
          id:0,
          nombre:"",
        },
        editar: false,
        mostrarConfirmDialog: false,
      };
    },
    watch: {
      options: {
        handler() {
          this.obtenerListadoDeApi();
        },
        deep: true,
      },
    },
    methods: {
      obtenerListadoDeApi() {
        const { sortBy, sortDesc, page, itemsPerPage } = this.options;
        let sortMode = "";
        if (sortDesc[0]) {
          sortMode = "-";
        }
        var that = this;
        this.axios
          .get(
            `/apiv1/autores?per-page=${itemsPerPage}&page=${page}&sort=${sortMode}${sortBy}`
          )
          .then(function (response) {
            if (response.status === 200) {            
              that.listadoAutores = response.data;
              that.cantTotalListadoAutores = parseInt(
                response.headers["x-pagination-total-count"]
              );
            }
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            that.loading = false;
          });
      },
      mostrarFormularioAbmautores() {
        this.mostrarAbmautores = true;
      },
      agregarautores() {
        this.editar = false;
        this.autoresSeleccionada = {
          id: 0,
          nombre: "",
        };
        this.mostrarFormularioAbmautores();
      },
      editarAutores(autores) {
        this.autoresSeleccionada  = {
          id: autores.id,
          nombre: autores.nombre,
        };
        this.editar = true;
        this.mostrarAbmautores = true;
      },
      guardarAbmautores() {
        console.log("Autor Guardado con exito!");
        this.mostrarAbmautores = false;
        this.obtenerListadoDeApi();
      },
      eliminarautores(autores) {
        var that = this;
        this.axios
          .delete(`/apiv1/autores/${autores.id}`)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            that.mostrarConfirmDialog = false;
            that.obtenerListadoDeApi();
          });
      },
      cancelarAbmautores() {
        this.autoresSeleccionada.nombre = "";
        this.autoresSeleccionada.id = 0;
        this.mostrarAbmautores = false;
      },
      mostrarConfirmacionEliminar(autores) {
      this.autoresSeleccionada = autores;
      this.mostrarConfirmDialog = true;
    },
    },
  };
  </script>
  