<template lang="html">
  <div class="container">
    <div class="row">
       <div class="col-md-3" v-for="classroom in classrooms" :key="classroom._id">
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>{{classroom.name}}</h4>
            <router-link :to="'/classroom/'+classroom._id">Go</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['userId'],
  data() {
    return {
      classrooms: [

      ]
    }
  },
  mounted() {
    console.log("Component Mounted");
  },
  created() {
    //do something after creating vue instance
    console.log("Created");
    this.fetchClassrooms();
  },
  methods: {
    fetchClassrooms() {
      axios.get('/api/v1/classrooms').then(response => {
        console.log(response.data.data);
        this.classrooms = response.data.data;
      }).catch(function(error) {
        console.log(error);
      });
    }

  }
}
</script>

<style lang="css">
</style>
