<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Live Shows</div>

                    <div class="panel-body">
                      <table class="table table-hover">
                        <thead>
                        <tr>
                          <td @click="changesort('Date_D_M_Y')">Date</td>
                          <td @click="changesort('Artist')">Artist</td>
                          <td @click="changesort('Festival_Venue')">Venue</td>
                          <td @click="changesort('Town')">Town</td>
                          <td @click="changesort('Country')">Country</td>
                          <td @click="changesort('Supporting')">Supporting</td>
                          <td @click="changesort('Capacity')">Capacity</td>
                          <td @click="changesort('Status')">Status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="show in orderedShows">
                          <td>{{ show.Date_D_M_Y | moment("dddd, MMMM Do YYYY") }}</td>
                          <td>{{ show.Artist }}</td>
                          <td>{{ show.Festival_Venue }}</td>
                          <td>{{ show.Town }}</td>
                          <td>{{ show.Country }}</td>
                          <td>{{ show.Supporting }}</td>
                          <td>{{ show.Capacity }}</td>
                          <td>{{ show.Status }}</td>
                        </tr>
                      </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    Vue.filter('moment', function(value) {
      if (value) {
        return moment(String(value)).format("MM/DD/YYYY");
      }
    });

    export default {
        mounted() {
            console.log('Component mounted.')
            this.$http.get('/api/liveshows').then(response => {
              this.shows = response.body;
            });
        },
        data: () =>  {
          return {
            shows: [],
            sort: 'Date_D_M_Y',
            direction: 'asc'
          }
        },
        methods: {
          changesort: function(which) {
            this.sort = which;
            this.direction = this.direction == 'asc' ? 'desc' : 'asc';
          }
        },
        computed: {
          orderedShows: function () {
            return _.orderBy(this.shows, this.sort, this.direction);
          }
        }
    }
</script>
