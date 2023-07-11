<template>
    <div>
        <v-card>
          <v-card-title class="text-h5 primary" style="display: block; color: white;">
            Confirmar eliminación
          </v-card-title>
          <v-divider></v-divider>
          <v-card-text>
            ¿ Está seguro que desea eliminar el registro con ID: <b>{{ id }}</b> ?
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-btn
              color="primary"
              @click="confirmar"
            >
              Confirmar
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
              color="secondary"
              @click="cancelar"
            >
              Cancelar
            </v-btn>
          </v-card-actions>
        </v-card>
    </div>
  </template>

<script lang="ts">
export default {
    props: {
    mostrar: {
      type: Boolean,
      default: false,
    },
    id: {
      type: Number,
      default: 0,
    }
  },
  data () {
    return {
      dialog: false,
    }
  },
  watch: {
    mostrar: {
      handler(nuevoValor) {
        this.dialog = nuevoValor;
      },
    },
  },
  methods: {
    confirmar() {
      this.$emit("confirmar");
    },
    cancelar() {
      this.$emit("cancelar");
    },
  },
}
</script>