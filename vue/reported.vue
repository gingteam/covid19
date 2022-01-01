<template>
  <div>
    <b-overlay :show="cases.length == 0" rounded="sm">
      <b-card title="Covid-19 Report">
        <div id="vnmap"></div>
        <b-table
          id="cases"
          :items="cases"
          :per-page="perPage"
          :current-page="currentPage"
          bordered
          small
          responsive
          class="mt-2"
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
            key: 'country',
            sortable: true
          },
          {
            key: 'total',
            sortable: true
          },
          {
            key: 'recovered',
            variant: 'success'
          },
          {
            key: 'deaths',
            variant: 'danger'
          }
        ],
        map: null,
      }
    },
    beforeMount () {
      axios
        .get('/api.php')
        .then(response => {
          this.items = response.data.global
          this.cases = response.data.vn
          this.map = L.map('vnmap').setView([16.4619, 107.59546], 5)
          L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'GingTeam'
          }).addTo(this.map)
          this.cases.forEach(data =>
            L.marker([data.lat, data.lng])
              .bindPopup(`${data.name} - ${data.address}`)
              .addTo(this.map)
          )
        })
    },
    beforeDestroy() {
      if (this.map) {
        this.map.remove()
      }
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

<style>
  #vnmap {
    width: 100%;
    height: 400px;
  }
</style>
