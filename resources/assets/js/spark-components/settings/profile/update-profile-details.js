Vue.component('update-profile-details', {
    props: ['user'],

    data: function() {
        return {
            form: new SparkForm({
                first_name: '',
                last_name: '',
                business_name: '',
                primary_affiliate: '',
                primary_affiliate_number: '',
                pos_type: '',
                pos_wan_address: '',
            }),
            connection: {
                message: '',
                status: false,
                testingConnection: false,
            },
            isLoading: false,
        };
    },

    mounted: function () {
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
            var van_ip = this.form.pos_wan_address;
            if (van_ip == null || van_ip == '') {
                self.$refs.pos_wan_address.focus();
                return;
            }
            self.isLoading = true;
            axios.post('/profile/test-connection', {'pos_wan_address': van_ip})
                .then(response => {
                    self.isLoading = false;

                    if(response.data.alert_type == true) {
                        self.connection.status = true;
                    } else {
                        self.connection.status = false;
                    }
                    self.connection.testingConnection = true;
                    self.connection.message = response.data.message;
            });
        },
        close() {
            this.connection.testingConnection = false;
            this.form.successful = false;
        }
    }
});