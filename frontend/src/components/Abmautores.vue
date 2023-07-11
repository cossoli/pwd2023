<template>
    <v-form ref="forms" v-model="valid" @submit.prevent>
      <v-card>
        <v-card-title>Agregar Autores</v-card-title>
        <v-card-text>
          <v-text-field
            @keyup.enter="submit"
            v-model="nuevoNombre"
            label="Nombre y Apellido"
            :rules="nombreRules"
              required
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="submit" :disabled="!valid"
            >Guardar</v-btn
          >
          <v-btn color="secondary" @click="cancelar">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </template>
  
  <script lang="ts">

  export default {
    props: {
      autores: {
        type: Object,
        default: () => ({ id: "", nombre_apellido: "" }),
      },
      editar: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        valid: false,
        nuevoNombre: "",
        nombreRules: [(v) => !!v || "El nombre es requerido"],
      };
    },
    watch: {
      autores: {
        handler(nuevoValor) {
          this.nuevoNombre = nuevoValor.nombre;
          if (!this.editar){
            this.resetValidationForAbm();
          }
        },
      },
    },
    methods: {
      submit() {
        if (this.editar) {
          this.editarAutores();
        } else {
          this.guardarAutores();
        }
      },
      guardarAutores() {
        const data = {
          nombre: this.nuevoNombre,
        };
        var that = this;
        this.axios
          .post("/apiv1/autores", data)
          .then(function (response) {
            console.log(response);
            that.nuevoNombre = "";
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            that.resetValidationForAbm();
            that.$emit("guardar");
          });
      },
      editarAutores() {
        const data = {
          nombre: this.nuevoNombre,
        };
        var that = this;
        this.axios
          .patch(`/apiv1/autores/${this.autores.id}`, data)
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            that.resetValidationForAbm();
            that.$emit("guardar");
          });
      },
      cancelar() {
        this.resetValidationForAbm();
        this.$emit("cancelar");
      },
      resetValidationForAbm() {
        this.$refs.forms.resetValidation();
      },
    },
    created() {
      if (this.autores) {
        this.nuevoNombre = this.autores.nombre;
      }
    },
  };
  </script>
  