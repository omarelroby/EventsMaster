<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'organization_Sn' => $this->organization_Sn,
            'commercial_Name' => $this->commercial_Name , 
            'name_tag' => $this->name_tag,
            'commercial_rgistryID '  => $this->commercial_rgistryID,
            'commercial_registry_expiration'=>  $this->commercial_registry_expiration,
            'commercial_registry_file' => $this->commercial_registry_file,
            'tax_registryID' => $this->tax_registryID,
            'tax_registry_expiration' => $this->tax_registry_expiration , 
            'email' => $this->email,
            'establish_date'  => $this->establish_date,
            'zip'=>  $this->zip,

            'Phone1' => $this->Phone1 , 
            'Phone2' => $this->Phone2 , 
            'WhatsApp' => $this->WhatsApp,
            'head_office_address'  => $this->head_office_address,
            'website'=>  $this->website,
            'city_id' => $this->city_id , 
            'nationality_country_Id' => $this->nationality_country_Id,
            'org_classification_id'  => $this->org_classification_id,
            'legal_form_id'=>  $this->legal_form_id,
            'organization_parent_Sn'=>  $this->organization_parent_Sn,
            'manager_id' => $this->manager_id,
            'iban'  => $this->iban,
            'swift_code'=>  $this->swift_code,
            'bank' => $this->bank , 
            'account_number' => $this->account_number


        ];
    }
}
