const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/* app */
mix.combine(['resources/assets/css/vendor.min.css', 'resources/assets/css/google/app.min.css'], 'public/assets/css/app.css').version();
mix.combine(['resources/assets/js/vendor.min.js', 'resources/assets/js/app.min.js'], 'public/assets/js/app.js').version();

/* login-master */
mix.minify('resources/assets/css/login-master.css', 'public/assets/css/login-master.css').version();

/* master */
mix.combine(
    [
        'resources/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css',
        'resources/assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
        'resources/assets/plugins/toastr/toastr.min.css',
        'resources/assets/plugins/select2/dist/css/select2.min.css',
        'resources/assets/plugins/datatables/css/dataTables.bootstrap5.min.css',
        'resources/assets/plugins/jquery-confirm/jquery-confirm.css'
    ],
    'public/assets/css/plugins.css').version();
mix.combine(
    [
        'resources/assets/css/cms.css',
        'resources/assets/css/cms-print.css'
    ],
    'public/assets/css/cms.css').version();

mix.combine(
    [
        'resources/assets/plugins/moment/moment.min.js',
        'resources/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        'resources/assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
        'resources/assets/plugins/select2/dist/js/select2.min.js',
        'resources/assets/plugins/parsleyjs/dist/parsley.min.js',
        'resources/assets/plugins/toastr/toastr.min.js',
        'resources/assets/plugins/datatables/js/jquery.dataTables.min.js',
        'resources/assets/plugins/datatables/js/dataTables.bootstrap5.min.js',
        'resources/assets/plugins/datatables/js/datetime-moment.js',
        'resources/assets/plugins/jquery-confirm/jquery-confirm.min.js'
    ],
    'public/assets/js/plugins.js').version();

mix.combine(
    [
        'resources/assets/js/cms.js'
    ],
    'public/assets/js/cms.js').version();

/* patients */
mix.combine(
    [
        'resources/assets/plugins/summernote/dist/summernote-lite.css',
        'resources/assets/plugins/dropzone/dropzone.min.css'
    ],
    'public/assets/css/plugins/patients.css').version();

mix.combine(
    [
        'resources/assets/plugins/print/jQuery.print.min.js',
        'resources/assets/plugins/autonumeric/autonumeric.min.js',
        'resources/assets/plugins/summernote/dist/summernote-lite.min.js',
        'resources/assets/plugins/dropzone/dropzone.min.js'
    ],
    'public/assets/js/plugins/patients.js').version();

mix.combine(
    [
        'resources/assets/js/patients/patient-visit-list.js',
        'resources/assets/js/patients/patient-label.js',
        'resources/assets/js/patients/patient-credit-list.js',
        'resources/assets/js/patients/patient-credits.js',
        'resources/assets/js/patients/patient-case-note-attachment-list.js',
        'resources/assets/js/patients/patient-case-note-attachments.js',
        'resources/assets/js/patients/patient-case-note-comment-form.js',
        'resources/assets/js/patients/patient-case-note-comment-list.js',
        'resources/assets/js/patients/patient-case-note-details.js',
        'resources/assets/js/patients/patient-case-note-form.js',
        'resources/assets/js/patients/patient-case-note-list.js',
        'resources/assets/js/patients/patient-details.js',
        'resources/assets/js/patients/patient-form.js',
        'resources/assets/js/patients/patient-list.js',
        'resources/assets/js/patients/patients.js'
    ],
    'public/assets/js/patients.js').version();

/* appointments */
mix.combine(
    [
        'resources/assets/plugins/fullcalendar/main.min.css',
        'resources/assets/plugins/bootstrap-icons/bootstrap-icons.css'
    ],
    'public/assets/css/plugins/appointments.css').version();

mix.combine(
    [
        'resources/assets/plugins/fullcalendar/main.min.js',
        'resources/assets/plugins/fullcalendar/rrule.min.js',
        'resources/assets/plugins/fullcalendar/fullcalendar-rrule.min.js',
        'resources/assets/plugins/print/jQuery.print.min.js'
    ],
    'public/assets/js/plugins/appointments.js').version();

mix.combine(
    [
        'resources/assets/js/appointment/appointment-search.js',
        'resources/assets/js/appointment/appointment-details.js',
        'resources/assets/js/appointment/appointment-form.js',
        'resources/assets/js/appointment/appointment-list.js',
        'resources/assets/js/appointment/appointment.js'
    ],
    'public/assets/js/appointments.js').version();


/* queue */
mix.combine(
    [
        'resources/assets/plugins/fullcalendar/main.min.css'
    ],
    'public/assets/css/plugins/queue.css').version();

mix.combine(
    [
        'resources/assets/plugins/fullcalendar/main.min.js',
        'resources/assets/plugins/fullcalendar/rrule.min.js',
        'resources/assets/plugins/fullcalendar/fullcalendar-rrule.min.js',
        'resources/assets/plugins/autonumeric/autonumeric.min.js',
        'resources/assets/plugins/print/jQuery.print.min.js'
    ],
    'public/assets/js/plugins/queue.js').version();

mix.combine(
    [
        'resources/assets/js/queue/queue-unknown-item.js',
        'resources/assets/js/patients/patient-label.js',
        'resources/assets/js/queue/queue-item-label.js',
        'resources/assets/js/queue/queue-invoice.js',
        'resources/assets/js/queue/queue-outside-prescription.js',
        'resources/assets/js/queue/queue-outside-prescription-list.js',
        'resources/assets/js/queue/queue-session-balance.js',
        'resources/assets/js/queue/queue-transaction-payment.js',
        'resources/assets/js/queue/queue-item-search.js',
        'resources/assets/js/queue/queue-transaction-item.js',
        'resources/assets/js/queue/queue-transaction.js',
        'resources/assets/js/queue/queue-appointment.js',
        'resources/assets/js/queue/queue-notes-modal.js',
        'resources/assets/js/queue/queue-time-picker.js',
        'resources/assets/js/queue/queue-form.js',
        'resources/assets/js/queue/queue-list.js',
        'resources/assets/js/queue/queue.js'
    ],
    'public/assets/js/queue.js').version();

/* inventory */
mix.combine(
    [
        'resources/assets/plugins/autonumeric/autonumeric.min.js'
    ],
    'public/assets/js/plugins/inventory-setup/inventory.js').version();

mix.combine(
    [
        'resources/assets/js/inventory-setup/inventory/item-details.js',
        'resources/assets/js/inventory-setup/inventory/item-form.js',
        'resources/assets/js/inventory-setup/inventory/item-list.js',
        'resources/assets/js/inventory-setup/inventory/inventory.js'
    ],
    'public/assets/js/inventory-setup/inventory.js').version();

/* packages */
mix.combine(
    [
        'resources/assets/plugins/autonumeric/autonumeric.min.js'
    ],
    'public/assets/js/plugins/inventory-setup/packages.js').version();

mix.combine(
    [
        'resources/assets/js/inventory-setup/packages/package-details.js',
        'resources/assets/js/inventory-setup/packages/package-form.js',
        'resources/assets/js/inventory-setup/packages/package-list.js',
        'resources/assets/js/inventory-setup/packages/packages.js'
    ],
    'public/assets/js/inventory-setup/packages.js').version();

/* suppliers */

mix.combine(
    [
        'resources/assets/js/inventory-setup/suppliers/supplier-details.js',
        'resources/assets/js/inventory-setup/suppliers/supplier-form.js',
        'resources/assets/js/inventory-setup/suppliers/supplier-list.js',
        'resources/assets/js/inventory-setup/suppliers/suppliers.js'
    ],
    'public/assets/js/inventory-setup/suppliers.js').version();

/* purchase orders */
mix.combine(
    [
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.css',
        'resources/assets/plugins/dropzone/dropzone.min.css'
    ],
    'public/assets/css/plugins/stock-management/purchase-orders.css').version();

mix.combine(
    [
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
        'resources/assets/plugins/autonumeric/autonumeric.min.js',
        'resources/assets/plugins/dropzone/dropzone.min.js'
    ],
    'public/assets/js/plugins/stock-management/purchase-orders.js').version();

mix.combine(
    [
        'resources/assets/js/stock-management/purchase-orders/order-attachment-list.js',
        'resources/assets/js/stock-management/purchase-orders/order-attachments.js',
        'resources/assets/js/stock-management/purchase-orders/order-payment.js',
        'resources/assets/js/stock-management/purchase-orders/order-delivery.js',
        'resources/assets/js/stock-management/purchase-orders/order-details.js',
        'resources/assets/js/stock-management/purchase-orders/order-form.js',
        'resources/assets/js/stock-management/purchase-orders/order-list.js',
        'resources/assets/js/stock-management/purchase-orders/purchase-orders.js'
    ],
    'public/assets/js/stock-management/purchase-orders.js').version();

/* stock adjustments */
mix.combine(
    [
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.css'
    ],
    'public/assets/css/plugins/stock-management/stock-adjustments.css').version();

mix.combine(
    [
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
        'resources/assets/plugins/autonumeric/autonumeric.min.js'
    ],
    'public/assets/js/plugins/stock-management/stock-adjustments.js').version();

mix.combine(
    [
        'resources/assets/js/stock-management/stock-adjustments/adjustment-details.js',
        'resources/assets/js/stock-management/stock-adjustments/adjustment-form.js',
        'resources/assets/js/stock-management/stock-adjustments/adjustment-list.js',
        'resources/assets/js/stock-management/stock-adjustments/stock-adjustments.js'
    ],
    'public/assets/js/stock-management/stock-adjustments.js').version();

/* accounting reports */
mix.combine(
    [
        'resources/assets/plugins/datatables/css/rowGroup.dataTables.min.css',
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.css'
    ],
    'public/assets/css/plugins/reports/accounting-reports.css').version();

mix.combine(
    [
        'resources/assets/plugins/print/jQuery.print.min.js',
        'resources/assets/plugins/datatables/js/dataTables.rowGroup.min.js',
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.js'
    ],
    'public/assets/js/plugins/reports/accounting-reports.js').version();

mix.combine(
    [
        'resources/assets/js/reports/accounting-reports/detailed-billing-summary.js',
        'resources/assets/js/reports/accounting-reports/owing-transaction.js',
        'resources/assets/js/reports/accounting-reports/transaction-summary.js',
        'resources/assets/js/reports/accounting-reports/accounting-reports.js'
    ],
    'public/assets/js/reports/accounting-reports.js').version();

/* inventory reports */
mix.combine(
    [
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.css',
        'resources/assets/plugins/datatables/css/rowGroup.dataTables.min.css',
    ],
    'public/assets/css/plugins/reports/inventory-reports.css').version();

mix.combine(
    [
        'resources/assets/plugins/print/jQuery.print.min.js',
        'resources/assets/plugins/datatables/js/dataTables.rowGroup.min.js',
        'resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.js'
    ],
    'public/assets/js/plugins/reports/inventory-reports.js').version();

mix.combine(
    [
        'resources/assets/js/reports/inventory-reports/drug-usage-package.js',
        'resources/assets/js/reports/inventory-reports/drug-usage-product.js',
        'resources/assets/js/reports/inventory-reports/stock-adjustment.js',
        'resources/assets/js/reports/inventory-reports/item-dispensed.js',
        'resources/assets/js/reports/inventory-reports/purchase-delivery.js',
        'resources/assets/js/reports/inventory-reports/inventory-reports.js'
    ],
    'public/assets/js/reports/inventory-reports.js').version();

/* patient reports */
mix.combine(
    [
        'resources/assets/plugins/datatables/css/rowGroup.dataTables.min.css'
    ],
    'public/assets/css/plugins/reports/patient-reports.css').version();

mix.combine(
    [
        'resources/assets/plugins/print/jQuery.print.min.js',
        'resources/assets/plugins/datatables/js/dataTables.rowGroup.min.js'
    ],
    'public/assets/js/plugins/reports/patient-reports.js').version();

mix.combine(
    [
        'resources/assets/js/reports/patient-reports/detailed-patient-history.js',
        'resources/assets/js/reports/patient-reports/patient-reports.js'
    ],
    'public/assets/js/reports/patient-reports.js').version();

/* access control */
mix.combine(
    [
        'resources/assets/js/general-setup/access-control/roles/role-form.js',
        'resources/assets/js/general-setup/access-control/roles/role-list.js',
        'resources/assets/js/general-setup/access-control/users/user-details.js',
        'resources/assets/js/general-setup/access-control/users/user-form.js',
        'resources/assets/js/general-setup/access-control/users/user-list.js',
        'resources/assets/js/general-setup/access-control/access-control.js'
    ],
    'public/assets/js/general-setup/access-control.js').version();

/* branches */
mix.combine(
    [
        'resources/assets/js/general-setup/branches/branch-details.js',
        'resources/assets/js/general-setup/branches/branch-form.js',
        'resources/assets/js/general-setup/branches/branch-list.js',
        'resources/assets/js/general-setup/branches/branches.js'
    ],
    'public/assets/js/general-setup/branches.js').version();

/* patient */
mix.combine(
    [
        'resources/assets/plugins/summernote/dist/summernote-lite.css'
    ],
    'public/assets/css/plugins/general-setup-patient.css').version();

mix.combine(
    [
        'resources/assets/plugins/summernote/dist/summernote-lite.min.js'
    ],
    'public/assets/js/plugins/general-setup-patient.js').version();

mix.combine(
    [
        'resources/assets/js/description-form.js',
        'resources/assets/js/general-setup/patient/case-note-templates/case-note-template-form.js',
        'resources/assets/js/general-setup/patient/case-note-templates/case-note-template-list.js',
        'resources/assets/js/general-setup/patient/case-type-list.js',
        'resources/assets/js/general-setup/patient/title-list.js',
        'resources/assets/js/general-setup/patient/patient.js'
    ],
    'public/assets/js/general-setup/patient.js').version();

/* appointment */
mix.combine(
    [
        'resources/assets/plugins/spectrum-colorpicker2/spectrum.min.css'
    ],
    'public/assets/css/plugins/general-setup/appointment.css').version();

mix.combine(
    [
        'resources/assets/plugins/autonumeric/autonumeric.min.js',
        'resources/assets/plugins/spectrum-colorpicker2/spectrum.min.js'
    ],
    'public/assets/js/plugins/general-setup/appointment.js').version();

mix.combine(
    [
        'resources/assets/js/general-setup/appointment/categories/category-form.js',
        'resources/assets/js/general-setup/appointment/categories/category-list.js',
        'resources/assets/js/general-setup/appointment/statuses/status-form.js',
        'resources/assets/js/general-setup/appointment/statuses/status-list.js',
        'resources/assets/js/general-setup/appointment/appointment.js'
    ],
    'public/assets/js/general-setup/appointment.js').version();

/* inventory */
mix.combine(
    [
        'resources/assets/js/description-form.js',
        'resources/assets/js/general-setup/inventory/type-list.js',
        'resources/assets/js/general-setup/inventory/category-list.js',
        'resources/assets/js/general-setup/inventory/uom-list.js',
        'resources/assets/js/general-setup/inventory/usage-list.js',
        'resources/assets/js/general-setup/inventory/dosage-list.js',
        'resources/assets/js/general-setup/inventory/frequency-list.js',
        'resources/assets/js/general-setup/inventory/inventory.js'
    ],
    'public/assets/js/general-setup/inventory.js').version();

/* finance */
mix.combine(
    [
        'resources/assets/plugins/autonumeric/autonumeric.min.js'
    ],
    'public/assets/js/plugins/general-setup/finance.js').version();

mix.combine(
    [
        'resources/assets/js/general-setup/finance/taxes/tax-form.js',
        'resources/assets/js/general-setup/finance/taxes/tax-list.js',
        'resources/assets/js/general-setup/finance/payment-modes/payment-mode-form.js',
        'resources/assets/js/general-setup/finance/payment-modes/payment-mode-list.js',
        'resources/assets/js/general-setup/finance/finance.js'
    ],
    'public/assets/js/general-setup/finance.js').version();

/* change password */
mix.combine(
    [
        'resources/assets/js/change-password.js'
    ],
    'public/assets/js/change-password.js').version();