@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parent_trans.email')}}</label>
                        <input type="email" wire:model="email"  class="form-control">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parent_trans.password')}}</label>
                        <input type="password" wire:model="password" class="form-control" >
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('parent_trans.fatherNameAr')}}</label>
                        <input type="text" wire:model="fatherNameAr" class="form-control" >
                        @error('fatherNameAr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parent_trans.fatherNameEn')}}</label>
                        <input type="text" wire:model="fatherNameEn" class="form-control" >
                        @error('fatherNameEn')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.fatherJobAr')}}</label>
                        <input type="text" wire:model="fatherJobAr" class="form-control">
                        @error('fatherJobAr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('parent_trans.fatherJobEn')}}</label>
                        <input type="text" wire:model="fatherJobEn" class="form-control">
                        @error('fatherJobEn')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parent_trans.identificationlID')}}</label>
                        <input type="text" wire:model="fatherIdentificationlID" class="form-control">
                        @error('fatherIdentificationlID')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('parent_trans.passportID')}}</label>
                        <input type="text" wire:model="fatherPassportID" class="form-control">
                        @error('fatherPassportID')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('parent_trans.phone')}}</label>
                        <input type="text" wire:model="fatherPhone" class="form-control">
                        @error('fatherPhone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('parent_trans.nationality')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="fatherNationality">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($nationalities as $national)
                                <option value="{{$national->id}}">{{$national->name}}</option>
                            @endforeach
                        </select>
                        @error('fatherNationality')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('parent_trans.bloodType')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="fatherBloodType">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @endforeach
                        </select>
                        @error('fatherBloodType')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('parent_trans.religion')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="fatherReligion">
                            <option selected>{{trans('parent_trans.Choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </select>
                        @error('fatherReligion')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('parent_trans.fatherAddress')}}</label>
                    <textarea class="form-control" wire:model="fatherAddress" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('fatherAddress')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_edit"
                            type="button">{{trans('parent_trans.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                            type="button">{{trans('parent_trans.Next')}}
                    </button>
                @endif
                <br><br>
                <button class="btn btn-warning btn-sm nextBtn btn-lg pull-right" wire:click="showFormOriginal"
                        type="button">{{trans('parent_trans.Back')}}
                </button>
            </div>
        </div>
    </div>
