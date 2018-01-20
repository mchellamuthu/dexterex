import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./components/Exams/Home.vue'),
        meta: { forGuest: true }
    },
    {
        path: '/classroom/:classId',
        component: require('./components/Exams/Classroom.vue'),
        props: true
    },
    {
        path: '/exam/:examId',
        component: require('./components/Exams/Exam.vue'),
        props: true
    }

];

export default new VueRouter({
    routes,
});
