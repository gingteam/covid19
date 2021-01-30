<template>
  <div>
    <b-overlay :show="cases.length == 0" rounded="sm">
      <b-card title="Covid-19 Report">
        <b-table
          id="cases"
          :items="cases"
          :per-page="perPage"
          :current-page="currentPage"
          bordered
          small
          responsive
        ></b-table>
        <b-pagination
          v-model="currentPage"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="cases"
        ></b-pagination>

        <b-table
          id="global"
          :items="items"
          :fields="fields"
          :per-page="perPage1"
          :current-page="currentPage1"
          bordered
          small
          responsive
        ></b-table>
        <b-pagination
          v-model="currentPage1"
          :total-rows="rows1"
          :per-page="perPage1"
          aria-controls="global"
        ></b-pagination>
      </b-card>
    </b-overlay>
  </div>
</template>
<script>
  module.exports = {
    data() {
      return {
        perPage: 5,
        currentPage: 1,
        cases: [],
        perPage1 : 5,
        currentPage1: 1,
        items: [],
        fields: [
          {
            key: 'Country',
            sortable: true
          },
          {
            key: 'Total',
            sortable: true
          },
          {
            key: 'Recovered',
            variant: 'success'
          },
          {
            key: 'Deaths',
            variant: 'danger'
          }
        ]
      }
    },
    mounted () {
      axios
        .get('/api.php')
        .then(response => {
          this.items = response.data.global
          this.cases = response.data.vn
        })
    },
    computed: {
      rows() {
        return this.cases.length
      },
      rows1() {
        return this.items.length
      }
    }
  }
</script>
