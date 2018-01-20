<template lang="html">
  <div class="container">
    <div class="row">
       <div class="col-md-3" v-for="exam in exams" :key="exam._id">
        <div class="panel panel-default">
          <div class="panel-body">
            <h4>{{exam.title}}</h4>
            <router-link :to="'/exam/'+exam._id">Go</router-link>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">ADD NEW</button>

      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create New Exam</h4>
      </div>
      <div class="modal-body">
        <form @submit.prevent="createExam" class="">
    <div class="form-group title-group">
        <input class="form-control " type="text" name="title" placeholder="Title" v-model="examInputs.title">
        <input type="hidden" name="classroom" :value="classId" />
        <span  class="help-block"></span>
    </div>

    <div class="form-group min_mark-group">
          <input class="form-control min_mark" type="text" name="min_mark" size="4" placeholder="min_mark" v-model="examInputs.min_mark">
        <span class="help-block"></span>
    </div>
    <div class="form-group max_mark-group">
          <input class="form-control max_mark" type="text" name="max_mark" size="4" placeholder="max_mark" v-model="examInputs.max_mark">
        <span class="help-block"></span>
    </div>
    <hr />
    <h4>Subjects <span class="btn btn-primary btn-sm" @click="addRow($index)"> <i class="glyphicon glyphicon-plus-sign"></i> </span> </h4>
    <table class="table" border="0">
      <thead border="0">
        <tr>
          <th>Name</th>
          <th>Code</th>
          <th>Mark</th>
          <th>Papers</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(subject,index) in subjects" :key="subject.key"  track-by="$index">
          <td> <input type="text" class="form-control input-sm" name="subjects[name]" v-model="subject.name" > <span v-for="paper in subject.papers" :key="paper.key" class="label label-primary">{{paper.name}} : {{paper.mark}}</span> </td>
          <td> <input type="text" class="form-control input-sm" name="subjects[code]" v-model="subject.code" size="4"> </td>
          <td> <input type="text" class="form-control input-sm" name="subjects[mark]"  v-model="subject.mark" size="4"> </td>
          <td> <button type="button" class="btn btn-success btn-sm" @click="addPaper(index)">ADD PAPER</button> </td>
          <td> <span class="btn btn-primary btn-sm" @click="addRow(index)"> <i class="glyphicon glyphicon-plus-sign"></i> </span> <span class="btn btn-danger btn-sm" @click="removeRow(index)"> <i class="glyphicon  glyphicon-remove-circle"></i> </span> </td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary" type="submit">create</button>
</form>
      </div>

    </div>
  </div>
</div>
      <!-- Modal -->
<div class="modal fade" id="PaperSModal" tabindex="-1" role="dialog" aria-labelledby="PaperSModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="PaperSModalLabel">Create New Exam</h4>
      </div>
      <div class="modal-body">
        <form>
      <h4>ADD PAPERS FOR <span id="subject_name">{{selectedSubject.name}}</span> <span class="btn btn-primary btn-sm" @click="addPaperRow($index)"> <i class="glyphicon glyphicon-plus-sign"></i> </span> </h4>
    <table class="table" border="0">
      <thead border="0">
        <tr>
          <th>Name</th>
          <th>Code</th>
          <th>Mark</th>
          <th>Get Mark</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(paper,index) in papers" :key="paper.key"  track-by="$index">
          <td> <input type="text" class="form-control input-sm" name="papers[name]" v-model="paper.name" > </td>
          <td> <input type="text" class="form-control input-sm" name="papers[code]" v-model="paper.code" size="4"> </td>
          <td> <input type="text" class="form-control input-sm" name="papers[mark]"  v-model="paper.mark" size="4"> </td>
          <td> <input type="text" class="form-control input-sm" name="papers[get_mark]"  v-model="paper.get_mark" size="4"> </td>
          <td> <span class="btn btn-primary btn-sm" @click="addPaperRow(index)"> <i class="glyphicon glyphicon-plus-sign"></i> </span> <span class="btn btn-danger btn-sm" @click="removePaperRow(index)"> <i class="glyphicon  glyphicon-remove-circle"></i> </span> </td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary" type="button" @click="submitPapers(selectedSubject.index)">Finish</button>
</form>
      </div>

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
      exams: [],
      selectedSubject: '',
      subjects: [{
        name: '',
        code: '',
        mark: '',
        papers:[]
      }],

      examInputs: {},
      formErrors: {},
      errorClass: "has-error",
      papers: []
    }
  },
  mounted() {
    console.log("  // Describe error!Component Mounted");
  },
  created() {
    //do something after creating vue instance

    console.log("Created");
    this.fetchExams();
  },
  methods: {
    fetchExams() {
      axios.get('/api/v1/exams?classroom=' + this.classId).then(response => {
        console.log(response.data.data);
        this.exams = response.data.data;
      }).catch(function(error) {
        console.log(error);
      });
    },
    addRow: function(index) {
      try {
        this.subjects.push({
          name: '',
          code: '',
          mark: '',
          papers: []
        });
      } catch (e) {
        console.log(e);
      }
    },
    removeRow: function(index) {
      this.subjects.splice(index, 1);
    },
    addPaperRow: function(index) {
      try {
        this.selectedSubject.papers.push({
          name: '',
          code: '',
          mark: '',
          get_mark: ''
        });
      } catch (e) {
        console.log(e);
      }
    },
    removePaperRow: function(index) {
      this.selectedSubject.papers.splice(index, 1);
      this.papers = this.subjects[index].papers;
    },
    addPaper: function(index) {
      $('#PaperSModal').modal('show');
      // console.log(index);
      // $('#addbtn').attr("@click","submitPapers(index)");
      console.log(index);
      this.selectedSubject = this.subjects[index];
      this.selectedSubject.index = index;
      this.papers = this.subjects[index].papers;
    },

    submitPapers: function(index) {
      console.log(this.subjects[index].name);
      this.subjects[index].papers = this.selectedSubject.papers;
      $('#PaperSModal').modal('hide');
    },
    createExam(e) {
      var form = e.srcElement;
      this.examInputs.classroom = this.classId;
      this.examInputs.subjects = this.subjects;
      axios.post('/api/v1/exam/create', this.examInputs)
        .then(response => {
          this.exams.push(response.data.data);
          $('#myModal').modal('hide');
        })
        .catch(error => {
          var errors = error.response.data.errors;
          this.formErrors = errors;
          $('form').find('.form-group').removeClass('has-error').find('.help-block').text('');
          $.each(errors, function(field, msg) {
            $('form').find('.' + field + '-group').addClass('has-error').find('.help-block').text(msg);
          });
        });
    }

  }
}
</script>

<style lang="css">
</style>
