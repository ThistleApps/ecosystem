<update-profile-details :user="user" inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Details</div>

        <div class="panel-body">
            <!-- Success Message -->
            <div class="alert alert-success alert-dismissable" v-if="form.successful">
                <button @click.prevent="" class="close" aria-label="close" @click="close">×</button>
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

                <div class="form-group" :class="{'has-error': form.errors.has('pos_type')}">
                    <label class="col-md-4 control-label">Target Platform/POS</label>

                    <div class="col-md-6">
                        <select class="form-control" name="pos_type" v-model="form.pos_type">
                            <option v-for="option in {{ \App\Models\PosType::all() }}" :value="option.id">
                                @{{ option.name }}
                            </option>
                        </select>

                        <span class="help-block" v-show="form.errors.has('pos_type')">
                            @{{ form.errors.get('pos_type') }}
                        </span>
                    </div>
                </div>

                <div class="form-group" :class="{'has-error': form.errors.has('pos_wan_address')}">
                    <label class="control-label col-sm-4" for="pos_wan_address">POS WAN Address</label>
                    <div class="col-sm-4">
                        <input ref="pos_wan_address" type="text" class="form-control" id="pos_wan_address" name="pos_wan_address" placeholder="10.0.0.10" v-model="form.pos_wan_address">
                    </div>
                    <div class="col-sm-2">
                        <button @click.prevent="testConnection" type="submit" class="btn btn-default pull-right">
                            <span :class="{'fa': true, 'fa-spinner fa-spin': isLoading, 'fa-plug': !isLoading}"></span>
                            Test Connection
                        </button>
                    </div>
                    <span class="help-block" v-show="form.errors.has('pos_wan_address')">
                        @{{ form.errors.get('pos_wan_address') }}
                    </span>
                </div>

                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-6">
                        <div class="alert alert-dismissable" :class="{'alert-success': connection.status, 'alert-danger': !connection.status}" v-if="connection.testingConnection">
                            <button @click.prevent="" class="close" aria-label="close" @click="close">×</button>
                            @{{ connection.message }}
                        </div>
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