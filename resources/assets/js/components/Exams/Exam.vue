<template lang="html">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
       <div class="panel panel-default">
         <div class="panel-body">
           <h4>All Subjects</h4>
            <a href="javascript:;" @click="showModal">Go</a>
         </div>
       </div>
     </div>
      <div class="col-md-3" v-for="subject in subjects" :key="subject._id">
       <div class="panel panel-default">
         <div class="panel-body">
           <h4>{{subject.name}}</h4>
           <router-link :to="'/marks/subject/'+subject._id">Go</router-link>
         </div>
       </div>
     </div>
    </div>
    <div class="modal fade" id="AllSubjects" tabindex="-1" role="dialog" aria-labelledby="AllSubjectsLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="AllSubjectsLabel">Update All Subject Marks</h4>
          </div>
          <div class="modal-body" style="padding:0px;">
            <form @submit.prevent="updateResult" class="">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th v-for="subject in subjects" :key="subject.key">{{subject.name}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in students" :key="student.key">
                    <td>{{student.rollno}}</td>
                    <td>{{student.first_name}} {{student.last_name}}</td>
                    <td v-for="subject in subjects" :key="subject.key"> <input type="text" name="subject[]" size="3"> </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['examId'],
  data() {
    return {
      subjects:'',
      students:'',
      exam : '',
      classId : ''

    }
  },
  created() {
    this.getExamInfo();
    this.fetchSubjects();
  },
  methods: {
    getExamInfo(){
      axios.get('/api/v1/exam?exam='+this.examId)
        .then(response => {
          this.exam = response.data.data;
          this.classId = response.data.data.classroom
          this.fetchStudents();
        }).catch(function (error){
          console.log(error);
        });
    },
    fetchSubjects() {
      axios.get('/api/v1/subjects?exam='+this.examId)
        .then(response => {
          this.subjects = response.data.data;
        }).catch(function (error){
          console.log(error);
        });
    },
    fetchStudents(){
      axios.get('/api/v1/students?classroom='+this.classId)
        .then(response => {
          this.students = response.data.data;
        }).catch(function (error){
          console.log(error);
        });
    },
    showModal() {
      $("#AllSubjects").modal('show');
    }
  }
}
</script>

<style lang="css">
</style>
