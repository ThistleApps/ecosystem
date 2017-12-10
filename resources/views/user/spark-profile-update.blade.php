<update-profile-details :user="user" inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Details</div>

        <div class="panel-body">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your profile has been updated!
            </div>

            <form class="form-horizontal" role="form">
                <!-- First Name -->
                <div class="form-group" :class="{'has-error': form.errors.has('first_name')}">
                    <label class="col-md-4 control-label">First Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="first_name" v-model="form.first_name">

                        <span class="help-block" v-show="form.errors.has('first_name')">
                            @{{ form.errors.get('first_name') }}
                        </span>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="form-group" :class="{'has-error': form.errors.has('last_name')}">
                    <label class="col-md-4 control-label">Last Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="last_name" v-model="form.last_name">

                        <span class="help-block" v-show="form.errors.has('last_name')">
                            @{{ form.errors.get('last_name') }}
                        </span>
                    </div>
                </div>

                <!-- Business Name -->
                <div class="form-group" :class="{'has-error': form.errors.has('business_name')}">
                    <label class="col-md-4 control-label">Business Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="business_name" v-model="form.business_name">

                        <span class="help-block" v-show="form.errors.has('business_name')">
                            @{{ form.errors.get('business_name') }}
                        </span>
                    </div>
                </div>

                <!-- Primary Affiliate -->
                <div class="form-group" :class="{'has-error': form.errors.has('primary_affiliate')}">
                    <label class="col-md-4 control-label">Primary Affiliate</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="primary_affiliate" v-model="form.primary_affiliate">

                        <span class="help-block" v-show="form.errors.has('primary_affiliate')">
                            @{{ form.errors.get('primary_affiliate') }}
                        </span>
                    </div>
                </div>


                <!-- Primary Affiliate Number -->
                <div class="form-group" :class="{'has-error': form.errors.has('primary_affiliate_number')}">
                    <label class="col-md-4 control-label">Affiliate Number</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="primary_affiliate_number" v-model="form.primary_affiliate_number">

                        <span class="help-block" v-show="form.errors.has('primary_affiliate_number')">
                            @{{ form.errors.get('primary_affiliate_number') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary"
                                @click.prevent="update"
                                :disabled="form.busy">

                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</update-profile-details>