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
    The 'add-parent' component works as a dynamic page, transitioning between displaying a parent list and father form and mother form based on conditional checks. By default, it shows the parent list using a condition to include either the parent table or the form steps.

    The $showParentsTable variable controls the display: when true, it shows the parent table; when false, the form steps appear. Triggering the 'Add Parent' button toggles $showParentsTable to false, hiding the parent table and revealing the initial form step (Father form).

    The form progression operates on $currentStep: initialized at 1, it manages form step visibility. For instance, if $currentStep != 1, the first form step remains hidden. After submitting the father form, $currentStep changes to 2, revealing the mother form, and so forth for subsequent steps.

    At the final step, a method clears the form and resets $currentStep to 1, redirecting back to the initial form state.

    */





// Properties for form steps and input fields
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
        Livewire validation (helper method for real time validation)
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
            'parents' => Parentt::all(), //Data for parents table
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
            $this->saveParentData();
            $this->uploadFiles();
            $this->setSuccessState();
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }



    private function saveParentData()
    {
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
    }


    private function uploadFiles()
    {
        if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->fatherPassportID, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => Parentt::latest()->first()->id,
                    ]);
                }
            }
    }

    private function setSuccessState() {
        $this->successMessage = trans('messages.success');
        $this->clearForm();
        $this->currentStep = 1;
    }
    
    private function handleError($errorMessage) {
        $this->catchError = $errorMessage;
    }










    

    public function edit($id)
    {
        $this->setFlagsAndMode();
        $this->retrieveParentData($id);
    }

    private function setFlagsAndMode()
    {
        $this->showParentsTable = false;
        $this->updateMode = true;
    }

    private function retrieveParentData($id)
    {
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
        try {
            if ($this->parentID){
                $this->updateParentData();
            }
            $this->setSuccessState();
        } catch (\Exception $e) {
            $this->handleError($e->getMessage());
        }
    }
    
    private function updateParentData() {
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
