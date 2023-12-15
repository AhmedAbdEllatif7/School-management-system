<div>

    <script>
        window.addEventListener('reset-error-message', event => {
            setTimeout(() => {
                console.log('Resetting error message...');
                Livewire.emit('resetErrorMessage');
            }, 5000); // Adjust the time in milliseconds as needed
        });
    </script>
    
            @if ($catchError)
                <div class="alert alert-danger" id="success-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    {{ $catchError }}
                </div>
            @endif


        <script>
            window.addEventListener('reset-success-message', event => {
                setTimeout(() => {
                    Livewire.emit('resetSuccessMessage');
                }, 5000); // Adjust the time in milliseconds as needed
            });
        </script>

        

        @if($showParentsTable)
            @include('livewire.parents.parent_table')
        @else
                @if (!empty($successMessage))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $successMessage }}
                    </div>
                @endif
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button"
                            class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                        <p>{{ trans('Parent_trans.Step1') }}</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button"
                            class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                        <p>{{ trans('Parent_trans.Step2') }}</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                        disabled="disabled">3</a>
                        <p>{{ trans('Parent_trans.Step3') }}</p>
                    </div>
                </div>
            </div>

            
            @include('livewire.parents.father_form')

            @include('livewire.parents.mother_form')


            {{-- Parents photos --}}
            @if(!empty($parentPhotos))
            @foreach($parentPhotos as $photo)
                <div class="col-md-3">
                    {{-- beacuase i run php artisan storage:link --}}
                    <img src="{{ URL::asset('parent_attachments/'.$this->fatherPassportID.'/'.$photo) }}" alt="Parent Photo" style="max-width: 100%;"><br>
                </div>
            @endforeach
            @else
                <p>No photos available</p>
            @endif


                        

            {{-- Third step --}}
        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
                    @endif
                    <div>
                        <!-- Other form elements... -->
                        
                        <!-- Display parent photos -->
                        
                    
                        <!-- Rest of your form -->
                    </div>
                    
                    <div class="col-xs-12">
                        <div class="col-md-12"><br>
                            <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>
                            <div class="form-group">
                                <input type="file" wire:model="photos" accept="image/*" multiple>
                            </div>
                            <br>

                            <input type="hidden" wire:model="Parent_id">

                            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                    wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>

                            @if($updateMode)
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                                        type="button">{{trans('Parent_trans.Finish')}}
                                </button>
                            @else
                                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                        type="button">{{ trans('Parent_trans.Finish') }}</button>
                            @endif

                        </div>
                    </div>
                </div>
        </div>
    @endif
</div>
