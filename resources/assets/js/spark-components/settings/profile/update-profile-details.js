Vue.component('update-profile-details', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                first_name: '',
                last_name: '',
                business_name: '',
                primary_affiliate: '',
                primary_affiliate_number: '',
            })
        };
    },

    mounted() {
        this.form.first_name = this.user.first_name;
        this.form.last_name = this.user.last_name;
        this.form.business_name = this.user.business_name;
        this.form.primary_affiliate = this.user.primary_affiliate;
        this.form.primary_affiliate_number = this.user.primary_affiliate_number;
        },

    methods: {
        update() {
            Spark.post('/profile/update', this.form)
                .then(response => {
                Bus.$emit('updateUser');
        });
        }
    }
});