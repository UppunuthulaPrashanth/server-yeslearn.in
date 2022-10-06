@php
if (!empty($itemValue) and !is_array($itemValue)) {
$itemValue = json_decode($itemValue, true);
}
@endphp

<div class="tab-pane mt-3 fade " id="referral" role="tabpanel" aria-labelledby="referral-tab">
    <!-- <div class="row">
        <div class="col-12 col-md-6">
            <form action="/oraclepopupsignin/settings/main" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="financial">
                <input type="hidden" name="name" value="referral">


                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[status]" value="0">
                        <input type="checkbox" name="value[status]" id="referralStatusSwitch" value="1" {{
                            (!empty($itemValue) and !empty($itemValue['status']) and $itemValue['status'])
                            ? 'checked="checked"' : '' }} class="custom-switch-input" />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="referralStatusSwitch">{{
                            trans('oraclepopupsignin/main.active') }}</label>
                    </label>
                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.multi_language_content_hint') }}</div>
                </div>

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[users_affiliate_status]" value="0">
                        <input type="checkbox" name="value[users_affiliate_status]" id="userReferralStatusSwitch"
                            value="1" {{ (!empty($itemValue) and !empty($itemValue['users_affiliate_status']) and
                            $itemValue['users_affiliate_status']) ? 'checked="checked"' : '' }}
                            class="custom-switch-input" />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="userReferralStatusSwitch">{{
                            trans('oraclepopupsignin/main.active_users_affiliate_when_registration') }} </label>
                    </label>
                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.active_referral_new_users_hint') }}
                    </div>
                </div>


                <div class="form-group">
                    <label>{{ trans('oraclepopupsignin/main.affiliate_user_commission') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>
                        <input type="number" name="value[affiliate_user_commission]"
                            value="{{ (!empty($itemValue) and !empty($itemValue['affiliate_user_commission'])) ? $itemValue['affiliate_user_commission'] : old('affiliate_user_commission') }}"
                            class="form-control text-center @error('affiliate_user_commission') is-invalid @enderror"
                            maxlength="3" min="0" max="100" />

                        @error('affiliate_user_commission')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.affiliate_user_commission_hint') }}
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ trans('oraclepopupsignin/main.affiliate_user_amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <input type="number" name="value[affiliate_user_amount]"
                            value="{{ (!empty($itemValue) and !empty($itemValue['affiliate_user_amount'])) ? $itemValue['affiliate_user_amount'] : old('affiliate_user_amount') }}"
                            class="form-control text-center" maxlength="8" min="0" />
                    </div>
                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.affiliate_user_amount_hint') }}</div>
                </div>


                <div class="form-group">
                    <label>{{ trans('oraclepopupsignin/main.referred_user_amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <input type="number" name="value[referred_user_amount]"
                            value="{{ (!empty($itemValue) and !empty($itemValue['referred_user_amount'])) ? $itemValue['referred_user_amount'] : old('referred_user_amount') }}"
                            class="form-control text-center" maxlength="8" min="0" />
                    </div>
                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.referred_user_amount_hint') }}</div>
                </div>

                <div class="form-group">
                    <label>{{ trans('oraclepopupsignin/main.referral_description') }}</label>
                    <textarea name="value[referral_description]" class="form-control" rows="6"
                        placeholder="">{{ (!empty($itemValue) and !empty($itemValue['referral_description'])) ? $itemValue['referral_description'] : old('referral_description') }}</textarea>
                    <div class="text-muted text-small mt-1">{{ trans('oraclepopupsignin/main.referral_description_hint') }}</div>
                </div>

                <button type="submit" class="btn btn-success">{{ trans('oraclepopupsignin/main.save_change') }}</button>
            </form>
        </div>
    </div> -->

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i>Add plan
    </button>
    <div class="table">
        <h6 class="text-center">All affiliate palns list</h6>
        <table class="table ">
            <thead class="table-dark">
                <tr>
                    <td>SNO</td>
                    <td>Rank</td>
                    <td>Rank name</td>
                    <td>Rank type</td>
                    <td>Rank amount</td>
                    <td>Direct com</td>
                    <td>Partner com</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$plan->rank}}</td>
                    <td>{{$plan->label}}</td>
                    <td>{{$plan->rank_amount_type}}</td>
                    <td>{{$plan->rank_amount}}</td>
                    <td>{{$plan->direct_commi}}</td>
                    <td>{{$plan->partner_commi}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$plan->id}}"
                            data-rid="{{$plan->id}}"><i class="fa fa-edit"></i></button>|
                        <a href="affiliate/delete/{{$plan->id}}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                    </td>
                </tr>





                <!-- update data model -->
                <!-- The Modal -->
                <div class="modal" id="myModal{{$plan->id}}" data-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update affiliate plan</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    data-bs-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="affiliate/update" method="post">
                                    @csrf
                                    <div class="card" style="border: 1px solid lightgrey;">
                                        <div class="row m-1">
                                            <div class="col-md-6">
                                                <label for="rank">Rank </label>
                                                <div class="input-group">
                                                    <input type="text" hidden value="{{$plan->id}}" name="itemID" id="itemID">
                                                    <input type="number" class="form-control" value="{{$plan->rank}}" name="rank" id="rank"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="label">Rank Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$plan->label}}" name="label" id="label"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-2">
                                                <label for="rank_amount_type">Rank amount Type</label>
                                                <div class="input-group">
                                                    <select name="rank_amount_type" id="rank_amount_type"
                                                        class="form-control" required>
                                                        <option value="Percentage" @if( $plan->rank_amount_type=='Percentage') echo 'Selected' @endif</option>>Percentage(%)</option>
                                                        <option value="Amount" @if( $plan->rank_amount_type=='Amount') echo 'Selected' @endif>Flat Amount</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="rank_amount">Rank amount value</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="{{$plan->rank_amount}}" name="rank_amount"
                                                        id="rank_amount" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="rank_color">Rank color</label>
                                                <div class="input-group">
                                                    
                                                    <input type="color" class="form-control" value="{{$plan->rank_color}}" name="rank_color"
                                                        id="rank_color" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="icon">icon</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button"
                                                            class="input-group-text admin-file-manager "
                                                            data-input="icon" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="icon" id="icon" value="{{ $plan->icon }}"
                                                        class="form-control" required />
                                                        <button type="button" class="input-group-text admin-file-view" data-input="icon">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                </div>
                                            </div>


                                            <div class="col-md-6 mt-2">
                                                <label for="direct_commi">Direct commission(%)</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="{{$plan->direct_commi}}" name="direct_commi"
                                                        id="direct_commi" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="partner_commi">Partner commission(%)</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" value="{{$plan->partner_commi}}" name="partner_commi"
                                                        id="partner_commi" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="description">Description</label>
                                                <div class="input-group">
                                                    <textarea name="description" id="description" cols="30" rows="2"
                                                        class="form-control" required>{{$plan->Description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="referralStatusSwitch">Status</label>
                                                <div class="form-group custom-switches-stacked">
                                                    <label class="custom-switch pl-0 d-flex align-items-center">
                                                        @if($plan->status===1)
                                                        <input type="checkbox" name="value" id="referralStatusSwitch" checked="checked" class="custom-switch-input" />
                                                        @elseif($plan->status===0)
                                                        <input type="checkbox" name="value" id="referralStatusSwitch" class="custom-switch-input" />
                                                        @endif
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="text-center m-2">
                                            <input type="submit" class="btn btn-primary btn-lg" value="add new plan">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                @endforeach
            </tbody>
        </table>
    </div>
</div>



<!-- adding data model -->
<!-- The Modal -->
<div class="modal fade" id="myModal" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add new affiliate plan</h4>
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="affiliate/add" method="post">
                    @csrf
                    <div class="card" style="border: 1px solid lightgrey;">
                        <div class="row m-1">
                            <div class="col-md-6">
                                <label for="rank">Rank</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="rank" id="rank" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="label">Rank Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="label" id="label" required>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="rank_amount_type">Rank amount Type</label>
                                <div class="input-group">
                                    <select name="rank_amount_type" id="rank_amount_type" class="form-control" required>
                                        <option value="Percentage" selected>Percentage(%)</option>
                                        <option value="Amount">Flat Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="rank_amount">Rank amount value</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="rank_amount" id="rank_amount"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="rank_color">Rank color</label>
                                <div class="input-group">
                                    <input type="color" class="form-control" name="rank_color" id="rank_color" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="icon">icon</label>
                                <!-- <div class="input-group">
                                <input type="file" class="form-control" name="icon" id="icon">
                            </div> -->
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text admin-file-manager "
                                            data-input="icon" data-preview="holder">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                                        class="form-control" required />
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text admin-file-manager " data-input="icon" data-preview="holder">
                                        <i class="fa fa-upload"></i>
                                    </button>
                                </div>
                                <input type="text" name="icon" id="icon"  class="form-control"/>
                            </div>


                            <div class="col-md-6 mt-2">
                                <label for="direct_commi">Direct commission(%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="direct_commi" id="direct_commi"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="partner_commi">Partner commission(%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="partner_commi" id="partner_commi"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <textarea name="description" id="description" cols="30" rows="2"
                                        class="form-control" required></textarea>
                                </div>
                            </div>

                            
                        </div>
                        <div class="text-center m-2">
                            <input type="submit" class="btn btn-primary btn-lg" value="add new plan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
