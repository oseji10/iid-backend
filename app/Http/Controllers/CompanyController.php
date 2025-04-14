<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;


use App\Models\SocialMedia;
use App\Models\ContactPerson;
use App\Models\FactoryLocation;
use App\Models\CompanyProductionDetail;
use App\Models\CompanyProduct;
use App\Models\CompanyService;
use App\Models\CompanyStaffing;



use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function RetrieveAll()
    {
        $companies = Company::with([
            'financialDetails',
            'socialMedia',
            'factoryLocations',
            'contactPersons',
            'productionDetails',
            'products',
            'services',
            'staffing',
            'rawMaterials',
            'machineryAndEquipment',
            'energyRequirements',
            'environmentalImpactAssessment',
            'investment',
            'foreignCurrencyUsage',
        ])->orderBy('companyId', 'desc')->get();
    
        return response()->json($companies);
    }
    

    public function StatusReport($companyId)
    {
        $company = Company::with([
            'financialDetails',
            'socialMedia',
            'factoryLocations',
            'contactPersons',
            'productionDetails',
            'products',
            'services',
            'staffing',
            'rawMaterials',
            'machineryAndEquipment',
            'energyRequirements',
            'environmentalImpactAssessment',
            // 'waterRequirements',
        ])->findOrFail($companyId);

        // return response()->json($company);

        $pdf = PDF::loadView('pdf.schedule-2', compact('company'));

        return $pdf->stream('schedule_2' . $company->companyId . '.pdf');
        // Or use ->stream() to view in browser:
        // return $pdf->stream('company_status_report_' . $company->companyId . '.pdf');
    }

  

    // public function store(Request $request)
    // {
    //     // Directly get the data from the request
    //     $data = $request->all();
    //     $data['status'] = 'active';
    //     // Create a new user with the data (ensure that the fields are mass assignable in the model)
    //     $companies = Company::create($data);
    
    //     // Return a response, typically JSON
    //     return $companies; // HTTP status code 201: Created
    // }


        public function store(Request $request)
        {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'companyName' => 'required|string|max:255',
                'natureOfBusiness' => 'nullable|string',
                'companyAddress' => 'nullable|string',
                'companyCity' => 'nullable|string',
                'state' => 'nullable|string',
                'LGA' => 'nullable|string',
                'companyPhone' => 'nullable|string|max:20',
                'companyWebsite' => 'nullable|url',
                'TIN' => 'nullable|string|max:50',
                'onStockExchange' => 'nullable|in:Yes,No',
                'dateListedOnSE' => 'nullable|date',
                'dateOfIncorporation' => 'nullable|date',
                'socialMedia' => 'nullable|array',
                'socialMedia.*.socialMediaName' => 'required|string|max:100',
                'socialMedia.*.url' => 'required|url',
                'factoryLocations' => 'nullable|array',
                'factoryLocations.*.locationName' => 'required|string|max:255',
                'contactPersons' => 'nullable|array',
                'contactPersons.*.staffName' => 'required|string|max:255',
                'contactPersons.*.designation' => 'required|string|max:100',
                'contactPersons.*.phoneNumber' => 'required|string|max:20',
                'contactPersons.*.email' => 'required|email|max:255',
                'productionDetails' => 'nullable|array',
                'productionDetails.dateProductionStarted' => 'nullable|date',
                'productionDetails.prductsAndServices' => 'nullable|string',
                'productionDetails.designedInstalledCapacity' => 'nullable|string',
                'productionDetails.operatingCapacity' => 'nullable|string',
                'productionDetails.percentageForExport' => 'nullable|string',
                'products' => 'nullable|array',
                'products.*.productName' => 'required|string|max:255',
                'services' => 'nullable|array',
                'services.*.serviceName' => 'required|string|max:255',
                'staffing' => 'nullable|array',
                'staffing.staffStrength' => 'nullable|string',
                'staffing.directorExpatriate' => 'nullable|integer|min:0',
                'staffing.directorNigerian' => 'nullable|integer|min:0',
                'staffing.managementExpatriate' => 'nullable|integer|min:0',
                'staffing.managementNigerian' => 'nullable|integer|min:0',
                'staffing.otherStaffSkilled' => 'nullable|integer|min:0',
                'staffing.otherStaffUnskilled' => 'nullable|integer|min:0',
                'financialDetails' => 'nullable|array',
                'financialDetails.shareholders' => 'nullable|string',
                'financialDetails.foreignEquity' => 'nullable|string',
                'financialDetails.nigerianEquity' => 'nullable|string',
                'financialDetails.financialPeriod' => 'nullable|string',
                'financialDetails.turnOverPreviousYear' => 'nullable|string',
                'financialDetails.operatingProfitBeforeTax' => 'nullable|string',
                'financialDetails.operatingProfitAfterTax' => 'nullable|string',
                'financialDetails.VAT' => 'nullable|string',
                'financialDetails.companyTax' => 'nullable|string',
                'financialDetails.exciseDuty' => 'nullable|string',
                'financialDetails.initialInvestment' => 'nullable|string',
                'financialDetails.totalFAIFinancialStatement' => 'nullable|string',
                'financialDetails.totalFAIAcceptanceCertificate' => 'nullable|string',
                'rawMaterials' => 'nullable|array',
                'rawMaterials.*.foreignItem' => 'nullable|string',
                'rawMaterials.*.foreignItemQuantity' => 'nullable|string',
                'rawMaterials.*.localItem' => 'nullable|string',
                'rawMaterials.*.localItemQuantity' => 'nullable|string',
                'machineryAndEquipment' => 'nullable|array',
                'machineryAndEquipment.*.equipmentName' => 'nullable|string',
                'machineryAndEquipment.*.sourceOfMachinery' => 'nullable|string',
                'energyRequirements' => 'nullable|array',
                'energyRequirements.averageEnergyConsumptionPerDay' => 'nullable|string',
                'energyRequirements.percentageContributionByDisco' => 'nullable|string',
                'energyRequirements.percentageContributionByGenerator' => 'nullable|string',
                'energyRequirements.percentageContributionByOthers' => 'nullable|string',
                'energyRequirements.quantityOfDieselUtilized' => 'nullable|string',
                'energyRequirements.quantityOfGasUtilized' => 'nullable|string',
                'environmentalImpactAssessment' => 'nullable|array',
                'environmentalImpactAssessment.*.typeOfAssessment' => 'nullable|string|in:Solid Waste Materials,Fluid Waste Materials,Gaseous Waste Materials',
                'environmentalImpactAssessment.*.degreeOfAbatementOrRemediation' => 'nullable|string',
                'investment' => 'nullable|array',
                'investment.FDI' => 'nullable|string',
                'investment.foreign' => 'nullable|string',
                'foreignCurrencyUsage' => 'nullable|array',
                'foreignCurrencyUsage.*.importedItemName' => 'nullable|string',
                'foreignCurrencyUsage.*.FX' => 'nullable|string',
                'foreignCurrencyUsage.*.currencyType' => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            try {
                return DB::transaction(function () use ($request) {
                    // Prepare company data
                    $companyData = $request->only([
                        'companyName',
                        'natureOfBusiness',
                        'companyAddress',
                        'companyCity',
                        'state',
                        'LGA',
                        'companyPhone',
                        'companyWebsite',
                        'TIN',
                        'onStockExchange',
                        'dateListedOnSE',
                        'dateOfIncorporation',
                    ]);
                    $companyData['status'] = 'active';
    
                    // Create the company
                    $company = Company::create($companyData);
    
                    // Save single-instance relationships
                    if ($request->has('financialDetails') && is_array($request->financialDetails)) {
                        $company->financialDetails()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->financialDetails
                        );
                    }
    
                    if ($request->has('productionDetails') && is_array($request->productionDetails)) {
                        $company->productionDetails()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->productionDetails
                        );
                    }
    
                    if ($request->has('staffing') && is_array($request->staffing)) {
                        $company->staffing()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->staffing
                        );
                    }
    
                    if ($request->has('energyRequirements') && is_array($request->energyRequirements)) {
                        $company->energyRequirements()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->energyRequirements
                        );
                    }
    
                    if ($request->has('investment') && is_array($request->investment)) {
                        $company->investment()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->investment
                        );
                    }
    
                    // Save multi-instance relationships
                    if ($request->has('socialMedia') && is_array($request->socialMedia)) {
                        foreach ($request->socialMedia as $social) {
                            $company->socialMedia()->create([
                                'socialMediaName' => $social['socialMediaName'],
                                'url' => $social['url'],
                            ]);
                        }
                    }
    
                    if ($request->has('factoryLocations') && is_array($request->factoryLocations)) {
                        foreach ($request->factoryLocations as $location) {
                            $company->factoryLocations()->create([
                                'locationName' => $location['locationName'],
                            ]);
                        }
                    }
    
                    if ($request->has('contactPersons') && is_array($request->contactPersons)) {
                        foreach ($request->contactPersons as $contact) {
                            $company->contactPersons()->create([
                                'staffName' => $contact['staffName'],
                                'designation' => $contact['designation'],
                                'phoneNumber' => $contact['phoneNumber'],
                                'email' => $contact['email'],
                            ]);
                        }
                    }
    
                    if ($request->has('products') && is_array($request->products)) {
                        foreach ($request->products as $product) {
                            $company->products()->create([
                                'productName' => $product['productName'],
                            ]);
                        }
                    }
    
                    if ($request->has('services') && is_array($request->services)) {
                        foreach ($request->services as $service) {
                            $company->services()->create([
                                'serviceName' => $service['serviceName'],
                            ]);
                        }
                    }
    
                    if ($request->has('rawMaterials') && is_array($request->rawMaterials)) {
                        foreach ($request->rawMaterials as $material) {
                            $company->rawMaterials()->create([
                                'foreignItem' => $material['foreignItem'],
                                'foreignItemQuantity' => $material['foreignItemQuantity'],
                                'localItem' => $material['localItem'],
                                'localItemQuantity' => $material['localItemQuantity'],
                            ]);
                        }
                    }
    
                    if ($request->has('machineryAndEquipment') && is_array($request->machineryAndEquipment)) {
                        foreach ($request->machineryAndEquipment as $equipment) {
                            $company->machineryAndEquipment()->create([
                                'equipmentName' => $equipment['equipmentName'],
                                'sourceOfMachinery' => $equipment['sourceOfMachinery'],
                            ]);
                        }
                    }
    
                    if ($request->has('environmentalImpactAssessment') && is_array($request->environmentalImpactAssessment)) {
                        foreach ($request->environmentalImpactAssessment as $assessment) {
                            $company->environmentalImpactAssessment()->create([
                                'typeOfAssessment' => $assessment['typeOfAssessment'],
                                'degreeOfAbatementOrRemediation' => $assessment['degreeOfAbatementOrRemediation'],
                            ]);
                        }
                    }
    
                    if ($request->has('foreignCurrencyUsage') && is_array($request->foreignCurrencyUsage)) {
                        foreach ($request->foreignCurrencyUsage as $usage) {
                            $company->foreignCurrencyUsage()->create([
                                'importedItemName' => $usage['importedItemName'],
                                'FX' => $usage['FX'],
                                'currencyType' => $usage['currencyType'],
                            ]);
                        }
                    }
    
                    // Return the created company with its relationships
                    return response()->json(
                        $company->load([
                            'financialDetails',
                            'socialMedia',
                            'factoryLocations',
                            'contactPersons',
                            'productionDetails',
                            'products',
                            'services',
                            'staffing',
                            'rawMaterials',
                            'machineryAndEquipment',
                            'energyRequirements',
                            'environmentalImpactAssessment',
                            'investment',
                            'foreignCurrencyUsage',
                        ]),
                        201
                    );
                });
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create company: ' . $e->getMessage()], 500);
            }
        }
    
        public function update(Request $request, $id)
        {
            $company = Company::findOrFail($id);
    
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'companyName' => 'required|string|max:255',
                'natureOfBusiness' => 'nullable|string',
                'companyAddress' => 'nullable|string',
                'companyCity' => 'nullable|string',
                'state' => 'nullable|string',
                'LGA' => 'nullable|string',
                'companyPhone' => 'nullable|string|max:20',
                'companyWebsite' => 'nullable|url',
                'TIN' => 'nullable|string|max:50',
                'onStockExchange' => 'nullable|in:Yes,No',
                'dateListedOnSE' => 'nullable|date',
                'dateOfIncorporation' => 'nullable|date',
                'socialMedia' => 'nullable|array',
                'socialMedia.*.socialMediaName' => 'required|string|max:100',
                'socialMedia.*.url' => 'required|url',
                'factoryLocations' => 'nullable|array',
                'factoryLocations.*.locationName' => 'required|string|max:255',
                'contactPersons' => 'nullable|array',
                'contactPersons.*.staffName' => 'required|string|max:255',
                'contactPersons.*.designation' => 'required|string|max:100',
                'contactPersons.*.phoneNumber' => 'required|string|max:20',
                'contactPersons.*.email' => 'required|email|max:255',
                'productionDetails' => 'nullable|array',
                'productionDetails.dateProductionStarted' => 'nullable|date',
                'productionDetails.prductsAndServices' => 'nullable|string',
                'productionDetails.designedInstalledCapacity' => 'nullable|string',
                'productionDetails.operatingCapacity' => 'nullable|string',
                'productionDetails.percentageForExport' => 'nullable|string',
                'products' => 'nullable|array',
                'products.*.productName' => 'required|string|max:255',
                'services' => 'nullable|array',
                'services.*.serviceName' => 'required|string|max:255',
                'staffing' => 'nullable|array',
                'staffing.staffStrength' => 'nullable|string',
                'staffing.directorExpatriate' => 'nullable|integer|min:0',
                'staffing.directorNigerian' => 'nullable|integer|min:0',
                'staffing.managementExpatriate' => 'nullable|integer|min:0',
                'staffing.managementNigerian' => 'nullable|integer|min:0',
                'staffing.otherStaffSkilled' => 'nullable|integer|min:0',
                'staffing.otherStaffUnskilled' => 'nullable|integer|min:0',
                'financialDetails' => 'nullable|array',
                'financialDetails.shareholders' => 'nullable|string',
                'financialDetails.foreignEquity' => 'nullable|string',
                'financialDetails.nigerianEquity' => 'nullable|string',
                'financialDetails.financialPeriod' => 'nullable|string',
                'financialDetails.turnOverPreviousYear' => 'nullable|string',
                'financialDetails.operatingProfitBeforeTax' => 'nullable|string',
                'financialDetails.operatingProfitAfterTax' => 'nullable|string',
                'financialDetails.VAT' => 'nullable|string',
                'financialDetails.companyTax' => 'nullable|string',
                'financialDetails.exciseDuty' => 'nullable|string',
                'financialDetails.initialInvestment' => 'nullable|string',
                'financialDetails.totalFAIFinancialStatement' => 'nullable|string',
                'financialDetails.totalFAIAcceptanceCertificate' => 'nullable|string',
                'rawMaterials' => 'nullable|array',
                'rawMaterials.*.foreignItem' => 'nullable|string',
                'rawMaterials.*.foreignItemQuantity' => 'nullable|string',
                'rawMaterials.*.localItem' => 'nullable|string',
                'rawMaterials.*.localItemQuantity' => 'nullable|string',
                'machineryAndEquipment' => 'nullable|array',
                'machineryAndEquipment.*.equipmentName' => 'nullable|string',
                'machineryAndEquipment.*.sourceOfMachinery' => 'nullable|string',
                'energyRequirements' => 'nullable|array',
                'energyRequirements.averageEnergyConsumptionPerDay' => 'nullable|string',
                'energyRequirements.percentageContributionByDisco' => 'nullable|string',
                'energyRequirements.percentageContributionByGenerator' => 'nullable|string',
                'energyRequirements.percentageContributionByOthers' => 'nullable|string',
                'energyRequirements.quantityOfDieselUtilized' => 'nullable|string',
                'energyRequirements.quantityOfGasUtilized' => 'nullable|string',
                'environmentalImpactAssessment' => 'nullable|array',
                'environmentalImpactAssessment.*.typeOfAssessment' => 'nullable|string|in:Solid Waste Materials,Fluid Waste Materials,Gaseous Waste Materials',
                'environmentalImpactAssessment.*.degreeOfAbatementOrRemediation' => 'nullable|string',
                'investment' => 'nullable|array',
                'investment.FDI' => 'nullable|string',
                'investment.foreign' => 'nullable|string',
                'foreignCurrencyUsage' => 'nullable|array',
                'foreignCurrencyUsage.*.importedItemName' => 'nullable|string',
                'foreignCurrencyUsage.*.FX' => 'nullable|string',
                'foreignCurrencyUsage.*.currencyType' => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            try {
                return DB::transaction(function () use ($request, $company) {
                    // Update company data
                    $companyData = $request->only([
                        'companyName',
                        'natureOfBusiness',
                        'companyAddress',
                        'companyCity',
                        'state',
                        'LGA',
                        'companyPhone',
                        'companyWebsite',
                        'TIN',
                        'onStockExchange',
                        'dateListedOnSE',
                        'dateOfIncorporation',
                    ]);
                    $company->update($companyData);
    
                    // Update single-instance relationships
                    if ($request->has('financialDetails') && is_array($request->financialDetails)) {
                        $company->financialDetails()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->financialDetails
                        );
                    }
    
                    if ($request->has('productionDetails') && is_array($request->productionDetails)) {
                        $company->productionDetails()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->productionDetails
                        );
                    }
    
                    if ($request->has('staffing') && is_array($request->staffing)) {
                        $company->staffing()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->staffing
                        );
                    }
    
                    if ($request->has('energyRequirements') && is_array($request->energyRequirements)) {
                        $company->energyRequirements()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->energyRequirements
                        );
                    }
    
                    if ($request->has('investment') && is_array($request->investment)) {
                        $company->investment()->updateOrCreate(
                            ['companyId' => $company->companyId],
                            $request->investment
                        );
                    }
    
                    // Update multi-instance relationships (clear existing records)
                    if ($request->has('socialMedia') && is_array($request->socialMedia)) {
                        $company->socialMedia()->delete();
                        foreach ($request->socialMedia as $social) {
                            $company->socialMedia()->create([
                                'socialMediaName' => $social['socialMediaName'],
                                'url' => $social['url'],
                            ]);
                        }
                    }
    
                    if ($request->has('factoryLocations') && is_array($request->factoryLocations)) {
                        $company->factoryLocations()->delete();
                        foreach ($request->factoryLocations as $location) {
                            $company->factoryLocations()->create([
                                'locationName' => $location['locationName'],
                            ]);
                        }
                    }
    
                    if ($request->has('contactPersons') && is_array($request->contactPersons)) {
                        $company->contactPersons()->delete();
                        foreach ($request->contactPersons as $contact) {
                            $company->contactPersons()->create([
                                'staffName' => $contact['staffName'],
                                'designation' => $contact['designation'],
                                'phoneNumber' => $contact['phoneNumber'],
                                'email' => $contact['email'],
                            ]);
                        }
                    }
    
                    if ($request->has('products') && is_array($request->products)) {
                        $company->products()->delete();
                        foreach ($request->products as $product) {
                            $company->products()->create([
                                'productName' => $product['productName'],
                            ]);
                        }
                    }
    
                    if ($request->has('services') && is_array($request->services)) {
                        $company->services()->delete();
                        foreach ($request->services as $service) {
                            $company->services()->create([
                                'serviceName' => $service['serviceName'],
                            ]);
                        }
                    }
    
                    if ($request->has('rawMaterials') && is_array($request->rawMaterials)) {
                        $company->rawMaterials()->delete();
                        foreach ($request->rawMaterials as $material) {
                            $company->rawMaterials()->create([
                                'foreignItem' => $material['foreignItem'],
                                'foreignItemQuantity' => $material['foreignItemQuantity'],
                                'localItem' => $material['localItem'],
                                'localItemQuantity' => $material['localItemQuantity'],
                            ]);
                        }
                    }
    
                    if ($request->has('machineryAndEquipment') && is_array($request->machineryAndEquipment)) {
                        $company->machineryAndEquipment()->delete();
                        foreach ($request->machineryAndEquipment as $equipment) {
                            $company->machineryAndEquipment()->create([
                                'equipmentName' => $equipment['equipmentName'],
                                'sourceOfMachinery' => $equipment['sourceOfMachinery'],
                            ]);
                        }
                    }
    
                    if ($request->has('environmentalImpactAssessment') && is_array($request->environmentalImpactAssessment)) {
                        $company->environmentalImpactAssessment()->delete();
                        foreach ($request->environmentalImpactAssessment as $assessment) {
                            $company->environmentalImpactAssessment()->create([
                                'typeOfAssessment' => $assessment['typeOfAssessment'],
                                'degreeOfAbatementOrRemediation' => $assessment['degreeOfAbatementOrRemediation'],
                            ]);
                        }
                    }
    
                    if ($request->has('foreignCurrencyUsage') && is_array($request->foreignCurrencyUsage)) {
                        $company->foreignCurrencyUsage()->delete();
                        foreach ($request->foreignCurrencyUsage as $usage) {
                            $company->foreignCurrencyUsage()->create([
                                'importedItemName' => $usage['importedItemName'],
                                'FX' => $usage['FX'],
                                'currencyType' => $usage['currencyType'],
                            ]);
                        }
                    }
    
                    // Return the updated company with its relationships
                    return response()->json(
                        $company->load([
                            'financialDetails',
                            'socialMedia',
                            'factoryLocations',
                            'contactPersons',
                            'productionDetails',
                            'products',
                            'services',
                            'staffing',
                            'rawMaterials',
                            'machineryAndEquipment',
                            'energyRequirements',
                            'environmentalImpactAssessment',
                            'investment',
                            'foreignCurrencyUsage',
                        ])
                    );
                });
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to update company: ' . $e->getMessage()], 500);
            }
        }
    }
    