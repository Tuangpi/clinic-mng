<form id="labelForm">
    <input type="hidden" id="branch" value="{{ $branch }}">
    <input type="hidden" id="branchAddress" value="{{ $branchAddress }}">
    <input type="hidden" id="patient" value="{{ $patient }}">
    @foreach ($items as $item)

    <div class="card mb-2" data-tr-id="{{ $item['trId'] }}" data-tr-prod-id="{{ $item['trProductId'] }}">
        <div class="card-header">{{ $item['name'] }}</div>
        <div class="card-body">
            @if (empty($item['trId']))
            <input type="hidden" class="qty" value="{{ $item['qty'] }}">
            <input type="hidden" class="description" value="{!! nl2br($item['description']) !!}">
            @endif

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row">
                        <label class="form-label col-form-label col-form-label-sm col-md-3">Usage</label>
                        <div class="col-md-9">
                            <select class="form-select form-select-sm usage">
                                <option value="" disabled selected></option>
                                @foreach ($usages as $usage)
                                <option value="{{ $usage->id }}" @if($usage->id == $item['usage']) selected @endif>{{
                                    $usage->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <label class="form-label col-form-label col-form-label-sm col-md-3">Dosage</label>
                        <div class="col-md-9">
                            <select class="form-select form-select-sm dosage">
                                <option value="" disabled selected></option>
                                @foreach ($dosages as $dosage)
                                <option value="{{ $dosage->id }}" @if($dosage->id == $item['dosage']) selected @endif>{{
                                    $dosage->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row">
                        <label class="form-label col-form-label col-form-label-sm col-md-3">Unit</label>
                        <div class="col-md-9">
                            <select class="form-select form-select-sm unit">
                                <option value="" disabled selected></option>
                                @foreach ($uoms as $uom)
                                <option value="{{ $uom->id }}" @if($uom->id == $item['uom']) selected @endif>{{
                                    $uom->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <label class="form-label col-form-label col-form-label-sm col-md-3">Frequency</label>
                        <div class="col-md-9">
                            <select class="form-select form-select-sm frequency">
                                <option value="" disabled selected></option>
                                @foreach ($frequencies as $frequency)
                                <option value="{{ $frequency->id }}" @if($frequency->id == $item['frequency']) selected
                                    @endif>{{ $frequency->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</form>