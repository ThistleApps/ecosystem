<form class="form-horizontal" role="form">
    @if (Spark::usesTeams() && Spark::onlyTeamPlans())
        <!-- Team Name -->
        <div class="form-group" :class="{'has-error': registerForm.errors.has('team')}" v-if=" ! invitation">
            <label class="col-md-4 control-label">{{ ucfirst(Spark::teamString()) }} Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="team" v-model="registerForm.team" autofocus>

                <span class="help-block" v-show="registerForm.errors.has('team')">
                    @{{ registerForm.errors.get('team') }}
                </span>
            </div>
        </div>

        @if (Spark::teamsIdentifiedByPath())
            <!-- Team Slug (Only Shown When Using Paths For Teams) -->
            <div class="form-group" :class="{'has-error': registerForm.errors.has('team_slug')}" v-if=" ! invitation">
                <label class="col-md-4 control-label">{{ ucfirst(Spark::teamString()) }} Slug</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="team_slug" v-model="registerForm.team_slug" autofocus>

                    <p class="help-block" v-show=" ! registerForm.errors.has('team_slug')">
                        This slug is used to identify your {{ Spark::teamString() }} in URLs.
                    </p>

                    <span class="help-block" v-show="registerForm.errors.has('team_slug')">
                        @{{ registerForm.errors.get('team_slug') }}
                    </span>
                </div>
            </div>
        @endif
    @endif

    <!-- First Name -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('first_name')}">
        <label class="col-md-4 control-label">First Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="first_name" v-model="registerForm.first_name" autofocus>

            <span class="help-block" v-show="registerForm.errors.has('first_name')">
                @{{ registerForm.errors.get('first_name') }}
            </span>
        </div>
    </div>


    <!-- Last Name -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('last_name')}">
        <label class="col-md-4 control-label">Last Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="first_name" v-model="registerForm.last_name" autofocus>

            <span class="help-block" v-show="registerForm.errors.has('last_name')">
            @{{ registerForm.errors.get('last_name') }}
        </span>
        </div>
    </div>

    <!-- E-Mail Address -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('email')}">
        <label class="col-md-4 control-label">Username</label>

        <div class="col-md-6">
            <input type="email" class="form-control" name="email" v-model="registerForm.email">

            <span class="help-block" v-show="registerForm.errors.has('email')">
                @{{ registerForm.errors.get('email') }}
            </span>
        </div>
    </div>

    <!-- Password -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('password')}">
        <label class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input type="password" class="form-control" name="password" v-model="registerForm.password">

            <span class="help-block" v-show="registerForm.errors.has('password')">
                @{{ registerForm.errors.get('password') }}
            </span>
        </div>
    </div>

    <!-- Password Confirmation -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('password_confirmation')}">
        <label class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation" v-model="registerForm.password_confirmation">

            <span class="help-block" v-show="registerForm.errors.has('password_confirmation')">
                @{{ registerForm.errors.get('password_confirmation') }}
            </span>
        </div>
    </div>


    <!-- Business Name -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('business_name')}">
        <label class="col-md-4 control-label">Business Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="business_name" v-model="registerForm.business_name" autofocus>

            <span class="help-block" v-show="registerForm.errors.has('business_name')">
                @{{ registerForm.errors.get('business_name') }}
            </span>
        </div>
    </div>

    <!-- Primary Supplier/CoOp/Brand Affiliate -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('primary_affiliate')}">
        <label class="col-md-4 control-label">Primary Supplier/CoOp/Brand Affiliate</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="primary_affiliate" v-model="registerForm.primary_affiliate" autofocus>

            <span class="help-block" v-show="registerForm.errors.has('primary_affiliate')">
            @{{ registerForm.errors.get('primary_affiliate') }}
        </span>
        </div>
    </div>


    <!-- Affiliate Number -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('primary_affiliate_number')}">
        <label class="col-md-4 control-label">Affiliate Number</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="primary_affiliate_number" v-model="registerForm.primary_affiliate_number" autofocus>

            <span class="help-block" v-show="registerForm.errors.has('primary_affiliate_number')">
                @{{ registerForm.errors.get('primary_affiliate_number') }}
            </span>
        </div>
    </div>

    <!-- Pos Type -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('pos_type')}">
        <label class="col-md-4 control-label">Target Platform/POS</label>

        <div class="col-md-6">
            {{--<input type="text" class="form-control" name="pos_type" v-model="registerForm.pos_type" autofocus>--}}
            <select class="form-control" name="pos_type" v-model="registerForm.pos_type" autofocus>
                <option v-for="option in {{ \App\Models\PosType::all() }}" :value="option.id">
                    @{{ option.name }}
                </option>
            </select>

            <span class="help-block" v-show="registerForm.errors.has('pos_type')">
                @{{ registerForm.errors.get('pos_type') }}
            </span>
        </div>
    </div>

    <!-- Terms And Conditions -->
    <div v-if=" ! selectedPlan || selectedPlan.price == 0">
        <div class="form-group" :class="{'has-error': registerForm.errors.has('terms')}">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="terms" v-model="registerForm.terms">
                        I Accept The <a href="/terms" target="_blank">Terms Of Service</a>
                    </label>

                    <span class="help-block" v-show="registerForm.errors.has('terms')">
                        @{{ registerForm.errors.get('terms') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" @click.prevent="register" :disabled="registerForm.busy">
                    <span v-if="registerForm.busy">
                        <i class="fa fa-btn fa-spinner fa-spin"></i>Registering
                    </span>

                    <span v-else>
                        <i class="fa fa-btn fa-check-circle"></i>Register
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>
