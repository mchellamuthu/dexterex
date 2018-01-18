<template lang="html">
  <div class="container">
    <div class="row">
       <div class="col-md-3" v-for="student in students" :key="student._id">
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>{{student.first_name}}</h4>
            <router-link :to="'/students/'+student._id">Go</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['classId'],
  data() {
    return {
      students: [

      ]
    }
  },
  mounted() {
    console.log("Component Mounted");
  },
  created() {
    //do something after creating vue instance
    console.log("Created");
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      axios.get('/api/v1/students?classroom='+this.classId).then(response => {
        console.log(response.data.data);
        this.students = response.data.data;
      }).catch(function(error) {
        console.log(error);
      });
    }

  }
}
</script>

<style lang="css">
</style>
