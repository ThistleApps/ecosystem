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
                pos_type: '',
                pos_wan_address: '',
                status: false,
                message: '',
                testingConnection: false,
            })
        };
    },

    mounted() {
        this.form.first_name = this.user.first_name;
        this.form.last_name = this.user.last_name;
        this.form.business_name = this.user.business_name;
        this.form.primary_affiliate = this.user.primary_affiliate;
        this.form.primary_affiliate_number = this.user.primary_affiliate_number;
        this.form.pos_type = this.user.pos_type;
        this.form.pos_wan_address = this.user.pos_wan_address;
    },

    methods: {
        update() {
            Spark.post('/profile/update', this.form)
                .then(response => {
                Bus.$emit('updateUser');
            });
        },
        testConnection() {
            var self = this;
            self.testingConnection = true;
            var van_ip = self.form.pos_wan_address;

            axios.post('/profile/test-connection', {'pos_wan_address': van_ip})
                .then(response => {
                    if(response.status == 200) {
                        self.form.status = true;
                    } else {
                        self.form.status = false;
                    }
                    self.form.message = response.data.message;
            });
        }
    }
});