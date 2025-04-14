<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Company Status Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1, .header h2 {
            margin: 5px 0;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .field {
            margin-bottom: 8px;
        }
        .field label {
            font-weight: bold;
            display: inline-block;
            width: 300px;
            vertical-align: top;
        }
        .field span {
            display: inline-block;
        }
        .list {
            margin-left: 20px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Page 1 -->
    <div class="header">
        <h2>FEDERAL MINISTRY OF INDUSTRY, TRADE AND INVESTMENT, ABUJA</h2>
        <h2>COMPANY STATUS REPORT</h2>
        <h3>SCHEDULE II OF INDUSTRIAL INSPECTORATE ACT CAP 18 LFN 2004</h3>
    </div>
    <div class="field">
        <label>Date of Data Input:</label>
        <span>{{ now()->format('d/m/Y') }}</span>
    </div>
    <!-- <div class="field">
        <label>1. Name of Company:</label>
        <span>{{ $company->companyName ?? 'N/A' }}</span>
    </div>
    <div class="field">
        <label>R.C. No.:</label>
        <span>{{ $company->rcNumber ?? 'N/A' }}</span>
    </div> -->
   
    <!-- Add more fields as needed, assuming only basic fields for page 1 -->
    <!-- @for ($i = 2; $i <= 15; $i++)
        <div class="field">
            <label>{{ $i }}.</label>
            <span>-</span>
        </div>
    @endfor -->

    <!-- <div class="section-title">2. Quoted on the Stock Exchange? Yes or No: If Yes, input date listed</div> -->
    <table width="100%" >

<tr>
<td colspan="3">
<b>1. Name of Company:</b>
<span style="border-bottom: 1px dotted black; display: inline-block; min-width: 75%;">
    {{ $company->companyName ?? 'N/A' }}
</span>
</td>
</tr>

<tr>
<td width="50%">
  <b>RC Number:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 75%;">
  {{ $company->rcNumber ?? 'N/A' }}
  </span>
</td>

<td width="50%" colspan="2">
  <b>TIN:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 80%;">
  {{ $company->TIN ?? 'N/A' }}
  </span>
</td>
</tr>




<tr>
<td colspan="3">
  <b>2. Quoted on the Stock Exchange? Yes or No: If Yes, input date listed:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 30%;">
  {{ $company->onStockExchange ?? 'N/A' }}. {{ $company->dateListedOnSE ?? '' }} 
  </span>
</td>
</tr>

<tr>
<td colspan="3">
<b>3. Address:</b>
<span style="border-bottom: 1px dotted black; display: inline-block; min-width: 80%;">
    {{ $company->companyAddress ?? 'N/A' }}
</span>
</td>
</tr>


<tr>
<td>
  <b>City:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 30%;">
  {{ $company->companyCity ?? 'N/A' }}
  </span>
</td>

<td>
  <b>LGA:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 30%;">
  {{ $company->LGA ?? 'N/A' }}
  </span>
</td>

<td>
  <b>State:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 40%;">
  {{ $company->state ?? 'N/A' }}
  </span>
</td>
</tr>



<tr>
<td width="50%">
  <b>(a) Contact Person:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 60%;">
  @foreach ($company->contactPersons as $index => $person)
  {{ $person->staffName }}@if(!$loop->last), @endif
@endforeach
  </span>
</td>

<td width="50%" colspan="2">
  <b>Tel:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 80%;">
  @foreach ($company->contactPersons as $index => $person)
  {{ $person->phoneNumber }}@if(!$loop->last), @endif
@endforeach
  </span>
</td>
</tr>


<tr>
<td width="50%">
  <b>(b) Website:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 60%;">
  {{ $company->companyWebsite ?? 'N/A' }}
  </span>
</td>

<td width="50%" colspan="2">
  <b>Email:</b>
  <span style="border-bottom: 1px dotted black; display: inline-block; min-width: 80%;">
  {{ $company->companyEmail ?? 'N/A' }}
  </span>
</td>
</tr>


<tr>
<td colspan="3">
<b>4. Locations of Factory:</b>
<span style="border-bottom: 1px dotted black; display: inline-block; min-width: 75%;">
@foreach ($company->factoryLocations as $index => $location)
  {{ $location->locationName }}@if(!$loop->last), @endif
@endforeach


</span>
</td>
</tr>

</table>


    <!-- <div class="field">
        <label>2. Quoted on the Stock Exchange? Yes or No: If Yes, input date listed</label>
        <span>Answer: {{ $company->onStockExchange ?? 'N/A' }}. Date Listed: {{ $company->dateListedOnSE ?? 'N/A' }}</span>
    </div>

    <div class="field">
        <label>3. Address</label>
        <span>{{ $company->companyAddress ?? 'N/A' }}</span>
    </div> -->

    <!-- Page 2 -->
    <div class="page-break"></div>

    <div class="section-title">16. Major Machinery and Equipment</div>
    @if ($company->machineryAndEquipment && $company->machineryAndEquipment->isNotEmpty())
        <ul class="list">
            @foreach ($company->machineryAndEquipment as $equipment)
                <li>{{ $equipment->equipmentName ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <div class="field">
            <span>N/A</span>
        </div>
    @endif

    <div class="section-title">17. Sources of Machinery and Equipment</div>
    @if ($company->machineryAndEquipment && $company->machineryAndEquipment->isNotEmpty())
        <ul class="list">
            @foreach ($company->machineryAndEquipment as $equipment)
                <li>{{ $equipment->sourceOfMachinery ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <div class="field">
            <span>N/A</span>
        </div>
    @endif

    <div class="section-title">18. Energy Requirement</div>
    @if ($company->energyRequirements)
        <div class="field">
            <label>(a) Average energy consumption per day (KW):</label>
            <span>{{ $company->energyRequirements->averageEnergyConsumptionPerDay ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <label>(b) Percentage (%) contribution by DISCO:</label>
            <span>{{ $company->energyRequirements->percentageContributionByDisco ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <label>(c) Percentage (%) contribution by Generator:</label>
            <span>{{ $company->energyRequirements->percentageContributionByGenerator ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <label>&nbsp;&nbsp;&nbsp;&nbsp;(i) Quantity of Diesel Utilised:</label>
            <span>{{ $company->energyRequirements->quantityOfDieselUtilized ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <label>&nbsp;&nbsp;&nbsp;&nbsp;(ii) Quantity of Gas Utilised:</label>
            <span>{{ $company->energyRequirements->quantityOfGasUtilized ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <label>(d) Percentage contribution by others:</label>
            <span>{{ $company->energyRequirements->percentageContributionByOthers ?? 'N/A' }}</span>
        </div>
    @else
        <div class="field">
            <span>N/A</span>
        </div>
    @endif

    <div class="section-title">19. Water Requirement</div>
    <div class="field">
        <label>(a) Average water consumption per/day (m³):</label>
        <span>{{ $company->waterRequirements->averageWaterConsumptionPerDay ?? 'N/A' }}</span>
    </div>
    <div class="field">
        <label>(b) Percentage (%) consumption from water works:</label>
        <span>{{ $company->waterRequirements->percentageConsumptionFromWaterWorks ?? 'N/A' }}</span>
    </div>
    <div class="field">
        <label>(c) Percentage (%) consumption from borehole/water treatment plant:</label>
        <span>{{ $company->waterRequirements->percentageConsumptionFromBorehole ?? 'N/A' }}</span>
    </div>
    <div class="field">
        <label>(d) Percentage contribution from others:</label>
        <span>{{ $company->waterRequirements->percentageContributionFromOthers ?? 'N/A' }}</span>
    </div>

    <div class="section-title">20. Environmental Impact Assessment (Degree of Abatement/Remediation)</div>
    @if ($company->environmentalImpactAssessment && $company->environmentalImpactAssessment->isNotEmpty())
        <div class="field">
            <label>(i) Solid Waste Materials:</label>
            <span>
                @foreach ($company->environmentalImpactAssessment as $assessment)
                    @if ($assessment->typeOfAssessment === 'Solid Waste Materials')
                        {{ $assessment->degreeOfAbatementOrRemediation ?? 'N/A' }}
                    @endif
                @endforeach
            </span>
        </div>
        <div class="field">
            <label>(ii) Fluid Waste Materials:</label>
            <span>
                @foreach ($company->environmentalImpactAssessment as $assessment)
                    @if ($assessment->typeOfAssessment === 'Fluid Waste Materials')
                        {{ $assessment->degreeOfAbatementOrRemediation ?? 'N/A' }}
                    @endif
                @endforeach
            </span>
        </div>
        <div class="field">
            <label>(iii) Gas:</label>
            <span>
                @foreach ($company->environmentalImpactAssessment as $assessment)
                    @if ($assessment->typeOfAssessment === 'Gas')
                        {{ $assessment->degreeOfAbatementOrRemediation ?? 'N/A' }}
                    @endif
                @endforeach
            </span>
        </div>
    @else
        <div class="field">
            <span>N/A</span>
        </div>
    @endif
</body>
</html>