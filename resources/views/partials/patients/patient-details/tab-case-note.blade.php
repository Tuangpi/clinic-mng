<form id="caseForm">
    <div class="row mb-2">
        <div id="addNoteContainer" class="col">
            <button type="button" id="addNote" class='btn btn-primary'>
                Add Note
            </button>
        </div>
        <div class="col-md-4 case-note-form-container" style="display: none;">
            <select id="caseType" name="caseType" class="form-select form-select-sm" required>
                <option value="" disabled selected>Select Case Type</option>
                @foreach ($caseTypes as $caseType)
                <option value="{{ $caseType->id }}">{{ $caseType->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 case-note-form-container" style="display: none;">
            <select id="template" name="template" class="form-select form-select-sm">
                <option value="" disabled selected>Select Template</option>
                @foreach ($caseNoteTemplates as $caseNoteTemplate)
                <option value="{{ $caseNoteTemplate->id }}">{{ $caseNoteTemplate->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 case-note-form-container" style="display: none;">
            <div class="input-group date">
                <input id="caseDate" name="caseDate" type="text" class="form-control form-control-sm"
                    placeholder="Select Date" required data-parsley-errors-container="#caseDate-error" />
                <span class="input-group-text input-group-addon bg-primary"><i class="fa fa-calendar"></i></span>
            </div>
            <div id="caseDate-error"></div>
        </div>
        <div class="col case-note-form-container text-end" style="display: none;">

            <button type="button" id="attachFile" class='btn btn-primary'>
                Attach File
            </button>
        </div>
    </div>
    <div class="case-note-form-container" style="display: none;">
        <div class="row">
            <div class="col">
                <div class="panel">
                    <div class="panel-body panel-body px-1px py-0">
                        <textarea class="summernote" id="caseNoteContent" required
                            data-parsley-errors-container="#caseNoteContent-error"
                            data-parsley-summernote-required=""></textarea>
                    </div>
                </div>
                <div id="caseNoteContent-error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col text-end">
                <button type="button" id="cancelCaseNote" class="btn btn-white me-1">Cancel</button>
                <button type="button" id="draftCaseNote" class="btn btn-dark-blue me-1">Save as Draft</button>
                <button type="button" id="saveCaseNote" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>
<hr class="bg-gray-600 opacity-2" />
<div class="table-responsive">
    <table id="caseNotesTable" class="table table-bordered table-striped table-hover w-100">
        <thead>
            <tr>
                <th width="1%"></th>
                <th width="1%"></th>
                <th>Case Note No.</th>
                <th>Case Type</th>
                <th>Date and Time</th>
                <th>Notes</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th>Case Note No.</th>
                <th>Case Type</th>
                <th>Date and Time</th>
                <th>Notes</th>
                <th>Created By</th>
            </tr>
        </tfoot>
    </table>
</div>