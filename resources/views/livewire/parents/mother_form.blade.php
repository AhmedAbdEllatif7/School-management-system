@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.motherNameAr')}}</label>
                        <input type="text" wire:model="motherNameAr" class="form-control">
                        @error('motherNameAr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.motherNameEn')}}</label>
                        <input type="text" wire:model="motherNameEn" class="form-control">
                        @error('motherNameEn')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.jobAr')}}</label>
                        <input type="text" wire:model="motherJobAr" class="form-control">
                        @error('motherJobAr')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('Parent_trans.jobEn')}}</label>
                        <input type="text" wire:model="motherJobEn" class="form-control">
                        @error('motherJobEn')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.identificationlID')}}</label>
                        <input type="text" wire:model="motherIdentificationlID" class="form-control">
                        @error('motherIdentificationlID')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('Parent_trans.passportID')}}</label>
                        <input type="text" wire:model="motherPassportID" class="form-control">
                        @error('motherPassportID')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('Parent_trans.phone')}}</label>
                        <input type="text" wire:model="motherPhone" class="form-control">
                        @error('motherPhone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('Parent_trans.nationality')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="motherNationality">
                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($nationalities as $national)
                                <option value="{{$national->id}}">{{$national->name}}</option>
                            @endforeach
                        </select>
                        @error('motherNationality')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('Parent_trans.bloodType')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="motherBloodType">
                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @endforeach
                        </select>
                        @error('motherBloodType')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('Parent_trans.religion')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="motherReligion">
                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </select>
                        @error('motherReligion')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('Parent_trans.motherAddress')}}</label>
                    <textarea class="form-control" wire:model="motherAddress" id="exampleFormControlTextarea1"
                            rows="4"></textarea>
                    @error('motherAddress')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('Parent_trans.Back')}}
                </button>

                
                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('Parent_trans.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="secondStepSubmit">{{trans('Parent_trans.Next')}}</button>
                @endif

            </div>
        </div>
    </div>
