<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Parentt;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
class AddParent extends Component
{
    use WithFileUploads;

    /*
        first of all i have only one page (add-parent component) and it changes to another page by the conditions,
        by default it show the parents list why? because i use this condition

        @if($showParentsTable)
            @include('livewire.Parent_Table')
        @else
                
            @include('livewire.Father_Form')
            @include('livewire.Mother_Form')

            <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
                    @endif
                    ....................etc
        and i assigned it's value by default ($showParentsTable = true) as you see in cuurent file
        now if i want to change the parents list page i must make ($showParentsTable = false)
        
        for this trick in the parents table there is (Add Parent) button this button do specefic method
        that make ($showParentsTable = false) then the parents table hideen and the first step of the form appear
        why? because the condition of the above

        and now i make by default public $currentStep = 1 , and in the father form a condition @if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif

        if the currentStep == 1 it appear else it hidden , and when i submit the father form i make the currentStep = 2
        so the mather form appear and father form disappear because the conditions   @if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif

        then go to the third form that in the add-parent with it's condition in the above  
                <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
                    @endi

                    after the last step i use
                    $this->clearForm();
                    $this->currentStep = 1;
                    
                    to go to the first step again

    */






    public $successMessage = '';

    public $catchError , $updateMode = false , $photos , $showParentsTable = true , $parentID;

    public $currentStep = 1,

        // Father INPUTS
        $email, $password,
        $fatherNameAr, $fatherNameEn,
        $fatherIdentificationlID, $fatherPassportID,
        $fatherPhone, $fatherJobAr, $fatherJobEn,
        $fatherNationality, $fatherBloodType,
        $fatherAddress, $fatherReligion,


        // Mother INPUTS
        $motherNameAr, $motherNameEn,
        $motherIdentificationlID, $motherPassportID,
        $motherPhone, $motherJobAr, $motherJobEn,
        $motherNationality, $motherBloodType,
        $motherAddress, $motherReligion;



    /*
        Father Livewire validation (helper method for real time validation)
    */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'fatherIdentificationlID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'fatherPassportID' => 'min:10|max:10',
            'fatherPhone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'motherIdentificationlID' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'motherPassportID' => 'min:10|max:10',
            'motherPhone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    
    public function render()
    {
        return view('livewire.parents.add-parent', [
            'nationalities' => Nationality::all(),
            'bloodTypes' => Blood::all(),
            'religions' => Religion::all(),
            'parents' => Parentt::all(), //for parents table
        ]);
    }





    public function showAddParentform(){
        $this->showParentsTable = false;
    }


    public function showFormOriginal(){
        $this->showParentsTable = true;
    }




    //firstStepSubmit (Father form)
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:parents,email,'.$this->id,
            'password' => 'required',
            'fatherNameAr' => 'required',
            'fatherNameEn' => 'required',
            'fatherJobAr' => 'required',
            'fatherJobEn' => 'required',
            'fatherIdentificationlID' => 'required|unique:parents,father_national_id,' . $this->id,
            'fatherPassportID' => 'required|unique:parents,father_passport_id,' . $this->id,
            'fatherPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'fatherNationality' => 'required',
            'fatherBloodType' => 'required',
            'fatherReligion' => 'required',
            'fatherAddress' => 'required',
        ]);

        $this->currentStep = 2;
    }





    // secondStepSubmit (Mather form)
    public function secondStepSubmit()
    {
        $this->validate([
            'motherNameAr' => 'required',
            'motherNameEn' => 'required',
            'motherIdentificationlID' => 'required|unique:parents,mother_national_id,' . $this->id,
            'motherPassportID' => 'required|unique:parents,mother_passport_id,' . $this->id,
            'motherPhone' => 'required',
            'motherJobAr' => 'required',
            'motherJobEn' => 'required',
            'motherNationality' => 'required',
            'motherBloodType' => 'required',
            'motherReligion' => 'required',
            'motherAddress' => 'required',
        ]);

        $this->currentStep = 3;
    }











    public function submitForm(){

        try {
            $parent = new Parentt();
            // Father_INPUTS
            $parent->email = $this->email;
            $parent->password = Hash::make($this->password);
            $parent->father_name = ['en' => $this->fatherNameEn, 'ar' => $this->fatherNameAr];
            $parent->father_national_id = $this->fatherIdentificationlID;
            $parent->father_passport_id = $this->fatherPassportID;
            $parent->father_phone = $this->fatherPhone;
            $parent->father_job = ['en' => $this->fatherJobEn, 'ar' => $this->fatherJobAr];
            $parent->father_nationality = $this->fatherNationality;
            $parent->father_blood_type = $this->fatherBloodType;
            $parent->father_religion = $this->fatherReligion;
            $parent->father_address = $this->fatherAddress;

            // Mother_INPUTS
            $parent->mother_name = ['en' => $this->motherNameEn, 'ar' => $this->motherNameAr];
            $parent->mother_national_id = $this->motherIdentificationlID;
            $parent->mother_passport_id = $this->motherPassportID;
            $parent->mother_phone = $this->motherPhone;
            $parent->mother_job = ['en' => $this->motherJobEn, 'ar' => $this->motherJobAr];
            $parent->mother_nationality = $this->motherNationality;
            $parent->mother_blood_type = $this->motherBloodType;
            $parent->mother_religion = $this->motherReligion;
            $parent->mother_address = $this->motherAddress;
            $parent->save();


            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->fatherPassportID, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => Parentt::latest()->first()->id,
                    ]);
                }
            }
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }


    
    public function edit($id)
    {
        $this->showParentsTable = false;
        $this->updateMode = true;

        $parent = Parentt::where('id',$id)->first();
        //هنا كإنك بتقول  {{parent->Email$}} = input name = "" value >

        //Father data
        $this->parentID = $id;
        $this->email = $parent->email;
        $this->password = $parent->password;
        $this->fatherNameAr = $parent->getTranslation('father_name', 'ar');
        $this->fatherNameEn = $parent->getTranslation('father_name', 'en');
        $this->fatherJobAr = $parent->getTranslation('father_job', 'ar');
        $this->fatherJobEn = $parent->getTranslation('father_job', 'en');
        $this->fatherIdentificationlID = $parent->father_national_id;
        $this->fatherPassportID = $parent->father_passport_id;
        $this->fatherPhone = $parent->father_phone;
        $this->fatherNationality = $parent->father_nationality;
        $this->fatherBloodType = $parent->father_blood_type;
        $this->fatherAddress = $parent->father_address;
        $this->fatherReligion = $parent->father_religion;


        //Mother data
        $this->motherNameAr = $parent->getTranslation('mother_name', 'ar');
        $this->motherNameEn = $parent->getTranslation('mother_name', 'en');
        $this->motherJobAr = $parent->getTranslation('mother_job', 'ar');
        $this->motherJobEn = $parent->getTranslation('mother_job', 'en');
        $this->motherIdentificationlID = $parent->mother_national_id;
        $this->motherPassportID = $parent->mother_passport_id;
        $this->motherPhone = $parent->mother_phone;
        $this->motherNationality = $parent->mother_nationality;
        $this->motherBloodType = $parent->mother_blood_type;
        $this->motherAddress = $parent->mother_address;
        $this->motherReligion = $parent->mother_religion;
    }



    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }


    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }



    public function submitForm_edit(){

        if ($this->parentID){
            $parent = Parentt::find($this->parentID);
            $parent->update([
                'father_passport_id' => $this->fatherPassportID,
                'father_national_id' => $this->fatherIdentificationlID,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'father_name' => ['en' => $this->fatherNameEn, 'ar' => $this->fatherNameAr],
                'father_phone' => $this->fatherPhone,
                'father_job' => ['en' => $this->fatherJobEn, 'ar' => $this->fatherJobAr],
                'father_nationality' => $this->fatherNationality,
                'father_blood_type' => $this->fatherBloodType,
                'father_religion' => $this->fatherReligion,
                'father_address' => $this->fatherAddress,
                'mother_name' => ['en' => $this->motherNameEn, 'ar' => $this->motherNameAr],
                'mother_national_id' => $this->motherIdentificationlID,
                'mother_passport_id' => $this->motherPassportID,
                'mother_phone' => $this->motherPhone,
                'mother_job' => ['en' => $this->motherJobEn, 'ar' => $this->motherJobAr],
                'mother_nationality' => $this->motherNationality,
                'mother_blood_type' => $this->motherBloodType,
                'mother_religion' => $this->motherReligion,
                'mother_address' => $this->motherAddress,
            ]);

        }
        $this->currentStep = 1;
        $this->successMessage = trans('messages.Update');


    }

    public function delete($id){
        Parentt::findOrFail($id)->delete();
        return redirect()->to('/parents');
    }


    //clearForm
    public function clearForm()
    {
        //Father data
        $this->email = '';
        $this->password = '';
        $this->fatherNameAr = '';
        $this->fatherNameEn = '';
        $this->fatherJobAr = '';
        $this->fatherJobEn = '';
        $this->fatherIdentificationlID ='';
        $this->fatherPassportID = '';
        $this->fatherPhone = '';
        $this->fatherNationality = '';
        $this->fatherBloodType = '';
        $this->fatherAddress ='';
        $this->fatherReligion ='';


        //Mother data
        $this->motherNameAr = '';
        $this->motherNameEn = '';
        $this->motherJobAr = '';
        $this->motherJobEn = '';
        $this->motherIdentificationlID ='';
        $this->motherPassportID = '';
        $this->motherPhone = '';
        $this->motherNationality = '';
        $this->motherBloodType = '';
        $this->motherAddress ='';
        $this->motherReligion ='';

    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

}
