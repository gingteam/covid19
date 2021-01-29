<template>
  <div>
    <b-overlay :show="items == null" rounded="sm">
      <b-card title="Covid-19 Report">
        <b-table responsive bordered :items="items" :fields="fields"></b-table>
      </b-card>
    </b-overlay>
  </div>
</template>
<script>
  module.exports = {
    data() {
      return {
        fields: [
          'Country',
          'Total',
          {
            key: 'Recovered',
            variant: 'success'
          },
          {
            key: 'Deaths',
            variant: 'danger'
          }
        ],
        items: null
      }
    },
    mounted () {
      axios
        .get('/api.php')
        .then(response => this.items = response.data)
    }
  }
</script>
